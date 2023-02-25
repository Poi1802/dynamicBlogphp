<?php
require_once SITE_ROOT . "/app/database/db.php";

$topics = selectAll('topics');

$errMsg = [];
$name = '';
$descr = '';
$id = '';

// Код формы добавления категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-btn']) || isset($_POST['topic-btn-user'])) {
  $name = trim($_POST['name']);
  $descr = trim($_POST['description']);

  if ($name === '' || $descr === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($name, 'UTF-8') < 2) {
    $errMsg[] = 'Категория должна быть больше 2 символов!';
  } else {
    $existTopic = selectOne('topics', ['name' => $name]);

    if ($existTopic) {
      $errMsg[] = 'Такая категория уже есть!';
    } else {
      $topic = [
        'name' => $name,
        'description' => $descr,
        'id_user' => $_SESSION['id']
      ];

      $id = insert('topics', $topic);
      $topic = selectOne('topics', ['id' => $id]);
      $_POST['topic-btn'] ? header('location: ' . BASE_URL . 'admin/topics') : header('location: ' . BASE_URL . 'user/topics');
    }
  }
}

// Код формы изменения категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit']) || isset($_POST['topic-edit-user'])) {
  $name = trim($_POST['name']);
  $descr = trim($_POST['description']);

  if ($name === '' || $descr === '') {
    $errMsg = 'Все поля должны быть заполнены';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'admin/topics/edit.php?id=' . $_POST['id']);
  } elseif (mb_strlen($name, 'UTF-8') < 2) {
    $errMsg = 'Категория должна быть больше 2 символов!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . 'admin/topics/edit.php?id=' . $_POST['id']);
  } else {
    $topic = [
      'name' => $name,
      'description' => $descr
    ];

    $id = $_POST['id'];
    update('topics', $id, $topic);
    unset($_SESSION['errMsg']);
    $_POST['topic-edit'] ? header('location: ' . BASE_URL . 'admin/topics') : header('location: ' . BASE_URL . 'user/topics');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $topic = selectOne('topics', ['id' => $id]);
  $name = $topic['name'];
  $descr = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id']) || isset($_GET['del_id-user'])) {
  $id = $_GET['del_id'] ? $_GET['del_id'] : $_GET['del_id-user'];
  deleteRow('topics', $id);
  $_GET['del_id'] ? header('location: ' . BASE_URL . 'admin/topics') : header('location: ' . BASE_URL . 'user/topics');
}