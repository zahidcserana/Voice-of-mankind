<?php

namespace App\Controller;

use App\Controller\AppController;

class StatesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(array('getLocationByZip'));
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $states = $this->paginate($this->States);

        $this->set(compact('states'));
    }

    /**
     * ajax Get List
     */
    public function ajaxGetList()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;

        if (!empty($this->request->getQueryParams())) {
            $offset = ($this->request->getQueryParams()['page'] - 1) * 10;
            $list = $this->States->find('list', [
                'offset' => $offset,
                'limit' => 10
            ])->toArray();
            $totalCount = $this->States->find()->count();
            $results = array(
                "results" => $list,
                "pagination" => array(
                    "more" => true
                ),
                "total_count" => $totalCount
            );
            echo json_encode($results);
        }
    }

    /**
     * get Location By Zip
     */
    public function getLocationByZip()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;
        $this->add_model(array('Zipcodes', 'Statezips'));
        $conditions = array();
        if (!empty($this->request->getQueryParams())) {
            $params = $this->request->getQueryParams();
            if (isset($params['term']) && !empty(trim($params['term']))) {
                $conditions = array_merge(array("Zipcodes.zip LIKE '%" . $params['term'] . "%'"), $conditions);
            }
            $zipData = $this->Zipcodes->find('all')->where($conditions)->toArray();
            $zipId = array();
            foreach ($zipData as $row) {

                $zipId[] = $row['id'];
            }
            if (!empty($zipData)) {
                $offset = ($this->request->getQueryParams()['page'] - 1) * 10;
                $list = $this->Statezips->find('all')
                    ->offset($offset)
                    ->contain(['Zipcodes', 'Counties', 'Cities', 'States'])
                    ->where(['Statezips.zip_id IN ' => $zipId])
                    ->limit(10)
                    ->toArray();

                $totalCount = $this->Statezips->find()
                    ->contain(['Zipcodes', 'Counties', 'Cities', 'States'])
                    ->where(['Statezips.zip_id IN ' => $zipId])
                    ->count();
                $location = array();
                if (!empty($list)) {
                    foreach ($list as $row) {
                        $location[$row->id]['zip'] = $row['zipcode']['zip'];
                        $address = '';
                        if (!empty($row['states']['name'])) {
                            $location[$row->id]['state'] = $row['states']['name'];
                            $address.= $row['states']['name'];
                        }
                        if (!empty($row['county']['name'])) {
                            $location[$row->id]['county'] = $row['county']['name'];
                            $address.= ', '.$row['county']['name'];
                        }
                        if (!empty($row['city']['name'])) {
                            $location[$row->id]['city'] = $row['city']['name'];
                            $address.= ', '.$row['city']['name'];
                        }
                        $location[$row->id]['address'] = $address;
                    }
                }
                $result = array(
                    "results" => $location,
                    "pagination" => array(
                        "more" => true
                    ),
                    "total_count" => $totalCount
                );
                $responseResult = json_encode($result);
                $this->response->type('json');
                $this->response->body($responseResult);
                return $this->response;
            }
        }
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => ['Agencies', 'Referrals', 'Users']
        ]);

        $this->set('state', $state);
    }

    /**
     * Add method
     */
    public function add()
    {
        $state = $this->States->newEntity();
        if ($this->request->is('post')) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $this->set(compact('state'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->getData());
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The state could not be saved. Please, try again.'));
        }
        $this->set(compact('state'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
