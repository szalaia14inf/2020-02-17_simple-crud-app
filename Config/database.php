<?php

$host = "localhost";
$db_name = "simple_crud_app";
$username = "simple_crud_app";
$password = "simple_crud_app";

try {

    $con = new PDO("mysql:host{$host};dbname={$db_name}", $username, $password);

}
catch(PDOException $exception) {

    echo "Connection error: " . $exception -> getMessage();

}

?>