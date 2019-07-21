<?php
namespace App\Controller\admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Captcha.Captcha');
        $this->loadComponent('Options');
        $this->loadComponent('Upload');
        $this->Auth->allow(['login', 'register','logout', 'forget_password', 'reset-password','activate']);
    }

    /*
     * Ajax Get List
     */
    public function ajaxGetList(){
        Configure::write('debug',0);
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;

        if($this->request->is('ajax')){
            if(!empty($this->request->getQueryParams()) && !empty($this->request->getQueryParams()['term'])){
                $name = $this->request->getQueryParams()['term'];
                $offset = ($this->request->getQueryParams()['page']-1)*10;
                $totalCount = $this->Users->find()->count();

                $userList = $this->Users->find('list')
                    ->offset($offset)
                    ->limit(10)
                    ->where(["Users.first_name LIKE '%" . $name . "%'"])
                    ->orWhere(["Users.last_name LIKE '%" . $name . "%'"])
                    ->toArray();

                $results = array(
                    "results" => $userList,
                    "pagination" => array(
                        "more" => true
                    ),
                    "total_count" => $totalCount
                );
                echo json_encode($results);
           } else {
                $offset = ($this->request->getQueryParams()['page']-1)*10;
                $totalCount = $this->Users->find()->count();

                $userList = $this->Users->find('list')
                    ->offset($offset)
                    ->limit(10)
                    //->select(['id','first_name'])
                    ->toArray();

                $results = array(
                    "results" => $userList,
                    "pagination" => array(
                        "more" => true
                    ),
                    "total_count" => $totalCount
                );
                echo json_encode($results);
            }
        }
    }

    /*
    * User List and Searching
    */
    public function index() {
//        $this->add_model(array('Users'));
//        $users = $this->Users->find('all')->toArray();
//
//        $this->set(compact('users'));
    }

    /*
    * Users indexing using datatble
    */
    public function getDataCake()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Users.id', 'Users.first_name', 'Users.last_name', 'Users.created', 'Users.status','Users.email','Users.created'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];

        if (!empty($params['status'])) {
            $where = array_merge(array('Users.status' => $params['status']), $where);
        }else {
            $where = array_merge(array('Users.status' => 1), $where);
        }

        if (!empty($params['username'])) {
            $where = array_merge(array("Users.first_name LIKE '%" . $params['username'] . "%' OR Users.last_name LIKE '%" . $params['username'] . "%'"), $where);
        }
        if (!empty($params['email'])) {
            $where = array_merge(array("Users.email LIKE '%" . $params['email'] . "%'"), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Users.created) =" . $date ), $where);

        }

        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }


        foreach ($searchableColumn as $column) {
            if (!empty($params['columns'][$column]['search']['value'])) {
                $columnSearch = $params['columns'][$column]['search']['value'];
                $where = array_merge(array($displayableColumn[$column] . " LIKE '%" . $columnSearch . "%'"), $where);
            }
        }
        $users = $this->Users->find()
            ->select($displayableColumn)
            ->contain(['Stories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
//debug($users);exit();
        $total = $this->Users->find()->count();
        $filtered = $this->Users->find()->contain(['Stories'])
            ->where($where)
            ->count();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($user['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($user['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($user['status'] == 4) {
                    $statusId = 5;
                    $statusName = 'Delete Permanently';
                    $status = '<button type="button" class="m-btn--pill btn btn-warning btn-sm">Deleted</button>';
                }
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/users/edit/' . $user['id'] . '">Profile</a>
                        <a class="dropdown-item" href="/admin/users/change_status/' . $user['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $user['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'username' => $user['first_name'] . ' ' . $user['last_name'],
                    'email' => $user['email'],
                    'created' => date_format($user['created'], 'd/m/y'),
                    'total_story' => count($user['stories']),
                    'status' => $status,
                    'action' => $actionMenu
                );
            }
        }
        $result = array
        (
            "draw" => $this->request->query['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        );
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $result = json_encode($result);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
   * Todays User List and Searching
   */
    public function todaysUser() {

    }

    /*
    * Users indexing using datatble
    */
    public function getTodaysUser()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Users.id', 'Users.first_name', 'Users.last_name', 'Users.created', 'Users.status','Users.email','Users.created'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $today = date('Y-m-d');
        $where = [];
        $where = array('DATE(Users.created)'=>$today);
        if (!empty($params['status'])) {
            $where = array_merge(array('Users.status' => $params['status']), $where);
        }else {
            $where = array_merge(array('Users.status' => 1), $where);
        }

        if (!empty($params['username'])) {
            $where = array_merge(array("Users.first_name LIKE '%" . $params['username'] . "%' OR Users.last_name LIKE '%" . $params['username'] . "%'"), $where);
        }
        if (!empty($params['email'])) {
            $where = array_merge(array("Users.email LIKE '%" . $params['email'] . "%'"), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Users.created) =" . $date ), $where);

        }

        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }


        foreach ($searchableColumn as $column) {
            if (!empty($params['columns'][$column]['search']['value'])) {
                $columnSearch = $params['columns'][$column]['search']['value'];
                $where = array_merge(array($displayableColumn[$column] . " LIKE '%" . $columnSearch . "%'"), $where);
            }
        }
        $users = $this->Users->find()
            ->select($displayableColumn)
            ->contain(['Stories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
//debug($users);exit();
        $total = $this->Users->find()->count();
        $filtered = $this->Users->find()->contain(['Stories'])
            ->where($where)
            ->count();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($user['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($user['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($user['status'] == 4) {
                    $statusId = 5;
                    $statusName = 'Delete Permanently';
                    $status = '<button type="button" class="m-btn--pill btn btn-warning btn-sm">Deleted</button>';
                }
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/users/edit/' . $user['id'] . '">Profile</a>
                        <a class="dropdown-item" href="/admin/users/change_status/' . $user['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $user['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'username' => $user['first_name'] . ' ' . $user['last_name'],
                    'email' => $user['email'],
                    'created' => date_format($user['created'], 'd/m/y'),
                    'total_story' => count($user['stories']),
                    'status' => $status,
                    'action' => $actionMenu
                );
            }
        }
        $result = array
        (
            "draw" => $this->request->query['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        );
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $result = json_encode($result);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
   * Todays User List and Searching
   */
    public function inactiveUser() {

    }

    /*
    * Users indexing using datatble
    */
    public function getInactiveUser()
    {
        $data = [];
        $this->add_model(array('Stories', 'Users', 'Agencies'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Users.id', 'Users.first_name', 'Users.last_name', 'Users.created', 'Users.status','Users.email','Users.created'];
        $searchableColumn = [0, 1, 2];
        $orderByColumn = [];
        $where = [];
        $where = array('Users.status'=>2);
        if (!empty($params['status'])) {
            $where = array_merge(array('Users.status' => $params['status']), $where);
        }else {
            $where = array_merge(array('Users.status' => 1), $where);
        }

        if (!empty($params['username'])) {
            $where = array_merge(array("Users.first_name LIKE '%" . $params['username'] . "%' OR Users.last_name LIKE '%" . $params['username'] . "%'"), $where);
        }
        if (!empty($params['email'])) {
            $where = array_merge(array("Users.email LIKE '%" . $params['email'] . "%'"), $where);
        }
        if (!empty($params['m_datepicker_1'])) {
            $date = date("Y-m-d", strtotime($params['m_datepicker_1']));
            $date = "'" . $date . "'";
            $where = array_merge(array("DATE(Users.created) =" . $date ), $where);

        }

        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }


        foreach ($searchableColumn as $column) {
            if (!empty($params['columns'][$column]['search']['value'])) {
                $columnSearch = $params['columns'][$column]['search']['value'];
                $where = array_merge(array($displayableColumn[$column] . " LIKE '%" . $columnSearch . "%'"), $where);
            }
        }
        $users = $this->Users->find()
            ->select($displayableColumn)
            ->contain(['Stories'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->toArray();
//debug($users);exit();
        $total = $this->Users->find()->count();
        $filtered = $this->Users->find()->contain(['Stories'])
            ->where($where)
            ->count();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user['status'] == 1) {
                    $statusId = 2;
                    $statusName = 'Make Inactive';
                    $status = '<button type="button" class="m-btn--pill btn btn-success btn-sm">&nbsp;&nbsp;Active&nbsp;&nbsp;</button>';
                } else if ($user['status'] == 2) {
                    $statusId = 4;
                    $statusName = 'Make Delete';
                    $status = '<button type="button" class="m-btn--pill btn btn-info btn-sm">Inactive</button>';
                } else if ($user['status'] == 3) {
                    $statusId = 1;
                    $statusName = 'Make Active';
                    $status = '<button type="button" class="m-btn--pill btn btn-primary btn-sm">Pending</button>';
                } else if ($user['status'] == 4) {
                    $statusId = 5;
                    $statusName = 'Delete Permanently';
                    $status = '<button type="button" class="m-btn--pill btn btn-warning btn-sm">Deleted</button>';
                }
                $actionMenu = '
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin/users/edit/' . $user['id'] . '">Profile</a>
                        <a class="dropdown-item" href="/admin/users/change_status/' . $user['id'] . '/' . $statusId . '">' . $statusName . '</a>
                    </div>
                  </div>';

                $str = '<label class="m-checkbox">
                          <input name="story" class="checkbox" type="checkbox" value="' . $user['id'] . '">
                            <span></span>
                        </label>';
                $data[] = array(
                    'id' => $str,
                    'username' => $user['first_name'] . ' ' . $user['last_name'],
                    'email' => $user['email'],
                    'created' => date_format($user['created'], 'd/m/y'),
                    'total_story' => count($user['stories']),
                    'status' => $status,
                    'action' => $actionMenu
                );
            }
        }
        $result = array
        (
            "draw" => $this->request->query['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        );
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $result = json_encode($result);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }

    /*
     * User Details
     */
    public function edit($id = null)
    {
        $this->add_model(array('Counties','Cities','States'));
        $user = $this->Users->find('all')
            ->where(['Users.id'=>$id])
            ->contain(['Counties','Cities','States'])
            ->first();
        if (!empty($this->request->data)) {
            $data= $this->request->data;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect('/admin/users/edit/'.$user['id']);
            } else{
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }

        }
        $this->add_model(array('States'));
        $states = $this->Users->States->find('list')->toArray();
        $cities = array();
        $counties = array();
        if (isset($user->county->id)){
            $cities = $this->Cities->find('list')->where(['county_id'=>$user->county->id])->toArray();
        }
        if (isset($user->state->id)){
            $counties = $this->Counties->find('list')->where(['state_id'=>$user->state->id])->toArray();
        }
        $this->set(compact('user','states','cities','counties'));
    }

    /*
     * delete user image
     */
    public function deleteimage($id){
        if ($id == null) {
            $this->Flash->error(__('Sorry! User ID required.'));
            return $this->redirect('/admin/users/index');
        }
        $this->add_model(array('Users'));
        $img = $this->Users->get($id);
        if (!empty($img)) {
            if ($img['avatar_name'] && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $img['avatar_name'])) {
                unlink(WWW_ROOT . 'img' . DS . 'users' . DS .$img['avatar_name']);
                $this->Flash->success(__('Profile image deleted successfully.'));
            }
            $img->avatar_name = '';
            $this->Users->save($img);
        }
        return $this->redirect('/admin/users/edit/'.$id);
    }

    /*
     * User Image Upload
     */
    public function upProfileImage($id)
    {
        if ($id == null) {
            $this->Flash->error(__('Sorry! User Id required'));
            return $this->redirect('/admin/users/index');
        }
        $this->add_model(array('Users'));
        $user = $this->Users->get($id);
        $data = $this->request->getData();
        if(!empty($data) && $data['file']['error']==0){
            $response = $this->Upload->uploadFile($data['file'], $user);
            if($response['success']){
                $user->avatar_name = $response['file_name'];
                if($this->Users->save($user)){
                    $this->Flash->success(__('Profile data save successfully.'));
                    //$this->redirect(['controller' => 'users', 'action' => 'my_profile']);
                }else{
                    $this->Flash->error(__('Avatar change failed! '.$response['error_message']));
                }
            }else{
                $this->Flash->error(__($response['error_message']));
            }
        }else{
            $this->Flash->error(__('Save Failed! Media is empty or corrupted.'));
        }
        return $this->redirect('/admin/users/edit/'.$id);
    }

    /**
     * Change User password
     */
    public function changePassword($id){
        $this->add_model(array('Users'));
        if (empty($id)) {
            $user = $this->Auth->user('id');
        } else {
            $user = $this->Users->get($id);
        }
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['npassword'])) {
                $npassword = $this->request->data('npassword');
                $cpassword = $this->request->data('cpassword');
                if ($npassword!=$cpassword){
                    $this->Flash->error('Password and Confirm Password does not match!');
                    return $this->redirect('/admin/users/edit/'.$id);
                }
                $data['password'] = (new \Cake\Auth\DefaultPasswordHasher)->hash($this->request->data['npassword']);
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Password Changed successfully.'));
                }
            }
        }
        return $this->redirect('/admin/users/edit/'.$id);
    }

    /*
     * Sending Activation Link
     */
    function resendActivation($user_id)
    {
        $this->add_model(array('Users'));
        $user = $this->Users->get($user_id);
        $email = $user['email'];
        if (!empty($email)) {
            // $this->Users->sendMail($this, $params);
            $options = array('template' => 'register', 'to' => $user['email'],
                'name' => $user['name'], 'activation' => md5($this->randomnum(8)), 'subject' => 'Registration');
            $this->email($options);
            $user->access_token=$options['activation'];
            $this->Users->save($user);
            $this->Flash->success('Activation Link has been sent.');
        } else {
            $this->Flash->error('Sorry! Not Found.');
        }
        return $this->redirect('/admin/users/edit/' . $user_id);
    }

    /*
     * User Account Activation
     */
    public function activate($activation_key)
    {
        $this->add_model(array('Users'));
        if (!empty($activation_key)) {
            $check_user = $this->Users->find()->where(['access_token' => $activation_key])->first();
            if (!empty($check_user)) {
                $check_user->status = 1;
                $check_user->access_token = '';
                $this->Users->save($check_user);
                $this->Flash->success('Your account activated successfully');
            } else {
                $this->Flash->error('Invalid activation code');
            }
        } else {
            $this->Flash->error('Invalid activation code');
        }
        $this->redirect('/users/login');
    }

    /*
     * Add User
     */
    public function add(){
        $this->add_model(array('Users','UserTypes','States'));
        $user = $this->Users->newEntity();
        if($this->request->is('post') && !empty($this->request->getData())){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $user['password'] = $user['confirm_password'] = $characters[rand(0, $charactersLength - 1)];

            if($user['password'] != $user['confirm_password']){
                $this->Flash->error(__('Password and Confirm password mismatched!'));
            }else{
                $user = $this->Users->newEntity($this->request->getData());
                $user['password'] = (new \Cake\Auth\DefaultPasswordHasher)->hash($user['password']);
                $activation = md5($this->randomnum(8));
                unset($user['confirm_password']);
                $user->access_token = $activation;
                $user->status = 1;
                //pr($user);exit();
                if($this->Users->save($user)){
                    // Sending activation mail
                    $options = array('template' => 'reset_password', 'to' => $user['email'],
                        'name' => $user['name'], 'activation' =>$activation, 'subject' => 'Registration');
                   if ($this->email($options)){
                       $this->Flash->success(__('Congratulation, User Successfully added.'));
                   }
                   else{
                       $this->Flash->error(__('Mail can not be sent! Pelase try again'));
                   }

                    $this->redirect(array('controller' => 'users', 'action' => 'index'));
                }else{
                    $this->Flash->error(__('Registration failed! Pelase try again'));
                }
            }
        }
        $userTypes = $this->UserTypes->find('list')->toArray();
        $states = $this->Users->States->find('list')->toArray();

        $this->set(compact('user','userTypes','states'));
    }

    /**
     * User login
     */
    public function login($type = '') {
        //echo (new DefaultPasswordHasher)->hash('siterocks');
        $this->viewBuilder()->layout('admin_login');

        if (!empty($this->request->data)) {
            $ip = getenv('REMOTE_ADDR');
            $gRecaptchaResponse = $this->request->data['g-recaptcha-response'];

            $captcha = $this->Captcha->check($ip,$gRecaptchaResponse);

            if($captcha->errorCodes == null) {

            } else {
                $this->Flash->error('The g-recaptcha-response field is required.');
                return $this->redirect('/admin/users/login');
            }
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                if ($this->request->params['prefix'] == 'admin') {
                    return $this->redirect('/admin/home');
                } else {
                    return $this->redirect('/home');
                }
            } else {
                $this->Flash->error('Email or password is incorrect');
            }
        }
//        return $this->redirect('/admin/home');
        $this->render('admin_login');
    }

    public function forgetPassword(){
        if ($this->prefix() == Configure::read('admin.prefix')) {
            $this->viewBuilder()->layout(Configure::read('admin.loginLayout'));
        }
        if (!empty($this->request->data)) {
            $email = $this->request->data['email'];
            if (!empty($email)) {
                $user = $this->Users->find()->where(['email' => $email])->first();
                if (empty($user)) {
                    $this->Flash->error(Configure::read('ErrorsCodes.7'));
                } else {
                    $activation = md5($this->randomnum(8));
                    $params = array('activation_key' => $activation);
                    $user->activation_key = $activation;
                    if ($this->Users->save($user)) {
                        $options = array('template' => 'forgot_password', 'to' => $email, 'activation' => $activation, 'subject' => 'Forgot Password');
                        $this->send_email($options);
                        $this->Flash->success('Please check your email and change password.');
                        $this->redirect(['controller' => 'users', 'action' => 'forget_password']);
                    }
                }
            }
        }
    }

    public function ResetPassword($activation_code = null) {
        if ($activation_code == null){
            $this->Flash->error('Activation Code Required!');
            return $this->redirect('/admin/users/login');
        }
        $check_user = $this->Users->find()->where(['access_token' => $activation_code])->first();
        if (empty($check_user)) {
            $this->Flash->error('Invalid Activation Code');
            $this->redirect('/admin/users/login');
        }
        if (!empty($this->request->data)) {
            $activation_code = $this->request->data('activation_code');
            $npassword = $this->request->data('npassword');
            $cpassword = $this->request->data('cpassword');
            if ($cpassword == $npassword){
                $check_user = $this->Users->find()->where(['access_token' => $activation_code])->first();
                $password = trim($npassword);
                $check_user->password = (new \Cake\Auth\DefaultPasswordHasher)->hash($password);
                //$check_user->password = $password;
                $check_user->access_token = '';
                if ($this->Users->save($check_user)) {
                    $this->Flash->success('Password Changed Successfully');
                    $this->redirect('/admin/users/login');
                }
            }else{
                $this->Flash->error('Password and Confirm Password does not match!');
                return $this->redirect('/admin/users/reset_password/'.$activation_code);
            }
        }
        $user = $check_user;
        $this->set(compact('user','activation_code'));
    }

    /*
     * delete Multiple Use
     */
    public function deleteUser()
    {
        $data = $this->request->data('data');
        $response = false;
        if (!empty($data)) {
            if ($this->Users->deleteAll(['Stories.id IN' => $data])) {
                $this->Flash->success(__('The user has been deleted.'));
                $response = true;
                $msg= '';
            }
            else {
                $msg= 'Sorry! user Can not be deleted.';
            }
        }
        else {
            $msg= 'Please! Select Atleast one user.';
        }
        $responseResult = json_encode(array('response' => $response,'msg'=>$msg));
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }
    /*
     * User delete
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The User has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect('/admin/users/index');
    }

    public function changeStatus($id = null, $status = null)
    {
        if ($status == 5) {
            return $this->delete($id);
        }
        $user = $this->Users->get($id);
        $user['status'] = $status;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The Status has been changed.'));
        } else {
            $this->Flash->error(__('The Status could not be changed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

