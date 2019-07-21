<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class ZipcodesController extends AppController
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
        $this->add_model(array('Zipcodes'));
        $zipcodes = $this->paginate($this->Zipcodes);
        $zipcode = '';
        if ($id != null) {
            $zipcode = $this->Zipcodes->get($id, [
                'contain' => []
            ]);
        }

        if ($this->request->data()) {
            if ($id == null) {
                $zipcode = $this->Zipcodes->newEntity();
            }
            $zipcode = $this->Zipcodes->patchEntity($zipcode, $this->request->getData());
            $this->Zipcodes->save($zipcode);

            if ($this->Zipcodes->save($zipcode)) {
                $this->Flash->success(__('The zipcode has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zipcode could not be saved. Please, try again.'));
        }

        $this->set(compact('zipcodes', 'zipcode'));
    }

    /*
    * Story indexing using datatble
    */
    public function getDataCake()
    {
        $data = [];
        //$this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Zipcodes.id', 'Zipcodes.zip', 'Zipcodes.latitude', 'Zipcodes.longitude'];
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
        $zipcodes = $this->Zipcodes->find()
            ->select($displayableColumn)
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

        $total = $this->Zipcodes->find()->count();
        $filtered = $this->Zipcodes->find()
            ->where($where)
            ->count();
        if (count($zipcodes) > 0) {
            foreach ($zipcodes as $zipcode) {
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/zipcodes/index/' . $zipcode['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/zipcodes/delete/' . $zipcode['id'] . '"> Delete </a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $zipcode['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    // 'id' => $str,
                    'zip' => $zipcode['zip'],
                    //'created' => date_format($state['created'], 'd/m/y'),
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
        $data = $this->Zipcodes->get($id);
        if ($this->Zipcodes->delete($data)) {
            $this->Flash->success(__('The Zipcode has been deleted.'));
        } else {
            $this->Flash->error(__('The Zipcode could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
