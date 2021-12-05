<?php


class delete{
    private $connection;

    public function __construct($connection)
    {
     $this->connection = $connection;   
    }

    public function docdelete($did){
        $sql = 'DELETE FROM DOCTORS WHERE did = ?';

        $smti = $this->connection->prepare($sql);
        if ( false===$smti ) {
           
            die('prepare() failed: ' . htmlspecialchars($this->connection->error));
          }
        $rc = $smti->bind_param("i",$did);
        if ( false===$rc ) {
            // again execute() is useless if you can't bind the parameters. Bail out somehow.
            die('bind_param() failed: ' . htmlspecialchars($smti->error));
          }
        $rc = $smti->execute();
        if ( false===$rc ) {
            die('execute() failed: ' . htmlspecialchars($smti->error));
          }else{
             echo 'Doctors record deleted';
          }

    }
    public function del_appointment($ap_id){
      $sql = 'DELETE FROM  APPOINTMENT WHERE ap_id = ?';
      $stmi = $this->connection->prepare($sql);
      if ( false===$stmi ) {
         
          die('prepare() failed: ' . htmlspecialchars($this->connection->error));
        }
      $rc = $stmi->bind_param('i',$ap_id);
      if ( false===$rc ) {
          // again execute() is useless if you can't bind the parameters. Bail out somehow.
          die('bind_param() failed: ' . htmlspecialchars($stmi->error));
        }
      $rc = $stmi->execute();
      if ( false===$rc ) {
          die('execute() failed: ' . htmlspecialchars($stmi->error));
        }
      // $result = $stmi->get_result();
      // $dep_id = $result->fetch_all();

     

      // if (count($dep_id) > 0){
      //     return $dep_id;
      // }else{
      //   return 'No appointments at the moments';
      // }
  }
}



?>