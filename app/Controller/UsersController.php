<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {


    public function beforeFilter()
    {
        parent::beforeFilter();
    }


/**
 * Components
 * @var array
 */
	public $components = array('Paginator','Captcha');


 /**
 * index method for admin
 * @return void
 */
	public function admin_index() {
//		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
    }

/**
 * view method for admin
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method for admin
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                $this->redirect(array('action' => 'index', ));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method for admin. If the user exist with the given id, delete it from the db.
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * function for logging in. Checks if the user already logged in, or not.
 * If user exists and the status is active the function set user to logged in.
 */
    public function login(){
        if ($this->Auth->loggedIn()) {
            $this->Session->setFlash('You are already logged in!');
        }
        if ($this->request->is('post'))
        {
            /*  $this->checkUserRole($this->Auth->user('user_type'));*/
            if ($this->Auth->login())
            {
                if($this->Auth->user('status')=='active'){
                return $this->redirect($this-> Auth-> redirectUrl());
                //  return $this->redirect($this->referer());
            }
                else if($this->Auth->user('status')=='inactive'){
                    $this->Auth->logout();
                    return $this->Session->setFlash(__('Your account is inactive, activate first!'));
                }
            $this->Session->setFlash(__('Invalid username or passwort, try agagin'));
        }
    }
}

/**
* The function calls the AuthComponent`s logout function, set the user to Logged out.
*/
   public function logout(){
       $this->Auth->logout();
       $this->redirect('/');
    }

/**Funtion for registering user. If captcha is correct and user is saved, sends an activation mail with activation code in it.
 *
 */
    public function register(){
        if ($this->request->is('post')) {
            $captcha = $this->Session->read('captcha_code');
            if ( $captcha == $this->request->data['User']['captcha']) {
                $this->User->create();
                $code=$this->request->data['User']['activation_code']=md5(mt_rand(10000,99999).time().mt_rand(10000,99999));
                $to=$this->request->data['User']['email'];
                if ($this->User->save($this->request->data)) {
                    $id=$this->User->id;
                    $subject='User activation - MadDollTees';
                    $this->sendMail($to, 'user_activation', $subject, $code, $id);
                    $this->Session->setFlash('You have successfully registered. Check your email acount for activation! ');
                    $this->redirect(array('controller'=>'Items','action'=>'index'));
			    } else {
				    $this->Session->setFlash(__('The account could not be saved. Please, try again.'));
			    }
            } else {
                $this->Session->setFlash(__('Captcha code does not match'));
            }
		}
    }

/**
*Function to isplay captcha code. call this function in page where we want to use captcha
*/
    public function get_captcha() {
        $this->autoRender = false;
        App::import('Component','Captcha');

        //generate random numbers for captcha
        $random = mt_rand(1000, 99999);

        //save characters into session variable
        $this->Session->write('captcha_code', $random);

        $settings = array(
            'characters' => $random,
            'winHeight' => 50,  // captcha image height
            'winWidth' => 220,  // captcha image width
            'fontSize' => 25,   // captcha image characters fontsize
            'fontPath' => WWW_ROOT.'tahomabd.ttf',    // captcha image font
            'noiseColor' => '#ccc',
            'bgColor' => '#fff',
            'noiseLevel' => '100',
            'textColor' => '#000'
        );
        $img = $this->Captcha->ShowImage($settings);
        echo $img;
    }

/**User activation function. Gets the activation code from the link sent in mail. If the code is the same as the code saved to db, set user status to active.
* @param $token
*/
    public function activate($token){

        if(!isset($token)){
            $this->redirect('/');
        }
        $codeId=explode('XCB',$token);
        $code=$codeId['0'];
        $id=$codeId['1'];
        $data=$this->User->findByActivationCode($code);
        if(empty($data)){
            $this->Session->setFlash('Invalid activation link!');
            $this->redirect(array('controller' => 'Items', 'action' => 'index'));
        }
        else{
            $this->User->id = $id;
            $this->User->set('activation_code',null);
            $this->User->set('status','active');
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('Your account is activated.');
                $this->redirect(array('controller' => 'Items', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('Cant activate!');
            }
        }
    }


    /**
*Function for change password if it is forgotten. Find user by email, if exist generates a link with random token, and send it to te given email address
*/
    public function forgottenPass(){
        if ($this->request->is('post')){
            if(!empty($this->request)){
                $email=$this->request->data['User']['email'];
                $data=$this->User->findByEmail($email);
                if(!$data){
                    $this->Session->setFlash('No Such E-mail address registerd with us ');
                } else {
                    $code=md5(mt_rand(10000,99999).time().mt_rand(10000,99999));
                    $this->User->updateAll(
                        array('activation_code' => '"' .$code.'"'),
                        array('email' => $email)
                    );
                    $subject='Password reset instructions - MadDollTees';
                    $this->sendMail($email,'forgotten_pass', $subject, $code, $data['User']['id']);
                    $this->Session->setFlash('Setting has been sent. Check your email account!');
                    $this->redirect('/');
                }
            }
        }
    }

/**Function for reset password. Gets the $token from url. Explde it to userId and Code, if code exist in db saves the new pasword typed in reset form.
* @param $token
*/
    public function reset($token){
        if(!isset($token)){
            $this->redirect('/');
        }
        $codeId=explode('XCB',$token);
        $code=$codeId['0'];
        $id=$codeId['1'];
        $data=$this->User->findByActivationCode($code);
        if(empty($data)){
            $this->Session->setFlash('Invalid reset link. Try again or request a new mail!');
        }
        else{
            if($this->request->is('post') AND (!empty($this->request))){
                $this->User->id = $id;
                $this->User->set('activation_code',null);
                if($this->User->save($this->request->data)){
                    $this->Session->setFlash('Password updated!');
                    $this->redirect('/');
                }
                else $this->Session->setFlash('error!');
            }
        }
    }

/**Function to send mails
* @param $mailto
* @param $template
* @param $subject
* @param $code
* @param $user_id
*/
    public function sendMail($mailto, $template, $subject, $code, $user_id){
        $Email = new CakeEmail('gmail');
        $Email->emailFormat('html');
        $Email->to($mailto);
        $Email->template($template)->viewVars(array('code'=>$code, 'id'=>$user_id));
        $Email->attachments(array(
            'maillogo.png' => array(
                'file' => WWW_ROOT.'/img/maillogo.png',
                'mimetype'=>'image/png',
                'contentId' => 'logo'
            )
        ));
        $Email->subject($subject);
        $Email->replyTo('maddoltees@gmail.com');
        $Email->from ('maddolltees@gmail.com');
        $Email->send();
    }
}
