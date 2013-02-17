<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 */
class Customer extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mobile' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'No puede ser vacío.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Seleccione un país.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
/*
 * Converts Facebooks birthday regular format (MM/DD/YYYY) into
 * database-like format string (YYYY-MM-DD) 
 */
	public function convertFbBirthday($birthday) {
		$birthday = explode('/', $birthday);
		$datetime = $birthday[2].'-'.$birthday[0].'-'.$birthday[1];
		return $datetime;
	}
}
