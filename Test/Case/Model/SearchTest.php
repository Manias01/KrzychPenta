<?php
/* Search Test cases generated on: 2012-04-25 21:19:43 : 1335381583*/
App::uses('Search', 'Model');

/**
 * Search Test Case
 *
 */
class SearchTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.search');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Search = ClassRegistry::init('Search');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Search);

		parent::tearDown();
	}

}
