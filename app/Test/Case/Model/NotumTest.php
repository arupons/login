<?php
App::uses('Notum', 'Model');

/**
 * Notum Test Case
 */
class NotumTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notum = ClassRegistry::init('Notum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notum);

		parent::tearDown();
	}

}
