<?php
require_once SITE_ROOT . "/app/database/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
  $id = $_GET['post_id'];
  $post = selectPostsOfUser('users', 'posts', $id);
  // $post = '';
  // foreach ($posts as $val) {
  //   if ($val['id'] == $id) {
  //     $post = $val;
  //   }
  // }
}