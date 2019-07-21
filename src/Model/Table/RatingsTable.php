<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RatingsTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ratings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stories', [
            'foreignKey' => 'story_id',
            'joinType' => 'INNER'
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
            ->numeric('rating')
            ->requirePresence('rating', 'create')
            ->notEmpty('rating');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['story_id'], 'Stories'));

        return $rules;
    }

    /**
     * @param $data
     * @param $user
     * @return mixed
     */
    public function addRating($data, $user){
        $response['success'] = true;
        if( (isset($data['story_id']) && isset($data['rating'])) && !empty($data['story_id']) && !empty($data['rating']) ){
            if($data['rating']>=1 && $data['rating']<=5){
                //now have to check whether the user already gave rating for this story or not
                $rating = $this->find('all', ['conditions' => ['story_id' => $data['story_id'], 'user_id' => $user['id']]])->toArray();
                if(!$rating){
                    $data['user_id'] = $user['id'];
                    $data['rating'] = (float)$data['rating'];
                    $rating = $this->newEntity();
                    $rating = $this->patchEntity($rating, $data);
                    if(!$this->save($rating)){
                        $response['success'] = false;
                        $response['error_message'] = 'Sorry rating could not be saved.';
                    }else{
                        $ratingSum = $this->find()
                            ->select(['rating_sum' => $this->find()->func()->sum('Ratings.rating')])
                            ->where(['Ratings.story_id' => $data['story_id']])->toArray();

                        $sum = $ratingSum[0]->rating_sum;

                        $totalRating = $this->find()->where(['Ratings.story_id' => $data['story_id']])->count();
                        $avg = (float)$sum/$totalRating;
                        $this->Stories->updateRating($data['story_id'], $avg);
                    }
                }else{
                    $response['success'] = false;
                    $response['error_message'] = 'Sorry your rating is not received since you already gave rating for this story.';
                }
            }else{
                $response['success'] = false;
                $response['error_message'] = 'Invalid rating value.Rating must be between 1 to 5';
            }
        }else{
            $response['success'] = false;
            $response['error_message'] = 'Invalid story or rating value';
        }
        return $response;
    }
}
