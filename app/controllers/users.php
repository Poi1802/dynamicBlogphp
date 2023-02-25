<?php
require_once SITE_ROOT . "/app/database/db.php";

$errMsg = [];
$users = selectAll('users');

function verifyUser($user)
{
  $_SESSION['id'] = $user['id'];
  $_SESSION['login'] = $user['username'];
  $_SESSION['admin'] = $user['admin'];

  if ($_SESSION['admin']) {
    header('location: ' . BASE_URL . 'admin/posts/index.php');
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

  $admin = $_POST['role'] ? $_POST['role'] : 0;

  if ($login === '' || $email === '' || $passF === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($login, 'UTF-8') < 2) {
    $errMsg[] = 'Логин должен быть больше 2 символов!';
  } elseif ($passF !== $passS) {
    $errMsg[] = 'Пароли в обоих полях должны совпадать';
  } else {
    $existEmail = selectOne('users', ['email' => $email]);
    $existLogin = selectOne('users', ['username' => $login]);

    if ($existEmail) {
      $errMsg[] = 'Пользователь с такой почтой уже есть!';
    } elseif ($existLogin) {
      $errMsg[] = 'Пользователь с таким логином уже есть!';
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

      if ($_SESSION) {
        header('location: ' . BASE_URL . '/admin/users');
      } else {
        verifyUser($user);
      }
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
    $errMsg[] = 'Все поля должны быть заполнены';
  } else {

    $existLogin = selectOne('users', ['username' => $login]);

    if (!$existLogin) {
      $errMsg[] = 'Логин не верен';
    } elseif (!password_verify($password, $existLogin['password'])) {
      $errMsg[] = 'Пароль не верен';
    } else {
      verifyUser($existLogin);
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) || isset($_GET['id-user'])) {
  $id = isset($_GET['id']) ? $_GET['id'] : $_GET['id-user'];
  $user = selectOne('users', ['id' => $id]);
  $login = $user['username'];
  $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user'])) {
  $id = $_POST['id'];
  $login = trim($_POST['login']);
  $email = trim($_POST['email']);
  $passF = trim($_POST['pass-first']);
  $passS = trim($_POST['pass-second']);
  $admin = $_POST['role'] ? $_POST['role'] : 0;

  if (mb_strlen($login, 'UTF-8') < 2) {
    $errMsg = 'Логин должен быть больше 2 символов!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'admin/users/edit.php?id=' . $_POST['id']);
  } elseif ($passF !== $passS) {
    $errMsg = 'Пароли в обоих полях должны совпадать';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'admin/users/edit.php?id=' . $_POST['id']);
  } else {

    $password = password_hash($_POST['pass-first'], PASSWORD_DEFAULT);

    $userP = [
      'username' => $login,
      'email' => $email,
      'password' => $password,
      'admin' => $admin
    ];
    $user = [
      'username' => $login,
      'email' => $email,
      'admin' => $admin
    ];

    update('users', $id, $passF ? $userP : $user);
    unset($_SESSION['errMsg']);
    header('location: ' . BASE_URL . '/admin/users');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user-login'])) {
  $id = $_POST['id'];
  $login = trim($_POST['login']);

  if (mb_strlen($login, 'UTF-8') < 2) {
    $errMsg = 'Логин должен быть больше 2 символов!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'user/profile/edit.php?log=1&id-user=' . $_POST['id']);
  } else {
    update('users', $id, ['username' => $login]);
    unset($_SESSION['errMsg']);
    header('location: ' . BASE_URL . '/user/profile');
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user-email'])) {
  $id = $_POST['id'];
  $email = trim($_POST['email']);

  if (mb_strlen($email, 'UTF-8') === 0) {
    $errMsg = 'EMAIL не должен быть пустой!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'user/profile/edit.php?email=1&id=' . $_POST['id']);
  } else {
    update('users', $id, ['email' => $email]);
    unset($_SESSION['errMsg']);
    header('location: ' . BASE_URL . '/user/profile');
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user-pass'])) {
  $id = $_POST['id'];
  $passF = trim($_POST['pass-first']);
  $passS = trim($_POST['pass-second']);

  if ($passF === '') {
    $errMsg = 'Все поля должны быть заполнены!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'user/profile/edit.php?pass=1&id=' . $_POST['id']);
  } elseif ($passF !== $passS) {
    $errMsg = 'Пароли в обоих полях должны совпадать';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'user/profile/edit.php?pass=1&id=' . $_POST['id']);
  } else {
    $password = password_hash($_POST['pass-first'], PASSWORD_DEFAULT);
    update('users', $id, ['password' => $password]);
    unset($_SESSION['errMsg']);
    header('location: ' . BASE_URL . '/user/profile');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];
  deleteRow('users', $id);
  deleteRow('posts', $id, 'id_user');
  header("location: " . BASE_URL . '/admin/users');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['role'])) {
  $id = $_GET['id'];
  update('users', $id, ['admin' => $_GET['role']]);
  header("location: " . BASE_URL . '/admin/users');
}