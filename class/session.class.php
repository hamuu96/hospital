<?php

class session{


    public function user_sess($session){
        if(!$session){
            header('Location:login.php');
          }
        else{
            $expireAfter = 30;
            
          //check if session counter is set
          if(isset($_SESSION['counter'])){
            
            //check session counter -> amount of time passed
            $secondsInactive = time() - $_SESSION['counter'];
            
            //Convert min into sec.
            $expireAfterSeconds = $expireAfter * 60;
            
            //Check to see if they have been inactive for too long.
            if($secondsInactive >= $expireAfterSeconds){
             //destroy session after set timer
              session_unset();
              session_destroy();
              header('Location:login.php');    }
            
          }
          $_SESSION['counter'] = time();
          
          }
    }
    public function doc_sess($session){
      if(!$session){
          header('Location:dlogin.php');
        }
      else{
          $expireAfter = 30;
          
        //check if session counter is set
        if(isset($_SESSION['counter'])){
          
          //check session counter -> amount of time passed
          $secondsInactive = time() - $_SESSION['counter'];
          
          //Convert min into sec.
          $expireAfterSeconds = $expireAfter * 60;
          
          //Check to see if they have been inactive for too long.
          if($secondsInactive >= $expireAfterSeconds){
           //destroy session after set timer
            session_unset();
            session_destroy();
            header('Location:dlogin.php');    }
          
        }
        $_SESSION['counter'] = time();
        
        }
  }
  public function adm_sess($session){
    if(!$session){
        header('Location:admin.php');
      }
    else{
        $expireAfter = 30;
        
      //check if session counter is set
      if(isset($_SESSION['counter'])){
        
        //check session counter -> amount of time passed
        $secondsInactive = time() - $_SESSION['counter'];
        
        //Convert min into sec.
        $expireAfterSeconds = $expireAfter * 60;
        
        //Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
         //destroy session after set timer
          session_unset();
          session_destroy();
          header('Location:admin.php');    }
        
      }
      $_SESSION['counter'] = time();
      
      }
}
}



?>