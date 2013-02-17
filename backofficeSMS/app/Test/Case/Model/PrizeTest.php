<?php
App::uses('Prize', 'Model');

/**
 * Prize Test Case
 *
 */
class PrizeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.prize');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Prize = ClassRegistry::init('Prize');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Prize);

		parent::tearDown();
	}

}
