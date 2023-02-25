<?php
include 'path.php';
include 'app/controllers/topics.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$offset = $limit * ($page - 1);
$totalPages = round(countOfPublPosts('posts') / $limit);

$postsAdm = selectPostsOfUsersPubl('users', 'posts', $limit, $offset);
$topPosts = selectAll('posts', ['id_topic' => 12, 'status' => 1]);

if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
  $postsAdm = selectPostsOfUsersPubl('users', 'posts', $limit, $offset, $cat_id);
  $totalPages = round(countOfPublPosts('posts', $cat_id) / $limit);
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

    <section class="carousel">
      <div class="container">
        <div class="row">
          <h2 class="carousel__title">Топ публикации</h2>
        </div>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php foreach ($topPosts as $key => $topPost): ?>
              <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                <img src="./assets/image/posts/<?= $topPost['img'] ?>" class="d-block w-100"
                  alt="<?= $topPost['title'] ?>" />
                <div class="carousel-caption d-none d-md-block">
                  <h5><a href="single.php?post_id=<?= $topPost['id'] ?>">
                      <?= strlen($topPost['title']) > 55 ? mb_substr($topPost['title'], 0, 55) . '...' : $topPost['title'] ?>
                    </a></h5>
                </div>
              </div>
            <?php endforeach ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container">
        <h3 class="content__title">Последние публикации</h3>
        <div class="content__inner">
          <div class="posts">
            <?php if ($postsAdm): ?>
              <?php foreach ($postsAdm as $key => $post): ?>
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
                      <?= mb_substr($content, 0, 160) . '...' ?>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php else: ?>
              <h4>
                <i>К сожалению статей нет :(</i>
              </h4>
            <?php endif ?>
            <?php if ($postsAdm) {
              include SITE_ROOT . '/app/include/pagination.php';
            } ?>
          </div>
          <div class="content__sidebar">
            <form class="search" action="search.php" method="post">
              <h3 class="search__title">Поиск</h3>
              <input name="search-text" class="search__input" type="text" placeholder="Веддите искомое слово..." />
            </form>
            <div class="categories">
              <h3 class="categories__title">Категории</h3>
              <ul class="categories__lists">
                <?php foreach ($topics as $topic): ?>
                  <li class="categories__list"><a href="?cat_id=<?= $topic['id'] ?>">
                      <?= $topic['name'] ?>
                    </a></li>
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