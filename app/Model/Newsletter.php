<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2016.01.20.
 * Time: 14:53
 */
App::uses('AppModel', 'Model');
class Newsletter extends AppModel {

    public $validate = array(
        'email'=>array(
            'rule1'=>array(
                'rule'=>array('email'),
                'allowEmpty' => false,
                'message'=>'Please enter a valid email adress!'
            ),
            'rule2'=>array(
                'rule'=>'isUnique',
                'message'=>'That address has already been taken',
            )
        )
    );
}