<?php
App::uses('AppModel', 'Model', 'Datasource');
/**
 * Code Model
 *
 */
class Code extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'used' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prodline' => array(
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
	
/**
 * 
 * @return new code
 */
 	public function get_new() {
 		$backup = $this->find('first', array('conditions'=>array('Code.reported' => 0, 'Code.backup' => 'Y')));
		if ($backup == null) {
			return "no";
		}
		return $backup['Code']['code'];
 	}
	
	public function kill_code($code) {
		$backup = $this->find('first', array('conditions'=>array('Code.code' => $code)));
		$backup['Code']['reported'] += 1;
		$backup['Code']['timereported'] = DboSource::expression('NOW()');
		$this->save($backup);
	}

	
	public function check_codes() {
		$backup = $this->find('first', array('conditions'=>array('Code.reported' => 0,
																  'Code.backup' => 'Y')));
		if ($backup == null) {
			return "no";
		}
		return "yes";
	}
}
