<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class StatesController extends AppController
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
        $this->add_model(array('States'));
        $states = $this->paginate($this->States);
        $state = '';
        if ($id != null) {
            $state = $this->States->get($id, [
                'contain' => []
            ]);
        }

        if ($this->request->data()) {
            if ($id == null) {
                $state = $this->States->newEntity();
            }
            $state = $this->States->patchEntity($state, $this->request->getData());
            $this->States->save($state);

            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }

        $this->set(compact('states', 'state'));
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
        $displayableColumn = ['States.id', 'States.name', 'States.latitude', 'States.longitude', 'States.created'];
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
        $states = $this->States->find()
            ->select($displayableColumn)
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

        $total = $this->States->find()->count();
        $filtered = $this->States->find()
            ->where($where)
            ->count();
        if (count($states) > 0) {
            foreach ($states as $state) {
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/states/index/' . $state['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/states/delete/' . $state['id'] . '"> Delete </a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $state['id'] . '">
                            <span></span>
                        </label>';
                $stateTypes = $this->Options->getAgencyTypes();
                foreach ($stateTypes as $k => $v) {
                    if ($k == $state['type']) {
                        $stateName = $v;
                    }
                }
                $data[] = array(
                    // 'id' => $str,
                    'name' => $state['name'],
                    'created' => date_format($state['created'], 'd/m/y'),
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
     * View method
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => ['Agencies', 'Referrals', 'Users']
        ]);

        $this->set('state', $state);
    }

    /**
     * Add method
     */
    public function add()
    {
        $state = $this->States->newEntity();
        if ($this->request->is('post')) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $this->set(compact('state'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $this->set(compact('state'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
