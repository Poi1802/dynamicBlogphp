<?php include __DIR__ . '/path.php'; ?>
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, dolor!
        </h3>
        <div class="content__inner">
          <div class="post">
            <div class="post__image">
              <img src="./image/img-3.jpg" alt="" />
            </div>
            <div class="post__info">
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
              <h3 class="post-title">Lorem ipsum dolor sit amet.</h3>
              <div class="post__info-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi maiores non
                tenetur quibusdam inventore atque repellat quaerat asperiores obcaecati soluta
                quisquam reprehenderit corporis saepe a eum, nobis dignissimos! Dolorum, enim! Eos
                quo excepturi explicabo, eum nihil voluptatibus quis soluta at deleniti. Sapiente
                aperiam architecto amet perferendis dolorum? Quas inventore quaerat, voluptates,
                amet eveniet ipsum eligendi impedit cumque at tempore culpa! Doloribus vel dicta,
                reprehenderit quas similique, suscipit explicabo reiciendis facere placeat ab
                maiores nisi possimus odit cum. Sint suscipit iste id qui quaerat aliquam possimus
                repellat. Voluptate placeat autem magnam. Inventore earum quisquam voluptatem
                sapiente fugit ipsum aliquid necessitatibus dolores unde deleniti illo
                voluptatibus, vero illum cum molestias repellendus tenetur ipsam odit sequi quis
                assumenda tempore! Error tempora laboriosam voluptatem! Perferendis maxime
                corrupti nisi enim quas illum reiciendis doloremque. Voluptates, magni. Veniam
                exercitationem, dicta amet a illo non repellendus cumque animi deserunt ex
                molestias assumenda mollitia ea quisquam placeat velit? Impedit illum quaerat
                dolores modi minima consequuntur repudiandae laborum qui blanditiis doloribus
                dolorum, eos obcaecati vero eaque doloremque delectus, incidunt quisquam error
                nemo voluptate! Autem nostrum eveniet nobis nemo consectetur! Deleniti odit autem
                eaque impedit ratione quam rerum dolorum voluptatibus, saepe vitae quaerat cumque
                numquam voluptas repellat voluptatem eius, qui itaque a, quod voluptate.
                Excepturi, illum rerum! Ratione, aperiam deserunt? Natus unde totam placeat quia
                libero similique voluptatibus saepe omnis non beatae architecto aliquam corporis,
                eius voluptate, quo quae vel laudantium expedita! Maxime optio, dolorum laudantium
                reiciendis ipsa repudiandae saepe! Deleniti id consequuntur autem ipsa quaerat
                dignissimos blanditiis alias molestias cum enim, fuga numquam? Et doloremque
                obcaecati, temporibus tempore facere corporis iste veritatis vero eius commodi
                iure, autem dolorem id! Ratione, ipsum! Dolores consequuntur iure accusantium,
                quam possimus odit eum veniam dolor eaque quod ratione, sapiente a nesciunt
                assumenda! Numquam sit nobis possimus architecto aliquid ratione ipsum provident
                placeat aliquam.
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
                <li class="categories__list">Програмированние</li>
                <li class="categories__list">Дизайн</li>
                <li class="categories__list">Кейсы</li>
                <li class="categories__list">Мотивация</li>
                <li class="categories__list">Успех</li>
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