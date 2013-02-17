<?php
App::uses('Mobile', 'Model');

/**
 * Mobile Test Case
 *
 */
class MobileTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.mobile');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mobile = ClassRegistry::init('Mobile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mobile);

		parent::tearDown();
	}

}
