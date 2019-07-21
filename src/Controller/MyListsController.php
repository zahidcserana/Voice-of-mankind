<?php
namespace App\Controller;

use App\Controller\AppController;

class MyListsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->loadModel('MyLists');
        $this->loadComponent('Options');
        $this->viewBuilder()->layout('inner');
    }

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $myLists = $this->paginate($this->MyLists);
        $this->set(compact('myLists'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $myList = $this->MyLists->get($id, [
            'contain' => ['Users', 'Categories']
        ]);

        $this->set('myList', $myList);
    }
    
    public function myList(){
        if(!empty($this->loggedinUser)){
            $conditions['type'] = $this->Options->getCategoryTypeByTitle('List');
            $userId = $this->loggedinUser['id'];
            $myLists = $this->MyLists->Categories->find('all', [
                'contain' => ['MyLists'],
                'conditions' => $conditions,
                'group' => 'Categories.id'])
                ->innerJoinWith('MyLists', function ($q) use ($userId){
                    return $q->where(['MyLists.user_id' => $userId]);
                })->toArray();
//            pr($myLists);exit;
            $this->set(compact('myLists'));
        }else{
            $this->redirect(['controller' => 'users','action' => 'login']);
        }
        $pageTitle = 'My Helpful Links';
        $this->set(compact('pageTitle'));
    }

    /**
     * Add method
     **/
    public function add()
    {        
        $myList = $this->MyLists->newEntity();
        if ($this->request->is('post')) {
            $myList = $this->MyLists->patchEntity($myList, $this->request->getData());
            $myList->user_id = $this->loggedinUser['id'];
            if ($this->MyLists->save($myList)) {
                $this->Flash->success(__('The myList has been saved.'));

                return $this->redirect(['action' => 'my-list']);
            }
            $this->Flash->error(__('The myList could not be saved. Please, try again.'));
        }
        $categories = $this->MyLists->Categories->find('treeList', [
            'conditions' => ['type' => $this->Options->getCategoryTypeByTitle('List')]
        ]);
        $this->set(compact('myList', 'categories'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $myList = $this->MyLists->get($id, [
            'contain' => ['Categories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $myList = $this->MyLists->patchEntity($myList, $this->request->getData());
            if ($this->MyLists->save($myList)) {
                $this->Flash->success(__('The myList has been saved.'));

                return $this->redirect(['action' => 'my-list']);
            }
            $this->Flash->error(__('The myList could not be saved. Please, try again.'));
        }
        $categories = $this->MyLists->Categories->find('treeList', [
            'conditions' => ['type' => $this->Options->getCategoryTypeByTitle('List')]
        ]);
        $this->set(compact('myList', 'categories'));
    }

    /**
     * Delete method
     *
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $myList = $this->MyLists->get($id);
        if ($this->MyLists->delete($myList)) {
            $this->Flash->success(__('The myList has been deleted.'));
        } else {
            $this->Flash->error(__('The myList could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
