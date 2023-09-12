<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
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
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function archivedprofiles()
    {
        // Define the time in seconds (e.g., 300 seconds for 5 minutes)
        $archivedTimeInSeconds = 300;

        $query = $this->Customers->find();

        // Filter by the 'archive' flag set to 1
        $query->where(['archive' => 1]);

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

        // Filter by 'archived_time' longer than $archivedTimeInSeconds
        $currentTimestamp = time();
        $archivedTimeAgo = $currentTimestamp - $archivedTimeInSeconds;
        $query->where(['archived_time <' => date('Y-m-d H:i:s', $archivedTimeAgo)]);

        $totalRecords = $query->count(); // Get the total number of records

        $this->paginate = [
            'limit' => $totalRecords, // Set the limit to the total number of records
            'contain' => ['Tickets', 'Devices', 'Commdetails', 'Counsellors'],
        ];
        $customers = $this->paginate($query);

        // Pass the $archivedTimeInSeconds variable to the view
        $this->set(compact('customers', 'archivedTimeInSeconds'));
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

//debug($assignedCustomers);
//exit;
        // pass data
        $this->set('assignedCustomers', $assignedCustomers);

//
// Get the related tickets for assigned customers
        $assigntickets = $this->Customers->Tickets->find()
            ->where([
                'Tickets.staff_id' => $currentStaffId,
                'Tickets.closetime IS NULL'
            ])
            ->contain(['Users', 'Contents', 'Customers'])
            ->all();

// Pass the tickets data to the view

//        debug($assigntickets);
//exit;
        $this->set('assigntickets', $assigntickets);

    }
    public function escalatetome()
    {



        // Get the current user id
        $identity = $this->request->getAttribute('authentication')->getIdentity();
        $currentStaffId = $identity->get('id');

        // get the relate cust
        $assignedCustomers = $this->Customers->find()
            ->innerJoinWith('Tickets', function ($query) use ($currentStaffId) {
                return $query->where([
                    'Tickets.staff_id' => $currentStaffId,
                    'Tickets.closetime IS NULL',
                    'Tickets.escalate IS TRUE'
                ]);
            })
            ->distinct(['Customers.id'])// Add this line to ensure distinct customers
            ->all();

//debug($assignedCustomers);
//exit;
        // pass data
        $this->set('assignedCustomers', $assignedCustomers);

//
// Get the related tickets for assigned customers
        $assigntickets = $this->Customers->Tickets->find()
            ->where([
                'Tickets.staff_id' => $currentStaffId,
                'Tickets.closetime IS NULL'
            ])
            ->contain(['Users', 'Contents', 'Customers'])
            ->all();

// Pass the tickets data to the view

//        debug($assigntickets);
//exit;
        $this->set('assigntickets', $assigntickets);

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

//            debug($customer);
//            exit;

            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

            $identifier = 'CUS';
            $generateId = $this->generateId($identifier, $customer->f_name, $customer->l_name);

            $customer->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} {1} has been added to the system!', $customer->f_name, $customer->l_name));

                return $this->redirect(['action' => 'index']);
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

            // WARNING: Changing PK is NOT RECOMMENDED AT ALL AND IS A HASSLE UNLESS YOU KNOW WHAT YOU ARE DOING
//            $previousId = $customer->id;
            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

//            $identifier = 'CUS';
//            $generateId = $this->generateId($identifier, $customer->f_name, $customer->l_name);
//
//            $customer->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The profile edit has been saved!.'));

                return $this->redirect(['action' => 'view', $customer->id]);
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


    public function deleteWithContents($userId)
    {
        // Find and delete the contents associated with user's tickets
        $ticketsTable = TableRegistry::getTableLocator()->get('Tickets');
        $tickets = $ticketsTable->find()->where(['cust_id' => $userId]);

        foreach ($tickets as $ticket) {
            $contentsTable = TableRegistry::getTableLocator()->get('Contents');
            $contents = $contentsTable->find()->where(['ticket_id' => $ticket->id]);

            foreach ($contents as $content) {
                $contentsTable->delete($content);
            }
        }

        // Delete the customer profile
        $customer = $this->Customers->get($userId);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('Customer profile and associated contents have been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the customer profile.'));
        }

        return $this->redirect(['action' => 'index']); // Redirect to a suitable page
    }


    /**
     * Archive Method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function archive($id)
    {
        $customer = $this->Customers->get($id);
        $currentArchiveValue = $customer->archive; // Store the current value

        if ($currentArchiveValue == 0) {
            // Change from 0 to 1
            $customer->archive = 1;
            $customer->archived_time = new \DateTime(); // Set archived_time to the current time
            $customer->status = 'Archived'; // Set status to 'archived'

            // Load the Tickets model
            $ticketsTable = $this->getTableLocator()->get('Tickets');

            // Close all tickets affiliated with this customer
            $openTickets = $ticketsTable->find()
                ->where(['cust_id' => $customer->id, 'closed' => 0])
                ->all();

            foreach ($openTickets as $ticket) {
                $ticket->closed = 1;
                $ticket->closetime = new \DateTime();
                $ticketsTable->save($ticket);
            }

            $message = __('{0} {1} has been successfully archived', $customer->f_name, $customer->l_name);
        } else {
            // Change from 1 to 0
            $customer->archive = 0;
            $customer->archived_time = null; // Set archived_time to null
            $customer->status = 'Recently Unarchived'; // Set status to 'recently unarchived'

            $message = __('{0} {1} has been successfully unarchived', $customer->f_name, $customer->l_name);
        }

        if ($this->Customers->save($customer)) {
            $this->Flash->success($message);
        } else {
            $this->Flash->error(__('Unable to update customer archive status for: {0} {1}', $customer->f_name, $customer->l_name));
        }

        return $this->redirect(['action' => 'view', $customer->id]);
    }

}


