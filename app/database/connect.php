<?php
$host = 'localhost';
$dbName = 'dynamic_site';
$login = 'eugen';
$password = 'Fyufhcr123';
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $login, $password, $options);
} catch (PDOException $i) {
  die('Connection error database');
}