<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Counsellors Controller
 *
 * @property \App\Model\Table\CounsellorsTable $Counsellors
 * @method \App\Model\Entity\Counsellor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CounsellorsController extends AppController
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
        $counsellors = $this->paginate($this->Counsellors);

        $this->set(compact('counsellors'));
    }

    /**
     * View method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $counsellor = $this->Counsellors->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('counsellor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;

        $this->set(compact('fullName', 'custId'));

        $counsellor = $this->Counsellors->newEmptyEntity();
        if ($this->request->is('post')) {
            $counsellor = $this->Counsellors->patchEntity($counsellor, $this->request->getData());

            /////////////////////////////
            // Generate the unique id  //
            /////////////////////////////

            // Call the generate id function in the AppController.php

            $identifier = 'COUNS';
            $generateId = $this->generateId($identifier, $counsellor->f_name, $counsellor->l_name);

            $counsellor->id = $generateId;

            ////////////////////////////////
            // End Generate the unique id //
            ////////////////////////////////

            $counsellor->cust_id = $custId;

            if ($this->Counsellors->save($counsellor)) {
                $this->Flash->success(__('Counsellor ' . $counsellor->f_name . ' has been saved'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counsellor could not be saved. Please, try again.'));
        }
        $customers = $this->Counsellors->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('counsellor', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $counsellor = $this->Counsellors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $counsellor = $this->Counsellors->patchEntity($counsellor, $this->request->getData());
            if ($this->Counsellors->save($counsellor)) {
                $this->Flash->success(__('The counsellor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counsellor could not be saved. Please, try again.'));
        }
        $customers = $this->Counsellors->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('counsellor', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $counsellor = $this->Counsellors->get($id);
        if ($this->Counsellors->delete($counsellor)) {
            $this->Flash->success(__('The counsellor has been deleted.'));
        } else {
            $this->Flash->error(__('The counsellor could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
