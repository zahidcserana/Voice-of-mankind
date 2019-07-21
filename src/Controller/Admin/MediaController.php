<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class MediaController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Upload');
        $this->loadComponent('Options');
        $this->Auth->allow(['showImage']);
    }

    public function deleteMedia($id = null,$storyId=null)
    {
        $media = $this->Media->get($id);
        if ($this->Media->delete($media)) {
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect('admin/stories/view/'.$media->story_id);
    }
}
