<?php
/**
* Class Bootstrap
* This class responsible for URL
*  
*/
namespace system;

class Bootstrap {

    function __construct() {
        $url = isset($_GET["url"]) ? $_GET["url"] : NULL;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0]) || $url[0] == 'index.php') {
            $controller = new \controller\LoginController();
            $controller->index();
            return FALSE;
        }

        $file = 'controller/' . $url[0] . 'Controller.php';
        if (!file_exists($file)) {
            $error = new ErrorHandler();
            $error->index();
            return FALSE;
        }

        $controllerFullName = "\\controller\\".ucfirst($url[0])."Controller";
        $controller = new $controllerFullName;

        if (isset($url[2])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                $error = new ErrorHandler();
                $error->index();
                return FALSE;
            }
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}();
                } else {
                    $error = new ErrorHandler();
                    $error->index();
                    return FALSE;
                }
            } else {
                $controller->index();
            }
        }
    }

}
