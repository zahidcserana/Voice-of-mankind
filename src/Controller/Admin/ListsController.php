<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class ListsController extends AppController
{

    /**
     * Index method
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $lists = $this->paginate($this->Lists);

        $this->set(compact('lists'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $list = $this->Lists->get($id, [
            'contain' => ['Users', 'Categories']
        ]);

        $this->set('list', $list);
    }

    /**
     * Add method
     */
    public function add()
    {
        $list = $this->Lists->newEntity();
        if ($this->request->is('post')) {
            $list = $this->Lists->patchEntity($list, $this->request->getData());
            if ($this->Lists->save($list)) {
                $this->Flash->success(__('The list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list could not be saved. Please, try again.'));
        }
        $users = $this->Lists->Users->find('list', ['limit' => 200]);
        $categories = $this->Lists->Categories->find('list', ['limit' => 200]);
        $this->set(compact('list', 'users', 'categories'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $list = $this->Lists->get($id, [
            'contain' => ['Categories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $list = $this->Lists->patchEntity($list, $this->request->getData());
            if ($this->Lists->save($list)) {
                $this->Flash->success(__('The list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The list could not be saved. Please, try again.'));
        }
        $users = $this->Lists->Users->find('list', ['limit' => 200]);
        $categories = $this->Lists->Categories->find('list', ['limit' => 200]);
        $this->set(compact('list', 'users', 'categories'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $list = $this->Lists->get($id);
        if ($this->Lists->delete($list)) {
            $this->Flash->success(__('The list has been deleted.'));
        } else {
            $this->Flash->error(__('The list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
