<?php
App::uses('AppController', 'Controller');
/**
 * Permisos Controller
 *
 * @property Permiso $Permiso
 * @property PaginatorComponent $Paginator
 */
class PermisosController extends AppController {

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
		$this->loadModel('Grupo');
		$this->loadModel('Menu');
		$this->Permiso->recursive = 0;
		$grupos = $this->Grupo->find('all');
		
			$optionsPermisos = 
				array('conditions'=>
					array(
						'OR'=>
							array(
								array(
									'foreign_key'=>$this->Session->read('whatdoido'),
									'model'=>'Rol'), 
								array(
									'foreign_key'=>$this->Session->read('whoami'),
									'model'=>'User')
								)
						)
					);
		$permisos = $this->Permiso->find('all', $optionsPermisos);
		$acum = '<ul class="nav nav-list">';
		$acum .= '<li class="nav-header">Men&uacute;</li>';
		foreach ($grupos as $grupo) {
				$optionsMenus = array('conditions'=>array('Menu.grupo_id'=>$grupo['Grupo']['id'], 'Menu.mostrar'=>1));
			$menus = $this->Menu->find('all', $optionsMenus);//correcto
			$acum .= '<li class="nav-header">'.$grupo['Grupo']['nombre'].'</li>';
			foreach ($menus as $menu) {
				foreach ($permisos as $permiso) {
					//echo $permiso['Permiso']['menu_id'].' - ';
					if($permiso['Permiso']['menu_id']==$menu['Menu']['id'] && $permiso['Permiso']['valor']==1)
					{
						$label = $menu['Menu']['alias']=='Listado' ? $menu['ParentMenu']['alias'] : $menu['Menu']['alias'] ;
						$acum .= '<li>';
						$acum .= 	'<a href="/'.$this->Session->read('url').'/'.$menu['ParentMenu']['nombre'].'/'.$menu['Menu']['nombre'].'">
										<i class="icon-orange icon-random"></i> '.$label.
								  	'</a>'; 
						$acum .= '</li>';
						//echo $menu['ParentMenu']['alias'].'/'.$menu['Menu']['alias'].' - '.$menu['Menu']['parent_id'].' - ';
						echo $grupo['Grupo']['nombre'].'/'.$menu['Menu']['alias'].' - '.$menu['Menu']['parent_id'].' - ';
						//array_push($acum, $menu['Menu']['nombre']);
					}
				}
			}
		}
			echo($acum);die;

		//$parent = $this->Permiso->Menu->getParentNode(12);

