<?php
include "../../path.php";
require_once SITE_ROOT . '/app/controllers/posts.php';
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
            <?php include "../../app/include/categories-admin.php" ?>
          </div>
          <div class="posts">
            <div class="posts-table ">
              <h2 class="table-title">Изменение статьи</h2>
              <div class="reg-error">
                <?php include SITE_ROOT . '/app/helps/errInfo.php' ?>
              </div>
              <form action="edit.php" method="post" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?= $id ?>">
                <input name="img_old" type="hidden" value="<?= $img ?>">
                <div class="col">
                  <label for="exampleFormControlInput1" class="form-label">Название статьи (больше 8-и символов)</label>
                  <input name="title" value="<?= $title ?>" type="text" class="form-control"
                    id="exampleFormControlInput1">
                </div>
                <div class="col">
                  <label for="exampleFormControlTextarea1" class="form-label">Содержимое статьи</label>
                  <textarea name="content" class="form-control" id="editor" rows="3"><?= $content ?></textarea>
                </div>
                <div class="input-group col">
                  <input name="img" type="file" class="form-control" id="inputGroupFile02">
                  <label class="input-group-text" for="inputGroupFile02">Изменить:
                    <?= explode('_', $img)[1] ?>
                  </label>
                </div>
                <div class="post__image">
                  <i>Картинка сейчас: </i>
                  <img src="<?= BASE_URL ?>\assets\image\posts\<?= $post['img'] ?>" alt="" />
                </div>
                <p class="label-topic">Категoрия: </p>
                <select name="id_topic" class="form-select" aria-label="Default select example">
                  <option selected value="<?= $topic['id'] ?>">
                    <?= $topic['name'] ?>
                  </option>
                  <?php foreach ($topics as $topic): ?>
                    <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option>
                  <?php endforeach ?>
                </select>
                <div class="mb-3 form-check">
                  <input name="publish" value="1" type="checkbox" class="form-check-input" id="exampleCheck1"
                    <?= $publish ? 'checked' : '' ?>>
                  <label class="form-check-label" for="exampleCheck1">Publish</label>
                </div>
                <div class="col">
                  <button name="edit_post" class="btn btn-primary" type="submit">Изменить запись</button>
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