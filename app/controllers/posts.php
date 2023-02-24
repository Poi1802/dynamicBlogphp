<?php
require_once SITE_ROOT . "/app/database/db.php";

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectPostsOfUsers('users', 'posts');

$errMsg = [];
$title = '';
$content = '';
$idTopic = '';
$_POST['img'] = '';
$id = '';



// Код формы добавления категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

  include SITE_ROOT . '/app/helps/checkImg.php';

  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $img = $_POST['img'];
  $idTopic = $_POST['id_topic'];
  $publish = isset($_POST['publish']) ? 1 : 0;

  if ($title === '' || $content === '' || $idTopic === '' || $img === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($title, 'UTF-8') < 8) {
    $errMsg[] = 'Название записи должно быть больше 8-и символов!';
  } elseif (!is_numeric($idTopic)) {
    $errMsg[] = 'Выберите категорию';
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
    move_uploaded_file($imgTmpName, $destination);
    header('location: ' . BASE_URL . 'admin/posts');
  }
}

// Код формы изменения категорий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {

  include SITE_ROOT . '/app/helps/checkImg.php';

  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $img = trim($_POST['img']);
  $publish = $_POST['publish'] ? 1 : 0;
  $idTopic = $_POST['id_topic'];

  if ($title === '' || $content === '' || $idTopic === '') {
    $errMsg = 'Все поля должны быть заполнены';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . "/admin/posts/edit.php?id=" . $_POST['id']);
  } elseif (mb_strlen($title, 'UTF-8') < 8) {
    $errMsg = 'Название записи должно быть больше 8-и символов!';
    setcookie('err', $errMsg, time() + 1);
    header('location: ' . BASE_URL . '/admin/posts/edit.php?id=' . $_POST['id']);
  } else {
    $post = [
      'title' => $title,
      'content' => $content,
      'status' => $publish,
      'id_topic' => $idTopic,
      'img' => $img ? $img : $_POST['img_old'],
    ];

    $id = $_POST['id'];
    $res = update('posts', $id, $post);

    if ($img) {
      move_uploaded_file($imgTmpName, $destination);
      unlink(ROOT_PATH . '/assets/image/posts/' . $_POST['img_old']);
    }
    unset($_SESSION['errMsg']);
    header('location: ' . BASE_URL . 'admin/posts');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $post = selectOne('posts', ['id' => $id]);
  $topic = selectOne('topics', ['id' => $post['id_topic']]);

  $title = $post['title'];
  $content = $post['content'];
  $publish = $post['status'];
  $img = $post['img'];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];
  $post = selectOne('posts', ['id' => $id]);
  unlink(ROOT_PATH . '/assets/image/posts/' . $post['img']);
  deleteRow('posts', $id);
  header('location: ' . BASE_URL . 'admin/posts');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['publ'])) {
  $id = $_GET['id'];
  update('posts', $id, ['status' => $_GET['publ']]);
  header('location: ' . BASE_URL . 'admin/posts');
}