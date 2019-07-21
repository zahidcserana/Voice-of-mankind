<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class PursuesController extends AppController
{
    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Referrals', 'Users']
        ];
        $pursues = $this->paginate($this->Pursues);

        $this->set(compact('pursues'));
    }

    /**
     * Add method
     */
    public function add($referralId = null)
    {
        $pursue = $this->Pursues->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->loggedinUser['id'];
            $data['pursue_date'] = date('Y-m-d H:i:s', time());
            $pursue = $this->Pursues->patchEntity($pursue, $data);
            if ($this->Pursues->save($pursue)) {
                $this->Flash->success(__('The pursue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pursue could not be saved. Please, try again.'));
        }
        $this->set(compact('pursue'));
        if($referralId){
            $this->set(compact('referralId'));
        }
    }
    
    public function ajaxAddResponse(){
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $data = $this->request->getData();
        $response['success'] = true;
        if($this->request->is('ajax') && !empty($data)){
            $pursue = $this->Pursues->newEntity();
            $data['user_id'] = $this->loggedinUser['id'];
            $data['pursue_date'] = date('Y-m-d H:i:s', time());
            $pursue = $this->Pursues->patchEntity($pursue, $data);
            if (!$this->Pursues->save($pursue)) {
                $response['success'] = false;
                $response['message'] = 'Save Failed! Please try again later';
            }else{
                $this->Flash->success(__('The pursue has been saved.'));
            }
        }
        echo json_encode($response);
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $pursue = $this->Pursues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pursue = $this->Pursues->patchEntity($pursue, $this->request->getData());
            if ($this->Pursues->save($pursue)) {
                $this->Flash->success(__('The pursue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pursue could not be saved. Please, try again.'));
        }
        $referrals = $this->Pursues->Referrals->find('list', ['limit' => 200]);
        $users = $this->Pursues->Users->find('list', ['limit' => 200]);
        $this->set(compact('pursue', 'referrals', 'users'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pursue = $this->Pursues->get($id);
        if ($this->Pursues->delete($pursue)) {
            $this->Flash->success(__('The pursue has been deleted.'));
        } else {
            $this->Flash->error(__('The pursue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
