<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

class AgenciesController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Options');
    }

    public function ajaxGetList(){
        Configure::write('debug',0);
        $this->viewBuilder()->setLayout('ajax');
        $this->autoRender = false;

        if($this->request->is('ajax')){
            if(!empty($this->request->getQueryParams()) && !empty($this->request->getQueryParams()['agency_type'])){

                $offset = ($this->request->getQueryParams()['page']-1)*10;
                $totalCount = $this->Agencies->find()->count();
                $where = array(['status' => 1]);
                if (!empty($this->request->getQueryParams()['term'])) {
                    $where = array_merge(array("Agencies.name LIKE '%" . $this->request->getQueryParams()['term'] . "%'"), $where);
                }
                if (!empty($this->request->getQueryParams()['agency_id'])) {
                    $where = array_merge(array("Agencies.id" => $this->request->getQueryParams()['agency_id']), $where);
                }

                $agencyList = $this->Agencies->find('list', [
                    'conditions' => $where,
                    'offset' => $offset,
                    'limit' => 10
                ])->toArray();

                $results = array(
                    "results" => $agencyList,
                    "pagination" => array(
                        "more" => true
                    ),
                    "total_count" => $totalCount
                );
                echo json_encode($results);
            }
        }
    }

    /**
     * Index method
     **/
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States']
        ];
        $agencies = $this->paginate($this->Agencies);
        $agencyTypes = $this->Options->getAgencyTypes();

        $this->set(compact('agencies', 'agencyTypes'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $agency = $this->Agencies->get($id, [
            'contain' => ['Users', 'States', 'Agencies', 'Stories']
        ]);

        $this->set('agency', $agency);
    }

    /**
     * Add method
     */
    public function add() {
        $agency = $this->Agencies->newEntity();
        if ($this->request->is('post')) {
            $agency = $this->Agencies->patchEntity($agency, $this->request->getData());
            $response = $this->Agencies->saveAgency($agency, $this->loggedinUser);
            if(!$response){
                $this->Flash->error(__('The agency could not be saved. Please, try again.'));
            }else{
                $this->Flash->success(__('The agency has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $states = $this->Agencies->States->find('list', ['limit' => 200]);
        $agencyTypes = $this->Options->getAgencyTypes();
        $this->set(compact('agency', 'agencyTypes', 'states'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $agency = $this->Agencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $agency = $this->Agencies->patchEntity($agency, $this->request->getData());
            if ($this->Agencies->save($agency)) {
                $this->Flash->success(__('The agency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agency could not be saved. Please, try again.'));
        }
        $users = $this->Agencies->Users->find('list', ['limit' => 200]);
        $states = $this->Agencies->States->find('list', ['limit' => 200]);
        $agencyTypes = $this->Options->getAgencyTypes();
        $this->set(compact('agency', 'users', 'states', 'agencyTypes'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $agency = $this->Agencies->get($id);
        if ($this->Agencies->delete($agency)) {
            $this->Flash->success(__('The agency has been deleted.'));
        } else {
            $this->Flash->error(__('The agency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
