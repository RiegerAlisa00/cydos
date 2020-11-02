<?php

function autoload($className)
{
    $prefix = "App";
    $dir = "./src";
    
    $class = substr($className, strlen($prefix));
    $class = str_replace("\\", "/", $class);
    
    if(file_exists("{$dir}{$className}.php")){
        require "{$dir}{$className}.php";
    }
}

spl_autoload_register("autoload");

$post = new App\Blog\Post();
var_dump($post);

$post2 = new App\Forum\Post();
var_dump($post2);
/*
require "./src/User/User.php";
require "./src/Blog/PostInterface.php";
require "./src/Blog/Post.php";
require "./src/Forum/Post.php";



$h = new BlogPost();
var_dump($h);
*/
?>