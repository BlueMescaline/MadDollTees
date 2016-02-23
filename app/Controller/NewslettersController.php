<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2016.01.20.
 * Time: 21:42
 */
App::uses('AppController', 'Controller');

class NewslettersController  extends AppController {
    public $components = array('Paginator');


    /**
     *
     */
    public function admin_index() {
//		$this->User->recursive = 0;
        $this->set('newsletters', $this->Paginator->paginate());
    }

    /**
     *
     */
    public function add(){
        if($this->request->is('post')){
            $this->Newsletter->create();
            if($this->Newsletter->save($this->request->data)){
                $this->Session->setFlash(__('Your email address has been saved.'));
                return $this->redirect('/');
            }
            else{
                $this->Session->setFlash(__('Unable to add your address'));
                return $this->redirect('/');

            }
        }
    }

    /**
     * @param null $id
     * @throws NotFoundException
     */
    public function admin_delete($id = null) {
        $this->Newsletter->id = $id;
        if (!$this->Newsletter->exists()) {
            throw new NotFoundException(__('Invalid address'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Newsletter->delete()) {
            $this->Session->setFlash(__('The adress has been deleted.'));
        } else {
            $this->Session->setFlash(__('The address could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
