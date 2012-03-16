<?php
class UsersController extends AppController {
    public $name = 'Users';
    public $helpers = array('Html','Form');


    function beforeFilter(){
      $this->set('css', 'admin.css');

      $this->Auth->allow('*');
      parent::beforeFilter();
    }


    public function login() {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }




    function admin_index() {
            $this->User->recursive = 0;
            $this->set('users', $this->paginate());
    }

    function admin_view($id = null) {
            if (!$id) {
                    $this->Session->setFlash(__('Invalid user', true));
                    $this->redirect(array('action' => 'index'));
            }
            $this->set('user', $this->User->read(null, $id));
    }

    function admin_add() {
            if (!empty($this->data)) {
                    $this->User->create();
                    $this->request->data['User']['password'] = Security::hash($this->data['User']['password'],NULL,'785f756785nv7w56om:}{p;[pl[L[p]luii');
                    if ($this->User->save($this->data)) {
                            $this->Session->setFlash(__('Zarejestrowano nowego użytkownika', true));
                            //$this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('Wystąpił problem z rejestracją nowego użytkownika', true));
                    }
            }
    }

    function admin_edit($id = null) {
            if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Invalid user', true));
                    $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                    if ($this->User->save($this->data)) {
                            $this->Session->setFlash(__('The user has been saved', true));
                            $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
                    }
            }
            if (empty($this->data)) {
                    $this->data = $this->User->read(null, $id);
            }
    }

    function admin_delete($id = null) {
            if (!$id) {
                    $this->Session->setFlash(__('Invalid id for user', true));
                    $this->redirect(array('action'=>'index'));
            }
            if ($this->User->delete($id)) {
                    $this->Session->setFlash(__('User deleted', true));
                    $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('User was not deleted', true));
            $this->redirect(array('action' => 'index'));
    }





}