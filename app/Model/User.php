<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Rol $Rol
 * @property Empresa $Empresa
 */
class User extends AppModel {
/**
 * Actuar Como
 *
 * @var Funcion del modelo
 */
	//public $actsAs = array('Acl' => array('type' => 'requester'));

	function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    $data = $this->data;
	    if (empty($this->data)) {
	        $data = $this->read();
	    }
	    if (!$data['User']['rol_id']) {
	        return null;
	    } else {
	        return array('Rol' => array('id' => $data['User']['rol_id']));
	    }
	}
	/*public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['rol_id'])) {
            $rolId = $this->data['User']['rol_id'];
        } else {
            $rolId = $this->field('rol_id');
        }
        if (!$rolId) {
            return null;
        }
        return array('Rol' => array('id' => $rolId));
    }*/
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no puede ir vacio',
				'allowEmpty' => false,
			),
			'Unique' => array(
				'rule' => 'isUnique',
        		'message' => 'Este nombre de usuario ya existe.'
    		),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no puede ir vacio',
				'allowEmpty' => false,
			),
		),
		'password2' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Este campo no puede ir vacio',
				//'allowEmpty' => false,
				'required' => false,
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Rol' => array(
			'className' => 'Rol',
			'foreignKey' => 'rol_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Empleado' => array(
			'className' => 'Empleado',
			'foreignKey' => 'user_id',
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

	public function beforeSave($options = array()) {
				if (isset($this->data[$this->alias]['password'])) {
						$passwordHasher = new SimplePasswordHasher();
						$this->data[$this->alias]['password'] = $passwordHasher->hash(
								$this->data[$this->alias]['password']
						);
				}
				return true;
		}
}
