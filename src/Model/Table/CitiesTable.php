<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class CitiesTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Agencies', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Referrals', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Statezips', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Stories', [
            'foreignKey' => 'city_id'
        ]);
        
        $this->hasMany('Users', [
            'foreignKey' => 'city_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 35)
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
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['county_id'], 'Counties'));

        return $rules;
    }
}
