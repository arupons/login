<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * 
 * Modificated acording to http://bakery.cakephp.org/articles/doze/2010/03/12/use-multiple-databases-in-one-app-based-on-requested-url
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
    public $components = array(
		'Session',
		'RequestHandler',
		'Auth'
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('display', 'login', 'logout');
		$this->Auth->loginError = "Credenciales Incorrectas";    
   		$this->Auth->authError = "<h4 style='color:#ff0000;'>Para acceder a su informacion debe iniciar sesion.</h2>";

		 //Configure AuthComponent
		    $this->Auth->authorize = array(
		        'Controller',
		        'Actions' => array('actionPath' => 'Controller')
		    );
		    $this->Auth->authenticate = array(
		        'Form' => array(
		            'fields' => array(
		                'username' => 'username',
		                'password' => 'password'
		            )
		        )
		    );
		    $this->Auth->loginAction = array(
		        'controller' => 'users',
		        'action' => 'login',
		        'admin' => false,
		        'plugin' => false
		    );
		    $this->Auth->logoutRedirect = array(
		        'controller' => 'pages',
		        'action' => 'display',
		        'admin' => false,
		        'plugin' => false
		    );
		    $this->Auth->loginRedirect = array(
		        'controller' => 'pages',
		        'action' => 'display',
		        'admin' => false,
		        'plugin' => false
		    );

   		 $this->RequestHandler->setContent( 'json', 'application/json' );

   		if(in_array($this->params['controller'],array('rest_empresas'))){
	        // For RESTful web service requests, we check the name of our contoller
	        $this->Auth->allow();
	        // this line should always be there to ensure that all rest calls are secure
	        /* $this->Security->requireSecure(); */
	        $this->Security->unlockedActions = array('view');
	         
	    }else{
	        // setup out Auth
	        $this->Auth->allow();         
	    }

	}

	public function isAuthorized($controller = null, $action = null) {
		if($this->Auth->loggedIn())
		{
			if($this->Session->read('whatdoido')==1)
				return true;
			if(!isset($controller)&&!isset($action))
				return false;

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

			if(isset($permisoAU['Permiso'])&&isset($permisoCU['Permiso']))
				if($permisoAU['Permiso']['valor'] == 1 && $permisoCU['Permiso']['valor'] == 1)
					return true;
			if(isset($permisoAR['Permiso'])&&isset($permisoCR['Permiso']))
				if($permisoAR['Permiso']['valor'] == 1 && $permisoCR['Permiso']['valor'] == 1)
					return true;
			return false;
 		}
	    return false;
	}
	
	public function beforeRender() {
		$this->set('yo',(int) $this->Session->read('whatdoido'));
		$this->set('leMenu', $this->getMenu());
		$this->set('auth', $this->Auth);
		 if($this->action==='index') {
            $keymap = "<script>
                    Mousetrap.bind([ 'ctrl+i'], function(e) {
                      window.location = '//" . $this->request->controller . "/add';
                  		return false;
                    });
                  </script>";
            $this->set('keymap', $keymap);
         }
	}

	public function getMenu() {
		$this->loadModel('Permiso');
		//$this->Accountcus->setDatabase('header');
		$this->loadModel('Grupo');
		$this->loadModel('Menu');
		$this->loadModel('Empresa');
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
		$acum = '<ul class="nav nav-pills nav-stacked">';
		$acum .= '<li class="nav-header">Men&uacute;</li>';
		foreach ($grupos as $grupo) {
				$optionsMenus = array('conditions'=>array('Menu.grupo_id'=>$grupo['Grupo']['id'], 'Menu.mostrar'=>1));
			$menus = $this->Menu->find('all', $optionsMenus);//correcto
			$acum .= '<li class="nav-header">'.$grupo['Grupo']['nombre'].'</li>';
			foreach ($menus as $menu) {
				foreach ($permisos as $permiso) {
					if(($permiso['Permiso']['menu_id']==$menu['Menu']['id'] && $permiso['Permiso']['valor']==1)||$this->Session->read('whatdoido')==1)
					{
						if($menu['Menu']['isTree']==1)
						{
							$label = ($menu['Menu']['alias']=='Listado' || $menu['Menu']['alias']=='Principal')? $menu['ParentMenu']['alias'] : $menu['Menu']['alias'] ;
							$acum .= '<li class="active btn-group">';
							$acum .= 		'<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="/'.$this->Session->read('url').'/'.$menu['ParentMenu']['nombre'].'/'.$menu['Menu']['nombre'].'">
												<i class="icon-white icon-'.$menu['Menu']['icon'].'"></i> '.$label.' <i class="icon-white icon-chevron-down"></i>
									  		</a>'; 
							$acum .= 		'<ul class="dropdown-menu">';
							$optionsSubMenus = array('conditions'=>array('Menu.grupo_id'=>$grupo['Grupo']['id'], 'Menu.parent_id'=>$menu['Menu']['id']));
								$subMenus = $this->Menu->find('all', $optionsSubMenus);//correcto
							foreach ($subMenus as $submenu) {
								$sublabel = ($submenu['Menu']['alias']=='Listado' || $submenu['Menu']['alias']=='Principal')? $submenu['ParentMenu']['alias'] : $submenu['Menu']['alias'] ;
								if($submenu['Menu']['parent_id']==$menu['Menu']['id'])
								{
									$acum .=	'<li><a href="/'.$this->Session->read('url').'/'.$submenu['ParentMenu']['nombre'].$submenu['Menu']['nombre'].'">
													<i class="icon-orange icon-'.$submenu['Menu']['icon'].'"></i> '.$sublabel.
											  	'</a></li>'; 
								}
							}
							$acum .= 		'</ul>';
							$acum .= '</li>';
						}else
						{
							$label = ($menu['Menu']['alias']=='Listado' || $menu['Menu']['alias']=='Principal')? $menu['ParentMenu']['alias'] : $menu['Menu']['alias'] ;
							$acum .= '<li class="active">';
							$acum .= 	'<a href="/'.$this->Session->read('url').'/'.$menu['ParentMenu']['nombre'].'/'.$menu['Menu']['nombre'].'">
											<i class="icon-orange icon-'.$menu['Menu']['icon'].'"></i> '.$label.
									  	'</a>'; 
							$acum .= '</li>';
						}
					}
				}
			}
		}
		//debug($acum);
		return $acum;
	}
}
