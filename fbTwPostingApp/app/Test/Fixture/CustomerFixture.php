<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'mobile' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sex' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birthday' => array('type' => 'date', 'null' => true, 'default' => null),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'country' => array('type' => 'string', 'null' => false, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'fbid' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'twid' => array('type' => 'integer', 'null' => true, 'default' => null),
		'fbcounter' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'twcounter' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'datecreated' => array('type' => 'datetime', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
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
			'name' => 'Lorem ipsum dolor sit amet',
			'sex' => 'Lorem ipsum dolor sit ame',
			'birthday' => '2012-09-05',
			'email' => 'Lorem ipsum dolor sit amet',
			'country' => 'Lorem ipsum dolor sit amet',
			'fbid' => 'Lorem ipsum dolor sit amet',
			'twid' => 1,
			'fbcounter' => 1,
			'twcounter' => 1,
			'datecreated' => '2012-09-05 00:13:06'
		),
	);

}
