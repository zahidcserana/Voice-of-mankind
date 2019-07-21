<?php

namespace App\Controller;

use App\Controller\AppController;

class CommentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['ajaxCommentsByStory', 'getAjaxComments','commentResponse']);
    }

    /**
     * Index method
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Stories']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
    }


    /**
     * get Comments By Ajax
     */

    public function getAjaxComments()
    {
        $this->viewBuilder()->setLayout('ajax');
        $limit = 100;
        $comments = array();
        $data = $this->request->getData();
        if (isset($data['content_type']) && !empty($data['content_type'])) {
            $conditions = ['content_id' => $data['content_id'],'content_type' =>$data['content_type']];
            $offset = ($data['page_no'] - 1) * $limit;
            $comments = $this->Comments->find('threaded', [
                'contain' => ['Users'],
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset
            ]);
        }
        $this->set(compact('comments'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Users', 'Stories']
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $stories = $this->Comments->Stories->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users', 'stories'));
    }

    /*
     * Add Response to comment
     */
    public function commentResponse()
    {
        $this->add_model(array('commentResponses', 'Comments'));
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        if ($this->loggedinUser) {
            $data = $this->request->getData();
            if (!empty($data)) {
                $user_id = $this->loggedinUser['id'];
                $comment = $this->commentResponses->find('all')->where(['comment_id' => $data['comment_id'], 'user_id' => $user_id])->first();
                $commentData = $this->Comments->get($data['comment_id']);
                if (!$comment) {
                    $comment = $this->commentResponses->newEntity();
                    $data['user_id'] = $user_id;
                    // Update Like/ Dislike
                    if ($data['response_type'] == 1) {
                        $total_like = $commentData->total_like + 1;
                        $commentData['total_like'] = $total_like;
                        $commentObj = $this->Comments->save($commentData);
                    } else {
                        $total_dislike = $commentData->total_dislike + 1;
                        $commentData['total_dislike'] = $total_dislike;
                        $commentObj = $this->Comments->save($commentData);
                    }
                    $comment = $this->commentResponses->patchEntity($comment, $data);
                    $saveResponse = $this->commentResponses->save($comment);
                    $response['like'] = $commentObj->total_like;
                    $response['dislike'] = $commentObj->total_dislike;
                } else {
                    if ($data['response_type'] != $comment['response_type']) {
                        if ($data['response_type'] == 0) {
                            $total_like = $commentData->total_like - 1;
                            $total_dislike = $commentData->total_dislike + 1;
                        } else {
                            $total_like = $commentData->total_like + 1;
                            $total_dislike = $commentData->total_dislike - 1;
                        }
                        $commentData['total_like'] = $total_like;
                        $commentData['total_dislike'] = $total_dislike;
                        $commentObj = $this->Comments->save($commentData);
                        $comment = $this->commentResponses->patchEntity($comment, $data);
                        $saveResponse = $this->commentResponses->save($comment);
                        // pr($saveResponse);exit();
                        $response['like'] = $commentObj->total_like;
                        $response['dislike'] = $commentObj->total_dislike;
                    } else {
                        $saveResponse = false;
                        $response['success'] = false;
                        $response['error_message'] = 'Already added.';
                    }
                }
                if (!$saveResponse) {
                    $response['success'] = false;
                    $response['error_message'] = 'Save Failed! Please try again.';
                }
            } else {
                $response['success'] = false;
                $response['error_message'] = 'Empty comment.';
            }
        } else {
            $response['success'] = false;
            $response['error_message'] = 'Please login first do place a comment.';
        }
       // echo json_encode($response);
        $responseResult = json_encode($response);
        $this->response->type('json');
        $this->response->body($responseResult);
        return $this->response;
    }

    /*
     * New comment
     */
    public function ajaxAdd()
    {
        $this->add_model(array('Users'));
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        if ($this->loggedinUser) {
            $data = $this->request->getData();
            if (!empty($data)) {
                $user = $this->Users->get($this->loggedinUser['id']);
                $comment = $this->Comments->newEntity();
                $comment = $this->Comments->patchEntity($comment, $data);
                $comment->user_id = $this->loggedinUser['id'];
                $saveResponse = $this->Comments->save($comment);
                if (!$saveResponse) {
                    $response['success'] = false;
                    $response['error_message'] = 'Save Failed! Please try again.';
                } else {
                    $response['id'] = $comment->id;
                    $response['comment'] = $comment->comment;
                    $response['created'] = $comment->created;
                    $response['user'] = $this->loggedinUser['first_name'] . ' ' . $this->loggedinUser['last_name'];
                    $response['user_id'] = $this->loggedinUser['id'];
                    $response['avatar_name'] = $user['avatar_name'];
                }
            } else {
                $response['success'] = false;
                $response['error_message'] = 'Empty comment.';
            }
        } else {
            $response['success'] = false;
            $response['error_message'] = 'Please login first do place a comment.';
        }
        //echo json_encode($response);
        $responseResult = json_encode($response);
        $this->response->type('json');
        $this->response->body($responseResult);
        return $this->response;
    }

    /*
     * New reply to comment
     */
    public function replyComment($contentId)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        if ($this->loggedinUser) {
            $data = $this->request->getData();
            if (!empty($data)) {
                $comment = $this->Comments->newEntity();
                $comment = $this->Comments->patchEntity($comment, $data);
                $comment->user_id = $this->loggedinUser['id'];
                $comment->content_id = $contentId;
                $saveResponse = $this->Comments->save($comment);
               // pr($saveResponse);
                if (!$saveResponse) {
                    $response['success'] = false;
                    $response['error_message'] = 'Save Failed! Please try again.';
                } else {
                    $response['id'] = $comment->id;
                    $response['comment'] = $comment->comment;
                    $response['created'] = $comment->created;
                    $response['user'] = $this->loggedinUser['first_name'] . ' ' . $this->loggedinUser['last_name'];
                    $response['user_id'] = $this->loggedinUser['id'];
                    $response['avatar_name'] = $this->loggedinUser['avatar_name'];
                }
            } else {
                $response['success'] = false;
                $response['error_message'] = 'Empty comment.';
            }
        } else {
            $response['success'] = false;
            $response['error_message'] = 'Please login first do place a comment.';
        }
        $result = json_encode($response);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
        //echo json_encode($response);
    }


    /**
     * Edit method
     *
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $stories = $this->Comments->Stories->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users', 'stories'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function ajaxDelete($id = null)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        $user_id = $this->loggedinUser['id'];
        $user_type = $this->loggedinUser['user_type_id'];
        $comment = $this->Comments->get($id);
       // pr($user_id);exit();
        if($comment && ($user_id == $comment->user_id || $user_type == 1)){
            $this->Comments->delete($comment);
        }else{
            $response['success'] = false;
            $response['error_message'] = 'Sorry! You are not permitted.';
        }
        $result = json_encode($response);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }
}
