<?php
include "../../path.php";
include "../../app/controllers/users.php";
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
            <?php include "../../app/include/categories-user.php" ?>
          </div>
          <div class="posts">
            <div class="posts-table ">
              <h2 class="table-title">Изменение Пользователя</h2>
              <div class="reg-error">
                <?php include SITE_ROOT . '/app/helps/errInfo.php' ?>
              </div>
              <form action="edit.php" method="post">
                <input name="id" type="hidden" value="<?= $id ?>">
                <?php if (isset($_GET['log'])): ?>
                  <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Измените логин</label>
                    <input name="login" value="<?= $login ?>" type="text" class="form-control"
                      id="formGroupExampleInput" />
                  </div>
                  <div class="col">
                    <button name="edit-user-login" class="btn btn-primary" type="submit">Изменить логин</button>
                  </div>
                <?php endif ?>
                <?php if (isset($_GET['email'])): ?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Измените Email</label>
                    <input name="email" value="<?= $email ?>" type="email" class="form-control" id="exampleInputEmail1"
                      aria-describedby="emailHelp" />
                    <div id="emailHelp" class="form-text">
                      Ваш email адрес не будет использован для спама
                    </div>
                  </div>
                  <div class="col">
                    <button name="edit-user-email" class="btn btn-primary" type="submit">Изменить email</button>
                  </div>
                <?php endif ?>
                <?php if (isset($_GET['pass'])): ?>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Задайте новый пароль</label>
                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" />
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Повторите новый пароль</label>
                    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword1" />
                  </div>
                  <div class="col">
                    <button name="edit-user-pass" class="btn btn-primary" type="submit">Изменить пароль</button>
                  </div>
                <?php endif ?>
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