<?php
App::uses('AppModel', 'Model');
/**
 * Rotation Model
 *
 * @property Champion $Champion
 */
class Rotation extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'champion_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Champion' => array(
			'className' => 'Champion',
			'foreignKey' => 'champion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
