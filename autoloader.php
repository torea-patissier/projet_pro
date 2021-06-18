<?php

spl_autoload_register('myAutoloader');

function myAutoloader($class){
    $path = "classes/";
    $extension = "Class.php";
    $fullPath = $path . $class . $extension;

    include_once $fullPath;
}

?>

