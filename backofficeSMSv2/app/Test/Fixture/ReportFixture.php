<?php
/**
 * ReportFixture
 *
 */
class ReportFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'idmessage' => array('type' => 'integer', 'null' => false, 'key' => 'index'),
		'idraffle' => array('type' => 'integer', 'null' => false),
		'messageposteddate' => array('type' => 'datetime', 'null' => false),
		'mobile' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'idcard' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 150, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'receipt' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 150, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'prize' => array('type' => 'text', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mobile2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'posteddate' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idmessage' => array('column' => 'idmessage', 'unique' => 0)),
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
			'idmessage' => 1,
			'idraffle' => 1,
			'messageposteddate' => '2013-01-30 15:47:49',
			'mobile' => 'Lorem ipsum d',
			'idcard' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'receipt' => 'Lorem ipsum dolor sit amet',
			'prize' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'mobile2' => 'Lorem ipsum d',
			'city' => 'Lorem ipsum dolor sit amet',
			'posteddate' => '2013-01-30 15:47:49'
		),
	);
}
