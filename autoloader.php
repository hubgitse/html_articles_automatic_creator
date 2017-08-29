<?php

spl_autoload_register(function($name){
    $path = preg_replace('#\\\#', '/', $name);
    require __DIR__.'/'.$path.'.php';
});