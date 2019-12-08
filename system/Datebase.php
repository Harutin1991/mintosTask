<?php
/**
* Class Datebase
* Connecting to DB
*  
*/
namespace system;
use PDO;

class Datebase extends PDO{
    
    public function __construct() {
        parent::__construct(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
    }
}
