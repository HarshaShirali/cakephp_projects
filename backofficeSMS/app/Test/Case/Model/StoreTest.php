<?php
App::uses('Store', 'Model');

/**
 * Store Test Case
 *
 */
class StoreTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.store');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Store = ClassRegistry::init('Store');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Store);

		parent::tearDown();
	}

}
