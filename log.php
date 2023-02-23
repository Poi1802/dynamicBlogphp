<?php
include __DIR__ . '/path.php';
include __DIR__ . '/app/database/db.php';
require_once __DIR__ . '/app/controllers/users.php';
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
</head>

<body>
  <div class="wrapper">
    <?php include __DIR__ . '/app/include/header.php'; ?>

    <section class="reg">
      <div class="container">
        <div class="reg__inner">
          <h2 class="reg-title">Авторизация</h2>
          <div class="reg-error">
            <?php include SITE_ROOT . '/app/helps/errInfo.php' ?>
          </div>
          <form method="post" action="log.php">
            <div class="mb-3">
              <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
              <input name="login" type="text" class="form-control" value="<?= $login ?>" id="formGroupExampleInput"
                placeholder="Введите ваш логин..." />
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Пароль</label>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                placeholder="Введите ваш пароль..." />
            </div>
            <div class="form__buttons">
              <button type="submit" name="btn-log" class="form__button form__button-reg btn btn-primary">
                Войти
              </button>
              <a class="form__button form__button-log btn btn-primary" href="reg.php">
                Регистрация
              </a>
            </div>
          </form>
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