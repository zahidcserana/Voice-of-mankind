<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CountriesTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('countries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('States', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'country_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('country_code')
            ->maxLength('country_code', 7)
            ->allowEmpty('country_code');

        return $validator;
    }

    /**
     * @desc Get country id from country code like "US", "UK" etc
     * @param null $countryCode
     * @return bool
     */
    public function getIdByCode($countryCode = null){
        if($countryCode){
            $id = $this->findByCountryCode($countryCode)->toArray()[0]->id;
            if($id){
                return $id;
            }
        }
        return false;
    }
}
