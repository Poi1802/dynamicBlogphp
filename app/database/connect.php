<?php
$host = 'localhost';
$dbName = 'dynamic_site';
$login = 'eugen';
$password = 'Fyufhcr123';


try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $login, $password);
} catch (PDOException $i) {
  die('Connection error database');
}