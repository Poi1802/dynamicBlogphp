<?php
if ($_FILES['img']['size'] > 0) {
  $imgName = time() . '_' . $_FILES['img']['name'];
  $imgTmpName = $_FILES['img']['tmp_name'];
  $imgType = $_FILES['img']['type'];
  $destination = ROOT_PATH . "/assets/image/posts/" . $imgName;

  if (explode('/', $imgType)[0] !== 'image') {
    $errMsg[] = 'Можно загружать только картинки';
  } elseif ($_FILES['img']['size'] > 2097152) {
    $errMsg[] = 'Изображение не должно быть дольше 2МБ';
  } else {

    $_POST['img'] = $imgName;

  }
} else {
  $errMsg[] = 'Ошибка получения картинки';
}