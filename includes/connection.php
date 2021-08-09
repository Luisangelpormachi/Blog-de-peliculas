<?php 

$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'blog_videos';

$connection = mysqli_connect($server, $user, $pass, $database);

mysqli_query($connection, "SET NAMES utf8");

// iniciar session

if(!isset($_SESSION)){
    session_start();
}

?>