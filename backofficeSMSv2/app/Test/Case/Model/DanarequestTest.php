<?php
App::uses('Danarequest', 'Model');

/**
 * Danarequest Test Case
 *
 */
class DanarequestTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.danarequest');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Danarequest = ClassRegistry::init('Danarequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Danarequest);

		parent::tearDown();
	}

}
