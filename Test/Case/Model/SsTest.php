<?php
/* Ss Test cases generated on: 2012-03-11 20:15:38 : 1331493338*/
App::uses('Ss', 'Model');

/**
 * Ss Test Case
 *
 */
class SsTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.ss');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Ss = ClassRegistry::init('Ss');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ss);

		parent::tearDown();
	}

}
