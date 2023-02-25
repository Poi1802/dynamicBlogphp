<?php
include "../../path.php";
include SITE_ROOT . "/app/database/db.php";

$commentsAdm = selectAll('comments');
$postId = isset($_POST['post-id']) ? $_POST['post-id'] : '';
$user = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$content = '';
$errMsg = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-comm'])) {
  $content = trim($_POST['comm-content']);

  if ($content === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($content, 'UTF-8') < 10) {
    $errMsg[] = 'Комментарий должен быть больше 20 символов!';
  } else {

    $comment = [
      'id_post' => $postId,
      'comment' => $content,
      'user' => $user
    ];

    insert('comments', $comment);
    header('location: ' . BASE_URL . '/single.php?post_id=' . $postId);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-comm'])) {
  $content = trim($_POST['comm-content']);
  $commId = $_POST['comm-id'];
  if ($content === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($content, 'UTF-8') < 10) {
    $errMsg[] = 'Комментарий должен быть больше 10 символов!';
  } else {

    $comment = [
      'comment' => $content
    ];

    $res = update('comments', $commId, $comment);
    header('location: ' . BASE_URL . '/single.php?post_id=' . $postId);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  deleteRow('comments', $_GET['del_id']);
  header('location: ' . BASE_URL . 'user/comments');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post'])) {
  $postId = $_GET['post'];
  deleteRow('comments', $_GET['del_id-user']);
  header('location: ' . BASE_URL . "/single.php?post_id=$postId");
}

// header('location: ' . BASE_URL . 'single.php?post_id=' . $postId);