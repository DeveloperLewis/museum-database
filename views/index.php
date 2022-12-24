<!DOCTYPE html>
<html lang="en">
<?php require_once('includes/header.php'); ?>
<body>
<?php require_once('includes/nav.php'); ?>


<div class="p-5 mb-4 text-white hero-image">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">Worlds of Micro Discovery</h1>
        <p class="col-md-6 fs-5">Cras pharetra, est id accumsan interdum, lorem velit consequat ligula, ut feugiat lorem nibh quis dolor. Nullam risus dolor, tempor non vehicula sed, porta non nulla. </p>
        <button class="btn bg-dark text-white rounded-0 btn-lg" type="button">Learn More</button>
    </div>
</div>
<div class="container">
    <div class="row">
            <div class="col-md-8 text-white">
                <h2><strong>Great Employment when working with the vault. Strong benefits for you and your family.</strong></h2>
            </div>

            <div class="col-md-4 text-white">
                <h3><strong>Free entry – book online</strong></h3>
                <h3><strong>Open today: 10.00–17.00</strong></h3>
                <h3><strong>Last entry: 16.00</strong></h3>
            </div>
    </div>

    <hr class="text-white">

    <div class="row">
        <div class="col-md-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/1.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/1.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card" style="width: 26rem; margin: auto;">
                <img class="card-img-top" src="/public/imgs/1.jpg">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isloggedIn()) {
    echo '<p class="text-center text-white">';
    echo 'You are logged in, ';
    echo  $vars["username"] ?? "";
    echo '</p>';
}
?>

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