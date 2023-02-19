<?php
include __DIR__ . '/path.php';
session_start();
session_destroy();
header('location: ' . BASE_URL);

/* Old logout */
// session_start();
// include __DIR__ . '/path.php';

// unset($_SESSION['id']);
// unset($_SESSION['login']);
// unset($_SESSION['admin']);
// header('location: ' . BASE_URL);