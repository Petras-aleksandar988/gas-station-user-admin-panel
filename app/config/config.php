<?php 

 include  'configEnv.php';
 include  'config_info/config-template.php';

$conn = mysqli_connect($config['servername'],
$config['db_username'],
$config['db_password'],
$config['database_name']);

if(!$conn){
  die("connection fail");
}