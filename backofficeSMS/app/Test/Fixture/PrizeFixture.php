<?php
/**
 * PrizeFixture
 *
 */
class PrizeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'prize' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 16, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'used' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'prize' => array('column' => 'prize', 'unique' => 0)),
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
			'prize' => 'Lorem ipsum do',
			'used' => 1
		),
	);
}
