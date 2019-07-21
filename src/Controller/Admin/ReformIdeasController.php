<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class ReformIdeasController extends AppController
{
    var $pageLimit = 6;

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
    }
    /**
     * Index method
     */
    public function index()
    {
        $agencies = $this->ReformIdeas->Agencies->find('list')->toArray();

        $this->set(compact('agencies'));
    }

    /*
    * Reform Idea indexing using datatble
    */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['ReformIdeas.id', 'ReformIdeas.user_id', 'ReformIdeas.agency_id', 'ReformIdeas.idea', 'Agencies.name', 'ReformIdeas.status', 'ReformIdeas.created','Users.first_name','Users.last_name'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['selectUser'])) {
            $userId = $params['selectUser'];
            $where = array_merge(array('Users.id IN' => $userId), $where);
        }
        if (!empty($params['idea'])) {
            $where = array_merge(array("ReformIdeas.idea LIKE '%" . $params['idea'] . "%'"), $where);
        }
        if (!empty($params['agency'])) {
            $where = array_merge(array("ReformIdeas.agency_id" => $params['agency']), $where);
        }

        if (!empty($params['status'])) {
            $where = array_merge(array("ReformIdeas.status " => $params['status']), $where);
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

        $tableData = $this->ReformIdeas->find()
            ->select($displayableColumn)
            ->contain(['Users', 'Stories', 'Agencies'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
        $total = $this->ReformIdeas->find()->count();
        $filtered = $this->ReformIdeas->find()->contain(['Users', 'Stories', 'Agencies'])
            ->where($where)
            ->count();
        if (count($tableData) > 0) {
            foreach ($tableData as $row) {
                if ($row['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($row['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($row['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($row['status'] == 4) {
                    $statusId = 5;
                    $statusName = 'Delete Permanently';
                    $status = '<button type="button" class="m-btn--pill btn btn-warning btn-sm">Deleted</button>';
                }
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/reform-ideas/view/' . $row['id'] . '">View</a>
                        <a class="dropdown-item" href="/admin/reform-ideas/edit/' . $row['id'] . '">Update</a>
                        <a class="dropdown-item" href="/admin/reform-ideas/change_status/' . $row['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $row['id'] . '">
                            <span></span>
                        </label>';
                $descr = strip_tags($row->idea);
                $descr = substr($descr, 0, 50);
                $idea = wordwrap($descr, 50).' ...';

                $data[] = array(
                    'id' => $str,
                    'user_id' => $row['user']['first_name'] . ' ' . $row['user']['last_name'],
                    'agency_id' => $row['agency']['name'],
                    'idea' => $idea,
                    'status' => $status,
                    'created' => date_format($row['created'], 'd/m/y'),
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
        $storyStatuses = $this->Options->getStoryStatuses();
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $reformIdea = $this->ReformIdeas->get($id, [
            'contain' => ['Users', 'Stories', 'Agencies'],
        ]);
        $pageTitle = 'Reform Idea Details';
        $relatedReform = $this->ReformIdeas->getRelatedReform($reformIdea);
        $commentsTotalPaginationPages = $this->ReformIdeas->Comments->getTotalPaginationLinks('ReformIdeas',$id, 10);//for ajaxified comment pagination
        $this->set(compact('storyStatuses','commentsTotalPaginationPages', 'relatedReform','reformIdea'));
    }

    /**
     * Add method
     */
    public function add($storyId=null) {
        $reformIdea = $this->ReformIdeas->newEntity();
        if($storyId){
            $story = $this->ReformIdeas->Stories->get($storyId);
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if($storyId){
                $data['user_id'] = $this->loggedinUser['id'];
                $data['story_id'] = $storyId;
                $data['agency_id'] = $story->agency_id;
            }
            $reformIdea = $this->ReformIdeas->patchEntity($reformIdea, $data);
            if ($this->ReformIdeas->save($reformIdea)) {
                $this->Flash->success(__('The reform idea has been saved. You story is added as pending.'));
                if(isset($reformIdea->story_id) && !empty($reformIdea->story_id)){ //when adding as story creation step
                    return $this->redirect(['controller' => 'stories', 'action' => 'index']);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The reform idea could not be saved. Please, try again.'));
        }
        $story = array();
        if ($storyId!=null){
            $this->set('storyId', $storyId);
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $pageTitle = 'New Reform Idea';
        $this->set(compact('pageTitle','reformIdea','agencyTypes'));
    }
    public function addOld($storyId=null)
    {
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $reformIdea = $this->ReformIdeas->newEntity();
        if ($this->request->is('post')) {
            $reformIdea = $this->ReformIdeas->patchEntity($reformIdea, $this->request->getData());
            if ($this->ReformIdeas->save($reformIdea)) {
                $this->Flash->success(__('The reform idea has been saved.'));
                if(isset($reformIdea->story_id) && !empty($reformIdea->story_id)){ //when adding as story creation step
                    return $this->redirect(['controller' => 'stories', 'action' => 'index']);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The reform idea could not be saved. Please, try again.'));
        }
        $story = array();
        if ($storyId!=null){
            $this->set('storyId', $storyId);
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $pageTitle = 'New Reform Idea';
        $this->set(compact('pageTitle','reformIdea','agencyTypes'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null, $squenceOfStoryEdit = false)
    {
        $storyId = $squenceOfStoryEdit;
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $reformIdea = $this->ReformIdeas->get($id, [
            'contain' => ['Agencies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reformIdea = $this->ReformIdeas->patchEntity($reformIdea, $this->request->getData());
            if ($this->ReformIdeas->save($reformIdea)) {
                $this->Flash->success(__('The reform idea has been saved.'));
                if($squenceOfStoryEdit){//then it should goes to my-reform-ideas
                    return $this->redirect(['controller' => 'stories', 'action' => 'index']);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The reform idea could not be saved. Please, try again.'));
        }
        $pageTitle = 'Update Reform Idea';
        $agencies = $this->Stories->Agencies->find('list', ['type' => $reformIdea->agency['type']]);
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $this->set(compact('storyId','pageTitle','reformIdea','agencies','agencyTypes','story','states','countries','counties','cities'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $reformIdea = $this->ReformIdeas->get($id);
        if ($this->ReformIdeas->delete($reformIdea)) {
            $this->Flash->success(__('The reform idea has been deleted.'));
        } else {
            $this->Flash->error(__('The reform idea could not be deleted. Please, try again.'));
        }

        return $this->redirect('/admin/reform-ideas');
    }

    /*
   * Status change
   */
    public function changeStatus($id = null, $status = null)
    {
        $this->add_model(array('ReformIdeas'));
        if ($status == 5) {
            return $this->delete($id);
        }
        $data = $this->ReformIdeas->get($id);
        $data['status'] = $status;
        if ($this->ReformIdeas->save($data)) {
            $this->Flash->success(__('The status has been changed.'));
        } else {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /*
     * Delete Permanently
     */
    public function deleteReform()
    {
        $this->add_model(array('ReformIdeas'));
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->ReformIdeas->deleteAll(['ReformIdeas.id IN' => $data])) {
                $this->Flash->success(__('The Reform has been deleted.'));
                $response = true;
                $msg = '';
            } else {
                $msg = 'Sorry! Reform Ideas Can not be deleted.';
            }
        } else {
            $msg = 'Please! Select Atleast one Reform Ideas.';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }
}
