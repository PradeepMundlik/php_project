<?php
define('db_server','localhost');
define('db_username','pradeep');
define('db_password','12345678');
define('db_name','kaustubha');

// Try connecting to db
$conn = mysqli_connect(db_server,db_username,db_password,db_name);

if($conn == false){
    dir('Error: Unable to connect to database '+db_name+ 'with username '+db_username);
}
?>