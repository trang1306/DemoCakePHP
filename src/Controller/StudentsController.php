<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 *
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->Auth->allow(['index'], ['add'], ['edit']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {   
        $this->paginate = [
            'Students' => [
                'limit' => 5
            ]
        ];

        $students = $this->paginate(
            $this->Students->find('all')
         );

        //$students = $this->Students->find('all');
        $this->set(compact('students', $students));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [],
        ]);

        $this->set('student', $student);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $myname = $data['IMAGE']['name'];
            $mytmp = $data['IMAGE']['tmp_name'];
            $myext = substr(strrchr($myname, "."), 1);
            $mypath = "uploads/".Security::hash($myname).".".$myext;
            $student->IMAGE = $mypath;
            if(move_uploaded_file($mytmp, WWW_ROOT. $mypath)) {
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            } else {
                $this->Flash->error(__('File upload error.'));
            }
        }
        $this->set(compact('student'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $myname = $data['IMAGE']['name'];
            $mytmp = $data['IMAGE']['tmp_name'];
            $myext = substr(strrchr($myname, "."), 1);
            $mypath = "uploads/".Security::hash($myname).".".$myext;
            $student->IMAGE = $mypath;

            $student = $this->Students->patchEntity($student, $this->request->getData());
            if(move_uploaded_file($mytmp, WWW_ROOT. $mypath)) {
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            } else {
                $this->Flash->error(__('File upload error.'));
            }   
        }
        $this->set(compact('student'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
