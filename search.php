<?php
include 'path.php';
include 'app/controllers/topics.php';

if (empty($_GET)) {
  $_SESSION['search'] = $_POST['search-text'];
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$offset = $limit * ($page - 1);
$totalPages = round(countOfSearchPublPosts('posts', $_SESSION['search']) / $limit);

$posts = selectPostsSearched('users', 'posts', $_SESSION['search'], $limit, $offset);

if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
  $posts = selectPostsSearched('users', 'posts', $_SESSION['search'], $limit, $offset, $cat_id);
  $totalPages = round(countOfSearchPublPosts('posts', $_SESSION['search'], $cat_id) / $limit);
}
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
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
  <div class=" wrapper">
    <?php include __DIR__ . '/app/include/header.php'; ?>

    <section class="content">
      <div class="container">
        <h3 class="content__title">Результаты поиска</h3>
        <div class="content__inner">
          <div class="posts">
            <?php if ($posts): ?>
              <?php foreach ($posts as $key => $post): ?>
                <?php $content = strip_tags($post['content'], ['p', 'a', 'ul']) ?>
                <div class="post">
                  <div class="post__image">
                    <img src="./assets/image/posts/<?= $post['img'] ?>" alt="<?= $post['title'] ?>" />
                  </div>
                  <div class="post__info">
                    <h4 class="post__info-title">
                      <a href="single.php?post_id=<?= $post['id'] ?>">
                        <?= strlen($post['title']) > 75 ? mb_substr($post['title'], 0, 75) . '...' : $post['title'] ?>
                      </a>
                    </h4>
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
                    <div class="post__info-text">
                      <?= mb_substr($content, 0, 240) . '...' ?>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php else: ?>
              <h4>
                <i>К сожалению не удалось найти статьи по вашему запросу :(</i>
              </h4>

            <?php endif ?>
            <?php if ($posts) {
              include SITE_ROOT . '/app/include/pagination.php';
            } ?>
          </div>
          <div class="content__sidebar">
            <form class="search" action="search.php" method="post">
              <h3 class="search__title">Поиск</h3>
              <input name="search-text" class="search__input" value="<?= $_SESSION['search'] ?>" type="text"
                placeholder="Веддите искомое слово..." />
            </form>
            <div class="categories">
              <h3 class="categories__title">Категории</h3>
              <ul class="categories__lists">
                <?php foreach ($topics as $topic): ?>
                  <li class="categories__list">
                    <a href="?cat_id=<?= $topic['id'] ?>">
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