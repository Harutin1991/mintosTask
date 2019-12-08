<?php
namespace system;

class Model {
    
    function __construct() {
	  $this->db = new Datebase();
    }
    
    public function loadData($data, $validate = true) {
	  if($validate) {
		foreach ($data as $key => $value) {
		    if (!property_exists($this, $key)) {
			  return false;
		    }
		    $this->isValid($key, $value);
		}
		if(!empty($this->errors)) {
		    return false;
		}
	  } else {
		foreach ($data as $key => $value) {
		    if (property_exists($this, $key)) {
			  $this->$key = $this->validInput($value);
		    }
		}
		return true;
	  }
    }
    
    public function save($lastInsertId = false) {
	  $fields = ''; //`fname`, `lname`, `email`, `password`
	  $values = ''; //:fname, :lname, :email, :password
	  $executionArray = []; 
	  $objVars = (array)$this;
	  $varsCount = count($objVars);
	  $i = 0;
	  foreach($objVars as $key=>$value) {
		if($key != 'db' && $key != 'table') {
		    if($varsCount-3 == $i) {
			  $fields.='`'.$key.'`';
			  $values .= ':'.$key;
		    } else {
			  $fields.='`'.$key.'`,';
			  $values .= ':'.$key.',';
		    }
		    $executionArray[':'.$key] = $value;
		    $i++;
		}
	  }
	  $query = $this->db->prepare("INSERT INTO `{$this->table}`({$fields}) VALUES ({$values})");
	  if ($query->execute($executionArray)) {
		return $lastInsertId ? $this->db->lastInsertId() : true;
	  } else {
		return false;
	  }
    }
    
    protected function isValid($key, $value) {
	  $methodName = 'validate' . ucfirst($key);
	  if (method_exists($this, $methodName)) {
		$methodName = 'validate' . ucfirst($key);
		$this->$key = $this->validInput($value);
		$this->$methodName();
	  }
    }
    
    protected function validInput($value) {
	  $value = trim($value);
	  $value = stripslashes($value);
	  $value = htmlspecialchars($value);
	  return $value;
    }
}