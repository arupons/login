<?php
App::uses('TipoSoporte', 'Model');

/**
 * TipoSoporte Test Case
 */
class TipoSoporteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipo_soporte'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TipoSoporte = ClassRegistry::init('TipoSoporte');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoSoporte);

		parent::tearDown();
	}

}
