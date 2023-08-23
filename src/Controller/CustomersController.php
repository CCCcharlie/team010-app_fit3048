<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Customers->find();

        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $searchConditions = [
                'OR' => [
                    'f_name LIKE' => '%' . $search . '%',
                    'l_name LIKE' => '%' . $search . '%',
                    'CONCAT(f_name, " ", l_name) LIKE' => '%' . $search . '%',
                    'email LIKE' => '%' . $search . '%',
                    'status LIKE' => '%' . $search . '%',
                    'notes LIKE' => '%' . $search . '%',
                    'Devices.transactionid LIKE' => '%' . $search . '%',
                    'Devices.sessionid LIKE' => '%' . $search . '%'
                ]
            ];
            $query->leftJoinWith('Devices')
                ->where($searchConditions);
        }


        $totalRecords = $query->count(); // Get the total number of records

        $this->paginate = [
            'limit' => $totalRecords, // Set the limit to the total number of records
            'contain' => ['Tickets', 'Devices', 'Commdetails', 'Counsellors'],
        ];
        $customers = $this->paginate($query);

        $this->set(compact('customers'));
    }
    /**
 * Fillter option
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

 */
    public function assigntome()
    {
        // Get the current user id
        $identity = $this->request->getAttribute('authentication')->getIdentity();
        $currentStaffId = $identity->get('id');

        // get the relate cust
        $assignedCustomers = $this->Customers->find()
            ->innerJoinWith('Tickets', function ($query) use ($currentStaffId) {
                return $query->where([
                    'Tickets.staff_id' => $currentStaffId,
                    'Tickets.closetime IS NULL'
                ]);
            })
            ->distinct(['Customers.id'])// Add this line to ensure distinct customers
            ->all();


        // pass data
        $this->set('assignedCustomers', $assignedCustomers);

    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Tickets', 'Devices', 'Commdetails', 'Counsellors'], // Include 'Devices' association
        ]);

        $tickets = $this->Customers->Tickets->find('all')
            ->where(['cust_id' => $customer->id])
            ->contain(['Users', 'Contents'])
            ->toArray();

        $devices = $this->Customers->Devices->find('all')
            ->where(['cust_id' => $customer->id])
            ->contain(['Customers'])
            ->toArray();

        $counsellors = $this->Customers->Counsellors->find('all')
            ->where(['cust_id' => $customer->id])
            ->contain(['Customers'])
            ->toArray();


        $this->set(compact('customer', 'tickets', 'devices','counsellors'));

//                get the current user id

        $identity = $this->request->getAttribute('authentication')->getIdentity();
        $currentStaffId = $identity->get('id');
        $assignedCustomers = $this->Customers->find()
            ->innerJoinWith('Tickets', function ($query) use ($currentStaffId) {
                return $query->where(['Tickets.staff_id' => $currentStaffId]);
            })
            ->all();

        $this->set(compact('assignedCustomers', 'assignedCustomers'));




    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} {1} has been added to the system!', $customer->f_name, $customer->l_name));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('{0} {1} could not be added to the system, please try again', $customer->f_name, $customer->l_name));
        }
        $this->set(compact('customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The profile edit has been saved!.'));

                return $this->redirect(['action' => 'view', $customer -> id]);
            }
            $this->Flash->error(__('The profile edit could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
