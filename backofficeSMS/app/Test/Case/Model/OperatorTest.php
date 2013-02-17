<?php
App::uses('Operator', 'Model');

/**
 * Operator Test Case
 *
 */
class OperatorTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.operator');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Operator = ClassRegistry::init('Operator');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Operator);

		parent::tearDown();
	}

}
