<?php 
class AccessComponent extends Object{ 
    var $components = array('Acl', 'Auth'); 
    var $user; 
  
    function startup(){ 
        $this->user = $this->Auth->user(); 
    } 

    function check($aco, $action='*'){ 
        if(!empty($this->user) && $this->Acl->check('User::'.$this->user['User']['id'], $aco, $action)){ 
            return true; 
        } else { 
            return false; 
        } 
    }
} 
?>