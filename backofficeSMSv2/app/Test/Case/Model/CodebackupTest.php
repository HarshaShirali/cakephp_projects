<?php
App::uses('Codebackup', 'Model');

/**
 * Codebackup Test Case
 *
 */
class CodebackupTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.codebackup');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Codebackup = ClassRegistry::init('Codebackup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Codebackup);

		parent::tearDown();
	}

}
