<?php
namespace system;

use system\Session;

class Controller {

    function __construct() {
	  Session::init();
        $this->view = new View();
    }

}
