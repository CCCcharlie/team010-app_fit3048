<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TicketsController extends AppController
{



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Users'],
        ];
        $tickets = $this->paginate($this->Tickets);

        $this->set(compact('tickets'));
    //        debug($tickets);
//        exit();
    }

    /**
     * Fillter option
     * @param string|null $id Tickets id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function unassigned()
    {

        $unassignedTickets = $this->Tickets->find()
            ->where(['staff_id IS NULL'])
            ->contain(['Customers', 'Users'])
            ->all();


        $this->set(compact('unassignedTickets'));

    }

    /**
     * View method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => ['Customers', 'Users', 'Contents'],
        ]);

        $this->set(compact('ticket'));
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

        $ticket = $this->Tickets->newEmptyEntity();
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

    //            debug($ticket);
    //            exit;
            //closed is a boolean variable where closed = 0 mean it is Open
            $ticket->closed = false;
            $ticket->cust_id = $custId;

            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

            $identifier = 'TCKT';
            $generateId = $this->generateId($identifier, $ticket->title, $ticket->type);

            $ticket->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            $ticket->escalate = true;

            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket titled: "'. $ticket->title . '" for ' . $fullName . ' Is successfully created'));

                return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);
            }
            $this->Flash->error(__('The ticket for titled: "'. $ticket->title . '" for ' .   $fullName . ' could not be created'));
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200])->all();

        //Users are written in a way to display in a drop down easily.
        //Key field refers to what will be stored in the form
        // Value field is what will be shown
        //In this case, it shows f_name of Staff but it stores the ID into the database
        $users = $this->Tickets->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'f_name',
            'limit' => 200
        ])->all();

        $this->set(compact('ticket', 'customers', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket id.
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
//        $ticketClosedStatus = $this->request->getQuery('ticket_closed');

        $this->set(compact('fullName', 'custId'));

        $ticket = $this->Tickets->get($id, [
            'contain' => [],
        ]);
//
        // Obtain the orginal data
        $originalData = $this->Tickets->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('originalData', 'originalData'));


//
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

//            debug($ticket);
//            debug($id);
//            exit;
//
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The Ticket now titled: "'. $ticket->title . '" is successfully edited'));
                // Save the original data in the session
                $this->getRequest()->getSession()->write('originalData', $originalData);

//                for undo action
               return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);
            }
            $this->Flash->error(__('This Ticket could not be saved. Please, try again.'));
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200])->all();
        $users = $this->Tickets->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'f_name',
            'limit' => 200
        ])->all();
        $this->set(compact('ticket', 'customers', 'users'));
//        return to current address
        $refererUrl = $this->referer();
//
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editticketunassigned($id = null)
    {
        //Obtain the query via key value pair [called from customer table view]
        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;
//        $ticketClosedStatus = $this->request->getQuery('ticket_closed');

        $this->set(compact('fullName', 'custId'));

        $ticket = $this->Tickets->get($id, [
            'contain' => [],
        ]);
//
        // Obtain the orginal data
        $originalData = $this->Tickets->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('originalData', 'originalData'));


//
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

//            debug($ticket);
//            debug($id);
//            exit;
//
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The Ticket: "'. $ticket->title . '" is successfully assigned'));
                // Save the original data in the session
                $this->getRequest()->getSession()->write('originalData', $originalData);

//                for undo action
//                return $this->redirect($this->redirect);
                return $this->redirect(['action' => 'unassigned']);
            }
            $this->Flash->error(__('This Ticket could not be assigned. Please, try again.'));
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200])->all();
        $users = $this->Tickets->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'f_name',
            'limit' => 200
        ])->all();
        $this->set(compact('ticket', 'customers', 'users'));
//        return to current address
        $refererUrl = $this->referer();
//
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);
        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('The ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function updateTicket($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);

        // Flip the replied field value (should be a boolean)
        $ticket->closed = !$ticket->closed;

        $successMessage = 'Status of Ticket ID: ' . $ticket->id . ' Successfully changed';
        if ($this->Tickets->save($ticket)) {
            $this->Flash->success(__($successMessage));
        } else {
            $this->Flash->error(__('The contact form could not be updated. Please, try again.'));
        }

        // Instead of redirect to index page, redirect to where the user came from
        // Remember the function is being called from both index listing and view page sidebar
        return $this->redirect($this->referer());
    }

    // TicketsController.php
    public function assignUser($id = null)
    {
        //Obtain the query via key value pair [called from customer table view]
        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;
//        $ticketClosedStatus = $this->request->getQuery('ticket_closed');

        $this->set(compact('fullName', 'custId'));

        $ticket = $this->Tickets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

//            debug($ticket);
//            debug($id);
//            exit;

            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));
                return $this->redirect(['controller' => 'Customers', 'action' => 'view', $custId]);
            }
            $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200])->all();
        $users = $this->Tickets->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'f_name',
            'limit' => 200
        ])->all();
        $this->set(compact('ticket', 'customers', 'users'));




    }


    public function undo($id = null)
    {

        $originalData = $this->getRequest()->getSession()->read('originalData');


        // obtain the data being changed
        $ticketToUndo = $this->Tickets->get($id);

        // cover the change
        $ticketToUndo = $this->Tickets->patchEntity($ticketToUndo, $originalData->toArray());

        if ($this->Tickets->save($ticketToUndo)) {
            $this->Flash->success(__('Changes have been undone.'));
        } else {
            $this->Flash->error(__('Unable to undo changes.'));
        }


//        return $this->redirect($this->referer());
        return $this->redirect(['controller' => 'Customers', 'action' => 'view', $originalData['cust_id']]);

    }


    public function beforeDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        // Find and delete associated Contents records
        $contentsTable = TableRegistry::getTableLocator()->get('Contents');
        $contents = $contentsTable->find()->where(['ticket_id' => $entity->id]);
        foreach ($contents as $content) {
            $contentsTable->delete($content);
        }
        return true;
    }

    public function updateEscalate($id)

    {
        $identity = $this->request->getAttribute('authentication')->getIdentity();
        $staffId= $identity->get('id');
//        current user

        // Get the related tickets for assigned customers
        $assigntickets = $this->Tickets->find()
            ->where([
                'Tickets.staff_id' => $staffId,
                'Tickets.cust_id' => $id,
                'Tickets.closetime IS NULL'


            ])
            ->contain(['Users',  'Customers'])
            ->all();

        $rootuser = $this->Tickets->Users->find()
            ->where([
                'Users.role' => 'root'
            ])
            ->contain(['Tickets'])
            ->first();
        $rootuserid = $rootuser->id;



        // Loop through the assigned tickets
        foreach ($assigntickets as $ticket) {
            // Update "escalate" to true（1）
            $ticket->escalate = true;
            $ticket->staff_id = $rootuserid;
//mark down the staff escalating


            $Customers = $this->Tickets->Customers->find()
                ->matching('Tickets', function ($q) use ($ticket) {
                    return $q->where(['Tickets.id' => $ticket->id]);
                })
                ->first();

//            debug($Customers);
//            exit();
            $Customers ->notes .= 'escalated by'.$identity->get('f_name').$identity->get('l_name');


            $this->request->getSession()->write('escalatedTickets', $assigntickets);
//note  for the customer
            if ($this->Tickets->Customers->save($Customers)) {
                $this->Flash->success(__('Note being added for Escalation : {0}', $ticket->title));
            } else {
                $this->Flash->error(__('Note have not being added for Escalation : {0}', $ticket->title));

            }
            // Save the ticket
            if ($this->Tickets->save($ticket)) {
                $this->request->getSession()->write('escalated', true);
                $this->Flash->success(__('Escalation successful for Ticket : {0}', $ticket->title));
            } else {
                $this->Flash->error(__('Escalation failed for Ticket : {0}', $ticket->title));
            }
        }

        //
        return $this->redirect($this->referer());
    }

    public function undoEscalate($id)

    {
        $escalatedTickets = $this->request->getSession()->read('escalatedTickets');

        $identity = $this->request->getAttribute('authentication')->getIdentity();
        $staffId = $identity->get('id');



        // Loop through the assigned tickets and de-escalate them
        foreach ($escalatedTickets as $ticket) {
            // Update "escalate" to false (0)
            $ticket->escalate = false;
            $ticket->staff_id = $staffId; // Set staff_id back to the current user's ID
            $ticket->closetime = null;

//
            $Customers = $this->Tickets->Customers->find()
                ->matching('Tickets', function ($q) use ($ticket) {
                    return $q->where(['Tickets.id' => $ticket->id]);
                })
                ->first();
            $note = $Customers->notes;
            $pattern = '/^escalated by /';
            $Customers->notes = preg_replace($pattern, '', $note);
// note
            if ($this->Tickets->Customers->save($Customers)) {
                $this->Flash->success(__('Note being undo for Escalation : {0}', $ticket->title));
            } else {
                $this->Flash->error(__('Note have not being undo for Escalation : {0}', $ticket->title));

            }
            // Save the ticket
            if ($this->Tickets->save($ticket)) {
                $this->request->getSession()->write('escalated', false);

                $this->Flash->success(__('Deescalation successful for Ticket : {0}', $ticket->title));
            } else {
                $this->Flash->error(__('Deescalation failed for Ticket : {0}', $ticket->title));
            }
        }

        return $this->redirect($this->referer());
    }

}


