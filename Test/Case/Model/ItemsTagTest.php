<?php
/* ItemsTag Test cases generated on: 2012-03-10 17:16:06 : 1331396166*/
App::uses('ItemsTag', 'Model');

/**
 * ItemsTag Test Case
 *
 */
class ItemsTagTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.items_tag', 'app.item');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->ItemsTag = ClassRegistry::init('ItemsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemsTag);

		parent::tearDown();
	}

}
