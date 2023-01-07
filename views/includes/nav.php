<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fs-5">
                <li class="nav-item text-center">
                    <a class="nav-link" href="/">Главная</a>
                </li>

                <?php
                    if (isLoggedIn()) {
                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/inventory">Инвентарь</a>';
                        echo '</li>';

                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/transactions">Транзакции</a>';
                        echo '</li>';
                    }
                ?>

                <li class="nav-item text-center">
                    <a class="nav-link" href="/"><span class="text-white"><strong>Национальный музей мировой истории</strong></span></a>
                </li>

                <?php
                    if (isLoggedIn()) {
                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/staff">Персонал</a>';
                        echo '</li>';

                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/visitors">Посетители</a>';
                        echo '</li>';

                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/user/logout">Выход</a>';
                        echo '</li>';

                    } else {
                        echo '<li class="nav-item text-center">';
                        echo    '<a class="nav-link" href="/user/login">Вход</a>';
                        echo '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

