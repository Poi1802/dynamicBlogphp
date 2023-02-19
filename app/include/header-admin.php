<header>
  <div class="header">
    <div class="container">
      <div class="header__inner">
        <h1 class="header__logo"><a href="<?php echo BASE_URL; ?>">My blog</a></h1>
        <nav class="header__nav">
          <ul class="header__lists">
            <li class="header__list">
              <i class="fa-solid fa-user"></i>
              <a class="cabinet" href="">
                <?= $_SESSION['login'] ?>
              </a>
            <li class="header__list">
              <a href="<?php echo BASE_URL . 'logout.php' ?>">Выход</a>
            </li>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>