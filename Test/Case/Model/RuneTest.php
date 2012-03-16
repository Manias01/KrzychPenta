<?php
/* Rune Test cases generated on: 2012-03-10 17:48:08 : 1331398088*/
App::uses('Rune', 'Model');

/**
 * Rune Test Case
 *
 */
class RuneTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.rune');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Rune = ClassRegistry::init('Rune');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rune);

		parent::tearDown();
	}

}
