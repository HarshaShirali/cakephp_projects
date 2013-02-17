<?php
/**
 * MessageFixture
 *
 */
class MessageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'mobile' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'message' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 180, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'answer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 180, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'posteddate' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'prize' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
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
			'mobile' => 'Lorem ipsum d',
			'message' => 'Lorem ipsum dolor sit amet',
			'answer' => 'Lorem ipsum dolor sit amet',
			'posteddate' => '2012-06-11 02:51:43',
			'prize' => 'Lorem ipsum do'
		),
	);
}
