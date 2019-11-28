<?php
namespace libraries;

class Redirect{
    public static function redirectTo($url) {
        header("location: " . $url);
    }
    
    public static function getUrlSegment($segment) {
	  $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $uriSegments = explode('/', $uriPath);
	  return isset($uriSegments[$segment]) ? $uriSegments[$segment] : '';
    }

}