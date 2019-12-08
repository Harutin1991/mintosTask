<?php
namespace system;

class Session{

    public static function init(){
        session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        if(isset($key))
            return  @$_SESSION[$key];
    }
    
    public static function remove($key){
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    public static function destroy(){
        session_destroy();
    }
    
    public static function getFleshMessage($key) {
	  if(isset($key)) {
		$message = $_SESSION[$key];
		unset($_SESSION[$key]);
		return  $message;
	  }
    }
    
    public function setValidationErrors($errors) {
	  foreach ($errors as $key => $value) {
		$_SESSION[$key] = $value;
	  }
    }
}