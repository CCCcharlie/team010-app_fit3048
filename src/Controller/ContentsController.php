<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response; // since we use response, add this line

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
        //If I want to get the name of the customer, from a ticket, shown in contents,
        // "'contain' => ['Tickets.Customers']"
        //this ^ is how you can do it instead of ['Tickets', 'Customers']
        // ['Tickets', 'Customers'] only works if contents has direct association (FK) with customers.
        // Which in how we did in our ERD, it does not (Customers - tickets - Content)
        $this->paginate = [
            'contain' => ['Tickets.Customers'],
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
//        $this->paginate = [
//            'contain' => ['Tickets.Customers'],
//        ];
//        $contents = $this->paginate($this->Contents);
//
//        $this->set(compact('contents'));

        //Obtain the query via key value pair [called from customer table view]
        $ticketId = $this->request->getQuery('ticket_id');
        $firstName = $this->request->getQuery('f_name');
        $lastName = $this->request->getQuery('l_name');
        $custId = $this->request->getQuery('cust_id');
        $fullName = $firstName . ' ' . $lastName;

        // Set the ticket ID as a default value for the form field
        $this->set(compact('ticketId', 'fullName', 'custId'));

        $content = $this->Contents->newEmptyEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());

            //File upload documentation: https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbWNNbmRGbC04NzZScDMtX0tCMnJZZFhPdnpZZ3xBQ3Jtc0tsQmRjbWhZdUI2NzhFVXEtbTFJVGJ6Z2xSU05PM1pkN29XWE4xRVBTUWFWVjEwSVdPRW4wbHR6c09HUW43aG5Tb2k2MzBTcEtyQTZTeVAtUVd1R1JKTGlYcGE3cnhaWXU2REFEOU9QX0hUNmEwZWRMZw&q=https%3A%2F%2Fbook.cakephp.org%2F4%2Fen%2Fcontrollers%2Frequest-response.html%23file-uploads&v=qgt1ALhWMeA

            //FOR VALIDATION, GO TO ContentsTable.PHP

            //if no error, run this.. Also check if the fieldname for 'file' or 'image' exists, we dont want to do anything to them
            //if they are null
            $checkFile = $this->request->getData('file');
            $checkImage = $this->request->getData('image');

//            debug($checkFile);
//            debug($checkImage);
//            debug($content);

            if (!$content->getErrors() && ($checkFile || $checkImage)) {
                //IMPORTANT NOTE: File here is both file and image (I know its confusing)
                //This line gets data (image) with name of 'image_file' (from services' add.php)
                if ($checkFile) {
                    $file = $this->request->getData('file');
                } else if ($checkImage) {
                    $file = $this->request->getData('image');
                }

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
                    //Set target path to webroot/img/conversation/name_of_image
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
                    //For regular files [PDF, DOCX OR TXT], save it as only its file name
                    $content->content = $file_name;
                }
            }
            //Set content id here because we dont want them to use html to modify other queries
            $content->ticket_id = $ticketId;

            if ($this->Contents->save($content)) {
                $message = "The attachment for Ticket" . $content->ticket_id .  "Saved successfully";
                $this->Flash->success(__($message));

                // Instead of redirect to index page, redirect to where the user came from
                // Remember the function is being called from both index listing and view page sidebar
                return $this->redirect($this->referer());
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

        // Instead of redirect to index page, redirect to where the user came from
        // Remember the function is being called from both index listing and view page sidebar
        return $this->redirect($this->referer());
    }

    /**
     * Download method
     *
     * @param string|null $encodedFilename Encoded file name.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function download($encodedFilename)
    {
        $fileName = urldecode($encodedFilename);
        $filePath = WWW_ROOT . 'file' . DS . 'user-file' . DS . $fileName; // Path to the uploaded file
        $imageFilePath = WWW_ROOT . 'img' . DS . $fileName; //path to the image file

//        debug($fileName);
//        debug($filePath);
//        debug($imageFilePath);
//        exit;

        //Because filename is expected to be receiving both IMAGES and FILES, we need to check if the item exists or not for both
        //cases in the if statement below
        $response = new Response();

        //If file [docx, pdf, txt] exists: download it
        if (file_exists($filePath)) {
            $response = $response->withFile($filePath, ['download' => true, 'name' => $fileName]);
            return $response;
            // However if its not a regular file, if its an Image file that exists: download it
        }else if(file_exists($imageFilePath)) {
            $response = $response->withFile($imageFilePath, ['download' => true, 'name' => $fileName]);
            return $response;
        } else {
            $this->Flash->error('File not found.');
            // Instead of redirect to index page, redirect to where the user came from
            // Remember the function is being called from both index listing and view page sidebar
            return $this->redirect($this->referer());
        }
    }
}
