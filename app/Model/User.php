    <?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {
    public $displayField = 'name';


    /**
     * Function beforeSave is for hasshing password before save itt to the database
     *
     */
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
                'rule'=> array('between', 5,20),
               // 'required' => true,
                'message' => 'The username must be between 5 and 20 characters.'
            ),
            'That username has already been taken'=>array(
                'rule' => 'isUnique',
                'message' => 'That username has already been taken',
            )
        ),
        'password'=>array(
            'Not empty' => array(
                'rule' => 'alphaNumeric',
                'on' => 'create',  // we only need this validation on create
                'message' => 'Please enter your password!',
            ),
            'Match paswords'=>array(
                'rule' => 'matchPasswords',
                'message' => 'Your passwords do not match!'
            ),
        ),
        'pasword_confirmation' => array(
            'rule' => 'alphaNumeric',
            'required' => 'false',
            'message' => 'Please confirm your password!',
        ),
        'email' => array(
            'Valid email' => array(
                'rule' => 'email',
                'message' => 'Please enter a valid email adress!'
            ),
            'That address has already been taken' => array(
                'rule' => 'isUnique',
                'message' => 'That address has already been taken',
            )
        ),
        'firstname' => array(
            'rule' => array('custom','/[a-zA-Z ]/'),
            'massage '=> 'Please enter Firstmane!'
            ),
        'lastname' => array(
            'rule' => array('custom','/[a-zA-Z ]/'),
            'massage' => 'Please enter Lastname!'
        ),
        'birthdate' => array(
            'rule' => 'date',
            'massage' => 'Please enter a valid date format!'
        )
	);

    /**
     * Logic for matching password and password confirmation fields
     *
     */

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
