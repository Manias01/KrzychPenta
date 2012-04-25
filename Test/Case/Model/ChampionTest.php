<?php
/* Champion Test cases generated on: 2012-04-25 20:02:55 : 1335376975*/
App::uses('Champion', 'Model');

/**
 * Champion Test Case
 *
 */
class ChampionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.champion', 'app.mobafire', 'app.build', 'app.user', 'app.skill');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Champion = ClassRegistry::init('Champion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Champion);

		parent::tearDown();
	}

}
