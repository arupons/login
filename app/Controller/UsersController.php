<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}

	public function login() {
		$this->loadModel('Empresa');
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$empresa = $this->Empresa->find('first', array('conditions' => array('Empresa.id' => $this->Auth->user('empresa_id')), 'fields' => array('Empresa.nombre', 'Empresa.ruc', 'Empresa.url')));
				$whoami = $this->Auth->user('id');
				// Escribir en la sesión los datos de empresa bd y user una vez
				// que el usuario se ha logueado
				$this->Session->write('whoami', $this->Auth->user('id'));
				$this->Session->write('whatdoido', $this->Auth->user('rol_id'));
				$this->Session->write('empresa', $this->Auth->user('empresa_id'));
				$this->Session->write('institucion', $empresa['Empresa']['nombre']);
				$this->Session->write('ruc', $empresa['Empresa']['ruc']);
				$this->Session->write('cliente', $this->Auth->user('empresa_id'));
				$this->Session->write('url', $empresa['Empresa']['url']);
				if((int) $this->Auth->user('rol_id')===3)
					return $this->redirect(array('controller'=>'o','action'=>'seleccionarEmpresa'));
				else
					return $this->redirect($this->Auth->redirectUrl());
			}
			else
			{
				$this->Session->setFlash(
                __("<h4 style='color:#ff4500;'>Credenciales incorrectas. Intente de nuevo."),
                'default',
                array(),
                'auth'
            );
			}
		}
	}

	public function logout() {
		$this->Session->write('institucion', '');
		$this->Session->write('whoami', '');
		$this->Session->write('whatdoido','');
		$this->Session->write('empresa', '');
		$this->Session->write('ruc', '');
		$this->Session->write('cliente', '');
		$this->Session->write('url', '');
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index($criterio = null) {
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if(isset($this->request->data['buscar']['criterio']))
			{	
				return $this->redirect(array('action' => 'index', $this->request->data['buscar']['criterio']));
			}
			$this->loadModel('Empresa');
			$this->loadModel('Rol');
			$this->User->recursive = 0;
			$paginate = array('conditions' => array('User.username LIKE' => '%' . $criterio . '%'));
			$this->Paginator->settings = $paginate;
			$this->set('users', $this->Paginator->paginate());
			$empresas = $this->User->Empresa->find('all',array('fields' => array('Empresa.id' ,'Empresa.nombre')));
			$this->set('empresas', $empresas);
			$this->set('criterio', $criterio);
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
		$rols = $this->User->Rol->find('list');
		$empresas = $this->User->Empresa->find('list');
		$this->set(compact('rols', 'empresas'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if (!$this->User->exists($id)) 
			{
				throw new NotFoundException(__('Usuario no existe'));
			}
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
		$rols = $this->User->Rol->find('list');
		$empresas = $this->User->Empresa->find('list');
		$this->set(compact('rols', 'empresas'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if ($this->request->is('post')) 
			{
				if (!($this->data['User']['password'] === $this->data['User']['password2'])) 
				{
				    $this->Session->setFlash(__("<h4 style='color:red;'>Las contraseñas no coinciden.", true));
				    return;
				}
				//$this->data['User']['password'] = $this->Auth->password($this->data['User']['password1']);
				$this->User->create();
				if ($this->User->save($this->request->data)) 
				{
					$this->Session->setFlash(__('<h4>El usuario se ha guardado con exito.</h4>'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<h4 style="color:red;">El usuario no se ha podido guardar, porfavor intente de nuevo.</h4>'));
				}
			}
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
		$rols = $this->User->Rol->find('list');
		$empresas = $this->User->Empresa->find('list');
		$this->set(compact('rols', 'empresas'));
	}
	public function addUsers($emp_id = null) 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			$this->loadModel('Empleado');
			if ($this->request->is('post')) 
			{
				if (!($this->data['User']['password'] === $this->data['User']['password2'])) 
				{
				    $this->Session->setFlash(__("<h4 style='color:red;'>Las contraseñas no coinciden.", true));
				    return;
				}
				//$this->data['User']['password'] = $this->Auth->password($this->data['User']['password1']);
				$this->User->create();
				if ($this->User->save($this->request->data)) 
				{
					$this->Empleado->create();
					$this->Empleado->id = $this->User->id;
					$this->Session->setFlash(__('<h4>El usuario se ha guardado con exito.</h4>'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<h4 style="color:red;">El usuario no se ha podido guardar, porfavor intente de nuevo.</h4>'));
				}
			}
		}
		else
		{
			$this->Session->setFlash(__('<h4 style="color:red;"></h4>'));
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
			$optionsRols = array('fields'=>array('id', 'name'));
		$rols = $this->User->Rol->find('list', $optionsRols);
		$empresas = $this->User->Empresa->find('list');
		$this->set(compact('rols', 'empresas', 'emp_id'));
	}

/**
 * add from empresa method
 *
 * @return void
 */
	public function addfemp($emp = null) 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if ($this->request->is('post')) 
			{
				if (!($this->data['User']['password'] === $this->data['User']['password2'])) 
				{
				    $this->Session->setFlash(__("<h4 style='color:red;'>Las contraseñas no coinciden.", true));
				    return;
				}
				//$this->data['User']['password'] = $this->Auth->password($this->data['User']['password1']);
				$this->User->create();
				if ($this->User->save($this->request->data)) 
				{
					$this->Session->setFlash(__('<h4>El usuario se ha guardado con exito.</h4>'));
					return $this->redirect(array('controller' => 'Empresas','action' => 'view', $emp));
				} else {
					$this->Session->setFlash(__('<h4 style="color:red;">El usuario no se ha podido guardar, porfavor intente de nuevo.</h4>'));
				}
			}
			$rols = $this->User->Rol->find('list');
			$empresas = $this->User->Empresa->find('list');
			$this->set(compact('rols', 'empresas', 'emp'));
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Usuario no existe'));
			}
			if ($this->request->is(array('post', 'put'))) {
				// Passwords do not match
				if (!($this->data['User']['password'] === $this->data['User']['password2'])) {
				    $this->Session->setFlash(__("<h4 style='color:red;'>Las contraseñas no coinciden.</h4>", true));               
				    return;
				}
				// If the password is left blank,
				// just reuse the existing password
				if (strlen($this->data['User']['password']) == 0) {
				    $User = $this->User->read(null, $id);
				    $this->data['User']['password'] = $User['User']['password'];
				} else {
				    $this->data['User']['password'] = $this->Auth->password($this->data['User']['password2']);
				}
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('<h4>Usuari guardado correctamente</h4>'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<h4 style="color:red;">El usuario no se ha podido guardar, porfavor intente de nuevo.</h4>'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
			$rols = $this->User->Rol->find('list');
			$empresas = $this->User->Empresa->find('list');
			$this->set(compact('rols', 'empresas'));
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
	}

	public function editFromEmp($id = null) 
	{
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Usuario no existe'));
			}
			if ($this->request->is(array('post', 'put'))) {
				// Passwords do not match
				if (!($this->data['User']['password'] === $this->data['User']['password2'])) {
				    $this->Session->setFlash(__("<h4 style='color:red;'>Las contraseñas no coinciden.</h4>", true));               
				    return;
				}
				// If the password is left blank,
				// just reuse the existing password
				if (strlen($this->data['User']['password']) == 0) {
				    $User = $this->User->read(null, $id);
				    $this->data['User']['password'] = $User['User']['password'];
				} else {
				    $this->data['User']['password'] = $this->Auth->password($this->data['User']['password2']);
				}
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('<h4>Usuario guardado correctamente</h4>'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<h4 style="color:red;">El usuario no se ha podido guardar, porfavor intente de nuevo.</h4>'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$users = $this->User->find('first', $options);
				$this->request->data = $users;
			}
			$rols = $this->User->Rol->find('list');
			$options = array('conditions' => array('id' => $users['User']['empresa_id']));
			$empresas = $this->User->Empresa->find('first', $options);
			$this->set(compact('rols', 'empresas'));
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
	}

	function beforeSave4User() 
    {  
	        if (!empty($this->data['User']['passwd'])) 
	        { 
	            $this->data['User']['password'] = $this->Auth->password($this->data['User']['passwd']);          
	        }
    	return true;        
 	}
	public function passwd($id = null) {
		$id = $this->Session->read('whoami');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario no existe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->beforeSave4User();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('<h4>El usuario se ha editado satisfactoriamente.</h4>'));
				return $this->redirect(array('controller' => 'Pages','action' => 'display'));
			} else {
				$this->Session->setFlash(__('Los cambios no se han podido guardar, porfavor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$rols = $this->User->Rol->find('list');
		$empresas = $this->User->Empresa->find('list');
		$this->set(compact('rols', 'empresas'));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action))
		{
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Usuario no existe'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->User->delete()) {
				$this->Session->setFlash(__('El usuario ha sido eliminado correctamente'));
			} else {
				$this->Session->setFlash(__('El usuario no ha sido eliminado por favor intente nuevamente'));
			}
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			return $this->redirect(array('controller' => 'Pages','action' => 'display'));
		}
	}
}
