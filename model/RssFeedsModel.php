<?php

namespace model;

use system\Model;
use system\Session;

class RssFeedsModel extends Model {
    
     public $table = 'feeds';
    
    public $title;
    public $author_name;
    public $uri;
    public $link;
    public $summary;
    public $entry_id;
    public $feed_id;
    public $updated;
    
    function __construct() {
	  parent::__construct();
    }
    
}