<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 */
class Item extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
            'allowEmpty' => false,
            'required' => true,
            'rule' => array('custom','/[a-zA-Z0-9 ]/'),
            'message' => 'Only alphabets and numbers allowed',
		),
		'description' => array(
            'rule' => array('custom', '/^[\w\-\s,.]+$/'),
            'allowEmpty' => true,
            'message' => 'Only alphanumeric , . and space allowed',
		),
		'price' => array(
			'rule' => array('numeric'),
			'allowEmpty' => false,
			'required' => true,
            'message' => 'Only numbers allowed',
        ),
        'image' => array(
            'rule1'=> array(
                'rule' => array('extension',array('jpeg','jpg','png','gif')),
                'required' => 'create',
                'allowEmpty' => true,
                'message' => 'Select Valid Image',
                'on' => 'create',
                'last'=> true
            ),
            'rule2'=>array(
                'rule' => array('extension',array('jpeg','jpg','png','gif')),
                'message' => 'Select Valid Image',
                'on' => 'update',
            ),
        ),
    );
}
