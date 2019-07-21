<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MediaTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('media');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->scalar('mime_type')
            ->maxLength('mime_type', 50)
            ->allowEmpty('mime_type');

        $validator
            ->scalar('file_name')
            //->maxLength('file_name', 50)
            ->requirePresence('file_name', 'create')
            ->notEmpty('file_name');

        $validator
            ->boolean('is_featured')
            ->requirePresence('is_featured', 'create')
            ->notEmpty('is_featured');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['story_id'], 'Stories'));

        return $rules;
    }

    public function saveYoutubeLink($storyId, $youtubeLink, $type){
        $response['success'] = true;
        $savable['story_id'] = $storyId;
        $savable['type'] = $type;
        $savable['mime_type'] = 'youtube';
        $savable['file_name'] = $youtubeLink;
        $savable['is_featured'] = 0;

        $media = $this->newEntity();
        $media = $this->patchEntity($media, $savable);

        if(!$this->save($media)){
            $response['success'] = false;
            $response['error_message'] = 'Media uploaded but could not be saved.';
        }
        return $response;
    }


}
