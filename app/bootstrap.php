<?php 

    // Load helpers
    require_once 'helpers/helpers.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/response_helper.php';
    require_once 'helpers/date_helper.php';
    
    // Load Config
    require_once 'config/config.php';
    
    // Load routes
    require_once 'routes.php';

    // Autoload Core Libraries
    // spl_autoload_register(function($className) {
    //     require_once "libraries/{$className}.php";
    // });