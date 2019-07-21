<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class CountiesController extends AppController
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
        $this->add_model(array('Counties','States'));
        $counties = $this->paginate($this->Counties);
        $county = '';
        if ($id != null) {
            $county = $this->Counties->get($id, [
                'contain' => ['States']
            ]);
        }
        $states = $this->States->find('list')->toArray();

        if ($this->request->data()) {
            if ($id == null) {
                $county = $this->Counties->newEntity();
            }
            $county = $this->Counties->patchEntity($county, $this->request->getData());
            $this->Counties->save($county);

            if ($this->Counties->save($county)) {
                $this->Flash->success(__('The county has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The county could not be saved. Please, try again.'));
        }

        $this->set(compact('counties', 'county','states'));
    }

    /*
    * Story indexing using datatble
    */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('States','Counties'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Counties.id', 'Counties.name', 'Counties.latitude', 'Counties.longitude', 'Counties.created','States.name'];
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
        $counties = $this->Counties->find()
            ->select($displayableColumn)
            ->contain(['States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

            //pr($counties);exit;

        $total = $this->Counties->find()->contain(['States'])->count();
        $filtered = $this->Counties->find()
        ->contain(['States'])
            ->where($where)
            ->count();
        if (count($counties) > 0) {
            foreach ($counties as $county) {
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/counties/index/' . $county['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/counties/delete/' . $county['id'] . '"> Delete </a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $county['id'] . '">
                            <span></span>
                        </label>';

                $data[] = array(
                    // 'id' => $str,
                    'name' => $county['name'],
                    'state' => $county->state['name'],
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
        $data = $this->Counties->get($id);
        if ($this->Counties->delete($data)) {
            $this->Flash->success(__('The County has been deleted.'));
        } else {
            $this->Flash->error(__('The County could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
