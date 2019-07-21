<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PursuesTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pursues');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Referrals', [
            'foreignKey' => 'referral_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->scalar('response')
            ->requirePresence('response', 'create')
            ->notEmpty('response');

        $validator
            ->dateTime('pursue_date')
            ->requirePresence('pursue_date', 'create')
            ->notEmpty('pursue_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['referral_id'], 'Referrals'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    
    /**
     * 
     * @param type $referralId
     * @return type
     */
    public function getPursuesByReferral($referralId, $userId){
        $response = '<div class="modal-header">';
        $pursues = $this->find('all')
                ->select(['Pursues.id','Pursues.user_id','Pursues.response','Pursues.pursue_date',
                    'Users.id','Users.first_name', 'Users.last_name', 'Referrals.name'])
                ->matching('Users', function($q) use ($userId){
                    return $q->where(['Pursues.user_id' => $userId]);                    
                })
                ->matching('Referrals', function($q) use ($referralId){
                    return $q->where(['Referrals.id' => $referralId]);                    
                })
                ->order(['Pursues.pursue_date' => 'DESC'])
                ->toArray();
        $referral = $this->Referrals->get($referralId);
        
//        pr($pursues);exit;
        if(!empty($pursues)){ 
            $response .= '<h4>Communication details with '.$referral->name.'</h4>'
                    . '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></hr>'
                    . '</div><br/>';
            $response .= '<table style="width:100%"><tr><th>Contacted By</th><th>Response</th><th>Contacted At</th></tr>';
            foreach($pursues as $pursue){
                $response .= '<tr><td>'. $pursue->_matchingData['Users']['first_name'].' '.$pursue->_matchingData['Users']['last_name'].
                        '</td><td>'.$pursue->response.'</td><td>'.$pursue->pursue_date .
                        '</td>';
            }
        }else{
            $response .= '<h4>Referred Person('.$referral->name.') is not communicated yet!</h4>'
                    . '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></hr>'
                    . '</div>';
        }
//        $response .= '</table></br></br><a href="/admin/Pursues/add/'. $referralId.'">Add Response</a>';
        $response .= '</table></br><a href="#" id="addPursueResponse">Add Response</a><br/><br/>'
                .'<div id="formContainer" style="visibility:hidden"><label>Response</label><br/>'
                .'<input type="hidden" id="userId" value="'.$userId.'"/><input type="hidden" id="referralId" value="'.$referralId.'"/>'
                . '<textarea rows="3" cols="60" id="pursue"></textarea><br/><button id="savePursueResponse">Save</button></div>';
        return $response;
    }
    
}
