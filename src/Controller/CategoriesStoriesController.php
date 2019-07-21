<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesStoriesController extends AppController
{

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Stories']
        ];
        $categoriesStories = $this->paginate($this->CategoriesStories);

        $this->set(compact('categoriesStories'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $categoriesStory = $this->CategoriesStories->get($id, [
            'contain' => ['Categories', 'Stories']
        ]);

        $this->set('categoriesStory', $categoriesStory);
    }

    /**
     * Add method
     **/
    public function add()
    {
        $categoriesStory = $this->CategoriesStories->newEntity();
        if ($this->request->is('post')) {
            $categoriesStory = $this->CategoriesStories->patchEntity($categoriesStory, $this->request->getData());
            if ($this->CategoriesStories->save($categoriesStory)) {
                $this->Flash->success(__('The categories story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories story could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesStories->Categories->find('list', ['limit' => 200]);
        $stories = $this->CategoriesStories->Stories->find('list', ['limit' => 200]);
        $this->set(compact('categoriesStory', 'categories', 'stories'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $categoriesStory = $this->CategoriesStories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriesStory = $this->CategoriesStories->patchEntity($categoriesStory, $this->request->getData());
            if ($this->CategoriesStories->save($categoriesStory)) {
                $this->Flash->success(__('The categories story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories story could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesStories->Categories->find('list', ['limit' => 200]);
        $stories = $this->CategoriesStories->Stories->find('list', ['limit' => 200]);
        $this->set(compact('categoriesStory', 'categories', 'stories'));
    }

    /**
     * Delete method
     *
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriesStory = $this->CategoriesStories->get($id);
        if ($this->CategoriesStories->delete($categoriesStory)) {
            $this->Flash->success(__('The categories story has been deleted.'));
        } else {
            $this->Flash->error(__('The categories story could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
