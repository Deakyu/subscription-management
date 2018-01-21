<nav class="nav">
    <ul class="nav__navbar">
        <li class="nav__item"><a href="/" style="font-size:22px;font-weight:bold;"><?= SITENAME; ?></a></li>

        <button class="nav__item nav__item--right nav__dropdown-btn">
            <a><i class="fa fa-bars"></i></a>
        </button>
        <div class="nav__menu">
            <?php if(isset($_SESSION['user_id'])): ?>
                <!-- Logged in users see this -->
                <li class="nav__item nav__item--right"><a href="<?= URLROOT.'/user/logout'; ?>">LOGOUT</a></li>
                <li class="nav__item nav__item--right"><a href="<?= URLROOT.'/cards'; ?>">CARDS</a></li>
                <li class="nav__item nav__item--right"><a href="<?= URLROOT.'/subscriptions'; ?>">SUBSCRIPTIONS</a></li>
            <?php else: ?>
                <!-- Guests see this -->
                <li class="nav__item nav__item--right"><a href="<?= URLROOT.'/user/register'; ?>">REGISTER</a></li>
                <li class="nav__item nav__item--right"><a href="<?= URLROOT.'/user/login'; ?>">LOGIN</a></li>
            <?php endif; ?>
        </div>

    </ul>
</nav>