<?php


class select{
    private $connection;
    public function __construct($connection)
    {
       $this->connection = $connection; 
    }
  public function user(){
        $sql = 'SELECT * from USER';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->get_result();
        $user = $result->fetch_all();
        if (count($user) > 0){
          return $user;
      }else{
        return 'No user registered yet';
      }
       
    }
    
    public function getuser($email){
      $sql = 'SELECT * from USER WHERE email = ?';
      $stm = $this->connection->prepare($sql);
      $stm->bind_param('s',$email);
      $stm->execute();
      $result = $stm->get_result();
      $dep_id = $result->fetch_all();

    //change dep id variable to user 

      if (count($dep_id) > 0){
          return $dep_id;
      }
      else{
        return 'User does not exists';
      }
  }
    public function getdoc($email){
      $sql = 'SELECT * from DOCTORS WHERE email = ?';
      $stm = $this->connection->prepare($sql);
      $stm->bind_param('s',$email);
      $stm->execute();
      $result = $stm->get_result();
      $dep_id = $result->fetch_all();

     
    //change dep id variable to doctor 

      if (count($dep_id) > 0){
          return $dep_id;
      }
      else{
        return 'Doctor does not exists';
      }
  }
    public function doctors(){
      $sql = 'SELECT * from DOCTORS';
      $stm = $this->connection->prepare($sql);
      $stm->execute();
      $result = $stm->get_result();
      $doctors = $result->fetch_all();

      if (count($doctors) > 0){
        return $doctors;
    }else{
      return 'No doctors registered yet';
    }
     
  }
    public function department(){
        $sql = 'SELECT * from DEPARTMENT';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->get_result();
        // $existing_user = $result->fetch_all();
       return $result;
    }
    public function department_id($department){
        $sql = 'SELECT dep_id from DEPARTMENT WHERE department = ?';
        $stm = $this->connection->prepare($sql);
        $stm->bind_param('s',$department);
        $stm->execute();
        $result = $stm->get_result();
        $dep_id = $result->fetch_all();

       

        if (count($dep_id) > 0){
            return $dep_id;
        }
    }
    public function count_dep($department){
        $sql = 'SELECT * from DOCTORS join DEPARTMENT ON DEPARTMENT.dep_id = DOCTORS.dep_id WHERE DOCTORS.dep_id = ?';
        $stmi = $this->connection->prepare($sql);
        if ( false===$stmi ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $stmi->bind_param('s',$department);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($stmi->error));
          }
        $rc = $stmi->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmi->error));
          }
        $result = $stmi->get_result();
        $dep_id = $result->fetch_all();

       

        if (count($dep_id) > 0){
            return $dep_id;
        }
    }

    public function doc_appointment($department){
        $sql = 'SELECT APPOINTMENT.ap_id,APPOINTMENT.firstname,APPOINTMENT.lastname,usr_msg,user_id from APPOINTMENT join DOCTORS ON APPOINTMENT.did = DOCTORS.did WHERE DOCTORS.did = ?';
        $stmi = $this->connection->prepare($sql);
        if ( false===$stmi ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $stmi->bind_param('s',$department);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($stmi->error));
          }
        $rc = $stmi->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($stmi->error));
          }
        $result = $stmi->get_result();
        $dep_id = $result->fetch_all();

       

        if (count($dep_id) > 0){
            return $dep_id;
        }else{
          return 'No appointments at the moments';
        }
    }
    public function medicine(){
      $sql = 'SELECT * from MEDICINE';
      $stm = $this->connection->prepare($sql);
      // $stm->bind_param('s',$department);
      $stm->execute();
      $result = $stm->get_result();
      $med = $result->fetch_all();

     

      if (count($med) > 0){
          return $med;
      }
  }
  public function med_id($med){
        $sql = 'SELECT * from MEDICINE WHERE med_name = ?';
        $stm = $this->connection->prepare($sql);
        if ( false===$stm ) {
           
          die('prepare() failed: ' . htmlspecialchars($this->connection->error));
        }
        $rc = $stm->bind_param('s',$med);
        $stm->execute();
        $result = $stm->get_result();
        $med = $result->fetch_all();

      

        if (count($med) > 0){
            return $med;
        }
    }
}

?>