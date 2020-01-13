<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validator;

/**
 * Users Controller
 *
 * @property \App\
 * Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add');  // Allow access add user 
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->set('username', '');
        $this->set('remember_me', '');

        $data = $this->request->data;
        if ($this->request->is('post')) {
            $validator = new Validator();
            $validator
                ->notBlank('USERNAME', 'We need your name.');
                    
            $errors = $validator->errors($this->request->data());
            if (!empty($errors)) {
                $this->Flash->error('Username not empty');
            }

            if ($data['remember_me']) {
                $this->Cookie->write('User.username', $data['USERNAME']);
                $this->Cookie->write('User.remember_me', $data['remember_me']);
            } else {
                $this->Cookie->delete('User');
            }

            $user = $this->Auth->identify();
            if($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Login Successful');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Username or password incorrect');
            }
        }
        // Get Cookies values for User
        $cookies = $this->Cookie->read('User');
        //set data from remember_me from cookies 
        if ($cookies['remember_me']) {
            $this->set('username', $cookies['username']);
            $this->set('remember_me',$cookies['remember_me']);
        }
    }
 
    public function logout() {
        $this->Flash->success('Logout Successful');
        $this->redirect($this->Auth->logout());
    }
}
