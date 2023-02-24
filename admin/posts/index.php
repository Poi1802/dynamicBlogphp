<?php
include "../../path.php";
require_once SITE_ROOT . '/app/controllers/posts.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My blog</title>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/0b50121546.js" crossorigin="anonymous"></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <!-- My css -->
  <link rel="stylesheet" href="../../assets/css/norm.css" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <link rel="stylesheet" href="../../assets/css/admin.css" />
</head>

<body>
  <div class=" wrapper">
    <?php include "../../app/include/header-admin.php" ?>

    <section class="content">
      <div class="container">
        <div class="content__inner ">
          <div class="content__sidebar">
            <?php include "../../app/include/categories-admin.php" ?>
          </div>
          <div class="posts">
            <div class="posts-table ">
              <h2 class="table-title">Управление статьями</h2>
              <div class="button-add">
                <a href="create.php" class="btn btn-succes">Создать статью</a>
              </div>
              <div class="row-admin">
                <div class="id">ID</div>
                <div class="title">Название</div>
                <div class="auth">Автор</div>
                <div class="manage">Управление</div>
              </div>

              <div class="posts-rows">
                <?php foreach ($postsAdm as $key => $post): ?>
                  <div class="post-row">
                    <div class="id">
                      <?= $key + 1 ?>
                    </div>
                    <div class="title">
                      <?= strlen($post['title']) > 50 ? mb_substr($post['title'], 0, 40) . '...' : $post['title'] ?>
                    </div>
                    <div class="auth">
                      <?= $post['username'] ?>
                    </div>
                    <div class="edit">
                      <a href="edit.php?id=<?= $post['id'] ?>">Редакт.</a>
                    </div>
                    <div class="del">
                      <a href="edit.php?del_id=<?= $post['id'] ?>">Удалить</a>
                    </div>
                    <div class="publish">
                      <?php if ($post['status']): ?>
                        <a href="edit.php?publ=0&id=<?= $post['id'] ?>">unpublish</a>
                      <?php else: ?>
                        <a href="edit.php?publ=1&id=<?= $post['id'] ?>">publish</a>
                      <?php endif ?>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <?php include "../../app/include/footer.php"; ?>
  </div>
  <!-- bootstrap scriprt -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>