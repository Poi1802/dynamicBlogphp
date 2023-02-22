<?php if (count($errMsg)): ?>
  <?php foreach ($errMsg as $err): ?>
    <li>
      <?= $err ?>
    </li>
  <?php endforeach ?>
<?php endif ?>