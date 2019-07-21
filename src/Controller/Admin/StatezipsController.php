<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class StatezipsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Options');
//        $this->Auth->allow(array('index','add'));
    }

    /**
     * Index method
     **/
    public function index($id = null)
    {
        $this->add_model(array('Cities','States','Zipcodes'));
        $Statezips = $this->paginate($this->Statezips);
        $statezip = '';
        $counties = '';
        $cities = '';
        if ($id != null) {
            $statezip = $this->Statezips->get($id, [
                'contain' => ['States','Counties','Cities','Zipcodes']
            ]);
             //pr($statezip->zipcode['zip']);exit();
            $counties = $this->Statezips->Counties->find('list')->where(['state_id'=>$statezip->states['id']])->toArray();
            $cities = $this->Statezips->Cities->find('list')->where(['county_id'=>$statezip->county['id']])->toArray();

        }

        $states = $this->States->find('list')->toArray();
        $zipcodes = $this->Zipcodes->find('list')->toArray();

        if ($this->request->data()) {
            if ($id == null) {
                $statezip = $this->Statezips->newEntity();
            }
            $statezip = $this->Statezips->patchEntity($statezip, $this->request->getData());
            $this->Statezips->save($statezip);

            if ($this->Statezips->save($statezip)) {
                $this->Flash->success(__('The zipcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zipcode could not be saved. Please, try again.'));
        }

        $this->set(compact('Statezips', 'statezip','states','zipcodes','counties','cities'));
    }

    /*
    * Story indexing using datatble
    */
    public function getDataCake()
    {


        $data = [];
        $this->add_model(array('Statezips','Cities','Counties','States','Zipcodes'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Statezips.id','Zipcodes.zip','States.name','Counties.name','Cities.name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }


        foreach ($searchableColumn as $column) {
            if (!empty($params['columns'][$column]['search']['value'])) {
                $columnSearch = $params['columns'][$column]['search']['value'];
                $where = array_merge(array($displayableColumn[$column] . " LIKE '%" . $columnSearch . "%'"), $where);
            }
        }
        $Statezips = $this->Statezips->find()
            ->select($displayableColumn)
            ->contain(['counties','cities','states','zipcodes'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

           //pr($Statezips);exit;

        $total = $this->Statezips->find()->contain(['counties','cities','states','zipcodes'])->count();
        $filtered = $this->Statezips->find()
        ->contain(['counties','cities','states','zipcodes'])
            ->where($where)
            ->count();
        if (count($Statezips) > 0) {
            foreach ($Statezips as $statezip) {
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/statezips/index/' . $statezip['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/statezips/delete/' . $statezip['id'] . '"> Delete </a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $statezip['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    // 'id' => $str,
                    'zipcode' => $statezip->Zipcodes['zip'],
                    'state' => $statezip->States['name'],
                    'county' =>$statezip->Counties['name'],
                    'city' =>$statezip->Cities['name'],
                  //  'created' => date_format($county['created'], 'd/m/y'),
                    //'latitude' => 00,
                    //'longitude' => 00,
                    'action' => $actionMenu
                );
            }
        }
        $result = array
        (
            "draw" => $this->request->query['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        );
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $result = json_encode($result);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }


    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $data = $this->Statezips->get($id);
        if ($this->Statezips->delete($data)) {
            $this->Flash->success(__('The Statezip has been deleted.'));
        } else {
            $this->Flash->error(__('The Statezip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /*
   * Get county By State
   */
    public function CountyByState($state){
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States','Counties'));

        $counties = $this->Counties->find('list')->where(['state_id'=>$state])->toArray();
        $this->set(compact('counties'));
    }

    /*
     * Get city By County
     */
    public function CityByCounty($county){
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Cities','Counties'));

        $cities = $this->Cities->find('list')->where(['county_id'=>$county])->toArray();
        $this->set(compact('cities'));
    }

}
