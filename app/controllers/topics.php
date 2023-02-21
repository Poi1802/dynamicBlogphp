<?php
require_once SITE_ROOT . "/app/database/db.php";

$topics = selectAll('topics');

$errMsg = '';
$name = '';
$descr = '';
$id = '';

// Код формы добавления категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-btn'])) {
  $name = trim($_POST['name']);
  $descr = trim($_POST['description']);

  if ($name === '' || $descr === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($name, 'UTF-8') < 2) {
    $errMsg = 'Категория должна быть больше 2 символов!';
  } else {
    $existTopic = selectOne('topics', ['name' => $name]);

    if ($existTopic) {
      $errMsg = 'Такая категория уже есть!';
    } else {
      $topic = [
        'name' => $name,
        'description' => $descr
      ];

      $id = insert('topics', $topic);
      $topic = selectOne('topics', ['id' => $id]);
      header('location: ' . BASE_URL . 'admin/topics');
    }
  }
}

// Код формы изменения категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {
  $name = trim($_POST['name']);
  $descr = trim($_POST['description']);

  if ($name === '' || $descr === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($name, 'UTF-8') < 2) {
    $errMsg = 'Категория должна быть больше 2 символов!';
  } else {
    $topic = [
      'name' => $name,
      'description' => $descr
    ];
    $id = $_POST['id'];
    update('topics', $id, $topic);
    header('location: ' . BASE_URL . 'admin/topics');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $topic = selectOne('topics', ['id' => $id]);
  $name = $topic['name'];
  $descr = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];
  deleteRow('topics', $id);
  header('location: ' . BASE_URL . 'admin/topics');
}