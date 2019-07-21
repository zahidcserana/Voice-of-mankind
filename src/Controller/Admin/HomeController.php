<?php
namespace App\Controller\admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->layout('admin');
        $this->Auth->allow();
        //$this->Auth->allow(['login', 'register','logout', 'forget_password', 'reset_password']);
    }
    public function index(){
        $this->add_model(array('Users','Stories','Categories'));
        $activeUser = $this->Users->find()->where(['status'=>1])->count();
        $totalStory = $this->Stories->find()->count();
        $todayStory = $this->Stories->find()->where(['DATE(created)'=>date("Y/m/d")])->count();

        $this->set(compact('activeUser','totalStory','todayStory'));
    }
}