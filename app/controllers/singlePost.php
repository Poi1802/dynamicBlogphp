<?php
require_once SITE_ROOT . "/app/database/db.php";

if (isset($_GET['post_id'])) {
  $id = $_GET['post_id'];
  $post = selectPostsOfUser('users', 'posts', $id);
}