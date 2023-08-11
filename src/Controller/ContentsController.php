<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contents Controller
 *
 * @property \App\Model\Table\ContentsTable $Contents
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContentsController extends AppController
{

    public function initialize(): void {
        parent::initialize();
        // Define types of contents in view
        $this->set('content_types', [
            'text' => 'Text',
            'image' => 'Image',
            'file' => 'File',
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tickets'],
        ];
        $contents = $this->paginate($this->Contents);

        $this->set(compact('contents'));
    }

    /**
     * View method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => ['Tickets'],
        ]);

        $this->set(compact('content'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $content = $this->Contents->newEmptyEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());

            //File upload documentation: https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbWNNbmRGbC04NzZScDMtX0tCMnJZZFhPdnpZZ3xBQ3Jtc0tsQmRjbWhZdUI2NzhFVXEtbTFJVGJ6Z2xSU05PM1pkN29XWE4xRVBTUWFWVjEwSVdPRW4wbHR6c09HUW43aG5Tb2k2MzBTcEtyQTZTeVAtUVd1R1JKTGlYcGE3cnhaWXU2REFEOU9QX0hUNmEwZWRMZw&q=https%3A%2F%2Fbook.cakephp.org%2F4%2Fen%2Fcontrollers%2Frequest-response.html%23file-uploads&v=qgt1ALhWMeA

            //FOR VALIDATION, GO TO ContentsTable.PHP

            //if no error, run this
            if (!$content->getErrors()) {
                //This line gets data (image) with name of 'image_file' (from services' add.php)
                $file = $this->request->getData('file');

                //If we were to type
//                  debug($file);
//                  exit;
                // $image will contain the data for the file itself such as clientFilename, MediaType, file, size, etc)

                //Say I want to get the name fo the file. Simple,
                $file_type = $file->getClientMediaType();
                $file_name = $file->getClientFilename();

//                debug($file_type);

                //Check if the file is an image type (PNG/JPEG/JPG) or regular file type (EX: PDF)
                //This is crucial because images should be stored in img of the webroot folder, not the file\user-files
//                image media type = image/jpg', 'image/png', 'image/jpeg'
                if($file_type === 'image/jpg' || $file_type === 'image/png' || $file_type === 'image/jpeg'){
                    //if a directory was not made already, create one
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'conversation')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'conversation');
                    }
                    //Set target path to webroot/img/user-img/name_of_image
                    $targetPath = WWW_ROOT . 'img' . DS . 'conversation' . DS . $file_name;

                    //Move the image obtained from the form, to the path defined above
                    $file->moveTo($targetPath);

                    //Similary to the add function here, store it in database the folder and the name of the image
                    $content->content =  'conversation/' . $file_name;
                } else {

                    if (!is_dir(WWW_ROOT . 'file')) {
                        mkdir(WWW_ROOT . 'file');
                    }
                    //To make storing files easier, create a folder user-file where it is all stored there
                    if (!is_dir(WWW_ROOT . 'file' . DS . 'user-file')) {
                        mkdir(WWW_ROOT . 'file' . DS . 'user-file');
                    }

                    //Since the file needs to be also stored in the webroot directory, we can move the image to it

                    //first define the path of webroot [WWW_ROOT is webroot, inside img folder,
                    //add a [Directory Separator i.e, backslash], the name
                    $targetPath = WWW_ROOT . 'file' . DS . 'user-file' . DS . $file_name;
                    //then move it
                    if ($file_name) {
                        $file->moveTo($targetPath);
                    }
                    //then, send the image to services' attribute, "image_name" including the path name so it can render properly.
                    $content->content = 'user-file/' . $file_name;
                }
            }

            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The content could not be saved. Please, try again.'));
        }
        $tickets = $this->Contents->Tickets->find('list', ['limit' => 200])->all();
        $this->set(compact('content', 'tickets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The content could not be saved. Please, try again.'));
        }
        $tickets = $this->Contents->Tickets->find('list', ['limit' => 200])->all();
        $this->set(compact('content', 'tickets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $content = $this->Contents->get($id);
        if ($this->Contents->delete($content)) {
            $this->Flash->success(__('The content has been deleted.'));
        } else {
            $this->Flash->error(__('The content could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
