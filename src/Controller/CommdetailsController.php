<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Commdetails Controller
 *
 * @property \App\Model\Table\CommdetailsTable $Commdetails
 * @method \App\Model\Entity\Commdetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommdetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $commdetails = $this->paginate($this->Commdetails);

        $this->set(compact('commdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Commdetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commdetail = $this->Commdetails->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('commdetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Obtain the query via key value pair [called from customer table view]
        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;

        $this->set(compact('fullName', 'custId'));

        $commdetail = $this->Commdetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $commdetail = $this->Commdetails->patchEntity($commdetail, $this->request->getData());

            //Server add into the customer id based on $custId query rather than the form
            $commdetail->cust_id = $custId;

            if ($this->Commdetails->save($commdetail)) {
                $this->Flash->success(__('The communication details for: ' . $fullName . ' has been saved'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The communication details for: ' . $fullName . ' could not be saved, please try again'));
        }
        $customers = $this->Commdetails->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('commdetail', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commdetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;

        $this->set(compact('fullName', 'custId'));

        $commdetail = $this->Commdetails->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {


            $commdetail = $this->Commdetails->patchEntity($commdetail, $this->request->getData());

            $commdetail->cust_id = $custId;

            if ($this->Commdetails->save($commdetail)) {
                $this->Flash->success(__('The communication details for: ' . $fullName . ' has been saved'));

                return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);;
            }
            $this->Flash->error(__('The communication details for: ' . $fullName . ' could not be saved, please try again'));
        }
        $customers = $this->Commdetails->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('commdetail', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commdetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commdetail = $this->Commdetails->get($id);
        if ($this->Commdetails->delete($commdetail)) {
            $this->Flash->success(__('The commdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The commdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
