<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class ReferralsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Options');
    }

    protected function _commonValues()
    {
        $states = $this->Referrals->States->find('list')->toArray();
        $professions = $this->Referrals->Professions->find('list')->toArray();
        $this->set(compact('states', 'professions'));
    }

    /**
     * Index method
     */
    public function index()
    {
        $this->_commonValues();
    }

    public function todaysReferrals()
    {
        $this->_commonValues();
    }

    public function ajaxTodaysReferrals()
    {
        $data = [];
        $params = $this->request->getQueryParams();
//        pr($params);
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Referrals.id', 'Referrals.name', 'Referrals.profession_id', 'Referrals.state_id',
            'Referrals.email', 'Referrals.phone', 'Referrals.address', 'Referrals.status', 'Referrals.created',
            'States.name', 'Professions.title', 'Stories.id', 'Stories.created', 'Pursues.id',
            'Pursues.user_id', 'Pursues.referral_id', 'Pursues.response', 'Pursues.pursue_date'
        ];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];

        $referralsWhere = [];
        $professionsWhere = [];
        $statesWhere = [];

        if (!empty($params['name'])) {
            $referralsWhere = array_merge(array("Referrals.name LIKE '%" . $params['name'] . "%'"), $referralsWhere);
        }
        if (!empty($params['email'])) {
            $referralsWhere = array_merge(array("Referrals.email LIKE '%" . $params['email'] . "%'"), $referralsWhere);
        }
        if (!empty($params['phone'])) {
            $referralsWhere = array_merge(array("Referrals.phone LIKE '%" . $params['phone'] . "%'"), $referralsWhere);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $referralsWhere = array_merge(array("DATE(Referrals.created) =" . $date), $referralsWhere);
        }
        if (!empty($params['status'])) {
            $referralsWhere = array_merge(array("Referrals.status " => $params['status']), $referralsWhere);
        }
        if (!empty($params['profession'])) {
            $professionsWhere = array_merge(array("Professions.id" => $params['profession']), $professionsWhere);
        }
        if (!empty($params['state'])) {
            $statesWhere = array_merge(array("States.id" => $params['state']), $statesWhere);
        }

        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }
