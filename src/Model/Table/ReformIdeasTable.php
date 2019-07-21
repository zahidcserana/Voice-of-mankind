<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReformIdeasTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('reform_ideas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Agencies', [
            'foreignKey' => 'agency_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Stories', [
            'foreignKey' => 'story_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'content_id'
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

//        $validator
//            ->integer('agency_id')
//            ->requirePresence('agency_id', 'create')
//            ->notEmpty('agency_id');

        $validator
            ->scalar('idea')
            ->maxLength('idea', 4294967295)
            ->requirePresence('idea', 'create')
            ->notEmpty('idea');

        return $validator;
    }

    /*
     * Related Reform Ideas
     */
    public function getRelatedReform($reform){
        $conditions['ReformIdeas.id !='] = $reform->id;
        $conditions['ReformIdeas.agency_id'] = $reform->agency_id;

        //$catId = $reform->agency_id;
        return $this->find('all', [
            'contain' => ['Users', 'Stories', 'Agencies'],
            'conditions' => $conditions,
            'limit' => 10,
            'order' => ['ReformIdeas.created' => 'DESC']
        ])->toArray();
    }

    /*
     * Recent Reform Ideas
     */
    public function getRecentReform(){
        return $this->find('all', [
            'contain' => ['Users', 'Stories', 'Agencies'],
            'limit' => 5,
            'order' => ['ReformIdeas.created' => 'DESC']
        ])->toArray();
    }
}
