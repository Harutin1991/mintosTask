<?php

namespace model;

use system\Model;
use system\Session;

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
    
    function __construct() {
	  parent::__construct();
    }
    
}