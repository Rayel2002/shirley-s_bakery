<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'shirleys_bakery';

$db = mysqli_connect($host, $user, $password, $database)
    or die('Error: '.mysqli_connect_error());
