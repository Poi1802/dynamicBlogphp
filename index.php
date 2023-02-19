<?php
include __DIR__ . '/path.php';
include __DIR__ . '/app/database/db.php';
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
            <div class="carousel-item active">
              <img src="./assets/image/img-1.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="">First slide label</a></h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="./assets/image/img-2.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="">First slide label</a></h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="./assets/image/img-3.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="">First slide label</a></h5>
              </div>
            </div>
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
            <div class="post">
              <div class="post__image">
                <img src="./assets/image/img-3.jpg" alt="" />
              </div>
              <div class="post__info">
                <h4 class="post__info-title">
                  <a href="single.php">Прикольная статья на тему динамического сайта...</a>
                </h4>
                <div class="post__info-user">
                  <div class="user">
                    <i class="fa-regular fa-user"></i>
                    <span>Имя автора</span>
                  </div>
                  <div class="date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Дата</span>
                  </div>
                </div>
                <div class="post__info-text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita voluptas
                  fugiat sint cupiditate officiis dolorem omnis assumenda at fugit quaerat.
                </div>
              </div>
            </div>
            <div class="post">
              <div class="post__image">
                <img src="./assets/image/img-3.jpg" alt="" />
              </div>
              <div class="post__info">
                <h4 class="post__info-title">Прикольная статья на тему динамического сайта...</h4>
                <div class="post__info-user">
                  <div class="user">
                    <i class="fa-regular fa-user"></i>
                    <span>Имя автора</span>
                  </div>
                  <div class="date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Дата</span>
                  </div>
                </div>
                <div class="post__info-text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita voluptas
                  fugiat sint cupiditate officiis dolorem omnis assumenda at fugit quaerat.
                </div>
              </div>
            </div>
            <div class="post">
              <div class="post__image">
                <img src="./assets/image/img-3.jpg" alt="" />
              </div>
              <div class="post__info">
                <h4 class="post__info-title">Прикольная статья на тему динамического сайта...</h4>
                <div class="post__info-user">
                  <div class="user">
                    <i class="fa-regular fa-user"></i>
                    <span>Имя автора</span>
                  </div>
                  <div class="date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Дата</span>
                  </div>
                </div>
                <div class="post__info-text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita voluptas
                  fugiat sint cupiditate officiis dolorem omnis assumenda at fugit quaerat.
                </div>
              </div>
            </div>
            <div class="post">
              <div class="post__image">
                <img src="./assets/image/img-3.jpg" alt="" />
              </div>
              <div class="post__info">
                <h4 class="post__info-title">Прикольная статья на тему динамического сайта...</h4>
                <div class="post__info-user">
                  <div class="user">
                    <i class="fa-regular fa-user"></i>
                    <span>Имя автора</span>
                  </div>
                  <div class="date">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Дата</span>
                  </div>
                </div>
                <div class="post__info-text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita voluptas
                  fugiat sint cupiditate officiis dolorem omnis assumenda at fugit quaerat.
                </div>
              </div>
            </div>
          </div>
          <div class="content__sidebar">
            <div class="search">
              <h3 class="search__title">Поиск</h3>
              <input class="search__input" type="text" placeholder="Веддите искомое слово..." />
            </div>
            <div class="categories">
              <h3 class="categories__title">Категории</h3>
              <ul class="categories__lists">
                <li class="categories__list"><a href="">Програмированние</a></li>
                <li class="categories__list"><a href="">Дизайн</a></li>
                <li class="categories__list"><a href="">Кейсы</a></li>
                <li class="categories__list"><a href="">Мотивация</a></li>
                <li class="categories__list"><a href="">Успех</a></li>
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