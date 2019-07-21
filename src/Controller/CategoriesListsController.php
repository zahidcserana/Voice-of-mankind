<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesListsController extends AppController
{

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Lists']
        ];
        $categoriesLists = $this->paginate($this->CategoriesLists);

        $this->set(compact('categoriesLists'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $categoriesList = $this->CategoriesLists->get($id, [
            'contain' => ['Categories', 'Lists']
        ]);

        $this->set('categoriesList', $categoriesList);
    }

    /**
     * Add method
     **/
    public function add()
    {
        $categoriesList = $this->CategoriesLists->newEntity();
        if ($this->request->is('post')) {
            $categoriesList = $this->CategoriesLists->patchEntity($categoriesList, $this->request->getData());
            if ($this->CategoriesLists->save($categoriesList)) {
                $this->Flash->success(__('The categories list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories list could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesLists->Categories->find('list', ['limit' => 200]);
        $lists = $this->CategoriesLists->Lists->find('list', ['limit' => 200]);
        $this->set(compact('categoriesList', 'categories', 'lists'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $categoriesList = $this->CategoriesLists->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriesList = $this->CategoriesLists->patchEntity($categoriesList, $this->request->getData());
            if ($this->CategoriesLists->save($categoriesList)) {
                $this->Flash->success(__('The categories list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories list could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesLists->Categories->find('list', ['limit' => 200]);
        $lists = $this->CategoriesLists->Lists->find('list', ['limit' => 200]);
        $this->set(compact('categoriesList', 'categories', 'lists'));
    }

    /**
     * Delete method
     *
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriesList = $this->CategoriesLists->get($id);
        if ($this->CategoriesLists->delete($categoriesList)) {
            $this->Flash->success(__('The categories list has been deleted.'));
        } else {
            $this->Flash->error(__('The categories list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
