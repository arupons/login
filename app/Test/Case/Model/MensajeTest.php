<?php
App::uses('Mensaje', 'Model');

/**
 * Mensaje Test Case
 */
class MensajeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mensaje',
		'app.empresa',
		'app.user',
		'app.rol',
		'app.telefono',
		'app.tipo_empresa',
		'app.empresa_tipo_empresa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mensaje = ClassRegistry::init('Mensaje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mensaje);

		parent::tearDown();
	}

}
