<?php
App::uses('Raffle', 'Model');

/**
 * Raffle Test Case
 *
 */
class RaffleTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.raffle');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Raffle = ClassRegistry::init('Raffle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Raffle);

		parent::tearDown();
	}

}
