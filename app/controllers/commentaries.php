<?php
include "../../path.php";
include "../database/db.php";

$postId = $_POST['post-id'];
$user = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$content = '';
$errMsg = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-comm'])) {
  $content = trim($_POST['comm-content']);

  if ($content === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($content, 'UTF-8') < 20) {
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