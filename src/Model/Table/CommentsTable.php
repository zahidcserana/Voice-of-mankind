<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentComments', [
            'className' => 'comments',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildComments', [
            'className' => 'comments',
            'foreignKey' => 'parent_id'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stories', [
            'foreignKey' => 'content_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('ReformIdeas', [
            'foreignKey' => 'content_id',
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
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

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
     * @param null $storyId
     * @param int $limit
     * @return float|int
     */
    public function getTotalPaginationLinks($content_type,$content_id = null, $limit = 10){
        $totalRow = $this->find('all', [
            'conditions' => ['Comments.content_type' => $content_type,'Comments.content_id' => $content_id]])->count();
        $totalPage = 0;
        if($totalRow % $limit != 0){
            $totalPage = (int)($totalRow/$limit) + 1;
        }else{
            $totalPage =  (int)$totalRow/$limit;
        }
        return $totalPage;
    }


}
