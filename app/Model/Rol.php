<?php
App::uses('AppModel', 'Model');
/**
 * Rol Model
 *
 * @property User $User
 */
class Rol extends AppModel {
/**
 * Actuar Como
 *
 * @var Funcion del modelo
 */
	//public $actsAs = array('Acl' => array('type' => 'requester'));

	public function parentNode() {
        return null;
    }
    
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank')
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'rol_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
