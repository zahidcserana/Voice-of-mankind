<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class AgenciesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Options');
        //$this->Auth->allow();
    }

    /**
     * Listing all Agency
     */
    public function index()
    {
        $this->add_model(array('Agencies'));
        $this->paginate = [
            'contain' => ['Users', 'States']
        ];
        $agencies = $this->paginate($this->Agencies);
        $agencyTypes = $this->Options->getAgencyTypes();

        $this->set(compact('agencies', 'agencyTypes'));
    }

    /*
    * Story indexing using datatble
    */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Agencies.id', 'Agencies.name', 'Agencies.email', 'Agencies.type', 'Agencies.status', 'Agencies.created', 'Agencies.user_id', 'Users.first_name', 'Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['name'])) {
            $where = array_merge(array("Agencies.name LIKE '%" . $params['name'] . "%'"), $where);
        }
        if (!empty($params['email'])) {
            $where = array_merge(array("Agencies.email LIKE '%" . $params['email'] . "%'"), $where);
        }
        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Agencies.created) =" . $date), $where);

        }
        if (!empty($params['type'])) {
            $where = array_merge(array("Agencies.type" => $params['type']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Agencies.status " => $params['status']), $where);
        }

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
        $agencies = $this->Agencies->find()
            ->select($displayableColumn)
            ->contain(['Users', 'States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

        $total = $this->Agencies->find()->count();
        $filtered = $this->Agencies->find()->contain(['Users', 'States'])
            ->where($where)
            ->count();
        if (count($agencies) > 0) {
            foreach ($agencies as $agency) {
                if ($agency['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($agency['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($agency['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($agency['status'] == 4) {
                    $statusId = 5;
                    $statusName = 'Delete Permanently';
                    $status = '<button type="button" class="m-btn--pill btn btn-warning btn-sm">Deleted</button>';
                }
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/agencies/edit/' . $agency['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/agencies/change_status/' . $agency['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $agency['id'] . '">
                            <span></span>
                        </label>';
                $agencyTypes = $this->Options->getAgencyTypes();
                foreach ($agencyTypes as $k => $v) {
                    if ($k == $agency['type']) {
                        $agencyName = $v;
                    }
                }
                $data[] = array(
                    'id' => $str,
                    'name' => $agency['name'],
                    //'user_id' => $agency['user']['first_name'] . ' ' . $agency['user']['last_name'],
                    //'created' => date_format($agency['created'], 'd/m/y'),
                    'email' => $agency['email'],
                    'type' => $agencyName,
                    'status' => $status,
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
     * View Agency
     */
    public function view($id = null)
    {
        $this->add_model(array('Agencies'));
        $agency = $this->Agencies->get($id, [
            'contain' => ['Users', 'States', 'Agencies', 'Stories']
        ]);

        $this->set('agency', $agency);
    }

    /**
     * Add Agency
     */
    public function add()
    {
        $this->add_model(array('Agencies'));
        $agency = $this->Agencies->newEntity();
        if ($this->request->is('post')) {
            $agency = $this->Agencies->patchEntity($agency, $this->request->getData());
            //by default agency will be active
            $agency->is_active = 1;
            $agency->user_id = $this->Auth->user('id');
            //$result = $this->Agencies->save($agency);
            //pr($agency->errors());exit();
            if ($this->Agencies->save($agency)) {
                $this->Flash->success(__('The agency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agency could not be saved. Please, try again.'));
        }
        $states = $this->Agencies->States->find('list')->toArray();
        $agencyTypes = $this->Options->getAgencyTypes();
        $this->set(compact('agency', 'agencyTypes', 'states'));
    }

    /**
     * Edit Agency
     */
    public function edit($id = null)
    {
        $this->accessControl($id,'Agencies');
        $this->add_model(array('Agencies','Counties', 'Cities', 'States'));
        $agency = $this->Agencies->get($id, [
            'contain' => ['Counties', 'Cities', 'States']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $agency = $this->Agencies->patchEntity($agency, $this->request->getData());
            //$result =$this->Agencies->save($agency);

            if ($this->Agencies->save($agency)) {
                $this->Flash->success(__('The agency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agency could not be saved. Please, try again.'));
        }
        //pr($agency);exit();
        $users = $this->Agencies->Users->find('list', ['limit' => 200]);
        $states = $this->Agencies->States->find('list')->toArray();
        $counties = array();
        $cities = array();
        if (isset($agency->state->id)){
            $counties = $this->Counties->find('list')->where(['state_id'=>$agency->state->id])->toArray();
        }
        if (isset($agency->county->id)){
            $cities = $this->Cities->find('list')->where(['county_id'=>$agency->county->id])->toArray();
        }
        $agencyTypes = $this->Options->getAgencyTypes();
        $this->set(compact('agency', 'users', 'states', 'agencyTypes','cities','counties'));
    }

    /**
     * Delete Agency Permanently
     */
    public function delete($id = null)
    {
        $this->add_model(array('Agencies'));
        $agency = $this->Agencies->get($id);
        if ($this->Agencies->delete($agency)) {
            $this->Flash->success(__('The agency has been deleted.'));
        } else {
            $this->Flash->error(__('The agency could not be deleted. Please, try again.'));
        }

        return $this->redirect('/admin/agencies/index');
    }

    /*
     * Status change
     */
    public function changeStatus($id = null, $status = null)
    {
        $this->add_model(array('Agencies'));
        if ($status == 5) {
            return $this->delete($id);
        }
        $agency = $this->Agencies->get($id);
        $agency['status'] = $status;
        if ($this->Agencies->save($agency)) {
            $this->Flash->success(__('The status has been changed.'));
        } else {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /*
     * Delete Permanently
     */
    public function deleteAgency()
    {
        $this->add_model(array('Agencies'));
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->Agencies->deleteAll(['Agencies.id IN' => $data])) {
                $this->Flash->success(__('The Agency has been deleted.'));
                $response = true;
                $msg = '';
            } else {
                $msg = 'Sorry! Agency Can not be deleted.';
            }
        } else {
            $msg = 'Please! Select Atleast one Agency.';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }
}
