<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\SocketException;
use DateTime;

class AppController extends Controller
{
    var $loggedinUser = null;
    var $baseUrl;
    var $cookie = null;
    var $cookies;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

            $this->baseUrl = Configure::read('baseUrl');
            $this->set('baseUrl', $this->baseUrl);

            $this->add_model(array('User', 'States', 'Cities', 'Counties'));
            if (empty($this->request->session()->read('allState'))) {
                $allState = $this->States->find('list')->toArray();
                $this->request->session()->write('allState', $allState);
            }
            $this->loadModel('Notification');
            if (!empty($this->request->params['prefix']) && ($this->request->params['prefix'] == 'admin')) {
                $this->loadComponent('Auth', [
                    'authorize' => 'Controller',
                    'authenticate' => [
                        'Form' => [
                            'fields' => ['username' => 'email', 'password' => 'password'],
                            'scope' => ['Users.user_type_id' => 1, 'status' => 1]
                        ]
                    ],
                ]);
                $user = $this->request->session()->read('Auth.User');
                $page = 'admin/' . $this->request->params['controller'] . '/' . $this->request->params['action'];
                if ($page != 'admin/Users/login' && $user['user_type_id'] != 1) {
                    return $this->redirect('/');
                }
                if ($this->Auth->user()) {
                    $this->loggedinUser = $this->Auth->user();
                }
                $this->viewBuilder()->setLayout('admin');
            } else {
                $this->loadComponent('Auth', [
                    'authorize' => 'Controller',
                    'authenticate' => [
                        'Form' => [
                            'fields' => ['username' => 'email', 'password' => 'password'],
                            'scope' => ['status' => 1]
                        ]
                    ],
                ]);
                if ($this->Auth->user()) {
                    $this->loggedinUser = $this->Auth->user();
                }
                $this->set('loggedinUser', $this->loggedinUser);
//            if ($this->Auth->user()) {
//                $this->viewBuilder()->layout('home_logged');
//            }
            }

            $this->Session = $this->request->session();
            $this->set('session', $this->Session->read());
        }

        /*
         * User ACL to edit by ID
         */
        public
        function accessControl($id = null, $model = null)
        {
            $modelName = $this->loadModel($model);
            $check = $modelName->get($id);
            if (($this->Auth->user('user_type_id') == 1) || $this->Auth->user('id') == $check->user_id) {
                return true;
            } else {
                $this->Flash->error(__('Sorry! You are not permitted!'));
                return $this->redirect('/users/my-profile');
            }
        }

        public
        function add_model($models)
        {
            foreach ($models as $model) {
                $this->loadModel($model);
            }
        }

        public
        function isAuthorized($user)
        {
            return true;
        }

        /**
         * Before render callback.
         */
        public
        function beforeRender(Event $event)
        {
            if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
            ) {
                $this->set('_serialize', true);
            }
        }

        function seoUrl($string)
        {
            //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
            $string = strtolower(trim($string));
            //Strip any unwanted characters
            $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
            //Clean multiple dashes or whitespaces
            $string = preg_replace("/[\s-]+/", " ", $string);
            //Convert whitespaces and underscore to dash
            $string = preg_replace("/[\s_]/", "-", $string);
            return trim($string);
        }

        /**
         * Random Alpha-Numeric String
         */
        function randomnum($length)
        {
            $randstr = "";
            srand((double)microtime() * 1000000);
            //our array add all letters and numbers if you wish
            $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
            for ($rand = 0; $rand <= $length; $rand++) {
                $random = rand(0, count($chars) - 1);
                $randstr .= $chars[$random];
            }
            return $randstr;
        }


        protected
        function setJsonResponse()
        {
            $this->loadComponent('RequestHandler');
            $this->RequestHandler->renderAs($this, 'json');
            $this->response->type('application/json');
        }

        public
        function email($options = array())
        {
            $template = $options['template'];
            $email = new \Cake\Mailer\Email();

            $email->transport('Leaping');

            if (!empty($options['activation'])) {
                $email->viewVars(array('activation' => $options['activation']));
            }
            if (!empty($options['email'])) {
                $email->viewVars(array('email' => $options['email']));
            }
            if (!empty($options['name'])) {
                $email->viewVars(array('name' => $options['name']));
            }
            if (!empty($options['message'])) {
                $email->viewVars(array('message' => $options['message']));
            }

            try {
                $email->template($template, 'email_layout')
                    ->emailFormat('html')
                    ->to($options['to'])
                    ->from('donotreply@leapinglogic.com')
                    ->subject($options['subject'])
                    ->send();

                return true;
            } catch (SocketException $exception) {
                return false;
            }
        }

        public
        function uploadImage($type)
        {
            $this->log(print_r($_FILES, true), 'error');
            if (!empty($_FILES['file']['name'])) {
                $directoryPath = WWW_ROOT . 'img' . DS . $type;
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath);
                }
                $dir = WWW_ROOT . 'img' . DS . $type . DS;
                $imageName = time() . '_' . $this->randomnum(7) . '_' . str_replace(" ", "", $_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'], $dir . $imageName);

                return $imageName;
            }
        }

        /**
         * @desc Deliver ads for various pages
         * @param type $controllerName
         * @param type $actionName
         * @return string
         */
        protected
        function _getAds($controllerName, $actionName)
        {
            $ads = [];
            $this->loadComponent('Options');
            $adTypes = $this->Options->getAdTypes();
            $adPositions = $this->Options->positionsForAd();
            $pageName = $controllerName . '_' . $actionName;
            $adPositions = isset($adPositions[$pageName]) ? $adPositions[$pageName] : false;

            if ($adPositions) {
                $this->loadModel('Ads');

                foreach ($adTypes as $type) {
                    foreach ($adPositions as $pos => $v) {
                        $result = $this->Ads->find('all', [
                            'fields' => ['Ads.id', 'Ads.ad_position', 'Ads.file_type', 'Ads.file_name'],
                            'conditions' => ['Ads.status' => 1, 'Ads.start_date <= CURDATE()', 'Ads.end_date >= CURDATE()',
                                'Ads.page_name' => $pageName, 'Ads.ad_type' => $type, 'Ads.ad_position' => $pos]
                        ])->toArray();
                        if (!empty($result)) {
                            $total = count($result);
                            $randomIndex = rand(0, $total - 1);
                            $temp = $result[$randomIndex];
                            $ads[$type][$adPositions[$temp->ad_position]] = '<img src="/Ads/showImage/' . $temp->id . '/' . $pageName . '/' . $temp->file_name . '"/>';
                        }
                    }
                }
            }
            return $ads;
        }
    }
