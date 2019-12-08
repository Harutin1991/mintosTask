<?php

namespace model;

use system\Model;
use system\Session;
use PDO;

class RssModel extends Model {
    
    public $table = 'feed_info';


    public $name;
    public $title;
    public $author_name;
    public $author_email;
    public $uri;
    public $self_link;
    public $alternate_link;
    public $rights;
    public $icon;
    public $subtitle;
    public $logo;
    public $updated;
    
    public function __construct() {
	  parent::__construct();
    }
    
    /*
    * Get Rss feed info from DB 
    * array 
    */
    public function getRssInfo() {
	  $query = $this->db->query("SELECT fi.title as fi_title, f.* FROM feed_info as fi JOIN feeds as f ON f.feed_id = fi.id");
	  return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}