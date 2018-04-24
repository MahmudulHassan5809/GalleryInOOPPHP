<?php 


 spl_autoload_register(function ($className) {
    require_once $className . '.php';
});


function redirect($location){
      header("Location: {$location}");
}






?>