<?php
App::uses('AppModel', 'Model');
class Order extends AppModel {

    public $validate=array(
        'first_name'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'alphaNumeric',
                'allowEmpty' => false,
                'required' => 'false',
                'massage'=>'Please enter Firstmane!'
            )
        ),
        'last_name'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'alphaNumeric',
                'allowEmpty' => false,
                'required' => 'false',
                'massage'=>'Please enter Lastname!'
            )
        ),
        'email'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'email',
                'allowEmpty' => false,

                'required' => 'false',
                'massage'=>'Please enter email address!'
            )
        ),
        'phone'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'numeric',
                'allowEmpty' => false,

                'required' => 'false',
                'massage'=>'Please enter phone number!'
            )
        ),
        'address'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'alphaNumeric',
                'allowEmpty' => false,
                'required' => 'false',
                'massage'=>'Please enter your address!'
            )
        ),
        'city'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'alphaNumeric',
                'allowEmpty' => false,
                'required' => 'false',
                'massage'=>'Please enter your city!'
            )
        ),
        'zip'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'numeric',
                'allowEmpty' => false,
                'required' => 'false',
                'massage'=>'Please enter zip code!'
            )
        ),
        'state_province'=> array(
            'Please enter Firstname!'=>array(
                'rule'=>'alphaNumeric',
                'allowEmpty' => true,
                'required' => 'false',
            )
        ),
    );


//////////////////////////////////////////////////

    public $hasMany = array(
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        )
    );
/*
    public $belongsTo = array(
        'User'=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'counterCache' => true,
            'counterScope' => array(),
        )
    );

*/

//////////////////////////////////////////////////

}