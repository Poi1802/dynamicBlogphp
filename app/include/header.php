<header>
  <div class="header">
    <div class="container">
      <div class="header__inner">
        <h1 class="header__logo"><a href="<?php echo BASE_URL; ?>">My blog</a></h1>
        <nav class="header__nav">
          <ul class="header__lists">
            <li class="header__list">
              <a href="<?php echo BASE_URL; ?>">Главная</a>
            </li>
            <li class="header__list">
              <a href="#">О нас</a>
            </li>
            <li class="header__list">
              <a href="#">Услуги</a>
            </li>
            <li class="header__list">
              <?php if (isset($_SESSION['id'])): ?>
                <i class="fa-solid fa-user"></i>
                <a class="cabinet" href="">
                  <?= $_SESSION['login'] ?>
                </a>
                <ul class="header__popup">
                  <li class="header__list">
                    <?php if ($_SESSION['admin']): ?>
                      <a href="<?php echo BASE_URL . 'admin/posts' ?>">Админ панель</a>
                    <?php elseif (!$_SESSION['admin']): ?>
                      <a href="<?php echo BASE_URL . 'user/profile' ?>">Панель управления</a>
                    <?php endif; ?>
                  </li>
                  <li class="header__list">
                    <a href="<?php echo BASE_URL . 'logout.php' ?>">Выход</a>
                  </li>
                </ul>
              <?php else: ?>
                <i class="fa-solid fa-user"></i>
                <a class="cabinet" href="<?php echo BASE_URL . 'log.php' ?>"> Войти </a>
                <ul class="header__popup">
                  <li class="header__list">
                    <a href="<?php echo BASE_URL . 'reg.php' ?> ">Регистрация</a>
                  </li>
                </ul>
              <?php endif; ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>