<?php
require_once SITE_ROOT . "/app/database/db.php";

$topics = selectAll('topics');
$posts = selectAll('posts');

$errMsg = '';
$title = '';
$content = '';
$idTopic = '';
$img = '';
$id = '';

// Код формы добавления категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $img = trim($_POST['img']);
  $idTopic = $_POST['id_topic'];
  $publish = $_POST['publish'] ? 1 : 0;

  if ($title === '' || $content === '' || $idTopic === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($title, 'UTF-8') < 8) {
    $errMsg = 'Название записи должно быть больше 8-и символов!';
  } else {
    $post = [
      'title' => $title,
      'content' => $content,
      'status' => $publish,
      'img' => $img,
      'id_topic' => $idTopic,
      'id_user' => $_SESSION['id']
    ];

    $id = insert('posts', $post);
    $post = selectOne('posts', ['id' => $id]);
    header('location: ' . BASE_URL . 'admin/posts');
  }
}

// Код формы изменения категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $img = trim($_POST['img']);
  $idTopic = $_POST['id_topic'];

  if ($title === '' || $content === '' || $idTopic === '') {
    $errMsg = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($title, 'UTF-8') < 8) {
    $errMsg = 'Название записи должно быть больше 8-и символов!';
  } else {
    $post = [
      'title' => $title,
      'content' => $content,
      'status' => 1,
      'id_topic' => $idTopic
    ];
    $id = $_POST['id'];
    update('posts', $id, $post);
    header('location: ' . BASE_URL . 'admin/posts');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $post = selectOne('posts', ['id' => $id]);
  $topic = selectOne('topics', ['id' => $post['id_topic']]);
  $title = $post['title'];
  $content = $post['content'];
  $img = $post['img'];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];
  deleteRow('posts', $id);
  header('location: ' . BASE_URL . 'admin/posts');
}