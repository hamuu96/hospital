<?php

include 'includes/autoloader.ini.php';

  

$try = new conn();
$connection = $try->test_connection();

//test connection and redirect to main page
if($connection){
    $db_create= $try->create_db($connection);

}


$database_select = $try->connect(); //connect to created database

// //create db tables
$table_creation = new create_tables($database_select);
$table_creation->main($database_select);

$insert = new insert_data($database_select);
$insert->insert_dep();
$insert->insert_doctor();
$insert->insert_medicine();
$insert->insert_admin();

header('Location:index.php');


?>