<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
    }

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = ['treeList'];
        $categories = $this->paginate($this->Categories);
        $categoryTypes = $this->Options->getCategoryTypes();

        $this->set(compact('categories', 'categoryTypes'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Lists', 'Stories', 'ChildCategories']
        ]);

        $this->set('category', $category);
    }

    /**
     * Add method
     **/
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $categoryTypes = $this->Options->getCategoryTypes();
        $categories = $this->Categories->find('treeList');
        $this->set(compact('category', 'categories', 'categoryTypes'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $categoryTypes = $this->Options->getCategoryTypes();
        $categories = $this->Categories->find('treeList');
        $this->set(compact('category', 'categories', 'categoryTypes'));
    }

    /**
     * Delete method
     *
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
