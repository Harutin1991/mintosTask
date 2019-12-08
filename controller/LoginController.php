<?php
namespace controller;

use system\Controller;
use system\Session;
use model\LoginModel;
use libraries\Request;
use libraries\Redirect;

class LoginController extends Controller{
    public function __construct() {
        parent::__construct();   
    }
    
    public function index() {
        $this->view->renderFullView('login');
    }
    
    public function register() {
	  $request = new Request();
	  if($request->isPost()) {
		$loginModel = new LoginModel();
		if($loginModel->loadData($request->getPost()) && $loginModel->register()) {
		    Session::set('success', 'You successfully registered');
		    Redirect::redirectTo(URL.'login');
		}
		$error = $loginModel->getErrors();
		Session::setValidationErrors($error);
	  }
	  $this->view->renderFullView('register');
    }

    public function validate() {
	  //Test!2010
	  $request = new Request();
	  $loginModel = new LoginModel();	 
	  if($request->isPost() && $loginModel->loadData($request->getPost(), false)) {
		if($user = $loginModel->login()){
		    Session::set('isLogedin', true);
		    Session::set('userInfo', $user);
		    Redirect::redirectTo(URL.'home'); 
		} else {
		    Session::set('errorMessage', "Something went wrong");
		    Redirect::redirectTo(URL.'login'); 
		}
	  } else {
		Session::set('errorMessage', "Something went wrong");
		Redirect::redirectTo(URL.'login'); 
	  }
    }
    
    public function checkEmail() {
	  $request = new Request();
	  if($request->isPost()) {
		$loginModel = new LoginModel();
		$loginModel->email = $request->getPost('email');
		if($loginModel->isEmailExist()){
		    echo json_encode(['success'=>false]);exit();
		}
		echo json_encode(['success'=>true]);exit();
	  }
    }
    
    public function logout() {
        Session::destroy();
        Redirect::redirectTo(URL.'login'); 
    }
    
}