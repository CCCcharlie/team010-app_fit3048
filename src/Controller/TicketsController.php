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

            //closed is a boolean variable where closed = 0 mean it is Open
            $ticket->closed = false;
            $ticket->cust_id = $custId;

            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket for ' . $fullName . ' Is successfully created'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The ticket for ' . $fullName . ' could not be created'));
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
        $ticket = $this->Tickets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
        }
        $customers = $this->Tickets->Customers->find('list', ['limit' => 200])->all();
        $users = $this->Tickets->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('ticket', 'customers', 'users'));
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

        return $this->redirect(['action' => 'index']);
    }

    public function updateTicket($id = null) {
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

}
