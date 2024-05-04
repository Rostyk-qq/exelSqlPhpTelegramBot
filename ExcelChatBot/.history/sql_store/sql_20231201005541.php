<?php
extract($_POST);

if(!$path_file){
    echo 'Error, dont get path_file';
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'users_db';

$conn = new mysqli($host, $username, $password, $dbName);

if($conn->connect_error){
    echo 'Error, dont connect!';
    exit();
}

if(!($conn->query($table))){
    echo 'Error, cannot create table!';
    exit();
}

$table = '';
$i = 0;

$table .= "#\t\t\t\t\t\tname\t\t\t\t\t\tcountry\n";
try {
    foreach ($reader as $key => $element){

        mysqli_query($conn, "INSERT INTO `excel_store` (name, country) VALUES ('$name', '$country')");

     
    }
    printf($table);
    $conn->close();

} catch (Exception $e) {
    exit($e->getMessage());
}
