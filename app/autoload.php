<?php

// Autoload for classes in the "classes" directory
spl_autoload_register(function($className)
{
    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = str_replace("\\", "/", $className);
    $class = __DIR__. "/classes/" . (empty($namespace) ? "" : $namespace."/") . "{$className}.class.php";

    if (file_exists($class)) {
        include_once($class);
    }
});