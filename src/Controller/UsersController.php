<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
        $this->Auth->allow('add');  // Cho phép access add user mà không cần login
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
        // Data mặc định
        $this->set('username', '');
        $this->set('remember_me', '');

        // Get form data
        $data = $this->request->data;

        // Done việc ghi nhớ form rồi đấy ^^
        // Nhưng mà hay hơn nữa thì mình check xem thông tin user login đúng chưa?
        // Nếu đúng thì mới ghi nhớ, còn không thì bỏ qua :) ^^
        // cho thêm if so sánh nhập vô với giá trị trong db ^^
        //    -> không cần, nhét đoạn set cookies ngay dưới đoạn Auth->identify() là được :)
        
        // Ủa sao nó xoá mất 1 đoạn nhỉ?
        if ($this->request->is('post')) {
            // Bây giờ bắt đầu nè ^^
            // Check xem ở form login user có check vào checkbox remember me không? oki
            // Đưa đoạn set Cookies vào đây để nó chỉ có hiệu lực set khi user click vào button Login mà thôi
            if ($data['remember_me']) {
                // Nếu có thì set data vào Cookies
                $this->Cookie->write('User.username', $data['USERNAME']);
                $this->Cookie->write('User.remember_me', $data['remember_me']);
            } else {
                // Nếu user không check vào thì mình không cần ghi nhớ làm gì
                // Xoá Cookies User đi luôn ^^
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
        //đoan set nay a le
        if ($cookies['remember_me']) {
            // Nếu Cookie remember_me đã được set trước đó
            // Lấy data trong Cookies ra gán vào form
            $this->set('username', $cookies['username']);
            $this->set('remember_me',$cookies['remember_me']);
        }
    }
 
    public function logout() {
        $this->Flash->success('Logout Successful');
        $this->redirect($this->Auth->logout());
    }
}
