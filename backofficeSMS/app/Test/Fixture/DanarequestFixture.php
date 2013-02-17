<?php
/**
 * DanarequestFixture
 *
 */
class DanarequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'tablecode' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'idconversation' => array('type' => 'integer', 'null' => false),
		'mobile' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last' => array('type' => 'string', 'null' => false, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'time' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'tablecode' => 'Lorem ipsum d',
			'idconversation' => 1,
			'mobile' => 'Lorem ipsum d',
			'name' => 'Lorem ipsum dolor ',
			'last' => 'Lorem ipsum dolor ',
			'code' => 'Lorem ip',
			'time' => 1339683378
		),
	);
}
