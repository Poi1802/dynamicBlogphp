<?php
require_once "app/database/db.php";

$errMsg = '';

function verifyUser($user)
{
  $_SESSION['id'] = $user['id'];
  $_SESSION['login'] = $user['username'];
  $_SESSION['admin'] = $user['admin'];

  if ($_SESSION['admin']) {
    header('location: ' . BASE_URL . 'admin/admin.php');
  } else {
    header('location: ' . BASE_URL);
  }
}

// Код формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-reg'])) {
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
        'username' => $login,
        'email' => $email,
        'password' => $password,
        'admin' => $admin
      ];

      $id = insert('users', $post);
      $user = selectOne('users', ['id' => $id]);

      verifyUser($user);
    }
  }

} else {
  $login = '';
  $email = '';
}

// Код формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-log'])) {
  $login = trim($_POST['login']);
  $password = $_POST['password'];

  if ($login === '' || $password === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } else {

    $existLogin = selectOne('users', ['username' => $login]);

    if (!$existLogin) {
      $errMsg = 'Логин не верен';
    } elseif (!password_verify($password, $existLogin['password'])) {
      $errMsg = 'Пароль не верен';
    } else {
      verifyUser($existLogin);
    }
  }
}