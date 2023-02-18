<?php
require_once "app/database/db.php";

$successMsg = '';
$errMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = trim($_POST['login']);
  $email = trim($_POST['email']);
  $passF = trim($_POST['pass-first']);
  $passS = trim($_POST['pass-second']);

  $admin = 0;

  if ($login === '' || $email === '' || $passF === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($login, 'UTF-8') < 2) {
    $errMsg = 'Логин должен быть больше 2 символов!';
  } elseif ($passF !== $passS) {
    $errMsg = 'Пароли в обоих полях должны совпадать';
  } else {
    $existEmail = selectOne('users', ['email' => $email]);
    $existLogin = selectOne('users', ['username' => $login]);

    if ($existEmail) {
      $errMsg = 'Пользователь с такой почтой уже есть!';
    } elseif ($existLogin) {
      $errMsg = 'Пользователь с таким логином уже есть!';
    } else {

      $password = password_hash($_POST['pass-first'], PASSWORD_DEFAULT);
      $post = [
        'login' => $login,
        'email' => $email,
        'password' => $password,
        'admin' => $admin
      ];
      dump($post);
      // $id = insert('users', $post);  
      // $lastRow = selectOne('users', ['id' => $id]);
      $successMsg = "<strong>$login</strong> вы успешно зарегестрированы!";
    }
  }

} else {
  $login = '';
  $email = '';

}