<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class CommentsController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
        $this->Auth->allow('ajaxCommentsByStory');
    }
    /**
     * get latest 5 Comments of a Story In Admin
     */
    public function commentsByStory(){
        $this->viewBuilder()->setLayout('ajax');
        $limit = 5;
        $comments = array();
        $data = $this->request->getData();
        $storyId = $data['content_id'];
        $type = $data['content_type'];
        if(isset($data['content_id']) && !empty($data['content_id'])){
            $conditions = ['content_id' => $data['content_id'],'content_type' =>$data['content_type']];
            $offset = ($data['page_no']-1)*$limit;
            $comments = $this->Comments->find('all', [
                'contain' => ['Users'],
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => ['Comments.created' => 'DESC']
            ]);
        }
        $this->set(compact('comments','storyId','type'));
    }

    /**
     * get all Comments of a Story In Admin
     */
    public function getComments(){
        $this->viewBuilder()->setLayout('ajax');
        $limit = 10;
        $comments = array();
        $data = $this->request->getData();

        if(isset($data['content_id']) && !empty($data['content_id'])){
            //$conditions = ['content_id' => $data['story_id']];
            $conditions = ['content_id' => $data['content_id'],'content_type' =>$data['content_type']];
            $offset = ($data['page_no']-1)*$limit;
            $comments = $this->Comments->find('all', [
                'contain' => ['Users'],
                'conditions' => $conditions,
                'limit' => $limit,
                'offset' => $offset,
                'order' => ['Comments.created' => 'DESC']
            ]);
        }
        //pr($comments);exit();
        $this->set(compact('comments'));
    }

    /*
     * New comment
     */
    public function ajaxAdd()
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
        echo json_encode($response);
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
                        $this->Comments->save($commentData);
                    } else {
                        $total_dislike = $commentData->total_dislike + 1;
                        $commentData['total_dislike'] = $total_dislike;
                        $this->Comments->save($commentData);
                    }
                    $comment = $this->commentResponses->patchEntity($comment, $data);
                    $saveResponse = $this->commentResponses->save($comment);
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
                        $this->Comments->save($commentData);
                        $comment = $this->commentResponses->patchEntity($comment, $data);
                        $saveResponse = $this->commentResponses->save($comment);
                        // pr($saveResponse);exit();
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
        echo json_encode($response);
    }

    /*
    * New reply to comment
    */
    public function replyComment($reformId)
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
                $comment->content_id = $reformId;
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
        echo json_encode($response);
    }

    /*
     * Get Comments By Ajax
     */
    public function GetAjaxComments()
    {
        $this->viewBuilder()->setLayout('ajax');
        $limit = 10;
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


        /*  foreach ($comments as $comment){
              pr($comment);
          }
         exit();*/
        $this->set(compact('comments'));
    }

    /**
     * View Story details
     */
    public function viewComments($type=null,$id = null)
    {
        $model = $this->loadModel($type);
        $this->add_model(array('Stories','Comments','Users'));

            $data = $model->get($id, [
                'contain' => ['Users','Comments']
            ]);
           // pr($data);exit();
            //need to give the description

           // $mediaTypes = $this->Options->getMediaTypes();
            $commentsTotalPaginationPages = $this->Stories->Comments->getTotalPaginationLinks($type,$id, 10);//for ajaxified comment pagination
            $this->set(compact('data','commentsTotalPaginationPages'));

    }
}
