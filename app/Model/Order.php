<?php
App::uses('AppModel', 'Model');
class Order extends AppModel {

    public $validate=array(
        'first_name'=> array(
            'rule' => array('custom','/[a-zA-Z]+/'),
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Please enter Firstmane!'
        ),
        'last_name'=> array(
            'rule' => array('custom','/[a-zA-Z]+/'),
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Please enter Lastname!'
        ),
        'email'=> array(
            'rule'=>'email',
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Please enter a valid email address!'
        ),
        'phone'=> array(
            'rule' => array('custom','/[0-9+ ]/'),
            'allowEmpty' => false,
            'massage'=>'Enter only numbers, start with +'
        ),
        'address'=> array(
            'rule' => array('custom', '/[a-z0-9.,\/ ]/'),
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Please enter your address!'
        ),
        'address2'=> array(
            'rule' => array('custom', '/[a-z0-9.,\/ ]/'),
            'allowEmpty' => true,
            'required' => false,
            'massage'=>'Please enter your address!'
        ),
        'city'=> array(
            'rule' => array('custom','/[a-zA-Z ]+/'),
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Please enter your city!'
        ),
        'zip'=> array(
            'rule'=>'numeric',
            'allowEmpty' => false,
            'required' => true,
            'massage'=>'Enter only numbers!'
        ),
        'state_province'=> array(
            'rule' => array('custom','/[a-zA-Z ]+/'),
            'allowEmpty' => true,
            'required' => false,
        ),
    );

    public $hasMany = array(
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
            'dependent' => true,
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
}