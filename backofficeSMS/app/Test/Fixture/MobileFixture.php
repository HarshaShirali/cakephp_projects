<?php
/**
 * MobileFixture
 *
 */
class MobileFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'raffledate' => array('type' => 'datetime', 'null' => false, 'key' => 'index'),
		'chosen' => array('type' => 'integer', 'null' => false),
		'current' => array('type' => 'integer', 'null' => false),
		'mobile' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dateupdated' => array('type' => 'datetime', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'name' => array('type' => 'string', 'null' => false, 'default' => '-', 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last' => array('type' => 'string', 'null' => false, 'default' => '-', 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'idcard' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'confirmedby' => array('type' => 'string', 'null' => false, 'default' => '-', 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dateconfirmed' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'givenby' => array('type' => 'string', 'null' => false, 'default' => '-', 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dategiven' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'date' => array('column' => 'raffledate', 'unique' => 0)),
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
			'raffledate' => '2012-07-04 21:32:02',
			'chosen' => 1,
			'current' => 1,
			'mobile' => 'Lorem ipsum d',
			'dateupdated' => '2012-07-04 21:32:02',
			'name' => 'Lorem ipsum dolor sit amet',
			'last' => 'Lorem ipsum dolor sit amet',
			'idcard' => 1,
			'confirmedby' => 'Lorem ipsum dolor sit amet',
			'dateconfirmed' => '2012-07-04 21:32:02',
			'givenby' => 'Lorem ipsum dolor sit amet',
			'dategiven' => '2012-07-04 21:32:02'
		),
	);
}
