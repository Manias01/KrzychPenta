<?php
App::uses('AppModel', 'Model');

class Ss extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ss';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name_en';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name_en' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lv' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