		//var_dump($parent);
		//$log = $this->Permiso->getDataSource()->getLog(false, false);
		//debug($log);die;
		$this->set('permisos', $this->Paginator->paginate());
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
			if (!$this->Permiso->exists($id)) {
				throw new NotFoundException(__('Invalid permiso'));
			}
			$options = array('conditions' => array('Permiso.' . $this->Permiso->primaryKey => $id));
			$this->set('permiso', $this->Permiso->find('first', $options));
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
				$this->Permiso->create();
				//debug($this->request->data);die;
				if ($this->Permiso->save($this->request->data)) {
					$this->Session->setFlash(__('The permiso has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The permiso could not be saved. Please, try again.'));
				}
			}
			$menus = $this->Permiso->Menu->find('list');
			$this->set(compact('menus'));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}
	public function addToUser($user_id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			$this->loadModel('User');
			$this->loadModel('Menu');
			if ($this->request->is('post')) {
				$this->Permiso->create();
				//debug($this->request->data);die;
				if ($this->Permiso->saveAll($this->request->data['Permiso'])) {
					$this->Session->setFlash(__('Los permisos se han asignado'));
					return $this->redirect(array('controller'=>'users','action' => 'index'));
				} else {
					$this->Session->setFlash(__('Error al guardar intente de nuevo.'));
				}
			}

				$optionsRol = array('conditions'=>array('id'=>$user_id), 'fields'=>'rol_id');
			$rol_id = $this->User->find('list', $optionsRol);
				$optionsPadres = array('conditions'=>array('Menu.parent_id'=>1));
			$padres = $this->Menu->find('all', $optionsPadres);
				$optionsMenus = array('conditions'=>array('Menu.parent_id >'=>0));
			$menus = $this->Menu->find('all', $optionsMenus);
				$optionsPermisos = array('conditions'=>
					array(
						'OR'=>
							array(
								array(
									'foreign_key'=>$rol_id,
									'model'=>'Rol'), 
								array(
									'foreign_key'=>$user_id,
									'model'=>'User')
								)
						),'fields'=>('menu_id'));
			$permisos = $this->Permiso->find('list', $optionsPermisos);
				$optionsPermisos = array('conditions'=>array('foreign_key'=>$user_id, 'model'=>'User'),
										 'fields'=>array('menu_id', 'id', 'valor'));
			$permisos2 = $this->Permiso->find('all', $optionsPermisos);

			//debug($permisos);die;

			$this->set('permisos', $permisos2);
			$this->set(compact('user_id'));
			$leArbol = $this->drawArbol($padres, $menus, $permisos);
			$this->set(compact('leArbol'));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}
	public function addToRol($rol_id = null) {
		if($this->isAuthorized($this->params['controller'],$this->action)){
			$this->loadModel('Rol');
			$this->loadModel('Menu');
			if ($this->request->is('post')) {
				$this->Permiso->create();
				//debug($this->request->data);die;
				if ($this->Permiso->saveAll($this->request->data['Permiso'])) {
					$this->Session->setFlash(__('Los permisos se han asignado'));
					return $this->redirect(array('controller'=>'rols','action' => 'index'));
				} else {
					$this->Session->setFlash(__('Error al guardar intente de nuevo.'));
				}
			}
				$optionsPadres = array('conditions'=>array('Menu.parent_id'=>1));
			$padres = $this->Menu->find('all', $optionsPadres);
				$optionsMenus = array('conditions'=>array('Menu.parent_id >'=>0));
			$menus = $this->Menu->find('all', $optionsMenus);
				$optionsPermisos = array('conditions'=>array('foreign_key'=>$rol_id, 'model'=>'Rol'), 'fields'=>('menu_id'));
			$permisos = $this->Permiso->find('list', $optionsPermisos);
				$optionsPermisos = array('conditions'=>array('foreign_key'=>$rol_id, 'model'=>'Rol'),
										 'fields'=>array('menu_id', 'id', 'valor'));
			$permisos2 = $this->Permiso->find('all', $optionsPermisos);
			$this->set('permisos', $permisos2);
			$this->set(compact('rol_id'));
			$leArbol = $this->drawArbol($padres, $menus,$permisos);
			$this->set(compact('leArbol'));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}
	public function drawArbol($modulos=array(),$hijos=array(), $selected = array()){
		$arbol="";
		$arbol.='<div class="tree well">';
		$arbol.='<ul>';
		$arbol.='<li>';
		$arbol.='<i class="icon-minus-sign"></i><span><i class="icon-leaf"></i> Permisos</span>';
		$arbol.='<ul>';
		foreach ($modulos as $padre):
			$arbol.='<li id='.$padre['Menu']['id'].'>';
			if(in_array($padre['Menu']['id'], $selected)){///$this->Session->read('url')/empresas/delete/1
				$arbol.='<i class="icon-minus-sign"></i>
					<span class="label label-success"> '
					.$padre['Menu']['alias'].' <input type="checkbox"  id='
					.$padre['Menu']['id'].' checked ></input></span>';
			}else{
				$arbol.='<i class="icon-minus-sign"></i><span class="label"> '.$padre['Menu']['alias'].' <input type="checkbox"  id='.$padre['Menu']['id'].' ></input></span>';
			}
			$arbol.=$this->nested($hijos, $padre['Menu']['id'],$selected);
			$arbol.='</li>';
		endforeach;
		$arbol.='</ul>';
		$arbol.='</li>';
		$arbol.='</ul></div>';
		return $arbol;
	}
	public function nested($rows = array(), $parent_id = 0, $selected = array()){
			$html = "";
			if(!empty($rows)){
				$html.="<ul>";
				foreach ($rows as $row) {
					if($row['Menu']['parent_id']==$parent_id){
						$html.="<li id=".$row['Menu']['id'].">";
						if(in_array($row['Menu']['id'], $selected)){
							$html.='<i class="icon-minus-sign"></i><span class="label label-success"> ' . $row['Menu']['alias'] . ' <input type="checkbox"  id=' . $row['Menu']['id'] . ' checked ></input></span>';
						}else{
							$html.='<i class="icon-plus-sign"></i><span class="label"> ' . $row['Menu']['alias'] . ' <input type="checkbox"  id=' . $row['Menu']['id'] . ' ></input></span>';
						}
						$html.=$this->nested($rows, $row["Menu"]["id"]);
						$html.="</li>";
					}
				}
				$html.="</ul>";
			}
			return $html;
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
			if (!$this->Permiso->exists($id)) {
				throw new NotFoundException(__('Invalid permiso'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Permiso->save($this->request->data)) {
					$this->Session->setFlash(__('The permiso has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The permiso could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Permiso.' . $this->Permiso->primaryKey => $id));
				$this->request->data = $this->Permiso->find('first', $options);
			}
			$menus = $this->Permiso->Menu->find('list');
			$this->set(compact('menus'));
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
			$this->Permiso->id = $id;
			if (!$this->Permiso->exists()) {
				throw new NotFoundException(__('Invalid permiso'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Permiso->delete()) {
				$this->Session->setFlash(__('The permiso has been deleted.'));
			} else {
				$this->Session->setFlash(__('The permiso could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		} else {return $this->redirect(array('controller' => 'Pages','action' => 'display')); }
	}


	public function pruebas($controller = null, $action = null){
		$this->autoRender = false;

		
		var_dump($controller);var_dump($action);

		$this->loadModel('User');
		$this->loadModel('Rol');
		$this->loadModel('Permiso');
		$this->loadModel('Menu');

		$user_id = $this->Session->read('whoami');
		$rol_id = $this->Session->read('whatdoido');

			$optionsMenuController = array('conditions' => array('Menu.nombre'=>$controller));
		$menuController = $this->Menu->find('first', $optionsMenuController);

			$optionsMenuAction = array('conditions' => array('Menu.nombre'=>$action, 'Menu.parent_id'=>$menuController['Menu']['id']));
		$menuAction = $this->Menu->find('first', $optionsMenuAction);

			$optionsPermisoCU = array('conditions'=>array('menu_id'=>$menuController['Menu']['id'], 'model'=>'User', 'foreign_key'=>$user_id));
		$permisoCU = $this->Permiso->find('first', $optionsPermisoCU);

			$optionsPermisoAU = array('conditions'=>array('menu_id'=>$menuAction['Menu']['id'], 'model'=>'User', 'foreign_key'=>$user_id));
		$permisoAU = $this->Permiso->find('first', $optionsPermisoAU);

			$optionsPermisoCR = array('conditions'=>array('menu_id'=>$menuController['Menu']['id'], 'model'=>'Rol', 'foreign_key'=>$rol_id));
		$permisoCR = $this->Permiso->find('first', $optionsPermisoCR);

			$optionsPermisoAR = array('conditions'=>array('menu_id'=>$menuAction['Menu']['id'], 'model'=>'Rol', 'foreign_key'=>$rol_id));
		$permisoAR = $this->Permiso->find('first', $optionsPermisoAR);


		if($permisoAU['Permiso']['valor'] == 1 && $permisoCU['Permiso']['valor'] == 1)
			return true;
		if($permisoAR['Permiso']['valor'] == 1 && $permisoCR['Permiso']['valor'] == 1)
			return true;
		return false;

		debug($menuAction);
		debug($menuController);
		debug($permisoCU);
		debug($permisoAU);
		die;
	}

}


