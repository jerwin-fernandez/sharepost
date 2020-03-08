<?php
  session_start();

  // flash message helper
  // example - flash('register_success', 'You are now registered')
  // display in view <?php echo flash('register_success'); 
  function flash($name = '', $message = '', $class = 'alert alert-success') {
    if(!empty($name)) {
      // if the session name is not created then create it
      if(!empty($message) && empty($_SESSION[$name])) {
        // unset session if not empty
        unset($_SESSION[$name]);
        unset($_SESSION[$name. '_class']);

        // set session
        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;
      }else if(empty($message) && !empty($_SESSION[$name])) {
        // if the session name is created then display it
        $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : $class;
        echo '<div class="'. $class. '" id="msg-flash">'. $_SESSION[$name] .'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
      }
    }
  }