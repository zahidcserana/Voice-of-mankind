<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class CitiesController extends AppController
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
        $this->add_model(array('Cities','States','Counties'));
        $cities = $this->paginate($this->Cities);
        $city = '';
        $counties = '';
        if ($id != null) {
            $city = $this->Cities->get($id, [
                'contain' => ['Counties.States']
            ]);
            $counties = $this->Counties->find('list')->where(['state_id'=>$city->county->state_id])->toArray();
        }
        if ($this->request->data()) {
            if ($id == null) {
                $city = $this->Cities->newEntity();
            }
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            $this->Cities->save($city);

            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        //pr($city);exit();
        $states = $this->States->find('list')->toArray();
        $this->set(compact('cities', 'city','states','counties'));
    }

    /*
    * Story indexing using datatble
    */
    public function getDataCake()
    {


        $data = [];
        $this->add_model(array('Cities','Counties','States'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Cities.id', 'Cities.name', 'Cities.latitude', 'Cities.longitude', 'Cities.created','Counties.name','States.name'];
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
        $cities = $this->Cities->find()
            ->select($displayableColumn)
            ->contain(['Counties.States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

           //pr($cities);exit;

        $total = $this->Cities->find()->contain(['Counties.States'])->count();
        $filtered = $this->Cities->find()
        ->contain(['Counties.States'])
            ->where($where)
            ->count();
        if (count($cities) > 0) {
            foreach ($cities as $city) {
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/cities/index/' . $city['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/cities/delete/' . $city['id'] . '"> Delete </a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $city['id'] . '">
                            <span></span>
                        </label>';
                // $countyTypes = $this->Options->getAgencyTypes();
                // foreach ($countyTypes as $k => $v) {
                //     if ($k == $county['type']) {
                //         $countyName = $v;
                //     }
                // }
                //pr($county);exit;
                $data[] = array(
                    // 'id' => $str,
                    'name' => $city['name'],
                    'state' => $city->county->state['name'],
                    'county' =>$city->county['name'],
                  //  'created' => date_format($county['created'], 'd/m/y'),
                    'latitude' => 00,
                    'longitude' => 00,
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
        $data = $this->Cities->get($id);
        if ($this->Cities->delete($data)) {
            $this->Flash->success(__('The City has been deleted.'));
        } else {
            $this->Flash->error(__('The City could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function countyByState($state){
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States','Counties'));

        $counties = $this->Counties->find('list')->where(['state_id'=>$state])->toArray();
        $this->set(compact('counties'));
    }

}
