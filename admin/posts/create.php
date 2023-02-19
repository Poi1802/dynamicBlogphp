<?php
include "../../path.php";
session_start();
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
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700;800;900&display=swap"
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
    <?php include "../../app/include/header-admin.php"; ?>

    <section class="content">
      <div class="container">
        <div class="content__inner ">
          <div class="content__sidebar">
            <div class="categories">
              <h3 class="categories__title">Админ-панель</h3>
              <ul class="categories__lists">
                <li class="categories__list"><a href="<?php echo BASE_URL . 'admin/posts' ?>">Записи</a></li>
                <li class="categories__list"><a href="<?php echo BASE_URL . 'admin/topics' ?>">Категории</a></li>
                <li class="categories__list"><a href="<?php echo BASE_URL . 'admin/users' ?>">Пользователи</a></li>
              </ul>
            </div>
          </div>
          <div class="posts">
            <div class="posts-table ">
              <h2 class="table-title"><strong>Добавление статьи</strong></h2>
              <form action="create.php" method="post">
                <div class="col">
                  <label for="exampleFormControlInput1" class="form-label">Название статьи</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="col">
                  <label for="exampleFormControlTextarea1" class="form-label">Содержимое статьи</label>
                  <textarea class="form-control" id="editor" rows="3"></textarea>
                </div>
                <div class="input-group col">
                  <input type="file" class="form-control" id="inputGroupFile02">
                  <label class="input-group-text" for="inputGroupFile02">Картинка</label>
                </div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
                <div class="col">
                  <button class="btn btn-primary" type="submit">Добавить запись</button>
                </div>
              </form>
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
  <!-- CKEditor редактирование текста поста при написании -->
  <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
  <script src="../../assets/js/scripts.js"></script>
</body>

</html>