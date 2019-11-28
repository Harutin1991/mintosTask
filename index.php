<?php
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', $class . '.php'));
});

require 'config/datebase.php';
require 'config/paths.php';

$application = new \system\Bootstrap();
