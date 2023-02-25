<?php
include __DIR__ . '/path.php';
include 'app/controllers/topics.php';
include __DIR__ . '/app/controllers/singlePost.php';
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
  <link rel="stylesheet" href="./assets/css/norm.css" />
  <link rel="stylesheet" href="./assets/css/main.css" />
  <link rel="stylesheet" href="./assets/css/single.css" />
</head>

<body>
  <div class="wrapper">
    <?php include __DIR__ . '/app/include/header.php'; ?>
    <section class="content">
      <div class="container">
        <h3 class="content__title">
          <?= $post['title'] ?>
        </h3>
        <div class="content__inner">
          <div class="post single-post">
            <div class="post__image">
              <img src="./assets/image/posts/<?= $post['img'] ?>" alt="" />
            </div>
            <div class="post__info-user">
              <div class="user">
                <i class="fa-regular fa-user"></i>
                <span>
                  <?= $post['username'] ?>
                </span>
              </div>
              <div class="date">
                <i class="fa-solid fa-calendar-days"></i>
                <span>
                  <?= $post['created_date'] ?>
                </span>
              </div>
            </div>
            <div class="post__info">
              <div class="post__info-text">
                <?= $post['content'] ?>
              </div>
            </div>
            <?php include SITE_ROOT . '/app/include/comments.php' ?>
          </div>
          <div class="content__sidebar">
            <div class="search">
              <h3 class="search__title">Поиск</h3>
              <input class="search__input" type="text" placeholder="Веддите искомое слово..." />
            </div>
            <div class="categories">
              <h3 class="categories__title">Категории</h3>
              <ul class="categories__lists">
                <?php foreach ($topics as $topic): ?>
                  <li class="categories__list">
                    <a href="index.php?cat_id=<?= $topic['id'] ?>">
                      <?= $topic['name'] ?>
                    </a>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include __DIR__ . '/app/include/footer.php'; ?>
  </div>
  <!-- bootstrap scriprt -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>