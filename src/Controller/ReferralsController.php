<?php

namespace App\Controller;

use App\Controller\AppController;

class ReferralsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index method
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['States']
        ];
        $referrals = $this->paginate($this->Referrals);

        $this->set(compact('referrals'));
    }

    /**
     * ajax Get List
     */
    public function ajaxGetList()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;

        if (!empty($this->request->getQueryParams())) {
            $conditions = array();
            $params = $this->request->getQueryParams();
            if (isset($params['term']) && !empty(trim($params['term']))) {
                $conditions['Referrals.name LIKE'] = '%' . trim($params['term']) . '%';
            }
            if (isset($params['profession_id']) && !empty($params['profession_id'])) {
                $conditions['Referrals.profession_id'] = $params['profession_id'];
            }
            $offset = ($this->request->getQueryParams()['page'] - 1) * 10;
            $results = $this->Referrals->referralsForSelect2($conditions, $offset);

            $responseResult = json_encode($results);
            $this->response->type('json');
            $this->response->body($responseResult);

            return $this->response;
        }
    }

    /**
     * Add method
     */
    public function add()
    {
        $referral = $this->Referrals->newEntity();
        if ($this->request->is('post')) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            $response = $this->Referrals->saveReferral($referral);
            if (!$response) {
                $this->Flash->error(__('The Referral could not be saved. Please, try again.'));
            } else {
                $this->Flash->success(__('The Referral has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $states = $this->Referrals->States->find('list', ['limit' => 200]);
        $stories = $this->Referrals->Stories->find('list', ['limit' => 200]);
        $this->set(compact('referral', 'states', 'stories'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => ['Stories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referral could not be saved. Please, try again.'));
        }
        $states = $this->Referrals->States->find('list', ['limit' => 200]);
        $stories = $this->Referrals->Stories->find('list', ['limit' => 200]);
        $this->set(compact('referral', 'states', 'stories'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $referral = $this->Referrals->get($id);
        if ($this->Referrals->delete($referral)) {
            $this->Flash->success(__('The referral has been deleted.'));
        } else {
            $this->Flash->error(__('The referral could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
