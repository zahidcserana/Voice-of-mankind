<?php

namespace App\Controller\admin;

use App\Controller\AppController;
use Cake\Core\Configure;

class CategoriesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ListUtil');
        $this->loadComponent('Options');
    }

    /**
     * List Category
     */
    public function index()
    {
        $parents = $this->Categories->find('list')
            ->where(['type'=>1])
            ->toArray();
        $categoryTypes = $this->Options->getCategoryTypes();

        $this->set(compact('categories', 'categoryTypes', 'parents'));
    }

    /*
  * Story indexing using datatble
  */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Categories'));
        $params = $this->request->getQueryParams();
        //pr($params);exit();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Categories.id', 'Categories.title', 'Categories.parent_id', 'Categories.type', 'Categories.status', 'Categories.created'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = array('type'=>1);

        if (!empty($params['title'])) {
            $where = array_merge(array("Categories.title LIKE '%" . $params['title'] . "%'"), $where);
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
            $where = array_merge(array("DATE(Categories.created) =" . $date), $where);

        }
        if (!empty($params['parent'])) {
            $where = array_merge(array("Categories.parent_id" => $params['parent']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Categories.status " => $params['status']), $where);
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
        $parents = $this->Categories->find('list')
            ->where(['type'=>1])
            ->toArray();
        $categories = $this->Categories->find('all')
            ->select($displayableColumn)
            //->contain(['Users', 'States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            //->group(['Categories.parent_id'])
            ->toArray();
//pr($categories);exit();
        $total = $this->Categories->find()->where(['type'=>1])->count();
        $filtered = $this->Categories->find()//->contain(['Users', 'States'])
        ->where($where)
            ->count();
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                if ($category['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($category['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($category['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($category['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/categories/edit/' . $category['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/categories/change_status/' . $category['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $category['id'] . '">
                            <span></span>
                        </label>';
                $parentTitle = 'Parent';

                if ($category['parent_id'] != 0){
                    foreach ($parents as $key => $value) {
                        if ($key == $category['parent_id']) {
                            $parentTitle = $value;
                        }
                    }
                }

                $data[] = array(
                    'id' => $str,
                    'parent_id' => $parentTitle,
                    'title' => $category['title'],
                    'type' => $category['type'] == 1 ? 'Story' : 'List',
                    'created' => date_format($category['created'], 'd/m/y'),
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
     * List Category
     */
    public function listCategories()
    {
        $parents = $this->Categories->find('list')
            ->where(['type'=>2])
            ->toArray();
        $categoryTypes = $this->Options->getCategoryTypes();

        $this->set(compact('categories', 'categoryTypes', 'parents'));
    }

    /*
   * Story indexing using datatble
   */
    public function getListDataCake()
    {
        $data = [];
        $this->add_model(array('Categories'));
        $params = $this->request->getQueryParams();
        //pr($params);exit();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Categories.id', 'Categories.title', 'Categories.parent_id', 'Categories.type', 'Categories.status', 'Categories.created'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = array('type'=>2);

        if (!empty($params['title'])) {
            $where = array_merge(array("Categories.title LIKE '%" . $params['title'] . "%'"), $where);
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
            $where = array_merge(array("DATE(Categories.created) =" . $date), $where);

        }
        if (!empty($params['parent'])) {
            $where = array_merge(array("Categories.parent_id" => $params['parent']), $where);
        }
        if (!empty($params['status'])) {
            $where = array_merge(array("Categories.status " => $params['status']), $where);
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
        $parents = $this->Categories->find('list')
            ->where(['type'=>2])
            ->toArray();
        $categories = $this->Categories->find('all')
            ->select($displayableColumn)
            //->contain(['Users', 'States'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            //->group(['Categories.parent_id'])
            ->toArray();
//pr($categories);exit();
        $total = $this->Categories->find()->where(['type'=>2])->count();
        $filtered = $this->Categories->find()//->contain(['Users', 'States'])
        ->where($where)
            ->count();
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                if ($category['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($category['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($category['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($category['status'] == 4) {
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
                        <a class="dropdown-item" href="/admin/categories/edit/' . $category['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/categories/change_status/' . $category['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $category['id'] . '">
                            <span></span>
                        </label>';
                $parentTitle = 'Parent';

                if ($category['parent_id'] != 0){
                    foreach ($parents as $key => $value) {
                        if ($key == $category['parent_id']) {
                            $parentTitle = $value;
                        }
                    }
                }

                $data[] = array(
                    'id' => $str,
                    'parent_id' => $parentTitle,
                    'title' => $category['title'],
                    'type' => $category['type'] == 1 ? 'Story' : 'List',
                    'created' => date_format($category['created'], 'd/m/y'),
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
     * View Category
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Lists', 'Stories', 'ChildCategories']
        ]);

        $this->set('category', $category);
    }

    /**
     * Add Category
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $category = $this->Categories->patchEntity($category, $data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                if ($data['type'] == 2){
                    return $this->redirect(['action' => 'listCategories']);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $categoryTypes = $this->Options->getCategoryTypes();
        $categories = $this->Categories->find('treeList');
        $this->set(compact('category', 'categories', 'categoryTypes'));
    }

    /**
     * Edit Category by ID
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $categoryTypes = $this->Options->getCategoryTypes();
        $categories = $this->Categories->find('treeList');
        $this->set(compact('category', 'categories', 'categoryTypes'));
    }

    /*
     * Ajax Pagination
     */
    public function search()
    {
        $data = $alldata = $this->Categories->find('all')->toArray();
//var_dump($_REQUEST);exit();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

// search filter by keywords
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
            ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['generalSearch']);
        }

// filter by field query
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $data = list_filter($data, [$key => $val]);
            }
        }

        $sort = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'RecordID';

        $meta = [];
        $page = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = count($data); // total items in array

// sort
        usort($data, function ($a, $b) use ($sort, $field) {
            if (!isset($a->$field) || !isset($b->$field)) {
                return false;
            }

            if ($sort === 'asc') {
                return $a->$field > $b->$field ? true : false;
            }

            return $a->$field < $b->$field ? true : false;
        });

// $perpage 0; get all data
        if ($perpage > 0) {
            $pages = ceil($total / $perpage); // calculate total pages
            $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }

            $data = array_slice($data, $offset, $perpage, true);
        }

        $meta = [
            'page' => $page,
            'pages' => $pages,
            'perpage' => $perpage,
            'total' => $total,
        ];


// if selected all records enabled, provide all the ids
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                return $row->RecordID;
            }, $alldata);
        }


        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        $result = [
            'meta' => $meta + [
                    'sort' => $sort,
                    'field' => $field,
                ],
            'data' => $data,
        ];

        //echo json_encode($result, JSON_PRETTY_PRINT);

        $responseResult = json_encode($result);
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

    /**
     * Delete permanently
     */
    public function delete($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /*
     * Status change
     */

    public function changeStatus($id = null, $status = null) {
        $this->add_model(array('Categories'));
        if ($status == 5) {
            return $this->delete($id);
        }
        $data = $this->Categories->get($id);
        $data['status'] = $status;
        if ($this->Categories->save($data)) {
            $this->Flash->success(__('The status has been changed.'));
        } else {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /*
     * Delete Permanently
     */

    public function deleteCategories() {
        $this->add_model(array('Categories'));
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->Categories->deleteAll(['Categories.id IN' => $data])) {
                $this->Flash->success(__('The Category has been deleted.'));
                $response = true;
                $msg = '';
            } else {
                $msg = 'Sorry! Category Can not be deleted.';
            }
        } else {
            $msg = 'Please! Select Atleast one Category.';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }
}
