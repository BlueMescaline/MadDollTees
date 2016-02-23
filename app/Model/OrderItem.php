<?php
App::uses('AppModel', 'Model');
class OrderItem extends AppModel {

//////////////////////////////////////////////////
    public $validate = array(
        'order_id' => array(
            'rule' => 'numeric',
        ),
        'name' => array(
            'rule' => array('custom', '/[a-z0-9.,\/ ]/'),
        ),
        'quantity' => array(
            'rule' => 'numeric',
        ),
    );

//////////////////////////////////////////////////

    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
            'counterScope' => array(),
        )
    );
//////////////////////////////////////////////////
}
