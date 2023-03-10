<?php
require_once "../../app/controllers/commentaries.php";
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
            <?php include "../../app/include/categories-user.php" ?>
          </div>
          <div class="posts comments">
            <div class="posts-table ">
              <h2 class="table-title">Управление комментариями</h2>
              <div class="row-admin">
                <div class="id">ID POST</div>
                <div class="title">Коммент</div>
                <div class="manage">Управление</div>
              </div>

              <div class="comments-rows">
                <?php foreach ($commentsAdm as $key => $comment): ?>
                  <?php if ($comment['user'] === $_SESSION['login']): ?>
                    <div class="post-row">
                      <div class="id">
                        <?= $comment['id_post'] ?>
                      </div>
                      <div class=" title">
                        <a href="<?= BASE_URL ?>single.php?post_id=<?= $comment['id_post'] ?>">
                          <a href="<?= BASE_URL ?>single.php?post_id=<?= $comment['id_post'] ?>">
                            <?= strlen($comment['comment']) > 120 ? mb_substr($comment['comment'], 0, 120) . '...' : $comment['comment'] ?>
                          </a>
                        </a>
                      </div>
                      <div class="edit">
                        <a href=<?= BASE_URL . "single.php?post_id=$comment[id_post]&edit=1" ?>>Редакт.</a>
                      </div>
                      <div class="del">
                        <a href="?del_id=<?= $comment['id'] ?>">Удалить</a>
                      </div>
                    </div>
                  <?php endif ?>
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