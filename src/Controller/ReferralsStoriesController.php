<?php
namespace App\Controller;

use App\Controller\AppController;

class ReferralsStoriesController extends AppController
{

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Referrals', 'Stories']
        ];
        $referralsStories = $this->paginate($this->ReferralsStories);

        $this->set(compact('referralsStories'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $referralsStory = $this->ReferralsStories->get($id, [
            'contain' => ['Referrals', 'Stories']
        ]);

        $this->set('referralsStory', $referralsStory);
    }

    /**
     * Add method
     */
    public function add()
    {
        $referralsStory = $this->ReferralsStories->newEntity();
        if ($this->request->is('post')) {
            $referralsStory = $this->ReferralsStories->patchEntity($referralsStory, $this->request->getData());
            if ($this->ReferralsStories->save($referralsStory)) {
                $this->Flash->success(__('The referrals story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referrals story could not be saved. Please, try again.'));
        }
        $referrals = $this->ReferralsStories->Referrals->find('list', ['limit' => 200]);
        $stories = $this->ReferralsStories->Stories->find('list', ['limit' => 200]);
        $this->set(compact('referralsStory', 'referrals', 'stories'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $referralsStory = $this->ReferralsStories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referralsStory = $this->ReferralsStories->patchEntity($referralsStory, $this->request->getData());
            if ($this->ReferralsStories->save($referralsStory)) {
                $this->Flash->success(__('The referrals story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referrals story could not be saved. Please, try again.'));
        }
        $referrals = $this->ReferralsStories->Referrals->find('list', ['limit' => 200]);
        $stories = $this->ReferralsStories->Stories->find('list', ['limit' => 200]);
        $this->set(compact('referralsStory', 'referrals', 'stories'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $referralsStory = $this->ReferralsStories->get($id);
        if ($this->ReferralsStories->delete($referralsStory)) {
            $this->Flash->success(__('The referrals story has been deleted.'));
        } else {
            $this->Flash->error(__('The referrals story could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
