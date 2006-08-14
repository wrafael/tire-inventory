<?php
class Session {
	
/************
	Constructor
/************/
	function Session() {
		session_name('SquatPadCookie'); 
		@session_start();
		header("Cache-control: private");
	}
	
/************
	Set a Session Variable
************/	
	function set($name, $value) {
		$_SESSION[$name] = $value;
	}
	
/************
	Gets a Session Variable
************/	
	function get($name) {
		if (isset($_SESSION[$name])) return $_SESSION[$name];
		else return false;
	}
	
/************
	Unsets a Session Variable
************/		
	function del($name)  {
		unset($_SESSION[$name]);
	}
	
/************
	Destroys the Session
************/		
	function destroy() {
		$_SESSION = array();
		
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	if(session_destroy()) return true;
		else return false;
	}

/************
	Check for Session Expiration
************/		
	function checkExpire($lastLogin,$sessionExp){
		$time = time();
		if (($lastLogin+$sessionExp) < $time){
			$this->destroy();
			return true;
		}
		return false;
	}
}
?>