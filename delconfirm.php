<?php
session_start();
include 'includes/autoloader.ini.php';

//connection
$conn = new conn;
$connection = $conn->connect();

if(!$_SESSION['admin-username']){
  header('Location:admin.php');
}

$delete = new delete($connection);

if(isset($_POST['delete'])){
  $result = $delete->docdelete($_SESSION['doc-id']);

  $_SESSION['deleted-doc'] = 'Doctors record deleted';
  header('Location:docdelete.php');

}


?>