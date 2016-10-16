<?php
App::uses('AppController', 'Controller');
/**
 * OptionDetails Controller
 *
 * @property OptionDetail $OptionDetail
 * @property PaginatorComponent $Paginator
 */
class OptionDetailsController extends AppController {

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
			$this->OptionDetail->recursive = 0;
			$this->set('optionDetails', $this->Paginator->paginate());
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
			if (!$this->OptionDetail->exists($id)) {
				throw new NotFoundException(__('Invalid option detail'));
			}
			$options = array('conditions' => array('OptionDetail.' . $this->OptionDetail->primaryKey => $id));
			$this->set('optionDetail', $this->OptionDetail->find('first', $options));
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
				$this->OptionDetail->create();
				if ($this->OptionDetail->save($this->request->data)) {
					$this->Session->setFlash(__('The option detail has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The option detail could not be saved. Please, try again.'));
				}
			}
			$options = $this->OptionDetail->Option->find('list');
			$this->set(compact('options'));
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
			if (!$this->OptionDetail->exists($id)) {
				throw new NotFoundException(__('Invalid option detail'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->OptionDetail->save($this->request->data)) {
					$this->Session->setFlash(__('The option detail has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The option detail could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('OptionDetail.' . $this->OptionDetail->primaryKey => $id));
				$this->request->data = $this->OptionDetail->find('first', $options);
			}
			$options = $this->OptionDetail->Option->find('list');
			$this->set(compact('options'));
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
			$this->OptionDetail->id = $id;
			if (!$this->OptionDetail->exists()) {
				throw new NotFoundException(__('Invalid option detail'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->OptionDetail->delete()) {
				$this->Session->setFlash(__('The option detail has been deleted.'));
			} else {
				$this->Session->setFlash(__('The option detail could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}
}
