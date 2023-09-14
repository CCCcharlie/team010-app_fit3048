<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Cb Controller
 *
 * @property \App\Model\Table\CbTable $Cb
 * @method \App\Model\Entity\Cb[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CbController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Since theres a bug where doing before filter here does not redirect authentication properly to login, this is
        // more or less a bandaid fix, this should be included in every beforeFilter code of controller where there is
        // a need of user privileges, example below:
        if($this->checkLoggedIn() === null){
            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }

        // Check if user is not an admin and redirect to index
        $loggedRole = $this->Authentication->getIdentity()->role;

        //Fabulous logic for mostly admin access
        $action = $this->request->getParam('action');

        // Whitelist "admin" and "root"
        //Prevent anyone not "admin" or "root" from entering
        if ($loggedRole !== 'admin' && $loggedRole !== 'root') {
            $this->Flash->error(__('You are not authorized to access this page.'));
            return $this->redirect(['controller' => 'Customers', 'action' => 'assigntome']);
        }

        //Since deletion of content blocks is EXTREMELY not recommended right now, prevent it entirely
        if($action === 'delete' || $action === 'add'){
            $this->Flash->error(__('Sorry! You cannot add or delete Content blocks.'));
            return $this->redirect(['action' => 'index']);
        }

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cbs = $this->paginate($this->Cb);

        $this->set(compact('cbs'));
    }

    /**
     * View method
     *
     * @param string|null $id Cb id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cb = $this->Cb->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('cb'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cb = $this->Cb->newEmptyEntity();
        if ($this->request->is('post')) {
            $cb = $this->Cb->patchEntity($cb, $this->request->getData());
            if ($this->Cb->save($cb)) {
                $this->Flash->success(__('The cb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cb could not be saved. Please, try again.'));
        }
        $this->set(compact('cb'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cb id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cb = $this->Cb->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cb = $this->Cb->patchEntity($cb, $this->request->getData());

            //IMPORTANT: updates the content of previous_value to the content of the current value before the change is made.
            //Basically acts as storing the previous value of content value
            $cb->previous_value = $cb->content_value;
//            debug($cb);
//            exit();
            //First check if theres errors or not and if image, we dont want to do stuff if its text lmao
            if (!$cb->getErrors() && $cb->content_type == "image") {
                //Gets from field name of edit.php of services
                $image = $this->request->getData('content_image');

//                debug($image);
//                exit();

                //get image name
                $image_name = $image->getClientFilename();
                //if it exists, do all of this
                if ($image_name) {
                    //if a directory was not made already, create one
                    if (!is_dir(WWW_ROOT . 'img')) {
                        mkdir(WWW_ROOT . 'img');
                    }
                    //Set target path to webroot/img/conversation/name_of_image
                    $targetPath = WWW_ROOT . 'img' . DS . $image_name;

                    //Move the image obtained from the form, to the path defined above
                    $image->moveTo($targetPath);

                    //Similary to the add function here, store it in database the folder and the name of the image
                    $cb->content_value =  $image_name;
                }
            }
//            debug($cb);
//            exit;

            if ($this->Cb->save($cb)) {
                $this->Flash->success(__('The block: ' . $cb->hint . ' has been saved'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The block: ' . $cb->hint . ' could not be saved, please try again'));
        }
        $this->set(compact('cb'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cb id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cb = $this->Cb->get($id);
        if ($this->Cb->delete($cb)) {
            $this->Flash->success(__('The cb has been deleted.'));
        } else {
            $this->Flash->error(__('The cb could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
