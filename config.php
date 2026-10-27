<?php
$host='localhost'; $dbname='apexplanet_bookstore'; $username='root'; $password='';
$conn = new mysqli($host,$username,$password,$dbname);
if ($conn->connect_error) die('Database connection failed. Import database.sql and check config.php.');
$conn->set_charset('utf8mb4');
if (session_status() === PHP_SESSION_NONE) session_start();
?>