<?php
/* Ad Test cases generated on: 2012-05-26 19:20:45 : 1338052845*/
App::uses('Ad', 'Model');

/**
 * Ad Test Case
 *
 */
class AdTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.ad');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Ad = ClassRegistry::init('Ad');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ad);

		parent::tearDown();
	}

}
