<?php

namespace App\Controller\admin;

use App\Controller\AppController;

class StoriesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Options');
    }

    /*
     * PDF Generator
     */
    public function pdfBuild()
    {
        $this->viewBuilder()->layout('ajax');
        $stories = $this->request->session()->read('stories');
        $this->set(compact('stories'));
        $this->set('ctp', 'stories');  // ctp file name
        $this->response->type('pdf');
        $this->render('/Element/pdf_view');
    }

    /*
     * CSV File Generator
     */
    public function csvFile()
    {
        $data = $this->request->session()->read('stories');
        $_serialize = 'data';

        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }

    /**
     * List all Story
     */
    public function index()
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $this->paginate = [
            'contain' => ['Users', 'Agencies'],
            'conditions' => $conditions
        ];
        $this->add_model(array('Agencies'));
        $stories = $this->paginate($this->Stories);
        $agencies = $this->Agencies->find('list')->toArray();
        //pr($agencies);exit();
        $storyStatuses = $this->Options->getStoryStatuses();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->request->session()->write('stories', $stories);
        $this->set(compact('stories', 'storyStatuses', 'storyCategories', 'agencies', 'agencyTypes'));
    }

    /*
     * Story indexing using datatble
     */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies', 'Categories'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Stories.id', 'Stories.title', 'Stories.user_id', 'Stories.created', 'Stories.agency_id', 'Stories.status', 'Agencies.name', 'Agencies.type', 'Users.first_name', 'Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['title'])) {
            $where = array_merge(array("Stories.title LIKE '%" . $params['title'] . "%'"), $where);
        }
        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Stories.created) =" . $date), $where);

        }
        if (!empty($params['agency_type'])) {
            $where = array_merge(array("Agencies.type" => $params['agency_type']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Stories.status " => $params['status']), $where);
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
        $stories = $this->Stories->find()
            ->select($displayableColumn)
            ->contain(['Users', 'Agencies', 'Categories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
//pr($stories);exit();
        $total = $this->Stories->find()->count();
        $filtered = $this->Stories->find()->contain(['Users', 'Agencies'])
            ->where($where)
            ->count();
        if (count($stories) > 0) {
            foreach ($stories as $story) {
                if ($story['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($story['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($story['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($story['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/stories/edit/' . $story['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/stories/view/' . $story['id'] . '">View</a>
                        <a class="dropdown-item" href="/admin/stories/change_status/' . $story['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $story['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'title' => $story['title'],
                    'user_id' => $story['user']['first_name'] . ' ' . $story['user']['last_name'],
                    'created' => date_format($story['created'], 'd/m/y'),
                    'agency_id' => $story['agency']['name'],
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
     * List all Story
     */
    public function todays()
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $this->paginate = [
            'contain' => ['Users', 'Agencies'],
            'conditions' => $conditions
        ];
        $this->add_model(array('Agencies'));
        $stories = $this->paginate($this->Stories);
        $agencies = $this->Agencies->find('list')->toArray();
        //pr($agencies);exit();
        $storyStatuses = $this->Options->getStoryStatuses();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->request->session()->write('stories', $stories);
        $this->set(compact('stories', 'storyStatuses', 'storyCategories', 'agencies', 'agencyTypes'));
    }

    /*
     * Story indexing using datatble
     */
    public function getDataTodays()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies', 'Categories'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Stories.id', 'Stories.title', 'Stories.user_id', 'Stories.created', 'Stories.agency_id', 'Stories.status', 'Agencies.name', 'Agencies.type', 'Users.first_name', 'Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['title'])) {
            $where = array_merge(array("Stories.title LIKE '%" . $params['title'] . "%'"), $where);
        }
        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Stories.created) =" . $date), $where);

        }else{
            //$where = array('DATE(Stories.created) = CURDATE()');
            $where = array_merge(array('DATE(Stories.created) = CURDATE()'), $where);
        }
        if (!empty($params['agency_type'])) {
            $where = array_merge(array("Agencies.type" => $params['agency_type']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Stories.status " => $params['status']), $where);
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
        $stories = $this->Stories->find()
            ->select($displayableColumn)
            ->contain(['Users', 'Agencies', 'Categories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
//pr($stories);exit();
        $total = $this->Stories->find()->count();
        $filtered = $this->Stories->find()->contain(['Users', 'Agencies'])
            ->where($where)
            ->count();
        if (count($stories) > 0) {
            foreach ($stories as $story) {
                if ($story['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($story['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($story['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($story['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/stories/edit/' . $story['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/stories/view/' . $story['id'] . '">View</a>
                        <a class="dropdown-item" href="/admin/stories/change_status/' . $story['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $story['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'title' => $story['title'],
                    'user_id' => $story['user']['first_name'] . ' ' . $story['user']['last_name'],
                    'created' => date_format($story['created'], 'd/m/y'),
                    'agency_id' => $story['agency']['name'],
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
     * List all Story By Category
     */
    public function storiesByCategory()
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $this->paginate = [
            'contain' => ['Users', 'Agencies'],
            'conditions' => $conditions
        ];
        $this->add_model(array('Agencies'));
        $stories = $this->paginate($this->Stories);
        $agencies = $this->Agencies->find('list')->toArray();

        $storyStatuses = $this->Options->getStoryStatuses();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();

        $this->request->session()->write('stories', $stories);
        $this->set(compact('stories', 'storyStatuses', 'storyCategories', 'agencies', 'agencyTypes'));
    }

    /*
     * Story indexing using datatble
     */
    public function getstoriesByCategory()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies', 'Categories'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Stories.id', 'Stories.title', 'Stories.user_id', 'Stories.created', 'Stories.agency_id', 'Stories.status', 'Agencies.name', 'Agencies.type', 'Users.first_name', 'Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];
        $whereCategory = [];
        if (!empty($params['title'])) {
            $where = array_merge(array("Stories.title LIKE '%" . $params['title'] . "%'"), $where);
        }
        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Stories.created) =" . $date), $where);

        }
        if (!empty($params['agency_type'])) {
            $where = array_merge(array("Agencies.type" => $params['agency_type']), $where);
        }
        if (!empty($params['category'])) {
            $whereCategory = array("Categories.id" => $params['category']);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Stories.status " => $params['status']), $where);
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
        $stories = $this->Stories->find()
            ->select($displayableColumn)
            ->contain(['Users', 'Agencies', 'Categories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->matching('Categories', function ($q) use ($whereCategory) {
                return $q->where($whereCategory)
                    ->order('Categories.id = DESC');
            })
            ->toArray();
        $total = $this->Stories->find()->count();
        $filtered = $this->Stories->find()->contain(['Users', 'Agencies', 'Categories'])
            ->where($where)
            ->matching('Categories', function ($q) use ($whereCategory) {
                return $q->where($whereCategory)
                    ->order('Categories.id = DESC');
            })
            ->count();
        if (count($stories) > 0) {
            foreach ($stories as $story) {
                if ($story['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($story['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($story['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($story['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/stories/edit/' . $story['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/stories/view/' . $story['id'] . '">View</a>
                        <a class="dropdown-item" href="/admin/stories/change_status/' . $story['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $story['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'category' => $story->categories[0]['title'],
                    'title' => $story['title'],
                    'user_id' => $story['user']['first_name'] . ' ' . $story['user']['last_name'],
                    'created' => date_format($story['created'], 'd/m/y'),
                    'agency_id' => $story['agency']['name'],
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
     * List all Story
     */
    public function pending()
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $this->paginate = [
            'contain' => ['Users', 'Agencies'],
            'conditions' => $conditions
        ];
        $this->add_model(array('Agencies'));
        $stories = $this->paginate($this->Stories);
        $agencies = $this->Agencies->find('list')->toArray();
        //pr($agencies);exit();
        $storyStatuses = $this->Options->getStoryStatuses();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->request->session()->write('stories', $stories);
        $this->set(compact('stories', 'storyStatuses', 'storyCategories', 'agencies', 'agencyTypes'));
    }

    /*
     * Story indexing using datatble
     */
    public function getPending()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Stories.id', 'Stories.title', 'Stories.user_id', 'Stories.created', 'Stories.agency_id', 'Stories.status', 'Agencies.name', 'Agencies.type', 'Users.first_name', 'Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = array("Stories.status " => 3);

        if (!empty($params['title'])) {
            $where = array_merge(array("Stories.title LIKE '%" . $params['title'] . "%'"), $where);
        }
        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Stories.created) =" . $date), $where);

        }
        if (!empty($params['agency_type'])) {
            $where = array_merge(array("Agencies.type" => $params['agency_type']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Stories.status " => $params['status']), $where);
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
        $stories = $this->Stories->find()
            ->select($displayableColumn)
            ->contain(['Users', 'Agencies'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();

        $total = $this->Stories->find()->count();
        $filtered = $this->Stories->find()->contain(['Users', 'Agencies'])
            ->where($where)
            ->count();
        if (count($stories) > 0) {
            foreach ($stories as $story) {
                if ($story['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($story['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($story['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($story['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/stories/edit/' . $story['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/stories/view/' . $story['id'] . '">View</a>
                        <a class="dropdown-item" href="/admin/stories/change_status/' . $story['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $story['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'title' => $story['title'],
                    'user_id' => $story['user']['first_name'] . ' ' . $story['user']['last_name'],
                    'created' => date_format($story['created'], 'd/m/y'),
                    'agency_id' => $story['agency']['name'],
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

    /*
     * Story delete
     */
    public function deleteStory()
    {
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->Stories->deleteAll(['Stories.id IN' => $data])) {
                $this->Flash->success(__('The story has been deleted.'));
                $response = true;
                $msg = '';
            } else {
                $msg = 'Sorry! Story Can not be deleted.';
            }
        } else {
            $msg = 'Please! Select Atleast one story.';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

    /**
     * get story By Category
     */
    public function storyByCategory($catId = null)
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $stories = array();
        if ($catId) {
            $query = $this->Stories->find('all', [
                'contain' => ['Users', 'Agencies'],
                'conditions' => $conditions
            ])->innerJoinWith('Categories', function ($q) use ($catId) {
                return $q->where(['Categories.id' => $catId]);
            });
            $stories = $this->paginate($query);
        }
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->set(compact('stories', 'storyStatuses', 'storyCategories'));
    }

    /**
     * get story By Month
     */
    public function storiesByMonth($intTimeVal = '')
    {
        $conditions = array();
        if (!$this->loggedinUser) {
            $conditions['is_public'] = 1;
        }
        $stories = array();
        if ($intTimeVal) {
            $startDate = date('Y-m-01', $intTimeVal);
            $endDate = date('Y-m-t', $intTimeVal);
            $conditions['DATE(Stories.created) >='] = $startDate;
            $conditions['DATE(Stories.created) <='] = $endDate;

            $query = $this->Stories->find('all', [
                'contain' => ['Users', 'Agencies'],
                'conditions' => $conditions
            ]);
            $stories = $this->paginate($query)->toArray();
        }
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->set(compact('stories', 'storyStatuses', 'storyCategories'));
    }

    /**
     * View Story details
     */
    public function view($id = null)
    {
        $storyStatuses = $this->Options->getStoryStatuses();
        //$referrals = $this->Stories->Referrals->find('list');
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $story = $this->Stories->get($id, [
            'contain' => ['Users', 'Agencies', 'Categories', 'Referrals', 'Media', 'ReformIdeas', 'Ratings']
        ]);

        if (empty($story->description)) {
            $this->redirect(['controller' => 'stories', 'action' => 'add_details', $story->id]);
        } else if (empty($story->referrals)) {
            $this->redirect(['controller' => 'stories', 'action' => 'add_referral', $story->id]);
        }
        $selectedReferralId = empty($story->referrals) ? '' : $story->referrals[0]->id; //when updating
        $selectedProfessionId = empty($story->referrals) ? '' : $story->referrals[0]->profession_id; //when updating
        $referrals = array();
        if ($selectedProfessionId) {
            $referrals = $this->Stories->Referrals->find('list', [
                'conditions' => ['Referrals.profession_id' => $selectedProfessionId]
            ]);
        }
        $professions = $this->Stories->Referrals->Professions->find('list');
        // pr($story);exit();
        $mediaTypes = $this->Options->getMediaTypes();
        $commentsTotalPaginationPages = $this->Stories->Comments->getTotalPaginationLinks($id, 10);//for ajaxified comment pagination
        $this->set(compact('story','storyStatuses', 'agencyTypes', 'professions', 'referrals', 'selectedReferralId', 'selectedProfessionId', 'commentsTotalPaginationPages', 'mediaTypes', 'states'));
    }

    /**
     * Add Story
     */
    public function add()
    {
        $story = $this->Stories->newEntity();
        if ($this->request->is('post')) {
            if (strlen(trim($this->request->getData('title'))) > 0) {
                $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses());
                if ($response['success']) {
                    $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
                } else {
                    $this->Flash->error(__('The story could not be saved. ' . $response['error_message']));
                }
            } else {
                $this->Flash->error(__('Save Failed! A story must have a title. Please add a story title.'));
            }
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $this->set(compact('story', 'agencyTypes', 'states'));
    }

    /*
     * Add Details
     */
    public function addDetails($id = null)
    {
        $story = $this->Stories->get($id, [
            'contain' => ['Users', 'Agencies', 'Categories', 'Referrals', 'Media']
        ]);
        //$story = $this->Stories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if (strlen(trim($this->request->getData('description'))) > 0) {
                $saveResponse = $this->Stories->addDetails($story, $this->request->getData());

                if ($saveResponse['success']) {
                    $this->Flash->success(__('The story details has been saved.'));
                    $this->redirect(['controller' => 'Stories', 'action' => 'addReferral', $saveResponse['id']]);
                } else {
                    $this->Flash->error(__('The story details could not be saved.'));
                    $this->redirect(['controller' => 'Stories', 'action' => 'addReferral', $saveResponse['id']]);
                }
            } else {
                $this->Flash->error(__('Save Failed! A story must have a title. Please add a story title.'));
            }
        }
        $storyTypeCatId = $this->Options->getCategoryByType('Story');
        $categories = $this->Stories->Categories->find('treeList', ['conditions' => ['type' => $storyTypeCatId]]);
        $r_mediaTypes = $this->Options->getMediaTypesForRadioField();
        $mediaTypes = $this->Options->getMediaTypes();
        $pageTitle = 'Add Story Details';
        //pr($story);exit();
        $this->set(compact('story', 'mediaTypes', 'r_mediaTypes', 'categories', 'pageTitle'));
    }

    /**
     * add Story Referral
     */
    public function addReferral($id = null)
    {
        $story = $this->Stories->get($id, [
            'contain' => ['Referrals', 'ReformIdeas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            ///pr($this->request->getData());exit();
            $resposne = $this->Stories->addReferral($story, $this->request->getData(), $this->loggedinUser);

            if ($resposne['success']) {

                if (isset($story->reform_idea) && !empty($story->reform_idea)) {
                    $this->redirect(array('controller' => 'ReformIdeas', 'action' => 'edit', $story->reform_idea->id, true));
                } else {
                    $this->redirect(array('controller' => 'ReformIdeas', 'action' => 'add', $id));
                }
            } else {
                $this->Flash->error(__('Save Failed! Referral could not be saved.'));
            }
        }
        $selectedReferralId = empty($story->referrals) ? '' : $story->referrals[0]->id; //when updating
        $selectedProfessionId = empty($story->referrals) ? '' : $story->referrals[0]->profession_id; //when updating
        $referrals = array();
        if ($selectedProfessionId) {
            $referrals = $this->Stories->Referrals->find('list', [
                'conditions' => ['Referrals.profession_id' => $selectedProfessionId]
            ]);
        }
        $professions = $this->Stories->Referrals->Professions->find('list');
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $this->set(compact('story', 'professions', 'referrals', 'selectedReferralId', 'selectedProfessionId', 'states'));
    }

    /*
     * edit referalls by Ajx
     */
    public function editReferralByAjax()
    {
        $this->add_model(array('Stories', 'Referrals'));
        $status = false;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $id = $this->request->data('id');
            $story = $this->Stories->get($id, [
                'contain' => ['Referrals']
            ]);
            //$data = $this->request->data;

            $data = $this->request->getData();
            $resposne = $this->Stories->addReferral($story, $data, $this->loggedinUser);
            $this->Flash->success(__('Referral Successfully Updated.'));
            //pr($resposne);exit();
            if ($resposne['success']) {
                $status = true;
                $msg = 'Successfully Updated';
            } else {
                $msg = 'Sorry! Not Updated';
            }
        } else {
            $msg = 'Sorry! Data required';
        }
        $result = json_encode(array('status' => $status, 'msg' => $msg));
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
     * edit description
     */
    public function editDescription()
    {
        $this->add_model(array('Stories'));
        //pr();exit();
        $status = false;
        if (isset($this->request->data)) {
            $storyId = $this->request->data('story_id');
            $descripition = $this->request->data('description');
            $story = $this->Stories->get($storyId);
            $story->description = $descripition;

            if ($this->Stories->save($story)) {
                $status = true;
                $msg = 'Successfully Updated';
            } else {
                $msg = 'Sorry! Not Updated';
            }
        } else {
            $msg = 'Sorry! Data required';
        }
        $result = json_encode(array('status' => $status, 'msg' => $msg));
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
     * edit Agency
     */
    public function editAgency()
    {
        $this->add_model(array('Stories'));
        //pr();exit();
        $status = false;
        if (isset($this->request->data)) {
            $storyId = $this->request->data('story_id');
            $agency_id = $this->request->data('agency_id');
            $story = $this->Stories->get($storyId);
            $story->agency_id = $agency_id;

            if ($this->Stories->save($story)) {
                $status = true;
                $msg = 'Successfully Updated';
            } else {
                $msg = 'Sorry! Not Updated';
            }
        } else {
            $msg = 'Sorry! Data required';
        }
        $result = json_encode(array('status' => $status, 'msg' => $msg));
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
     * edit Agency
     */
    public function editReferral()
    {
        $this->add_model(array('Stories'));
        $status = false;
        if (isset($this->request->data)) {
            $data = $this->request->data;
            $storyId = $this->request->data('story_id');
            $story = $this->Stories->get($storyId, [
                'contain' => ['Referrals']
            ]);
            $resposne = $this->Stories->addReferral($story, $this->request->getData());
            if ($resposne['success']) {
                $status = true;
                $msg = 'Successfully Updated';
            } else {
                $msg = 'Sorry! Not Updated';
            }
        } else {
            $msg = 'Sorry! Data required';
        }
        $result = json_encode(array('status' => $status, 'msg' => $msg));
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /**
     * Edit Story
     */
    public function edit($id = null)
    {

        $story = $this->Stories->get($id, [
            'contain' => ['Referrals', 'Agencies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (strlen(trim($this->request->getData('title'))) > 0) {
                $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses(), $story);
                if ($response['success']) {
                    $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
                } else {
                    $this->Flash->error(__('The story could not be saved. ' . $response['error_message']));
                }
            } else {
                $this->Flash->error(__('Save Failed! A story must have a title. Please add a story title.'));
            }
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $agencies = $this->Stories->Agencies->find('list', ['type' => $story->agency['type']]);
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $pageTitle = 'Update Story Details';
        $this->set(compact('story', 'agencyTypes', 'states', 'agencies', 'pageTitle'));
    }

    public function editStoryLocation($storyId = null)
    {
        $story = $this->Stories->get($storyId);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses(), $story);
            if ($response['success']) {
                $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
            } else {
                $this->Flash->error(__('The story could not be saved. ' . $response['error_message']));
            }
        }
        $countries = $this->Stories->Countries->find('list')->toArray();
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $this->set(compact('story', 'countries', 'states'));
    }

    /**
     * Delete Story
     */
    public function delete($id = null)
    {
        $story = $this->Stories->get($id);
        if ($this->Stories->delete($story)) {
            $this->Flash->success(__('The story has been deleted.'));
        } else {
            $this->Flash->error(__('The story could not be deleted. Please, try again.'));
        }

        return $this->redirect('/admin/stories/index');
    }

    /*
     * Status change
     */
    public function changeStatus($id = null, $status = null)
    {
        if ($status == 5) {
            return $this->delete($id);
        }
        $story = $this->Stories->get($id);
        $story['status'] = $status;
        if ($this->Stories->save($story)) {
            $this->Flash->success(__('The status has been changed.'));
        } else {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /*
    * All Story List
    */
    public function allStory()
    {
        $this->add_model(array('Users', 'Stories'));
        $conditions = [];
        /* $stories = $this->Users->Stories->find('all', [
             'contain' => ['Users', 'Media', 'Referrals'],
             'conditions' => $conditions,
             'limit' => 10
         ]);*/
        $this->paginate = [
            'limit' => 10,
            'contain' => ['Users', 'Media', 'Referrals'],
            'order' => [
                'Stories.id' => 'desc'
            ],
            'conditions' => $conditions
        ];
        $stories = $this->paginate($this->Stories->find())->toArray();
        //pr($stories);exit();
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Users->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $this->set(compact('stories', 'storyStatuses', 'storyCategories'));
    }

    /*
     * User Story List
     */
    public function userStory($id = null)
    {
        if ($id == null) {
            $this->Flash->error(__('Please! Select an User'));

            return $this->redirect('/admin/users/index');
        }
        $this->add_model(array('Users', 'Stories'));
        $this->loadComponent('Paginator');
        if ($id != null) {
            $conditions['Stories.user_id'] = $id;
            /* $stories = $this->Users->Stories->find('all', [
                 'contain' => ['Users', 'Media', 'Referrals'],
                 'conditions' => $conditions,
                 'limit' => 10
             ]);*/
            $this->paginate = [
                'limit' => 10,
                'contain' => ['Users', 'Media', 'Referrals'],
                'order' => [
                    'Stories.id' => 'desc'
                ],
                'conditions' => $conditions
            ];
            $stories = $this->paginate($this->Stories->find())->toArray();
            //pr($stories);exit();
            $storyStatuses = $this->Options->getStoryStatuses();
            $storyCategories = $this->Users->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
            $this->set(compact('stories', 'storyStatuses', 'storyCategories'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'My Stories';
        $this->set(compact('pageTitle'));
    }

    public function ajaxDelete($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        $this->request->allowMethod(['post', 'delete']);
        $story = $this->Stories->get($id);
        if (!$story) {
            $response['success'] = false;
            $response['error_message'] = 'Delete Failed! Invalid story.';
        }
        if (!$this->Stories->delete($story)) {
            $response['success'] = false;
            $response['error_message'] = 'Delete Failed! Please try again later.';
        }
        echo json_encode($response);
    }
}
