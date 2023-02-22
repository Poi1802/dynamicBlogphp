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
  if ($_FILES['img']['size'] > 0) {
    $imgName = time() . '_' . $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgType = $_FILES['img']['type'];
    $destination = ROOT_PATH . "/assets/image/posts/" . $imgName;

    if (explode('/', $imgType)[0] !== 'image') {
      $errMsg[] = 'Можно загружать только картинки';
    } elseif ($_FILES['img']['size'] > 2097152) {
      $errMsg[] = 'Изображение не должно быть дольше 2МБ';
    } else {
      $result = move_uploaded_file($imgTmpName, $destination);
      $result ? $_POST['img'] = $imgName : $errMsg[] = 'Ошибка загрузки картинки на сервер';
    }
  } else {
    $errMsg[] = 'Ошибка получения картинки';
  }

  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $img = $_POST['img'];
  $idTopic = $_POST['id_topic'];
  $publish = isset($_POST['publish']) ? 1 : 0;

  if ($title === '' || $content === '' || $idTopic === '' || $img === '') {
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($title, 'UTF-8') < 6) {
    $errMsg[] = 'Название записи должно быть больше 6-и символов!';
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
    $errMsg[] = 'Все поля должны быть заполнены';
  } elseif (mb_strlen($title, 'UTF-8') < 8) {
    $errMsg[] = 'Название записи должно быть больше 8-и символов!';
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