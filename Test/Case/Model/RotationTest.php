<?php
/* Rotation Test cases generated on: 2012-04-14 17:49:47 : 1334418587*/
App::uses('Rotation', 'Model');

/**
 * Rotation Test Case
 *
 */
class RotationTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.rotation', 'app.champion', 'app.skill');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Rotation = ClassRegistry::init('Rotation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rotation);

		parent::tearDown();
	}

}
