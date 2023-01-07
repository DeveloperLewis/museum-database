<!DOCTYPE html>
<html lang="en">
<?php require_once('includes/header.php'); ?>
<body>
<?php require_once('includes/nav.php'); ?>


<div class="p-5 mb-4 text-white hero-image">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">Новый взгляд на историю</h1>
        <p class="col-md-6 fs-5">Наши работники трудятся, чтобы создать самый уникальный опыт для посетителей музея</p>
    </div>
</div>
<div class="container">
    <div class="row">
            <div class="col-md-8 text-white">
                <h2><strong>Отличные условия труда и полный социальный пакет для работников музея. Вакансии открыты.</strong></h2>
            </div>

            <div class="col-md-4 text-white">
                <h3><strong>Время работы (ежедневно): 10.00–17.00</strong></h3>
                <h3><strong>Билеты не продаются после 16.00</strong></h3>
            </div>
    </div>

    <hr class="text-white">

    <div class="row">
        <div class="col-xl-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/2.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Музей процветает благодаря своей креативности, изобретательности и любви к обмену и сохранению исторического наследия.</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/4.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">В музее всегда есть чем заняться, вы не заскучаете!</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/5.jpg">
                <div class="card-body">
                    <p class="card-text">Мы всегда заинтереснованы в пополнении персонала. Не упустите свой шанс стать частью нашей команды!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-image {
        background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('/public/imgs/hero.jpg');
        height: 600px;
        background-position: 25% 80%;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<?php require_once('includes/footer.php'); ?>
</body>
</html>