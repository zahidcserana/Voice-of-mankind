<?php
namespace App\Controller;

use App\Controller\AppController;

class ReformIdeasController extends AppController
{
    var $pageLimit = 6;

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
        $this->viewBuilder()->setLayout('inner');
        $this->Auth->allow(array('index', 'search'));
        $ads = $this->_getAds($this->request->params['controller'],$this->request->params['action']);        
        $this->set(compact('ads'));
    }
    /**
     * Index method
     */
    public function index(){
        $conditions = [];
        $agencyConditions = [];
        $params = $this->request->query();

        if (!empty($params['city'])) {
            $agencyConditions = array_merge(array("Agencies.city" => $params['city']), $agencyConditions);
        }
        if (!empty($params['state_id'])) {
            $agencyConditions = array_merge(array("Agencies.state_id" => $params['state_id']), $agencyConditions);
        }
        if (!empty($params['county_id'])) {
            $agencyConditions = array_merge(array("Agencies.county_id" => $params['county_id']), $agencyConditions);
        }
        if (!empty($params['zip_code'])) {
            $agencyConditions = array_merge(array('Agencies.zip_code' => $params['zip_code']), $agencyConditions);
        }
        if (!empty($params['agency_id'])) {
            $conditions = array_merge(array('ReformIdeas.agency_id' => $params['agency_id']), $conditions);
        }
        if (!empty($params['user_id'])) {
            $conditions = array_merge(array('ReformIdeas.user_id' => $params['user_id']), $conditions);
        }                
        $query = $this->ReformIdeas->find()
            ->where($conditions)
            ->matching('Users')
            ->leftJoin(['Stories' => 'stories'], ['ReformIdeas.story_id = Stories.id'])
            ->matching('Agencies'
                    , function ($q) use ($agencyConditions) {
                return $q->where($agencyConditions);
            })
            ->group(['ReformIdeas.id'])
            ->order(['ReformIdeas.created' => 'DESC']);            
        $this->paginate = ['limit' => $this->pageLimit];
        $reformIdeas = $this->paginate($query);
        $agencies = $this->ReformIdeas->Agencies->find('list')->toArray();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();

        $pageTitle = 'Reform Idea';
        $recentReform = $this->ReformIdeas->getRecentReform();

        $this->set(compact('recentReform','pageTitle','reformIdeas','agencies','agencyTypes','story','states','counties','cities'));
    }
    
    /**
     * 
     */
    public function myReformIdeas(){
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $params = $this->request->query();
        $where = ['ReformIdeas.user_id' => $this->loggedinUser['id']];

        $this->paginate = [
            'contain' => ['Users', 'Stories', 'Agencies'],
            'conditions' => $where,
            'limit' => 10,
            'order' => ['ReformIdeas.created' => 'DESC']
        ];
        $reformIdeas = $this->paginate($this->ReformIdeas);

        $agencies = $this->Agencies->find('list')->toArray();
        $counties = $this->Counties->find('list')->toArray();
        $cities = $this->Cities->find('list')->toArray();
        $states = $this->States->find('list')->toArray();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();

        $pageTitle = 'My Reform Ideas';
        $this->set(compact('pageTitle','reformIdeas','agencies','agencyTypes','story','states','counties','cities'));
    }

    /*
     * Search Reform Ideas
     */
    public function search(){
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));

        $data = $this->request->getData();
        $reformIdeas = array();

        if($this->request->is('post') && !empty(trim($data['search']))){
            $data['search'] = trim($data['search']);
            $conditions = ['ReformIdeas.idea LIKE' => '%'.$data['search'].'%'];
            $query = $this->ReformIdeas->find('all', [
                'contain' => ['Users', 'Stories', 'Agencies'],
                'conditions' => $conditions,
                'order' => ['ReformIdeas.created' => 'DESC']
            ]);
            $this->paginate = ['limit' => $this->pageLimit];
            $reformIdeas = $this->paginate($query)->toArray();
        }
        $agencies = $this->Agencies->find('list')->toArray();
        $counties = $this->Counties->find('list')->toArray();
        $cities = $this->Cities->find('list')->toArray();
        $states = $this->States->find('list')->toArray();
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();

        $pageTitle = 'Reform Idea Search Result';

        $this->set(compact('pageTitle','reformIdeas','agencies','agencyTypes','story','states','counties','cities'));
        $this->render('index');
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $reformIdea = $this->ReformIdeas->get($id, [
            'contain' => ['Users', 'Stories', 'Agencies'],
        ]);
        $pageTitle = 'Reform Idea Details';
        $relatedReform = $this->ReformIdeas->getRelatedReform($reformIdea);
        $commentsTotalPaginationPages = $this->ReformIdeas->Comments->getTotalPaginationLinks('ReformIdeas',$id, 10);//for ajaxified comment pagination
        $this->set(compact('pageTitle','commentsTotalPaginationPages', 'relatedReform','reformIdea'));
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
                    return $this->redirect(['action' => 'my-reform-ideas']);
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
        $this->set(compact('pageTitle','reformIdea','agencyTypes','storyId'));
    }

    /**
     * Edit method
     * @sequenceOfStoryEdit When editing reform idea as step of story then it will redirect to stories index
     */
    public function edit($id = null, $squenceOfStoryEdit = false) {        
        $this->add_model(array('Agencies','ReformIdeas','Stories','Counties','States','Cities'));
        $reformIdea = $this->ReformIdeas->get($id, [
            'contain' => ['Agencies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $reformIdea = $this->ReformIdeas->patchEntity($reformIdea, $data);
            if ($this->ReformIdeas->save($reformIdea)) {
                $this->Flash->success(__('The reform idea has been saved.'));                
                if($squenceOfStoryEdit){//then it should goes to my-reform-ideas
                    return $this->redirect(['controller' => 'users', 'action' => 'my-stories']);
                }else{
                    return $this->redirect(['action' => 'my-reform-ideas']);
                }                
            }
            $this->Flash->error(__('The reform idea could not be saved. Please, try again.'));
        }
        $pageTitle = 'Update Reform Idea';
        $agencies = $this->Stories->Agencies->find('list', ['type' => $reformIdea->agency['type']]);
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $this->set(compact('pageTitle','reformIdea','agencies','agencyTypes','story','states','countries','counties','cities'));
    }

    /**
     * Delete method
     */
    public function delete($id = null) {
        $reformIdea = $this->ReformIdeas->get($id);
        if ($this->ReformIdeas->delete($reformIdea)) {
            $this->Flash->success(__('The reform idea has been deleted.'));
        } else {
            $this->Flash->error(__('The reform idea could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'my-reform-ideas']);
    }

    /*
     * county By State
     */
    public function countyByState($state){
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States','Counties'));
        $counties = '';
        if ($state !=0){
            $counties = $this->Counties->find('list')->where(['state_id'=>$state])->toArray();
        }
        $this->set(compact('counties'));
    }

    /*
     * city By County
     */
    public function cityByCounty($county){
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Cities','Counties'));
        $cities = '';
        if ($county !=0){
            $cities = $this->Cities->find('list')->where(['county_id'=>$county])->toArray();
        }
        $this->set(compact('cities'));
    }
}
