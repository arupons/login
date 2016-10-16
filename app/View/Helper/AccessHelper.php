<? 
class AccessHelper extends AppHelper{ 
    var $helpers = array("Session"); 
  
    function isLoggedin(){ 
        App::import('Component', 'Auth'); 
        $auth = new AuthComponent(); 
        $auth->Session = $this->Session;
        debug($auth) ;exit(0);
        $user = $auth->user(); 
        return !empty($user); 
    } 
}
?>