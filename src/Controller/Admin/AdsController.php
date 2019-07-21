<?php
namespace App\Controller\admin;

use App\Controller\AppController;

class AdsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Options');
        $this->loadComponent('Upload');
    }

    /**
     * Index method
     */
    public function index(){
        $this->paginate = [
            'contain' => ['Users', 'Referrals']
        ];
        $ads = $this->paginate($this->Ads);
        // pr($ads);exit;
        $referrals = $this->Ads->Referrals->find('list')->toArray();
        $adTypes = $this->Options->getAdTypes();
        $this->set(compact('ads', 'referrals', 'adTypes'));
    }

    public function getAdlist()
    {
        $data = [];
        $this->add_model(array('Ads','Users','Referrals'));
        $params = $this->request->getQueryParams();
        $start = $params['start'];
        $length = $params['length'];
        $displayableColumn = ['Users.first_name','Users.last_name','Referrals.name','Ads.page_name','Ads.ad_type','Ads.start_date','Ads.end_date','Ads.created','Ads.id'];
        $orderByColumn = [];
        $where = [];

        // // $uuid = $params['uuid'];
        // $name = $params['name'];
        // $email = $params['email'];
        // $companyid = $params['companyid'];
        // $campaignid = $params['campaignid'];
        // $status = $params['status'];

        // if (!empty($email)) {
        //     $where = array_merge(array("Employee.email LIKE '%" . $email . "%'"), $where);
        // }
        // if (!empty($companyid)) {
        //     $where = array_merge(array("Employee.company_id" => $companyid), $where);
        // }
        // if (!empty($campaignid)) {
        //     $where = array_merge(array("Employee.campaign_id" => $campaignid), $where);
        // }
        // if (!empty($status)) {
        //     $where = array_merge(array("Employee.status" => $status), $where);
        // }
        if (!empty($params['order'])) {
            $order = $params['order'][0];
            $orderByColumn[$displayableColumn[$order['column']]] = $order['dir'];
        }

        $ads = $this->Ads->find()
            ->select($displayableColumn)
            ->contain(['Users'])
            ->leftJoin(
                ['Referrals' => 'referrals'],
                ['Ads.referral_id = Referrals.id'])
            ->offset($start)
            ->limit($length)
            ->where($where)
            ->order($orderByColumn)
            ->group(['Ads.id'])
            ->toArray();
        $total = $this->Ads->find()->count();
        $filtered = $this->Ads->find()
            ->select($displayableColumn)
            ->contain(['Users'])
            ->leftJoin(
                ['Referrals' => 'referrals'],
                ['Ads.referral_id = Referrals.id'])
            ->where($where)
            ->group(['Ads.id'])
            ->count();
//        pr($ads);exit;
        if (count($ads) > 0) {
            foreach ($ads as $ad) {
                if ($ad['status'] == 1) {
                    $status = '<span class="label label-sm label-success">Active</span>';
                } else{
                    $status = '<span class="label label-sm label-danger">Inactive</span>';
                }

                $action = '<a href="/admin/ads/edit/' . $ad['id'] . '"
                                                class="btn btn-xs green-haze"><i class="fa fa-edit"></i>&nbsp;Update</a>
                                                <form action="/admin/Ads/delete/'.$ad['id'].'" name="post_5ac080de2d7ee110913045" id="post_5ac080de2d7ee110913045" style="display:none;" method="post">
                                                   <input type="hidden" name="_method" value="POST">
                                                </form>
                                            <a href="#" class="btn btn-xs red" onclick="if (confirm(\'Are you sure you want to delete the Ad?\')) { document.getElementById(\'post_5ac080de2d7ee110913045\').submit(); } event.returnValue = false; return false;"
                                               ><i class="fa fa-trash">&nbsp;</i>Delete</a>';
                $data[] = array(
                    'createdby' => $ad['user']['first_name'].' '.$ad['user']['last_name'],
                    'createdfor' => $ad['referral']['name'],
                    'page_name' => $ad['page_name'],
                    'ad_type' => $ad['ad_type'],
                    'start_date' => date_format($ad['start_date'],"Y-m-d"),
                    'end_date' => date_format($ad['end_date'],"Y-m-d"),
                    'created' => date_format($ad['created'],"Y-m-d"),
                    'action' => $action
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
        // debug($ads);
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $result = json_encode($result);
        $this->response->body($result);
        $this->response->type('json');
        return $this->response;
    }


    /**
     * View method
     */
    public function view($id = null)
    {
        $ad = $this->Ads->get($id, [
            'contain' => ['Users', 'Referrals']
        ]);

        $this->set('ad', $ad);
    }

    /**
     * Add method
     */
    public function add()
    {   $ad = $this->Ads->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->User('id');

            $path = WWW_ROOT . 'img' . DS . 'ads' . DS . $data['page_name'];
            $message = $this->Upload->uploadFile($data['file_name'],null,false,$path);
            if($message['success']){
                $data['file_type']= $message['mime_type'];
                $data['file_name']= $message['file_name'];
                $data['start_date'] = date_format(date_create($data['start_date']),"Y-m-d");
                $data['end_date'] = date_format(date_create($data['end_date']),"Y-m-d");
                $ad = $this->Ads->patchEntity($ad, $data);
                if ($this->Ads->save($ad)) {
                    $this->Flash->success(__('The ad has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The ad could not be saved. Please, try again.'));
            }
            else{
                $this->Flash->error(__('The ad could not be saved. Please, try again.'));
            }
        }
        $users = $this->Ads->Users->find('list', ['limit' => 200]);
        $referrals = $this->Ads->Referrals->find('list', ['limit' => 200]);
        $pagesForAd = $this->Options->pagesForAd();
        $positionsForAd = $this->Options->positionsForAd();
        $adTypes = $this->Options->getAdTypes();
        $this->set(compact('ad', 'users', 'referrals','pagesForAd','positionsForAd','adTypes'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $ad = $this->Ads->get($id);
        $positionsForAd = [];
        if(!empty($ad->page_name)){
            $positionsForAd = $this->Options->positionsForAd();
            $positionsForAd = $positionsForAd[$ad['page_name']];
        }
        $ad->start_date = date_format($ad->start_date,"m/d/Y");
        $ad->end_date = date_format($ad->end_date,"m/d/Y");
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $path = WWW_ROOT . 'img' . DS . 'ads' . DS . $data['page_name'];
            
            if(!empty($data['file_name']['tmp_name'])){
                $message = $this->Upload->uploadFile($data['file_name'],null,false,$path);
              //  pr($message);
                if($message['success']){
                    $data['file_type']= $message['mime_type'];
                    $data['file_name']= $message['file_name'];
                } else{
                    $this->Flash->error(__('The ad could not be saved. Please, try again.'));
                    return $this->redirect(['action' => 'index']);
                }
            }else{
                $data['file_type']= $ad->file_type;
                $data['file_name']= $ad->file_name;
            }
            $data['user_id'] = $this->Auth->User('id');
            $data['start_date'] = date_format(date_create($data['start_date']),"Y-m-d");
            $data['end_date'] = date_format(date_create($data['end_date']),"Y-m-d");

            $ad = $this->Ads->patchEntity($ad, $data);

            //pr($ad);exit;
            // dd($ad);
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $users = $this->Ads->Users->find('list', ['limit' => 200]);
        $referrals = $this->Ads->Referrals->find('list', ['limit' => 200]);
        $pagesForAd = $this->Options->pagesForAd();
        $adTypes = $this->Options->getAdTypes();
        $this->set(compact('ad', 'users', 'referrals','pagesForAd','positionsForAd','adTypes'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ad = $this->Ads->get($id);
        if ($this->Ads->delete($ad)) {
            $this->Flash->success(__('The ad has been deleted.'));
        } else {
            $this->Flash->error(__('The ad could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getadPostion(){
        $this->autoRender = false;
        $this->viewBuilder()->layout(false);
        $page_name = $this->request->query['page_name'];
        $positions = $this->Options->positionsForAd();
        $positions = $positions[$page_name];
        $response = json_encode($positions);
        $this->response->body($response);
        return $this->response;
    }
}
