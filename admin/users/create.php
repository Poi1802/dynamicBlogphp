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
    <?php include "../../app/include/header-admin.php"; ?>

    <section class="content">
      <div class="container">
        <div class="content__inner ">
          <div class="content__sidebar">
            <?php include "../../app/include/categories-admin.php" ?>
          </div>
          <div class="posts">
            <div class="posts-table ">
              <h2 class="table-title">Добавление категории</h2>
              <form action="create.php" method="post">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Задайте логин</label>
                  <input name="login" value="" type="text" class="form-control" id="formGroupExampleInput" />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input name="email" value="" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" />
                  <div id="emailHelp" class="form-text">
                    Ваш email адрес не будет использован для спама
                  </div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Задайте пароль</label>
                  <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" />
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
                  <input name="pass-second" type="password" class="form-control" id="exampleInputPassword1" />
                </div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>User</option>
                  <option value="1">Admin</option>
                </select>
                <div class="col">
                  <button class="btn btn-primary" type="submit">Добавить пользователя</button>
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
</body>

</html>