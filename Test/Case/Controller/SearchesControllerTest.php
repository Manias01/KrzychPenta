<?php
/* Searches Test cases generated on: 2012-04-25 21:19:10 : 1335381550*/
App::uses('SearchesController', 'Controller');

/**
 * TestSearchesController *
 */
class TestSearchesController extends SearchesController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * SearchesController Test Case
 *
 */
class SearchesControllerTestCase extends CakeTestCase {
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

		$this->Searches = new TestSearchesController();
		$this->Searches->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Searches);

		parent::tearDown();
	}

}
