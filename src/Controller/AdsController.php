<?php
namespace App\Controller;

use App\Controller\AppController;

class AdsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Auth->allow('showImage');
    }

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Referrals']
        ];
        $ads = $this->paginate($this->Ads);

        $this->set(compact('ads'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $ad = $this->Ads->get($id, [
            'contain' => ['Users', 'Referrals']
        ]);

        $this->set('ad', $ad);
    }

    /**
     * Add method
     */
    public function add()
    {
        $ad = $this->Ads->newEntity();
        if ($this->request->is('post')) {
            $ad = $this->Ads->patchEntity($ad, $this->request->getData());
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $users = $this->Ads->Users->find('list', ['limit' => 200]);
        $referrals = $this->Ads->Referrals->find('list', ['limit' => 200]);
        $this->set(compact('ad', 'users', 'referrals'));
    }

    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $ad = $this->Ads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ad = $this->Ads->patchEntity($ad, $this->request->getData());
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $users = $this->Ads->Users->find('list', ['limit' => 200]);
        $referrals = $this->Ads->Referrals->find('list', ['limit' => 200]);
        $this->set(compact('ad', 'users', 'referrals'));
    }

    /**
     * Delete method
     *
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ad = $this->Ads->get($id);
        if ($this->Ads->delete($ad)) {
            $this->Flash->success(__('The ad has been deleted.'));
        } else {
            $this->Flash->error(__('The ad could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * To show ad image
     * @param type $id
     * @param type $pageName
     * @param type $imageName
     * @return type
     */
    public function showImage($id, $pageName, $imageName) {
        $ad = $this->Ads->get($id);
        $image_path = WWW_ROOT.'img'.DS. 'ads' .DS. $pageName. DS. $imageName;
        if (!is_file($image_path)) {
            $image_path = WWW_ROOT.'img'.DS.'blog3.jpeg';
        }
        return $this->response->withFile($image_path);
    }
}
