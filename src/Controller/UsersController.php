<?php

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Captcha.Captcha');
        $this->loadComponent('Options');
        $this->loadComponent('Upload');
        $this->Auth->allow(array('getAddress','updateAddress', 'getCityByCounty', 'getCountyByState', 'getLocationByZip', 'socialLogin', 'social', 'login', 'logout', 'signup', 'forgotPassword', 'resetPassword', 'activate', 'registerSuccess'));
        $this->viewBuilder()->layout('inner');
        $ads = $this->_getAds($this->request->params['controller'], $this->request->params['action']);
        $this->set(compact('ads'));
    }

    /*
     * Social Login
     */
    public function social($type = '', $ref = '')
    {
        $this->autoRender = false;
        if (!empty($ref) && ($ref != 'int_callback')) {
            $this->Session->write('Social.ref', $ref);
        }
        require_once(ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'lib' . DS . 'Opauth' . DS . 'Opauth.php');
        require_once(ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'opauth.conf.php');
        define('CONF_FILE', ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'opauth.conf.php');
        define('OPAUTH_LIB_DIR', ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'lib' . DS . 'Opauth' . DS);
        $Opauth = new \Opauth($config);

    }

    public function socialLogin()
    {
        $this->autoRender = false;
        require_once(ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'lib' . DS . 'Opauth' . DS . 'Opauth.php');
        require_once(ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'opauth.conf.php');
        define('CONF_FILE', ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'opauth.conf.php');
        define('OPAUTH_LIB_DIR', ROOT . DS . 'vendor' . DS . 'opauth' . DS . 'lib' . DS . 'Opauth' . DS);
        $Opauth = new \Opauth($config);
        $response = null;

        switch ($Opauth->env['callback_transport']) {
            case 'session':
                $response = $_SESSION['opauth'];
                unset($_SESSION['opauth']);
                break;
            case 'post':
                $response = unserialize(base64_decode($_POST['opauth']));
                break;
            case 'get':
                $response = unserialize(base64_decode($_GET['opauth']));
                break;
            default:
                break;
        }
        /* echo "<pre>";
         print_r($response);echo "<pre>";*/
        if (!empty($response['auth'])) {

            $name = explode(' ', $response['auth']['info']['name']);
            $count = count($name);
            $fname = $name[0];
            $lname = $name[$count - 1];

            $data = array(
                'register_type' => $response['auth']['provider'],
                'social_type' => $response['auth']['provider'],
                'social_id' => $response['auth']['uid'],
                'first_name' => $response['auth']['info']['first_name'],
                'last_name' => $response['auth']['info']['last_name'],
                'email' => !empty($response['auth']['info']['email']) ? $response['auth']['info']['email'] : '',
                'avatar_name' => !empty($response['auth']['info']['image']) ? $response['auth']['info']['image'] : '',
                'access_token' => json_encode($response['auth']['credentials']),
                'password' => '123456',
                'status' => 1,
                // 'type' => 2
            );
            if (empty($response['auth']['uid'])) {
                $this->redirect('/users/login');
            } else {
                $user = $this->Users->find('all', [
                    'conditions' => ['social_type' => $response['auth']['provider'], 'social_id' => $response['auth']['uid']]
                ])->first();

                if (empty($user)) {
                    $user = $this->Users->newEntity();
                }
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $data['id'] = $user->id;
                    $this->Auth->setUser($data);
                } else {
                    pr($user->errors());
                }
                $this->redirect('/');
            }
        }
    }

    /*
     * administrators Index
     */
    function administratorsIndex()
    {
        $this->loadModel('Users');
        $records = $this->Users->getMultiple();
        $this->set('users', $records);
    }

    /*
     * Registration Seccess
     */
    function registerSuccess()
    {
        $email = $this->request->session()->read('email');

        $this->set(compact('email'));
    }

    public function signup()
    {
        if ($this->request->is('post') && !empty($this->request->getData())) {
            $ip = getenv('REMOTE_ADDR');
            $gRecaptchaResponse = $this->request->data['g-recaptcha-response'];

            $captcha = $this->Captcha->check($ip, $gRecaptchaResponse);

            if ($captcha->errorCodes == null) {

            } else {
                $this->Flash->error('The g-recaptcha-response field is required.');
                return $this->redirect('/users/signup');
            }
            $user = $this->Users->newEntity($this->request->getData());
            if ($user->password != $this->request->getData('confirm_password')) {
                $this->Flash->error(__('Password and Confirm password mismatched!'));
            } else {
                $user->password = (new \Cake\Auth\DefaultPasswordHasher)->hash($user->password);
                unset($user->confirm_password);

                $countryId = $this->Users->Countries->getIdByCode('US');
                if ($countryId) {
                    $user->country_id = $countryId;
                }
                $user->status = 3;//Default is pending
                $activation = md5($this->randomnum(8));
                $user->access_token = $activation;

                $user->user_type_id = $this->Users->UserTypes->find()->select('id')->where(['title' => 'Member']);

                $response = $this->Users->save($user);
                // pr($user->errors());exit();
                if ($response) {
                    // Sending activation mail
                    $options = array('template' => 'register', 'to' => $user->email,
                        'name' => ($user->first_name . ' ' . $user->last_name), 'activation' => $activation, 'subject' => 'Registration');
                    $rsp = $this->email($options);
                    $this->request->session()->write('email', $user->email);

                    $this->Flash->success(__('Signup done. An activation link is sent at your email. Please check your mail and activate account.'));
                    $this->redirect(array('controller' => 'users', 'action' => 'register_success'));
                } else {
                    $this->Flash->error(__('Signup failed! Pelase try again'));
                }
            }
        }
        $states = $this->Users->States->find('list')->toArray();
        $pageTitle = 'Signup To Share your Stories';
        $this->set(compact('states', 'pageTitle'));

    }

    /*
   * Get Location By Zip
   */
    public function getLocationByZip()
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Zipcodes', 'Statezips'));
        if (isset($this->request->data)) {
            $data = $this->request->data;
            $zipcode = $data['zipcode'];
            $zipData = $this->Zipcodes->find('all')->where(['zip' => $data['zipcode']])->first();

            $locationData = $this->Statezips->find('all')
                ->where(['zip_id' => $zipData['id']])
                ->contain(['Counties', 'Cities', 'States'])
                ->first();
            //pr($locationData);exit();
            if (empty($locationData)) {
                //$this->Flash->error(__('Not Found!'));
                $this->autoRender = false;
                $responseResult = json_encode(array('response' => false, 'msg' => 'Not Found!'));
                $this->response->type('json');
                $this->response->body($responseResult);

                return $this->response;
            } else {
                $states = $this->Users->States->find('list')->toArray();
                $counties = array();
                $cities = array();
                if (isset($locationData->state_id) && $locationData->state_id != '') {
                    $counties = $this->Counties->find('list')->where(['state_id' => $locationData->state_id])->toArray();
                }
                if (isset($locationData->county_id) && $locationData->county_id != '') {
                    $cities = $this->Cities->find('list')->where(['county_id' => $locationData->county_id])->toArray();
                }
                $this->set(compact('locationData', 'cities', 'states', 'counties', 'zipcode'));
            }
        }
    }

    /*
   * Get county By State
   */
    public function getCountyByState($state)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States', 'Counties'));

        $counties = $this->Counties->find('list')->where(['state_id' => $state])->toArray();
        $this->set(compact('counties'));
    }

    /*
     * Get city By County
     */
    public function getCityByCounty($county)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Cities', 'Counties'));

        $cities = $this->Cities->find('list')->where(['county_id' => $county])->toArray();
        $this->set(compact('cities'));
    }

    public function login()
    {
        //pr($this->request->getData());exit;
        $this->add_model(array('Users'));
        if (!empty($this->request->data)) {
            $user = $this->Auth->identify();
            $this->Auth->setUser($user);
            if ($user) {
                if (isset($user['group_id']) && $user['group_id'] == 1) {
                    $this->redirect(array('administrators' => true, 'controller' => 'users', 'action' => 'account'));
                } else if (isset($user['group_id']) && $user['group_id'] == 2) {
                    return $this->redirect('/administrators/studies/index');
                } else {
                    $this->redirect('/stories');
                }
            } else {
                $this->Flash->error(__('Login failed! Invalid email or password.'));
                $this->redirect('/users/login');
            }
        }
        $states = $this->Users->States->find('list')->toArray();
        $pageTitle = 'Login To Your Account';
        $this->set(compact('states', 'pageTitle'));
    }

    function logout()
    {
        $this->Session->delete('User');
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            if (!empty($this->request->getData())) {
                if (!empty($this->request->getData('email'))) {
                    $email = $this->request->getData('email');
                    $user = $this->Users->find()->where(['email' => $email])->first();
                    if ($user) {
                        $activation = md5($this->randomnum(8));
                        $params = array('access_token' => $activation);
                        $user->access_token = $activation;
                        if ($this->Users->save($user)) {
                            $options = array('template' => 'reset_password', 'to' => $email, 'activation' => $activation, 'subject' => 'Forget Password');
                            if ($this->email($options)) {
                                $this->Flash->success(__('An email to reset your password is sent. Please check your mail.'));
                            }
                        }
                    } else {
                        $this->Flash->error(__('Invalid Email! This email is not found.'));
                    }
                } else {
                    $this->Flash->error(__('Please enter your email first.'));
                }
            }
        }
        $pageTitle = 'No Worry, Sometimes we all forget.';
        $this->set(compact('pageTitle'));
    }

    public function resetPassword($activation = null)
    {
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $data = $this->request->getData();
                if (isset($data['access_token']) && !empty($data['access_token'])) {
                    $user = $this->Users->find()->where(['access_token' => $data['access_token']])->first();

                    if ($user) {
                        if (trim($data['password']) == trim($data['confirm_password'])) {
                            $password = trim($data['password']);
                            $password = (new \Cake\Auth\DefaultPasswordHasher)->hash($password);
                            $user->password = $password;
                            $user->access_token = '';
                            if ($this->Users->save($user)) {
                                $this->Flash->success(__('Password reset successful.'));
                                $this->redirect(['controller' => 'users', 'action' => 'login']);
                            }
                        } else {
                            $this->Flash->error('Password and Confirm Password mismatch!');
                        }
                    } else {
                        $this->Flash->error(__('Invalid activation token!'));
                    }
                } else {
                    $this->Flash->error(__('Invalid activation link! Please click on the link sent at your email.'));
                }
            }
            $this->set(compact('user', 'activation'));
        } else {
            if ($activation) {
                $user = $this->Users->find()->where(['access_token' => $activation])->first();
                if (!$user) {
                    $this->Flash->error(__('Invalid Activation Link! Please check your email for valid activation link.'));
                }
            } else {
                $this->Flash->error(__('Invalid activation link!'));
            }
        }
        $pageTitle = 'Reset Your Password';
        $this->set(compact('pageTitle'));
    }

    /**
     * User accout activation after registration
     */
    public function activate($activation_key = null)
    {
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;
        if (!empty($activation_key)) {
            $user = $this->Users->find()->where(['access_token' => $activation_key])->first();
            if (!empty($user)) {
                $this->Auth->identify();
                $this->Auth->setUser($user);
                $user->status = 1;
                $user->access_token = '';
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Congratulation! Account activated. You can login now.'));
                    $this->redirect(['controller' => 'users', 'action' => 'login']);
                } else {
                    $this->Flash->error(__('Save Failed!'));
                }
            } else {
                $this->Flash->error(__('Activation Failed! Invalid activation url.'));
            }
        } else {
            $this->Flash->error(__('Activation Failed! Invalid activation url.'));
        }
        $this->redirect('/users/account');
    }


    /**
     * User Profile
     */
    public function myProfile()
    {
//        $this->add_model(array('Counties','Cities','States','Statezips','Zipcodes'));
        if (!empty($this->loggedinUser)) {
            $user = $this->Users->find('all')
                ->where(['Users.id' => $this->loggedinUser['id']])
                ->contain(['Counties', 'Cities', 'States'])
                ->first();
            //pr($user);exit();
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                //pr($data);exit();
                if (!empty($data)) {
                    $response = $this->Users->saveProfile($user, $data);
                    if ($response['success']) {
                        $this->Flash->success(__('Profile data save successful.'));
                        $this->redirect(['controller' => 'users', 'action' => 'my_profile']);
                    } else {
                        $this->Flash->error(__($response['error_message']));
                    }
                } else {
                    $this->Flash->error(__('Save Failed! Data is empty.'));
                }
            }
            $states = $this->Users->States->find('list')->toArray();
            //$countries = $this->Users->States->Countries->find('list')->toArray();
            $counties = array();
            $cities = array();
            if ($user->state_id != '') {
                $counties = $this->Users->States->Counties->find('list')->where(['state_id' => $user->state_id])->toArray();
            }
            if ($user->county_id != '') {
                $cities = $this->Users->States->Counties->Cities->find('list')->where(['county_id' => $user->county_id])->toArray();
            }

            $this->set(compact('user', 'states', 'zipCode', 'counties', 'cities'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'My Profile Details';
        $this->set(compact('pageTitle'));
    }

    /**
     * User Story
     */
    public function myStories()
    {
        if (!empty($this->loggedinUser)) {
            $conditions['Stories.user_id'] = $this->loggedinUser['id'];
            $conditions['Stories.status'] = 1;//only active stories
            $this->loadModel('Stories');
            $this->paginate = ['limit' => 6];
            $query = $this->Stories->find('all', [
                'contain' => ['Users', 'Media', 'Referrals', 'Categories'],
                'conditions' => $conditions,
                'order' => ['Stories.created' => 'DESC']
            ]);
            $stories = $this->paginate($query);
            $storyStatuses = $this->Options->getStoryStatuses();
            $storyCategories = $this->Users->Stories->Categories->find('list', ['conditions' => ['type' => $this->Options->getCategoryByType('Story')]])->toArray();
            $this->set(compact('stories', 'storyStatuses', 'storyCategories'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'My Stories';
        $this->set(compact('pageTitle'));
    }

    /**
     * Story Comments
     */
    public function myComments()
    {
        if (!empty($this->loggedinUser)) {
            $this->loadModel('Comments');
            $this->paginate = ['limit' => 6];
            $query = $this->Users->Comments->find('all', [
                'conditions' => ['Comments.user_id' => $this->loggedinUser['id']],
                'contain' => ['Users']]);
            $comments = $this->paginate($query);
            $this->set(compact('comments'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'My Comments';
        $this->set(compact('pageTitle'));
    }


    /**
     * change Password
     */
    public function changePassword()
    {
        if (!empty($this->loggedinUser)) {
            $user = $this->Users->get($this->loggedinUser['id']);
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                if (!empty($data)) {
                    $response = $this->Users->saveProfile($user, $data, true);//true to update password
                    if ($response['success']) {
                        $this->Flash->success(__('Profile data save successful.'));
                        $this->redirect(['controller' => 'users', 'action' => 'my_profile']);
                    } else {
                        $this->Flash->error(__($response['error_message']));
                    }
                } else {
                    $this->Flash->error(__('Save Failed! Data is empty.'));
                }
            }
            $this->set(compact('user'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'Password Update Hear';
        $this->set(compact('pageTitle'));
    }

    /**
     * change Avatar
     */
    public function changeAvatar()
    {
        if (!empty($this->loggedinUser)) {
            $user = $this->Users->get($this->loggedinUser['id']);
            if ($this->request->is('put')) {
                $data = $this->request->getData();
                if (!empty($data) && $data['avatar_name']['error'] == 0) {
                    $response = $this->Upload->uploadFile($data['avatar_name'], $user);
                    if ($response['success']) {
                        $user->avatar_name = $response['file_name'];
                        if ($this->Users->save($user)) {
                            $this->Flash->success(__('Profile data save successfully.'));
                            $this->redirect(['controller' => 'users', 'action' => 'my_profile']);
                        } else {
                            $this->Flash->error(__('Avatar change failed! ' . $response['error_message']));
                        }
                    } else {
                        $this->Flash->error(__($response['error_message']));
                    }
                } else {
                    $this->Flash->error(__('Save Failed! Media is empty or corrupted.'));
                }
            }
            $this->set(compact('user'));
        } else {
            $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $pageTitle = 'Avatar Changing Section';
        $this->set(compact('pageTitle'));
    }

    /**
     * show Image
     */
    public function showImage($userId, $imageName)
    {
        if ($this->loggedinUser['id'] == $userId) {
            $userEmail = $this->loggedinUser['email'];
        } else {
            $userEmail = $this->Users->get($userId)->email;
        }
        $image_path = WWW_ROOT . 'img' . DS . ($userEmail . DS . $imageName);
        if (!is_file($image_path)) {
            $image_path = WWW_ROOT . 'img' . DS . 'blog3.jpeg';
        }
        return $this->response->withFile($image_path);
    }

    /*
     * Get county By State
     */
    public function countyByState($state)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('States', 'Counties'));

        $counties = $this->Counties->find('list')->where(['state_id' => $state])->toArray();
        $this->set(compact('counties'));
    }

    /*
     * Get city By County
     */
    public function cityByCounty($county)
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Cities', 'Counties'));

        $cities = $this->Cities->find('list')->where(['county_id' => $county])->toArray();
        $this->set(compact('cities'));
    }

    /*
     * User Location Update
     */
    public function userLocation()
    {
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;
        $response = false;
        $msg = '';
        if (isset($this->request->data)) {
            //$data = $this->request->data;
            $userId = $this->Auth->user('id');
            $user = $this->Users->get($userId);
            $user['state_id'] = $this->request->data['state_id'];
            $user['county_id'] = $this->request->data['county_id'];
            $user['city_id'] = $this->request->data['city_id'];
            $user['zip_code'] = $this->request->data['zip_code'];
            $user['address'] = $this->request->data['address'];
            if ($this->Users->save($user)) {
                $response = true;
                $msg = 'User Location Successfully Updated';
                $this->Flash->success(__('User Location Successfully Updated.'));
            }
        } else {
            $msg = 'Sorry! User Location Not Updated';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

    /*
    * Update users address by Zip Code
    */
    public function updateAddress($postcode = null, $address = null)
    {
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;
        $response = false;
        if ($postcode != null) {
            $this->add_model(array('Zipcodes', 'Statezips'));
            $zipData = $this->Zipcodes->find('all')->where(['zip' => $postcode])->first();
            $locationData = $this->Statezips->find('all')
                ->where(['zip_id' => $zipData['id']])
                ->first();
            if(!isset($_COOKIE['userState'])) {
                setcookie("userState", $locationData->state_id, time() + (86400 * 1), "/"); // 86400 = 1 day
                setcookie("userCounty", $locationData->county_id, time() + (86400 * 1), "/"); // 86400 = 1 day
            }
            $userId = $this->Auth->user('id');
            $user = $this->Users->get($userId);

            $user['state_id'] = $locationData['state_id'];
            $user['county_id'] = $locationData['county_id'];
            $user['city_id'] = $locationData['city_id'];
            $user['zip_code'] = $postcode;
            $user['address'] = $address;


            if ($this->Users->save($user)) {
                $response = true;
                $msg = $locationData;
            } else {
                $msg = 'Sorry! Location cannot updated';
            }
        } else {
            $msg = 'Sorry! Location cannot updated';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

    /*
   * Get users address by Zip Code
   */
    public function getAddress($postcode = null)
    {
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;
        $response = false;
        if ($postcode != null) {
            $this->add_model(array('Zipcodes', 'Statezips'));
            $zipData = $this->Zipcodes->find('all')->where(['zip' => $postcode])->first();
            $locationData = $this->Statezips->find('all')
                ->where(['zip_id' => $zipData['id']])
                ->first();
            if(!isset($_COOKIE['userState'])) {
                setcookie("userState", $locationData->state_id, time() + (86400 * 1), "/"); // 86400 = 1 day
                setcookie("userCounty", $locationData->county_id, time() + (86400 * 1), "/"); // 86400 = 1 day
            }
            // $this->Cookie->delete('latitude');
           // $this->locationCookie($locationData);
            //$this->Session->write('userState', $locationData->state_id);
            //$this->Session->write('userCounty', $locationData->county_id);
            $response = true;
            $msg = $locationData;
        } else {
            $msg = 'Sorry! Location cannot updated';
        }
        $responseResult = json_encode(array('response' => $response, 'msg' => $msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }

}