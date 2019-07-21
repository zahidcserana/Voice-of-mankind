<?php

namespace App\Controller;

use Cake\Http\Cookie;
use Cake\Http\Cookie\CookieCollection;

use Cake\Core\Configure;


class HomeController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(array('index', 'view', 'second', 'third', 'about', 'sharelocation'));
    }

    /**
     * Home page of the vom application
     */
    public function index()
    {
        $this->add_model(array('Stories', 'States', 'Cities', 'Reformideas', 'Agencies'));
        $whereState = array('state_id' => 10);
        $whereCounty = array('county_id' => 657);
        if (isset($_COOKIE['userState'])) {
            $userState = $_COOKIE['userState'];
            $whereState = array('state_id' => $userState);
        }
        if (isset($_COOKIE['userCounty'])) {
            $userCounty = $_COOKIE['userCounty'];
            $whereCounty = array('county_id' => $userCounty);
        }

        $sort = array('id', 'created', 'head_fname', 'head_title', 'phone', 'zip_code');
        $agencies = $this->Agencies->find('list')
            ->where($whereState)
            ->limit(20)
            ->order([$sort[array_rand($sort)] => 'ASC'])
            ->toArray();

        $cities = $this->Cities->find('list')
            ->where($whereCounty)
            ->limit(10)
            ->toArray();
        $this->set(compact('agencies', 'cities'));
    }

    public function second()
    {

    }

    public function third()
    {

    }

    public function about()
    {
        $this->viewBuilder()->setLayout('inner');
        $pageTitle = 'About Us';

        $this->set(compact('pageTitle'));
    }

    public function sharelocation($location = null){
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;
        if ($this->request->data('lat')) {
            $data = $this->request->data();
            $lat = $data['lat'];
            $lng = $data['lng'];
            $this->setLocation($lat, $lng);
        } else {
            $this->response = $this->response->withCookie('remember_me', [
                'value' => 'yes',
                'path' => '/',
                'httpOnly' => true,
                'secure' => false,
                'expire' => strtotime('+1 days')
            ]);
        }
    }

    /*
  * Get Location By Zip
  */
    public function getLocationByZip()
    {
        $this->viewBuilder()->setLayout(false);
        $this->add_model(array('Zipcodes', 'Statezips','Users'));
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
}
