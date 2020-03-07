<?php
  // load config file
  require_once 'config/config.php';

  // load all the libraries / config / helper 
  // require_once 'libraries/Core.php';
  // require_once 'libraries/Controller.php';
  // require_once 'libraries/Database.php';

  // autoload core libraries
  spl_autoload_register(function($className) {
    require_once 'libraries/'. $className .'.php';
  });