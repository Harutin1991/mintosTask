<?php 
namespace system;

use system\View;

class ErrorHandler {
    
    public function index() {
	  $view = new View();
	  $view->renderFullView('error/error');
    }
}