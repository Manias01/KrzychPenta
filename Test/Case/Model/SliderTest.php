<?php
/* Slider Test cases generated on: 2012-04-10 19:47:10 : 1334080030*/
App::uses('Slider', 'Model');

/**
 * Slider Test Case
 *
 */
class SliderTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.slider');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Slider = ClassRegistry::init('Slider');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Slider);

		parent::tearDown();
	}

}
