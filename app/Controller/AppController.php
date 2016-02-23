<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers=array('Html','Form','Session');
    public $components=array('Session','Auth');



    public function beforeRender(){
        if($this->Auth->user('user_type')==1){
              $this->layout='admin';
        }
        else{
            $this->layout='default';
        }
    }

    public function beforeFilter() {
        if ($this->request->prefix == 'admin') {
            $this->layout = 'admin';
        }
        if(isset($this->request->params['admin'])){
                // the user has accessed an admin function, so handle it accordingly.
            if($this->Auth->user('user_type')==1){
              //  $this->layout='admin';
                $this->Auth->allow();
            }
            else{
                // A non-admin user has accessed an admin function, so we shouldn't allow it.
              //  $this->redirect(array('controller'=>'pages', 'action'=>'start', 'admin'=>false));
                $this->redirect('/');
            }
        }
        else{
        //the user has accessed a NON-admin function, so handle it accordingly.
            $this->Auth->allow();
            $this->layout = 'default';
        }
        $this->set('logged_in', $this->Auth->loggedIn());
        $this->set('current_user', $this->Auth->user());


        ////// SHOPPING CART /////
        $this->loadModel('Cart');
        $this->set('count',$this->Cart->getCount());
    }

/*

        public function checkUserRole($user_type){
        if($user_type==1){
            $this->layout = 'admin';x
        }
    }
*/
}

