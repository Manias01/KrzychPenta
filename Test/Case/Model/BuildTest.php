<?php
/* Build Test cases generated on: 2012-03-24 12:39:30 : 1332589170*/
App::uses('Build', 'Model');

/**
 * Build Test Case
 *
 */
class BuildTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.build', 'app.champion', 'app.skill', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Build = ClassRegistry::init('Build');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Build);

		parent::tearDown();
	}

}
