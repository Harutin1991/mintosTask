<?php
namespace libraries;

Class Request{
    public function isPost(){//ispost
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }
        else{
            return false;
        }
    }
    public function getPost($key = ''){
	  if($key != '') {
		return (isset($_POST[$key])) ? $_POST[$key] :  NULL;
	  }
       return $_POST;
    }
    
    public function isValidRssUrl($url) {
	  
    }
}

