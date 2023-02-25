<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
      <a class="page-link" href='<?= isset($_GET['cat_id']) ? "?cat_id=$cat_id&" : '?' ?>page=1'>First</a>
    </li>
    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="<?= isset($_GET['cat_id']) ? "?cat_id=$cat_id&" : '?' ?>page=<?= $page - 1 ?>">Prev</a>
    </li>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $page == $i ? 'active' : '' ?>">
        <a class="page-link" href="<?= isset($_GET['cat_id']) ? "?cat_id=$cat_id&" : '?' ?>page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor ?>
    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
      <a class="page-link" href="<?= isset($_GET['cat_id']) ? "?cat_id=$cat_id&" : '?' ?>page=<?= $page + 1 ?>">Next</a>
    </li>
  </ul>
</nav>