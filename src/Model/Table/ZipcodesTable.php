<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class ZipcodesTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('zipcodes');
        $this->setDisplayField('zip');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Statezips', [
            'foreignKey' => 'state_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
            ->scalar('zip')
            ->maxLength('zip', 5)
            ->allowEmpty('zip');

        $validator
            ->scalar('zipext')
            ->maxLength('zipext', 4)
            ->allowEmpty('zipext');

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
}
