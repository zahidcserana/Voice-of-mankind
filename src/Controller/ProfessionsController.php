<?php
namespace App\Controller;

use App\Controller\AppController;

class ProfessionsController extends AppController
{
    public function index() {
        $professions = $this->paginate($this->Professions);
        $this->set(compact('professions'));
    }
    
    public function add() {
        $profession = $this->Professions->newEntity();
        if ($this->request->is('post')) {
            $profession = $this->Professions->patchEntity($profession, $this->request->getData());
            if ($this->Professions->save($profession)) {
                $this->Flash->success(__('The profession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profession could not be saved. Please, try again.'));
        }
        $this->set(compact('profession'));
    }
    
    public function edit($id = null) {
        $profession = $this->Professions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profession = $this->Professions->patchEntity($profession, $this->request->getData());
            if ($this->Professions->save($profession)) {
                $this->Flash->success(__('The profession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profession could not be saved. Please, try again.'));
        }
        $this->set(compact('profession'));
    }
    
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $profession = $this->Professions->get($id);
        if ($this->Professions->delete($profession)) {
            $this->Flash->success(__('The profession has been deleted.'));
        } else {
            $this->Flash->error(__('The profession could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
