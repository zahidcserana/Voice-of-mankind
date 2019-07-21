<?php
namespace App\Controller;

use App\Controller\AppController;

class PursuesController extends AppController
{
    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     **/
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
     **/
    public function add($referralId = null)
    {
        $pursue = $this->Pursues->newEntity();
        if ($this->request->is('post')) {
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
