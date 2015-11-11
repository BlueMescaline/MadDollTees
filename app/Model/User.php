    <?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {
    public $displayField = 'name';

    public function beforeSave($options = array()) {
    if(!empty($this->data['User']['password'])) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    } else {
        unset($this->data['User']['password']);
    }
    return true;
}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'username' => array(
            'The username must be between 5 and 20 characters.'=>array(
                'rule'=>array('between', 5,20),
                'required' => false,
                'message'=>'The username must be between 5 and 20 characters.'
            ),
            'That username has already been taken'=>array(
                'rule'=>'isUnique',
                'message'=>'That username has already been taken',
            )
        ),
        'password'=>array(
            'Not empty'=>array(
                'rule'=>'notEmpty',
                'required' => 'false',
                'on'        => 'create',  // we only need this validation on create
                'message'=>'Please enter your password!',
            ),
            'Match paswords'=>array(
                'rule'=>'matchPasswords',
                'message'=>'Your passwords do not match!'
            ),
        ),

        'pasword_confirmation'=>array(
            'Not empty'=>array(
                'rule'=>'notEmpty',
                'required' => 'false',
                'message'=>'Please confirm your password!',
            ),
        ),

        'email'=>array(
            'Valid email'=>array(
                'rule'=>array('email'),
                'required' => 'false',
                'message'=>'Please enter a valid email adress!'
            ),
            'That address has already been taken'=>array(
                'rule'=>'isUnique',
                'message'=>'That address has already been taken',
            )
        ),

        'firstname'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'notEmpty',
                'required' => 'false',
                'massage'=>'Please enter Firstmane!'
            )
            ),

        'lastname'=> array(
            'Please enter Lastname!'=>array(
                'rule'=>'notEmpty',
                'required' => false,
                'massage'=>'Please enter Lastname!'
            )
        ),

        'birthdate'=>array(
            'Please set the date of birth!'=>array(
                'rule'=>'notEmpty',


            )
        )

	);

    public function matchPasswords($data){
        if($data['password']==$this->data['User']['password_confirmation']){
            return true;
        }
        $this->invalidate('password_confirmation','Your passwords do not match');
        return false;
    }

    /*
    public $hasMany = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
        )
    );

    */
}
