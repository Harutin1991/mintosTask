<?php

namespace system;

class View {
    public function render($viewName = '', $params = []) {
	  if (!empty($params)) {
		extract($params, EXTR_OVERWRITE);
	  }
	  if ($viewName != '') {
		require 'view/layout/header.php';
		require 'view/' . $viewName . '.php';
		require 'view/layout/footer.php';
	  }
	  $error = new ErrorHandler();
    }
    public function renderFullView($viewName = '') {
	  if ($viewName != '') {
		require 'view/' . $viewName . '.php';
	  }
	  $error = new ErrorHandler();
    }
    
    public function pushCSS($param) {
	  if(is_array($param)) {
		foreach($param as $src) {
		    $this->css[] = $src;
		}
	  } else {
		$this->css[] = $param;
	  }
    }
    
    public function pushJS($param) {
	  if(is_array($param)) {
		foreach($param as $src) {
		    $this->js[] = $src;
		}
	  } else {
		$this->js[] = $param;
	  }
    }
    
    public function addScript($script) {
	  $this->script[] = $script;
    }
}