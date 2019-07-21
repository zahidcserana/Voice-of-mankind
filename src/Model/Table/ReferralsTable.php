<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReferralsTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('referrals');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professions', [
            'foreignKey' => 'profession_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Stories', [
            'foreignKey' => 'referral_id',
            'targetForeignKey' => 'story_id',
            'joinTable' => 'referrals_stories'
        ]);
        $this->hasMany('Pursues', [
            'foreignKey' => 'referral_id'
        ]);
        $this->hasMany('Ads', [
            'foreignKey' => 'referral_id'
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
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('profession_id')
            ->requirePresence('profession_id', 'create')
            ->notEmpty('profession_id');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmpty('email');//When non admin/moderator is adding referral he might not know the referrals phone or email

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->allowEmpty('address');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->isUnique(['email']));
        //$rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }

    /**
     * @desc : Add/Updated referral
     */
    public function saveReferral($referral){
        if(!property_exists($referral, 'is_active')){
            $referral->is_active = 1;//since by default it will be true
        }
        return $this->save($referral);
    }
    
    /**
     * 
     * @param type $conditions
     * @param type $offset
     * @return string
     */
    public function referralsForSelect2($conditions, $offset){
        $referrals = $this->find('all', [
            'fields' => ['id','profession_id','name','email', 'phone', 'address'],
            'conditions' => $conditions,
            'offset' => $offset,
            'limit' => 10
        ])->toArray();
        $totalCount = $this->find()->count();
        $list = [];
        if(!empty($referrals)){
            foreach($referrals as $referral){
                $list[$referral->id]['name'] = $referral->name;
                if(!empty($referral->phone)){
                    $list[$referral->id]['phone'] = $referral->phone;
                }
                if(!empty($referral->email)){
                    $list[$referral->id]['email'] = $referral->email;
                }
                if(!empty($referral->address)){
                    $list[$referral->id]['address'] = $referral->address;
                }           
            }
        }
        return array(
            "results" => $list,
            "pagination" => array(
                "more" => true
            ),
            "total_count" => $totalCount
        );
    }    
}
