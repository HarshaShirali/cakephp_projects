<?php
/**
 * CodebackupFixture
 *
 */
class CodebackupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'used' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'prodline' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 14, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'code' => array('column' => 'code', 'unique' => 0), 'backup' => array('column' => 'backup', 'unique' => 0), 'prodline' => array('column' => 'prodline', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'code' => 'Lorem ip',
			'used' => 1,
			'prodline' => 'Lorem ipsum '
		),
	);
}
