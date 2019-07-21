<?php
namespace App\Controller;


use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class StoriesController extends AppController
{
    var $pageLimit = 6;

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
        $this->Auth->allow(array('index','view', 'storyByCategory', 'search', 'storiesByMonth'));
        $this->viewBuilder()->setLayout('inner');
        $ads = $this->_getAds($this->request->params['controller'],$this->request->params['action']);
        $this->set(compact('ads'));
    }

    /**
     * Index method
     */
    public function index() {
        $conditions = [];
        if(!$this->loggedinUser){
            $conditions['is_public'] = 1;
        }
        $conditions['Stories.status'] = 1;
        $params = $this->request->query();

        $agencyConditions = [];

        if (!empty($params['city_id'])) {
            $agencyConditions = array_merge(array("Agencies.city_id" => $params['city_id']), $agencyConditions);
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
            $conditions = array_merge(array('Stories.agency_id' => $params['agency_id']), $conditions);
        }
        if (!empty($params['user_id'])) {
            $conditions = array_merge(array('Stories.user_id' => $params['user_id']), $conditions);
        }
        $query = $this->Stories->find()
            ->select(['Stories.id','Stories.user_id','Stories.agency_id','Stories.title','Stories.description',
                'Stories.rating_average', 'Stories.created','Users.id','Users.first_name','Users.last_name',
                'Users.email','Referrals.id','Referrals.name','Referrals.email','Categories.id','Categories.title',
                'Agencies.id','Agencies.name','Agencies.email','Media.id','Media.type','Media.mime_type','Media.file_name'])
            ->where($conditions)
            ->matching('Users')
            ->matching('Referrals')
            ->matching('Categories')
            ->matching('Agencies'
                    , function ($q) use ($agencyConditions) {
                return $q->where($agencyConditions);
            })
            ->leftJoin(
                ['Media' => 'media'],
                ['Media.story_id = Stories.id'])
            ->group(['Stories.id'])
            ->order(['Stories.created' => 'DESC']);
        $this->paginate = ['limit' => $this->pageLimit];
        //pr($query);exit;
        $stories = $this->paginate($query);

        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $mediaTypes = $this->Options->getMediaTypes();
        $pageTitle = 'Stories Of Mankind';
        $this->set(compact('stories','storyStatuses', 'storyCategories', 'pageTitle', 'mediaTypes'));
    }

    /**
     * story By Category
     */
    public function storyByCategory($catId = null){
        $conditions = array();
        if(!$this->loggedinUser){
            $conditions['is_public'] = 1;
        }
        $conditions['Stories.status'] = 1;
        $stories = array();
        if($catId){
            $query = $this->Stories->find()
                ->select(['Stories.id','Stories.user_id','Stories.agency_id','Stories.title','Stories.description',
                    'Stories.rating_average', 'Stories.created','Users.id','Users.first_name','Users.last_name',
                    'Users.email','Referrals.id','Referrals.name','Referrals.email','Categories.id','Categories.title',
                    'Agencies.id','Agencies.name','Agencies.email','Media.id','Media.type','Media.mime_type','Media.file_name'])
                ->where($conditions)
                ->matching('Users')
                ->matching('Referrals')
                ->matching('Categories', function($q) use ($catId){
                    return $q->where(['Categories.id' => $catId]);
                })
                ->matching('Agencies')
                ->leftJoin(
                    ['Media' => 'media'],
                    ['Media.story_id = Stories.id'])
                ->group(['Stories.id'])
                ->order(['Stories.created' => 'DESC']);
            $this->paginate = ['limit' => $this->pageLimit];
            $stories = $this->paginate($query);
        }
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $pageTitle = $storyCategories[ $catId ];
        $this->set(compact('stories','storyStatuses', 'storyCategories', 'pageTitle'));
        $this->render('index');
    }

    /*
     * stories By Month
     */
    public function storiesByMonth($intTimeVal = ''){
        $conditions = array();
        if(!$this->loggedinUser){
            $conditions['is_public'] = 1;
        }
        $conditions['Stories.status'] = 1;
        $stories = array();
        if($intTimeVal){
            $startDate = date('Y-m-01', $intTimeVal);
            $endDate = date('Y-m-t', $intTimeVal);
            $conditions['DATE(Stories.created) >='] = $startDate;
            $conditions['DATE(Stories.created) <='] = $endDate;

            $query = $this->Stories->find()
                ->select(['Stories.id','Stories.user_id','Stories.agency_id','Stories.title','Stories.description',
                    'Stories.rating_average', 'Stories.created','Users.id','Users.first_name','Users.last_name',
                    'Users.email','Referrals.id','Referrals.name','Referrals.email','Categories.id','Categories.title',
                    'Agencies.id','Agencies.name','Agencies.email','Media.id','Media.type','Media.mime_type','Media.file_name'])
                ->where($conditions)
                ->matching('Users')
                ->matching('Referrals')
                ->matching('Categories')
                ->matching('Agencies')
                ->leftJoin(
                    ['Media' => 'media'],
                    ['Media.story_id = Stories.id'])
                ->group(['Stories.id'])
                ->order(['Stories.created' => 'DESC']);
            $this->paginate = ['limit' => $this->pageLimit];
            $stories = $this->paginate($query)->toArray();
        }
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $pageTitle = 'Stories From Archive';
        $this->set(compact('stories','storyStatuses', 'storyCategories', 'pageTitle'));
        $this->render('index');
    }

    public function search(){
        $data = $this->request->getData();
        $stories = array();
        if(!$this->loggedinUser){
            $conditions['is_public'] = 1;
        }
        $conditions['Stories.status'] = 1;
        if($this->request->is('post') && !empty(trim($data['search']))){
            $data['search'] = trim($data['search']);
            $conditions = ['OR' => [
                'Stories.title LIKE' => '%'.$data['search'].'%',
                'Stories.description LIKE' => '%'.$data['search'].'%']];
            $query = $this->Stories->find()
                ->select(['Stories.id','Stories.user_id','Stories.agency_id','Stories.title','Stories.description',
                    'Stories.rating_average', 'Stories.created','Users.id','Users.first_name','Users.last_name',
                    'Users.email','Referrals.id','Referrals.name','Referrals.email','Categories.id','Categories.title',
                    'Agencies.id','Agencies.name','Agencies.email','Media.id','Media.type','Media.mime_type','Media.file_name'])
                ->where($conditions)
                ->matching('Users')
                ->matching('Referrals')
                ->matching('Categories')
                ->matching('Agencies')
                ->leftJoin(
                    ['Media' => 'media'],
                    ['Media.story_id = Stories.id'])
                ->group(['Stories.id'])
                ->order(['Stories.created' => 'DESC']);
            $this->paginate = ['limit' => $this->pageLimit];
            $stories = $this->paginate($query)->toArray();
        }
        $storyStatuses = $this->Options->getStoryStatuses();
        $storyCategories = $this->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
        $pageTitle = 'Search Result';
        $this->set(compact('stories', 'storyStatuses', 'storyCategories', 'pageTitle'));
        $this->render('index');
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $story = $this->Stories->get($id, [
            'contain' => ['Users', 'Agencies', 'Categories', 'Referrals',  'Media', 'ReformIdeas']
        ]);

        //need to give the description
        if($this->loggedinUser){
            if(empty($story->description)){
                $this->redirect(['controller' => 'stories', 'action' => 'add_details', $story->id]);
            }else if( empty($story->referrals)){
                $this->redirect(['controller' => 'stories', 'action' => 'add_referral', $story->id]);
            }else{
                $pageTitle = $story->title;
                $this->set(compact('story','pageTitle'));
            }
        }else{
            if($story->is_public){
                $pageTitle = $story->title;
                $this->set(compact('story','pageTitle'));
            }else{
                $this->Flash->error(__('Requested story is a private story. If yor are the owner or admin of the story, please login first.'));
                $this->redirect(['controller'  => 'users', 'action' => 'login']);
            }
        }
        $relatedStories = $this->Stories->getRelatedStories($story, $this->loggedinUser);
        $commentsTotalPaginationPages = $this->Stories->Comments->getTotalPaginationLinks('Stories',$id, 10);//for ajaxified comment pagination
        $mediaTypes = $this->Options->getMediaTypes();
        $this->set(compact('commentsTotalPaginationPages', 'relatedStories', 'mediaTypes'));
    }

    /**
     * Add method
     */
    public function add() {
        $story = $this->Stories->newEntity();
        if ($this->request->is('post')) {
            if( strlen(trim($this->request->getData('title')))>0 ){
                $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses());
                if($response['success']){
                    $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
                }else{
                    $this->Flash->error(__('The story could not be saved. '.$response['error_message']));
                }
            }else{
                $this->Flash->error(__('Save Failed! A story must have a title. Please add a story title.'));
            }
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $pageTitle = 'Write Your Story';
        $this->set(compact('story',  'agencyTypes', 'states', 'pageTitle'));
    }

    /**
     * add story Details
     */
    public function addDetails($id = null){
        if (empty($id)){
            $this->Flash->error(_('Missing Story ID'));
            return $this->redirect('/stories/add');
        }
        $story = $this->Stories->get($id, [
            'contain' => ['Users', 'Agencies', 'Categories', 'Referrals',  'Media']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if( strlen(trim($this->request->getData('description')))>0 ){                
                $saveResponse = $this->Stories->addDetails($story, $this->request->getData());

                if($saveResponse['success']){
                    $this->Flash->success(__('The story details has been saved.'));
                    $this->redirect(['controller' => 'Stories', 'action' => 'addReferral', $saveResponse['id']]);
                }else{
                    $this->Flash->error(__('The story details could not be saved.'));
                    $this->redirect(['controller' => 'Stories', 'action' => 'addReferral', $saveResponse['id']]);
                }
            }else{
                $this->Flash->error(__('Save Failed! A story must have description. Please add story description.'));
            }
        }
        $storyTypeCatId = $this->Options->getCategoryByType('Story');
        $categories = $this->Stories->Categories->find('treeList', ['conditions' => ['type' => $storyTypeCatId]]);
        $r_mediaTypes = $this->Options->getMediaTypesForRadioField();
        $mediaTypes = $this->Options->getMediaTypes();
        $pageTitle = 'Add Story Details';
        //pr($story);exit();
        $this->set(compact('story','mediaTypes','r_mediaTypes', 'categories', 'pageTitle','id'));
    }

    /**
     * add Story Referral
     */
    public function addReferral($id = null){
        if (empty($id)){
            $this->Flash->error(_('Missing Story ID'));
            return $this->redirect('/stories/add');
        }
        $story = $this->Stories->get($id, [
            'contain' => ['Referrals', 'ReformIdeas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resposne = $this->Stories->addReferral($story, $this->request->getData(), $this->loggedinUser);
            if($resposne['success']){
                if(isset($story->reform_idea) && !empty($story->reform_idea)){
                    $this->redirect(array('controller' => 'ReformIdeas', 'action' => 'edit', $story->reform_idea->id, true));
                }else{
                    $this->redirect(array('controller' => 'ReformIdeas', 'action' => 'add', $id));
                }
            }else{
                $this->Flash->error(__('Save Failed! Referral could not be saved.'));
            }
        }
        $selectedReferralId = empty($story->referrals) ? '' : $story->referrals[0]->id; //when updating
        $selectedProfessionId = empty($story->referrals) ? '' : $story->referrals[0]->profession_id; //when updating
        $referrals  = array();
        if($selectedProfessionId){
            $referrals = $this->Stories->Referrals->find('list', [
                'conditions' => ['Referrals.profession_id' => $selectedProfessionId]
            ]);
        }
       // pr($story->referrals);exit();
        $professions = $this->Stories->Referrals->Professions->find('list');
        $pageTitle = 'Add Referral For Your Story';
        $this->set(compact('story','id', 'professions', 'referrals', 'selectedReferralId', 'selectedProfessionId', 'pageTitle'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $this->accessControl($id,'Stories');
        $story = $this->Stories->get($id, [
            'contain' => [ 'Referrals', 'Agencies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if( strlen(trim($this->request->getData('title')))>0 ){
                $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses(), $story);
                if($response['success']){
                    $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
                }else{
                    $this->Flash->error(__('The story could not be saved. '.$response['error_message']));
                }
            }else{
                $this->Flash->error(__('Save Failed! A story must have a title. Please add a story title.'));
            }
        }
        $agencyTypes = $this->Options->getAgencyTypesForRadioField();
        $agencies = $this->Stories->Agencies->find('list', ['type' => $story->agency['type']]);
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $pageTitle = 'Update Story Details';
        $this->set(compact('story',  'agencyTypes', 'states', 'agencies', 'pageTitle','id'));
    }

    /*
     * edit Story Location
     */
    public function editStoryLocation($storyId = null){
        $story = $this->Stories->get($storyId);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $response = $this->Stories->saveStory($this->request->getData(), $this->loggedinUser, $this->Options->getStoryStatuses(), $story);
            if($response['success']){
                    $this->redirect(['controller' => 'Stories', 'action' => 'addDetails', $response['id']]);
            }else{
                $this->Flash->error(__('The story could not be saved. '.$response['error_message']));
            }
        }
        $countries = $this->Stories->Countries->find('list')->toArray();
        $states = $this->Stories->Agencies->States->find('list')->toArray();
        $pageTitle = 'Update Story Location';
        $this->set(compact('story', 'countries', 'states', 'pageTitle'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $story = $this->Stories->get($id);
        if ($this->Stories->delete($story)) {
            $this->Flash->success(__('The story has been deleted.'));
        } else {
            $this->Flash->error(__('The story could not be deleted. Please, try again.'));
        }

       return $this->redirect(array('controller' => 'users', 'action' => 'my-stories'));
    }
}