//        foreach ($searchableColumn as $column) {
//            if (!empty($params['columns'][$column]['search']['value'])) {
//                $columnSearch = $params['columns'][$column]['search']['value'];
//                $where = array_merge(array($displayableColumn[$column] . " LIKE '%" . $columnSearch . "%'"), $where);
//            }
//        }
//        $where = array_merge(['DATE(Stories.created) = CURDATE()'], $where);

        $referrals = $this->Referrals->find('all')
            ->where($referralsWhere)
            ->matching('States', function ($q) use ($statesWhere) {
                return $q->where($statesWhere);
            })
            ->matching('Professions', function ($q) use ($professionsWhere) {
                return $q->where($professionsWhere);
            })
            ->matching('Stories', function ($q) {
                return $q->where(['DATE(Stories.created) = CURDATE()']);
            })
            ->leftJoin(
                ['Pursues' => 'pursues'],
                ['Pursues.referral_id = Referrals.id'])
            ->select($displayableColumn)
            ->offset($start)
            ->limit($length)
            ->group(['Referrals.id'])
            ->order($orderByColumn)
            ->toArray();
        //pr($referrals);exit();
        $query = $this->Referrals->find()
            ->matching('States', function ($q) use ($statesWhere) {
                return $q->where($statesWhere);
            })
            ->matching('Professions', function ($q) use ($professionsWhere) {
                return $q->where($professionsWhere);
            })
            ->matching('Stories', function ($q) {
                return $q->where(['DATE(Stories.created) = CURDATE()']);
            })
            ->leftJoin(
                ['Pursues' => 'pursues'],
                ['Pursues.referral_id = Referrals.id'])
            ->select($displayableColumn)
            ->where($referralsWhere)
            ->group(['Referrals.id']);

        $total = count($query->toArray());
        $filtered = $query->count();

        if (count($referrals) > 0) {
            foreach ($referrals as $referral) {
                if ($referral['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($referral['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($referral['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($referral['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/referrals/edit/' . $referral['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/referrals/change_status/' . $referral['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $referral['id'] . '">
                            <span></span>
                        </label>';

                $pursue = '<a href="#" class="view-pursues" id="referrals-pursues-' . $referral['id'] . '">View Details</a>';
                $story = '<a href="#" class="view-stories" id="referrals-stories-' . $referral['id'] . '">View Details</a>';

                $data[] = array(
                    'id' => $str,
                    'profession' => $referral->_matchingData['Professions']['title'],
                    'name' => $referral['name'],
                    'phone' => $referral['phone'],
                    'email' => $referral['email'],
                    'address' => $referral['address'],
                    'state' => $referral->_matchingData['States']['name'],
                    'status' => $status,
                    'pursue' => $pursue,
                    'story' => $story,
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
     *
     */
    public function ajaxGetTodaysStoriesByReferral()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $response['success'] = true;
        if ($this->request->is('get')) {
            $data = $this->request->getQueryParams();
            if (isset($data['referral_id']) && !empty($data['referral_id'])) {
                $response['data'] = $this->Referrals->Stories->getTodaysStoriesByReferral($data['referral_id']);
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid request! Referral id is missing';
            }
        }
        echo json_encode($response);
    }

    /**
     *
     */
    public function ajaxGetPursuesByReferral()
    {
        $this->autoRender = false;
        $this->viewBuilder()->setLayout('ajax');
        $response['success'] = true;
        if ($this->request->is('get')) {
            $data = $this->request->getQueryParams();
            if (isset($data['referral_id']) && !empty($data['referral_id'])) {
                $response['data'] = $this->Referrals->Pursues->getPursuesByReferral($data['referral_id'], $this->loggedinUser['id']);
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid request! Referral id is missing';
            }
        }
        echo json_encode($response);
    }

    /*
     * Referral indexing using datatble
     */

    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Referrals', 'States', 'Professions'));
        $params = $this->request->getQueryParams();
        //pr($params);exit();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Referrals.id', 'Referrals.name', 'Referrals.profession_id', 'Referrals.state_id', 'Referrals.email', 'Referrals.status', 'Referrals.created', 'States.name', 'Professions.title'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['name'])) {
            $where = array_merge(array("Referrals.name LIKE '%" . $params['name'] . "%'"), $where);
        }
        if (!empty($params['email'])) {
            $where = array_merge(array("Referrals.email LIKE '%" . $params['email'] . "%'"), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Referrals.created) =" . $date), $where);
        }
        if (!empty($params['profession'])) {
            $where = array_merge(array("Professions.id" => $params['profession']), $where);
        }
        if (!empty($params['state'])) {
            $where = array_merge(array("States.id" => $params['state']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Referrals.status " => $params['status']), $where);
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
        $referrals = $this->Referrals->find()
            ->select($displayableColumn)
            ->contain(['Professions', 'States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
        $total = $this->Referrals->find()->count();
        $filtered = $this->Referrals->find()->contain(['Professions', 'States'])
            ->where($where)
            ->count();
        if (count($referrals) > 0) {
            foreach ($referrals as $referral) {
                if ($referral['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($referral['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($referral['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($referral['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/referrals/edit/' . $referral['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/referrals/change_status/' . $referral['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $referral['id'] . '">
                            <span></span>
                        </label>';

                $data[] = array(
                    'id' => $str,
                    'profession' => $referral['profession']['title'],
                    'name' => $referral['name'],
                    //'user_id' => $referral['user']['first_name'] . ' ' . $referral['user']['last_name'],
                    //'created' => date_format($referral['created'], 'd/m/y'),
                    'email' => $referral['email'],
                    'state' => $referral['state']['name'],
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
     * View method
     *
     */
    public function view($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => ['States', 'Stories']
        ]);

        $this->set('referral', $referral);
    }

    /**
     * Add method
     */
    public function add()
    {
        $referral = $this->Referrals->newEntity();
        if ($this->request->is('post')) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            //by default referral is active
            $referral->is_active = 1;
            $referral->user_id = $this->Auth->user('id');
//            pr($referral);exit;
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referral could not be saved. Please, try again.'));
        }
        //$states = $this->Referrals->States->find('list', ['limit' => 200]);
        $stories = $this->Referrals->Stories->find('list', ['limit' => 200]);

        $professions = $this->Referrals->Professions->find('list')->toArray();
        $states = $this->Referrals->States->find('list')->toArray();
        $this->set(compact('referral', 'states', 'stories', 'professions'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $this->accessControl($id, 'Referrals');

        $referral = $this->Referrals->find('all')
            ->contain(['Stories', 'States', 'Counties', 'Cities'])
            ->where(['Referrals.id'=>$id])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referral could not be saved. Please, try again.'));
        }
        $states = $this->Referrals->States->find('list', ['limit' => 200]);
        $cities = array();
        $counties = array();
        if (isset($referral->county->id)) {
            $cities = $this->Cities->find('list')->where(['county_id' => $referral->county->id])->toArray();
        }
        if (isset($referral->state->id)) {
            $counties = $this->Counties->find('list')->where(['state_id' => $referral->state->id])->toArray();
        }
        $stories = $this->Referrals->Stories->find('list', ['limit' => 200]);
        $professions = $this->Referrals->Professions->find('list')->toArray();
        $this->set(compact('referral', 'states', 'stories', 'professions', 'counties', 'cities'));
    }

    /*
     * Get Location By Zip
     */

    public function locationByZip()
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Zipcodes', 'Statezips', 'Counties', 'Cities', 'States'));
        if (isset($this->request->data)) {
            $data = $this->request->data;
            $zipcode = $data['zipcode'];
            $zipData = $this->Zipcodes->find('all')->where(['zip' => $data['zipcode']])->first();

            $locationData = $this->Statezips->find('all')
                ->where(['zip_id' => $zipData['id']])
                ->contain(['Counties', 'Cities', 'States'])
                ->first();

            if (empty($locationData)) {
                $this->Flash->error(__('Not Found!'));
                $this->autoRender = false;
                $responseResult = json_encode(array('response' => false, 'msg' => 'Not Found!'));
                $this->response->type('json');
                $this->response->body($responseResult);

                return $this->response;
            } else {
                $states = $this->States->find('list')->toArray();
                $counties = array();
                $cities = array();
                if (isset($locationData->state_id) && $locationData->state_id!=''){
                    $counties = $this->Counties->find('list')->where(['state_id'=>$locationData->state_id])->toArray();
                }
                if (isset($locationData->county_id) && $locationData->county_id!=''){
                    $cities = $this->Cities->find('list')->where(['county_id'=>$locationData->county_id])->toArray();
                }
                $this->set(compact('locationData', 'cities', 'states', 'counties', 'zipcode'));
            }
        }
    }

    /*
     * Get county By State
     */

    public function countyByState($state)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States', 'Counties'));
        $counties = array();
        if ($state != 0) {
            $counties = $this->Counties->find('list')->where(['state_id' => $state])->toArray();
        }
        $this->set(compact('counties'));
    }

    /*
     * Get city By County
     */

    public function cityByCounty($county)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Cities', 'Counties'));
        $cities = array();
        if ($county != 0) {
            $cities = $this->Cities->find('list')->where(['county_id' => $county])->toArray();
        }
        $this->set(compact('cities'));
    }


    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $referral = $this->Referrals->get($id);
        if ($this->Referrals->delete($referral)) {
            $this->Flash->success(__('The referral has been deleted.'));
        } else {
            $this->Flash->error(__('The referral could not be deleted. Please, try again.'));
        }

        return $this->redirect('/admin/referrals/index');
    }

    /*
     * Status change
     */

    public function changeStatus($id = null, $status = null)
    {
        $this->add_model(array('Referrals'));
        if ($status == 5) {
            return $this->delete($id);
        }
        $agency = $this->Referrals->get($id);
        $agency['status'] = $status;
        if ($this->Referrals->save($agency)) {
            $this->Flash->success(__('The status has been changed.'));
        } else {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /*
     * Delete Permanently
     */

    public function deleteReferral()
    {
        $this->add_model(array('Referrals'));
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->Referrals->deleteAll(['Referrals.id IN' => $data])) {
                $this->Flash->success(__('The Referral has been deleted.'));
                $response = true;
                $msg = '';
            } else {
                $msg = 'Sorry! Referral Can not be deleted.';
            }
        } else {
            $msg = 'Please! Select Atleast one Referral.';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

}
