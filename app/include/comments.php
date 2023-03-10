<?php
$postId = $_GET['post_id'];
$comments = selectAll('comments', ['id_post' => $postId]);

if (isset($_GET['edit'])) {
  $comment = selectOne('comments', ['id_post' => $postId, 'user' => $_SESSION['login']]);
}
?>

<div class="comments">
  <?php if (empty($_SESSION['login'])): ?>
    <h3><a href="<?= BASE_URL . '/log.php' ?>">Авторизуйтесь</a> чтобы оставлять комментарии!</h3>
  <?php else: ?>
    <h3>Комментарии: </h3>
    <?php if (isset($_GET['edit'])): ?>
      <div class="reg-error">
        <?php include SITE_ROOT . '/app/helps/errInfo.php' ?>
      </div>
      <form class="col-8 " action="<?= BASE_URL . '/app/controllers/commentaries.php' ?>" method="post">
        <input name="comm-id" type="hidden" value="<?= $comment['id'] ?>">
        <input name="post-id" type="hidden" value="<?= $_GET['post_id'] ?>">
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Ваш комментарий: </label>
          <textarea name="comm-content" class="form-control" id="exampleFormControlTextarea1"
            placeholder="<?= $_SESSION['login'] . ' введите ваш комментарий (больше 10-и символов)' ?>"
            rows="3"><?= $comment['comment'] ?></textarea>
        </div>
        <button name="edit-comm" class="btn btn-primary" type="submit">Изменить комментарий</button>
      </form>
    <?php else: ?>
      <div class="reg-error">
        <?php include SITE_ROOT . '/app/helps/errInfo.php' ?>
      </div>
      <form class="col-8 " action="<?= BASE_URL . '/app/controllers/commentaries.php' ?>" method="post">
        <input name="post-id" type="hidden" value="<?= $_GET['post_id'] ?>">
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Ваш комментарий: </label>
          <textarea name="comm-content" class="form-control" id="exampleFormControlTextarea1"
            placeholder="<?= $_SESSION['login'] . ' введите ваш комментарий (больше 10-и символов)' ?>" rows="3"></textarea>
        </div>
        <button name="add-comm" class="btn btn-primary" type="submit">Оставить комментарий</button>
      </form>
    <?php endif ?>
  <?php endif ?>
  <?php if ($postId === $_GET['post_id']): ?>
    <?php foreach ($comments as $comment): ?>
      <div class="col-10 comment-block">
        <div class="comment-info">
          <h5 class="comment-user">
            Прокоментировал:
            <?= $comment['user'] ?>
          </h5>
          <div class="comment-date">
            Дата:
            <?= $comment['created'] ?>
          </div>
        </div>
        <div class="comment-content">
          <?= $comment['comment'] ?>
        </div>
        <?php if ($comment['user'] === $_SESSION['login']): ?>
          <?php $commId = $comment['id'] ?>
          <a href="?post_id=<?= $postId ?>&edit=1">Редактировать...</a>
          <a class="delete"
            href="<?= BASE_URL . "app/controllers/commentaries.php?post=$postId&del_id-user=$commId" ?>">Удалить...</a>
        <?php endif ?>
      </div>
    <?php endforeach ?>
  <?php endif ?>
</div>