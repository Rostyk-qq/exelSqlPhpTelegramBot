<?php
extract($_POST);

if(!$path_file){
    echo 'Error, dont get path_file';
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'excel_chatbot';

$conn = new mysqli($host, $username, $password, $dbName);

if($conn->connect_error){
    echo 'Error, dont connect!';
    exit();
}

// create Table
$table = "CREATE TABLE IF NOT EXISTS excel_store(
   id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(20) NOT NULL,
   country VARCHAR(20) NOT NULL
)";

if(!($conn->query($table))){
    echo 'Error, cannot create table!';
    exit();
}

require "excelReader/excel_reader2.php";
require "excelReader/SpreadsheetReader.php";

$table = '';
$i = 0;

$table .= "#\t\t\t\t\t\tname\t\t\t\t\t\tcountry\n";
try {
    $reader = new SpreadsheetReader($path_file);
    global $name, $country;
    foreach ($reader as $key => $element){

        $name = $element[0];
        $country = $element[1];

        mysqli_query($conn, "INSERT INTO `excel_store` (name, country) VALUES ('$name', '$country')");

        $table .= "{$i}\t\t\t\t\t\t{$element[0]}\t\t\t\t\t\t{$element[1]}\n";
        $i++;
    }
    printf($table);
    $conn->close();

} catch (Exception $e) {
    exit($e->getMessage());
}
