<?php
namespace App\Controller;

use App\Controller\AppController;

class MediaController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Upload');
        $this->loadComponent('Options');
        $this->Auth->allow(['showImage']);
    }

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Stories']
        ];
        $media = $this->paginate($this->Media);

        $this->set(compact('media'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $media = $this->Media->get($id, [
            'contain' => ['Stories']
        ]);

        $this->set('media', $media);
    }

    /**
     * add Story Files
     */

    public function addStoryFilesAjax(){
        $response['success'] = true;
        $data = $this->request->getData();

        if(!empty($data) && (isset($data['file'][0]) && !empty($data['file'][0]))){
//            $this->log(print_r($data, true),'error');
            $uploadResponse = $this->Upload->uploadFile($data['file'][0], $this->loggedinUser);

            if($uploadResponse['success']){
                unset($uploadResponse['success']);
                $uploadResponse['story_id'] = $this->request->getData('story_id');
                $uploadResponse['type'] = $this->request->getData('type');

                $savable = $uploadResponse;
                $savable['is_featured'] = 0;
                $savable['story_id'] = $data['story_id'];
                $savable['type'] = $data['type'];

                $media = $this->Media->newEntity();
                $media = $this->Media->patchEntity($media, $savable);
                $this->Media->save($media);
                //pr($media->errors());exit();
                if(!$this->Media->save($media)){
                    $response['success'] = false;
                    $response['error_message'] = 'Media uploaded but could not be saved.';
                }
            }else{
                $response = $uploadResponse;
            }
        }else{
            $response['success'] = false;
            $response['error_message'] = 'No file found to upload.';
        }
        echo json_encode($response);
    }

    /**
     * Add method
     **/
    public function add()
    {
        $media = $this->Media->newEntity();
        if ($this->request->is('post')) {
            $media = $this->Media->patchEntity($media, $this->request->getData());
            if ($this->Media->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $stories = $this->Media->Stories->find('list', ['limit' => 200]);
        $this->set(compact('media', 'stories'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $media = $this->Media->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Media->patchEntity($media, $this->request->getData());
            if ($this->Media->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $stories = $this->Media->Stories->find('list', ['limit' => 200]);
        $this->set(compact('media', 'stories'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $media = $this->Media->get($id);
        if ($this->Media->delete($media)) {
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deleteMedia($id = null,$storyId=null)
    {
        $media = $this->Media->get($id);
        if ($this->Media->delete($media)) {
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect('/stories/add-details/'.$media->story_id);
    }

    public function showImage($id, $userId, $imageName) {
        $image_path = WWW_ROOT.'img'.DS. 'stories'.DS.($userId.DS. $imageName);
        if (!is_file($image_path)) {
            $image_path = WWW_ROOT.'img'.DS.'blog3.jpeg';
        }
        return $this->response->withFile($image_path);
    }

    public function download($userId, $fileName){
        $filePath = WWW_ROOT.'img'.DS. 'stories'.DS.($userId.DS. $fileName);
        if (!is_file($filePath)) {
            $filePath = WWW_ROOT.'img'.DS.'blog3.jpeg';
        }
        return $this->response->withFile($filePath, ['download' => true, 'name' => $fileName]);
    }
}
