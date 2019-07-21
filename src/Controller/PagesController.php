<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(array('contactUs','ourMission','emailSending'));
        $this->viewBuilder()->setLayout('inner');
    }

    /**
     * Displays a view
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function contactUs(){

    }

    // Quick Contact By Emailing
    public function emailSending()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->add_model(array('Users'));
        $this->autoRender = false;
        if (isset($this->request->data)) {
            $params = array();
            $params['email'] = $this->request->data['email'];
            $params['name'] = $this->request->data['name'];
            $params['message'] = $this->request->data['message'];
            $toEmail = \Cake\Core\Configure::read('adminEmail');
            $options = array('template' => 'contact', 'to' => $toEmail, 'application' => 'Democake', 'name' => $params['name'], 'email' => $params['email'], 'message' => $params['message'], 'subject' => 'Quick Contact');
            if ($result = $this->email($options)) {
                $responseResult = json_encode(array('success' => 1, 'message' => 'Message Succesfully Send'));
            } else {
                $responseResult = json_encode(array('success' => 0, 'message' => 'Message Not Send'));
            }
        }
        $this->response->type('json');
        $this->response->body($responseResult);

        return $this->response;
    }
    
    public function ourMission(){        
    }
}
