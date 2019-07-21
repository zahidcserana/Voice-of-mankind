<?php
namespace App\Model\Table;

use App\Controller\Component\OptionsComponent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StoriesTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('stories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Agencies', [
            'foreignKey' => 'agency_id'
        ]);
        $this->hasOne('ReformIdeas', ['foreignKey' => 'story_id']);
        
        $this->hasMany('Comments', [
            'foreignKey' => 'content_id'
        ]);
        $this->hasMany('Media', [
            'foreignKey' => 'story_id'
        ]);
        $this->hasMany('Ratings', [
            'foreignKey' => 'story_id'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'story_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_stories'
        ]);
        $this->belongsToMany('Referrals', [
            'foreignKey' => 'story_id',
            'targetForeignKey' => 'referral_id',
            'joinTable' => 'referrals_stories'
        ]);
    }

    /**
     * Default validation rules.
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
//            ->requirePresence('description', 'create')
            ->allowEmpty('description');

        $validator
            ->numeric('rating_average')
            ->allowEmpty('rating_average');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['agency_id'], 'Agencies'));

        return $rules;
    }

    /**
     * @desc If Agency form data is found then add it and returns newly added agency id otherwise just returns the selected agency id
     */
    protected function _getAgencyId($data, $story, $user){
      // pr($data);exit();
        $response['success'] = true;
        if(isset($data['agency_id']) && !empty($data['agency_id'])){
            $response['agency_id'] = $data['agency_id'];
        }else if(isset($data['Agency']) && !empty($data['Agency'])){
            $agency = $this->Agencies->newEntity();
            if(!isset($data['Agency']['is_active'])){
                $data['Agency']['is_active'] = 1;
            }
            if (isset($data['state_id']) && isset($data['county_id']) && isset($data['city_id'])){
                $data['Agency']['state_id'] = $data['state_id'];
                $data['Agency']['county_id'] = $data['county_id'];
                $data['Agency']['city_id'] = $data['city_id'];
                $data['Agency']['zip_code'] = $data['zip_code'];
            }
            $data['Agency']['type'] = $data['agency_type'];
            $agency = $this->Agencies->patchEntity($agency, $data['Agency']);
            $respSaveAgency = $this->Agencies->saveAgency($agency, $user);

            if(!$respSaveAgency){
                $response['success'] = false;
                $response['error_message'] = 'Agency save failed!';
            }else{
                $response['agency_id'] = $respSaveAgency['id'];
            }
        }else if($story!=null && $story->agency_id){
            $response['agency_id'] = $story->agency_id;
        }else{
            $response['success'] = false;
            $response['error_message'] = 'No Agency found.';
        }
        return $response;
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function _getReferralId($data){
        $response['success'] = true;
        if(isset($data['referral_id']) && !empty($data['referral_id'])){
            $response['referral_id'] =  $data['referral_id'];
        } else if(isset($data['Referral']) && !empty($data['Referral'])){
            $referral = $this->Referrals->newEntity();
            $referral = $this->Referrals->patchEntity($referral, $data['Referral']);
            $respAddReferral = $this->Referrals->saveReferral($referral);
            if(!$respAddReferral){
                $response['success'] = false;
                $response['error_message'] = 'Referral save failed!';
            }else{
                $response['referral_id'] = $respAddReferral['id'];
            }
        } else {
            $response['success'] = false;
            $response['error_message'] = 'No Referral found.';
        }
        return $response;
    }

    /**
     * @desc : Save/Update story
     */
    public function saveStory($data, $user, $storyStatuses, $story = null){
        /**
         * 1. If Agency form data are present then agency should be add first
         * 2. If agency_id is present then agency is selected, not adding new agency
         * 3. If story id is present then story is should be updated
         */
        if($story == null){ //when adding new story
            $story = $this->newEntity();
            $story = $this->patchEntity($story, $data);
            if($user){
                $story->user_id = $user['id'];//Loggedin user is creating the story
            }
        }else if(isset($data['title'])){ //when updating a story
            $story->title = trim($data['title']);
        }
//        $story = $this->_story_location($data, $user, $story);

        $response = $this->_getAgencyId($data, $story, $user);
        if($response['success']){
            $story->agency_id = $response['agency_id'];
            if(!isset($story->is_public)){
                $story->is_public = 1; //since default is public
            }
            if(!isset($story->status)){
                $story->status = array_search('Pending', $storyStatuses);
            }
        }else{
            return $response;
        }

        $saveResponse = $this->save($story);

        if(!$saveResponse){
            return array('success' => false, 'error_message' => 'Save Failed! Please try again.');
        }else{
            return array('success' => true, 'id' => $saveResponse->id);
        }
    }

    /**
     * @desc Saving story details like descriptions, public or private story, category etc.
     */
    public function addDetails($story, $data){
        $story->description = $data['description'];
        if(isset($data['is_public'])){
            $data['is_public'] = ($data['is_public']=='public' ? 1 : 0);
        }else{
            $data['is_public'] = 0;
        }
        $story->is_public = isset($data['is_public']) ? $data['is_public'] : 0;

        if(isset($data['youtube_link']) && !empty($data['youtube_link'])){
            if($this->Media->saveYoutubeLink($story->id, $data['youtube_link'], $data['media_type'])){
                unset($data['youtube_link']);
            }else{
                $response['success'] = false;
                $response['error_message'] = 'Youtube link save failed! Please try again.';
                return $response;
            }
        }

        $story = $this->patchEntity($story, $data);

//        pr($story);exit;

        $response['success'] = true;
        $response['id'] = $story->id;

        if(!$this->save($story)){
            $response['success'] = false;
            $response['error_message'] = 'Story details save Failed! Please try again';
        }
        return $response;
    }

    /**
     * add Referral
     */
    public function addReferral($story, $data, $user){
        $response['success'] = true;
        $response['id'] = $story->id;
        if(!empty($data['referrals']['_ids'][0])){
            unset($data['referral']);
            $story = $this->patchEntity($story, $data);
            $result = $this->save($story);
            if(!$result){
                $response['success'] = false;
                $response['error_message'] = 'Referrals could not be saved! Please try again.';
            }
        }else {
            unset($data['referrals']);
            //now have to add new referral
            $requiredFields = array('name','state_id', 'county_id', 'city_id','zip_code','profession_id');
            //Primarily users(who is creating the story) location will be referrals location
            //further admin/moderator can change it
            $data['referral']['state_id'] = !empty($data['state_id'])? $data['state_id']: null;
            $data['referral']['county_id'] = !empty($data['county_id'])? $data['county_id']: null;
            $data['referral']['city_id'] = !empty($data['city_id'])? $data['city_id']: null;
            $data['referral']['zip_code'] = !empty($data['zip_code'])? $data['zip_code']: null;
            $data['referral']['profession_id'] = !empty($data['referral']['profession'])? $data['referral']['profession']: null;
            foreach($data['referral'] as $k => $v){
                $data['referral'][$k] = trim($data['referral'][$k]);
                if(in_array($k, $requiredFields)){
                    if(empty($data['referral'][$k])){
                        $response['success'] = false;
                        $response['error_message'] = 'No value found for '.$k;
                        break;
                    }
                }
            }
            if(empty($data['referral']['phone']) && empty($data['referral']['email'])){
                $response['success'] = false;
                $response['error_message'] = 'Save Failed! Either Phone or Email must be given to add new Referral';
                return $response;
            }
            $data['referrals'][] = $data['referral'];
            unset($data['referral']);
            $story = $this->patchEntity($story, $data);
            if($this->save($story)){
                $response['success'] = true;
            }else{
                $response['success'] = false;
                $response['error_message'] = 'Referrals could not be saved! Please try again.';
            }
        }
        return $response;
    }

    /**
     * @param $story
     * @param $user
     * @return $this
     */
    public function getRelatedStories($story, $user){
        $conditions['Stories.id !='] = $story->id;
        if(!$user){
            $conditions['is_public'] = 1;
        }
        $catId = $story->categories[0]->id;
        return $this->find('all', [
            'contain' => ['Media', 'Users'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['Stories.created' => 'DESC']
        ])->innerJoinWith('Categories', function ($q) use ($catId){
            return $q->where(['Categories.id' => $catId]);
        })->toArray();
    }

    /**
     * @param $storyId
     * @param $average
     * @return bool
     */
    public function updateRating($storyId, $average){
        $story = $this->get($storyId);
        if($story){
            $story->rating_average = $average;
            if($this->save($story)){
                return true;
            }
        }
        return false;
    }
    
    /**
     * 
     * @param type $referralId
     * @return type
     */
    public function getTodaysStoriesByReferral($referralId){
        $response = '<div class="modal-header">';
        $stories = $this->find('all')
                ->select(['Stories.id','Stories.title','Stories.description','Stories.created',
                    'Referrals.id','Referrals.name','Referrals.email','Referrals.phone'])
                ->where(['DATE(Stories.created) = CURDATE()'])                
                ->matching('Referrals', function($q) use ($referralId){
                    return $q->where(['Referrals.id' => $referralId]);                    
                })->toArray();                
        if(!empty($stories)){
            $response .= '<h4>'.$stories[0]->_matchingData['Referrals']['name'].' referred in the following stories</h4>'
                    . '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></hr>'
                    . '</div><br/>';
            $response .= '<table style="width:100%"><tr><th>Title</th><th>Description</th><th>Created</th><th>Action</th></tr>';
            foreach($stories as $story){
                $shortDescr = substr($story->description, 0, 100);
                $response .= '<tr><td>'. $story->title.'</td><td>'.$shortDescr.'</td><td>'.$story->created .
                        '</td><td><a href="/admin/Stories/view/'. $story->id.'">View Story</a></td>';
            }
        }
        $response .= '</table>';
        return $response;
    }
}
