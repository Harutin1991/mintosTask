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
}