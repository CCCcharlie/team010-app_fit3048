<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 * @method \App\Model\Entity\Device[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevicesController extends AppController
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
        $devices = $this->paginate($this->Devices);

        $this->set(compact('devices'));
    }

    /**
     * View method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('device'));
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

        $device = $this->Devices->newEmptyEntity();
        if ($this->request->is('post')) {
            $device = $this->Devices->patchEntity($device, $this->request->getData());

            //Set the custId here instead of the form
            $device->cust_id = $custId;


            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

            $identifier = 'CUSDEV';
            $generateId = $this->generateId($identifier, $device->device_model, $device->platform);

            $device->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));
                //Return back to the referer of this function
                return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $customers = $this->Devices->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('device', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        //Obtain the query via key value pair [called from customer table view]
        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;

        $this->set(compact('fullName', 'custId'));

        $device = $this->Devices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $device = $this->Devices->patchEntity($device, $this->request->getData());

            //Set the custId here instead of the form
            $device->cust_id = $custId;

            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));

                return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $customers = $this->Devices->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('device', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $device = $this->Devices->get($id);
        if ($this->Devices->delete($device)) {
            $this->Flash->success(__('The device has been deleted.'));
        } else {
            $this->Flash->error(__('The device could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer() );
    }
}
