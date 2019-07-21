<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CountiesTable extends Table
{

    /**
     * Initialize method
     *
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('counties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Agencies', [
            'foreignKey' => 'county_id'
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'county_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Referrals', [
            'foreignKey' => 'county_id'
        ]);
        $this->hasMany('Statezips', [
            'foreignKey' => 'county_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('Stories', [
            'foreignKey' => 'county_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'county_id'
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
            ->maxLength('name', 25)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('latitude')
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->decimal('longitude')
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

        $validator
            ->integer('population')
            ->requirePresence('population', 'create')
            ->notEmpty('population');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
