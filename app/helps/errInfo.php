<?php
// dump($_COOKIE);
if (isset($_COOKIE['err'])) {
  $errMsg[] = $_COOKIE['err'];
}
?>
<?php if (count($errMsg)): ?>
  <?php foreach ($errMsg as $err): ?>
    <li>
      <?= $err ?>
    </li>
  <?php endforeach ?>
<?php endif ?>