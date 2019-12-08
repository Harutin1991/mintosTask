<?php
/**
* Class Controller
* Root class controller 
*  
*/
namespace system;

use system\Session;

class Controller {

    function __construct() {
	  Session::init();
        $this->view = new View();
    }

}
