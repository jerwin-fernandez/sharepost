<?php
  /*
  * App Core Class
  * Creates URL & loads core controller 
  * URL FORMAT - /controller/method/param
  */

  class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';

    // properties
    protected $params = [];

    public function __construct() {
      // print_r($this->getUrl());

      $url = $this->getUrl();

      // look in controllers for first value
      if(file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
        $this->currentController = ucfirst($url[0]);
        
        // unset 0 index
        unset($url[0]);
      }

      // require the controller
      require_once '../app/controllers/' . $this->currentController . '.php';

      // instantiate the controller class
      $this->currentController = new $this->currentController();

      // check for second part of url
      if(isset($url[1])) { 
        // check if method exist
        if(method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];

          // unset 1 index
          unset($url[1]);
        }
      }

      // get params/properties
      $this->params = $url ? array_values($url) : [];

      // call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // get the url
    public function getUrl() {
      $url = '';

      if(isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }

  }