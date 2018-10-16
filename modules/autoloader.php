<?php

require_once 'config/config.php';
require_once 'config/http_res_headers.php';
require_once 'middleware/error_middleware.php';
require_once 'middleware/sendData.php';
require_once 'middleware/auth_token.php';

spl_autoload_register(function($classname){

    if(!file_exists('../modules/libs/'.$classname.'.php')){

        require_once '../modules/libs/jwtphp/'.$classname.'.php';

    }else{
        require_once '../modules/libs/'.$classname.'.php';
    }    
    
});

?>