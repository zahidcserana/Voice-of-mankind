<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
       // $this->setDisplayField('first_name');
        $this->setDisplayField('full_name');
        //$this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserTypes', [
            'foreignKey' => 'user_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id'
        ]);
        $this->belongsTo('Statezips', [
            'foreignKey' => 'zip_id'
        ]);
        $this->hasMany('Agencies', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('MyLists', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Ratings', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Stories', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Ads', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Pursues', [
            'foreignKey' => 'user_id'
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
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('about_me')
            ->allowEmpty('about_me');

        $validator
            ->dateTime('token_created_at')
            ->allowEmpty('token_created_at');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_type_id'], 'UserTypes'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }

    /**
     * @desc To trim form field value
     * @param $data
     * @return array
     */
    public function trimFormData($data){
        if(is_array($data) && !empty($data)){
            foreach($data as $k => $v){
                $data[$k] = trim($v);
            }
        }
        return $data;
    }

    public function saveProfile($user, $data, $isUpdatePass = false){
        $data = $this->trimFormData($data);
        //first validate
        if($isUpdatePass){
            if(isset($data['password']) && !empty($data['password'])){
                if((new \Cake\Auth\DefaultPasswordHasher)->check($data['password'], $user->password)){
                    if($data['new_password'] == $data['confirm_password']){
                        unset($data['confirm_password']);
                        $data['password'] = (new \Cake\Auth\DefaultPasswordHasher)->hash($data['new_password']);
                        unset($data['new_password']);
                    }else{
                        return ['success' => false, 'error_message' => 'Update Failed! New Password and Confirm password mismatched!'];
                    }
                }else{
                    return ['success' => false, 'error_message' => 'Update Failed! Given old password is not matched with the exising one!'];
                }
            }
        }
        $user = $this->patchEntity($user, $data);
        $response = $this->save($user);
        if($response){
            return array('success' => true);
        }else{
            return array('success' => false, 'error_message' => 'Save Failed!');
        }
    }
}
