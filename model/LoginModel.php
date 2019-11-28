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
    private $errors = [];
    
    function __construct() {
	  parent::__construct();
    }
    
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
    
    public function validateFname() {
	  if (strlen($this->fname) > 100) {
		$this->errors['fname'] = 'Too long First Name';
		return false;
	  }
	  if (!preg_match("/^[a-zA-Z ]*$/", $this->fname)) {
		$this->errors['fname'] = "Only letters and white space allowed";
		return false;
	  }
	  return true;
    }
    
    public function validateLname() {
	  if (strlen($this->lname) > 100) {
		$this->errors['fname'] = 'Too long Last Name';
		return false;
	  }
	  if (!preg_match("/^[a-zA-Z ]*$/", $this->fname)) {
		$this->errors['fname'] = "Only letters and white space allowed";
		return false;
	  }
	  return true;
    }
    
    public function validateEmail() {
	  if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		$this->errors['email'] = "Invalid email format";
		return false;
	  }
	  if ($this->isEmailExist()) {
		$this->errors['email'] = 'This email already exist';
		return false;
	  }
	  return true;
    }
    
    public function validatePassword() {
	  $password = $this->password;
	  $uppercase = preg_match('@[A-Z]@', $password);
	  $lowercase = preg_match('@[a-z]@', $password);
	  $number = preg_match('@[0-9]@', $password);
	  $specialChars = preg_match('@[^\w]@', $password);
	  if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$this->errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
		return false;
	  }
	  return true;
    }
    
    public function validateConfirmPassword() {
	  if ($this->password != $this->confirmPassword) {
		$this->errors['confirmPassword'] = "Confirm password and password doesn't match.";
		return false;
	  }
	  return true;
    }
    
    public function isEmailExist() {
	  $userPrepare = $this->db->prepare("SELECT * FROM `users` WHERE email = :email");
	  $userPrepare->execute([':email' => $this->email]);
	  $count = $userPrepare->rowCount();
	  return $count;
    }
    
    public function getErrors() {
	  return $this->errors;
    }
    
    private function generatePassword($password) {
	  $saltLength = 20;
	  $hashFormat = "2y$10$"; 
	  $salt = $this->generateSalt($saltLength);
	  $formatAndSalt = $hashFormat . $salt; 
	  $hash = crypt($password, $formatAndSalt);
	  return $hash;
    }
    
    private function generateSalt($length) {
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  $base64_string = base64_encode($unique_random_string);
	  $modified_base64_string = str_replace('+', ".", $base64_string);
	  $salt = substr($modified_base64_string, 0, $length);
	  return $salt;
    }
}
?>