<?php

namespace model;

use system\Model;
use system\Session;

class LoginModel extends Model {
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirmPassword;
    public $errors = [];
    
    function __construct() {
	  parent::__construct();
    }
    
     /**
    * Checking is user exist or no with entered email and password 
    * @return mixed (bool , array) 
    */
    public function login() {
	  $query = $this->db->prepare("SELECT * FROM users WHERE email= :email AND password= :password");
	  $query->execute(array(
		":email" => $this->email,
		":password" => $this->generatePassword($this->password)
	  ));
	  if ($query->rowCount()) {
		return $query->fetch();
	  }
	  return false;
    }
    
     /**
    * Adding user into DB
    * @return boolean 
    */
    public function register() {
	  $user = $this->db->prepare("INSERT INTO `users`(`fname`, `lname`, `email`, `password`) VALUES (:fname, :lname, :email, :password)");
	  if ($user->execute(array(
			  ":fname" => $this->fname,
			  ":lname" => $this->lname,
			  ":email" => $this->email,
			  ":password" => $this->generatePassword($this->password)
		    ))) {
		return true;
	  } else {
		return false;
	  }
    }
    
      /**
    * Checking is Fname valid
    * @return void 
    */
    public function validateFname() {
	  if($this->fname != '') {
		if (strlen($this->fname) > 50) {
		    $this->errors['fname'] = 'Too long First Name';
		}

		if (!preg_match("/^[a-zA-Z ]*$/", $this->fname)) {
		    $this->errors['fname'] = "Only letters and white space allowed";
		}
	  } else {
		$this->errors['fname'] = 'First Name can\'t be blank' ;
	  }
    }
    
     /**
    * Checking is Lname valid
    * @return void 
    */
    public function validateLname() {
	  if($this->lname != '') {
		if (strlen($this->lname) > 50) {
		    $this->errors['lname'] = 'Too long Last Name';
		}
		if (!preg_match("/^[a-zA-Z ]*$/", $this->fname)) {
		    $this->errors['lname'] = "Only letters and white space allowed";
		}
	  } else {
		$this->errors['lname'] = 'Last Name can\'t be blank' ;
	  }
	  
    }
    
     /**
    *  Is entered email valid or no
    * @return void 
    */
    public function validateEmail() {
	  if($this->fname != '') {
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		    $this->errors['email'] = "Invalid email format";
		}
		if ($this->isEmailExist()) {
		    $this->errors['email'] = 'This email already exist';
		}
	  } else {
		$this->errors['email'] = 'Email can\'t be blank' ;
	  }
    }
    
     /**
    * Checking is password satisfies requirements
    * @return void 
    */
    public function validatePassword() {
	  $password = $this->password;
	  $uppercase = preg_match('@[A-Z]@', $password);
	  $lowercase = preg_match('@[a-z]@', $password);
	  $number = preg_match('@[0-9]@', $password);
	  $specialChars = preg_match('@[^\w]@', $password);
	  if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$this->errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	  }
    }
    
     /**
    * Checking is confirm password input data same as password
    * @return void 
    */
    public function validateConfirmPassword() {
	  if ($this->password != $this->confirmPassword) {
		$this->errors['confirmPassword'] = "Confirm password and password doesn't match.";
	  }
    }
    
    /**
    * Checking is entered email already exist in DB or no
    * @return int 
    */
    public function isEmailExist() {
	  $userPrepare = $this->db->prepare("SELECT * FROM `users` WHERE email = :email");
	  $userPrepare->execute([':email' => $this->email]);
	  $count = $userPrepare->rowCount();
	  return $count;
    }
    
    /*
    * Getting errors
    * @return array 
    */
    public function getErrors() {
	  return $this->errors;
    }
    
    /*
    * generating password
    * @return string 
    */
    private function generatePassword($password) {
	  $saltLength = 20;
	  $hashFormat = "2y$10$"; 
	  $salt = $this->generateSalt($saltLength);
	  $formatAndSalt = $hashFormat . $salt; 
	  $hash = crypt($password, $formatAndSalt);
	  return $hash;
    }
    
     /*
    * Generating salt
    * @return string 
    */
    private function generateSalt($length) {
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  $base64_string = base64_encode($unique_random_string);
	  $modified_base64_string = str_replace('+', ".", $base64_string);
	  $salt = substr($modified_base64_string, 0, $length);
	  return $salt;
    }
}
?>