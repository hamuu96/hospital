<?php

spl_autoload_register('autoload');


function autoload($classname){

    $extention = '.class.php';
    $path = 'class/';
    $fullpath = $path .$classname . $extention;

    include_once $fullpath;

    if (!file_exists($fullpath)) {
        echo 'File does not exists';
    }
}



?>