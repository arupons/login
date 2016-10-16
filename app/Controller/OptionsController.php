<?php
App::uses('AppController', 'Controller');
/**
 * Options Controller
 *
 * @property Option $Option
 * @property PaginatorComponent $Paginator
 */
class OptionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			$this->Option->recursive = 0;
			$this->set('options', $this->Paginator->paginate());
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			if (!$this->Option->exists($id)) {
				throw new NotFoundException(__('Invalid option'));
			}
			$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
			$this->set('option', $this->Option->find('first', $options));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			if ($this->request->is('post')) {
				$this->Option->create();
				if ($this->Option->save($this->request->data)) {
					$this->Session->setFlash(__('The option has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The option could not be saved. Please, try again.'));
				}
			}
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			if (!$this->Option->exists($id)) {
				throw new NotFoundException(__('Invalid option'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Option->save($this->request->data)) {
					$this->Session->setFlash(__('The option has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The option could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
				$this->request->data = $this->Option->find('first', $options);
			}
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action)){
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
			if (!$this->Option->exists()) {
				throw new NotFoundException(__('Invalid option'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Option->delete()) {
				$this->Session->setFlash(__('The option has been deleted.'));
			} else {
				$this->Session->setFlash(__('The option could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		$this->Option->id = $id;
	}
}
