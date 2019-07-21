<?php
namespace App\Controller;

use App\Controller\AppController;

class RatingsController extends AppController
{
    public function initialize(){
        parent::initialize();
    }

    public function ajaxAddRating(){
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $response['success'] = true;
        if($this->loggedinUser){
            if($this->request->is('ajax')){
                if(!empty($this->request->getData())){
                    $data = $this->request->getData();
                    $addResponse = $this->Ratings->addRating($data, $this->loggedinUser);
                    if(!$addResponse['success']){
                        $response = $addResponse;
                    }
                }
            }
        }else{
            $response['success'] = true;
            $response['error_message'] = 'Please login first to give rating.';
        }
        echo json_encode($response);
    }
}
