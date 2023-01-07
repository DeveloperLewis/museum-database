<!DOCTYPE html>
<html lang="en">
<?php require_once('views/includes/header.php'); ?>
<body>
<?php require_once('views/includes/nav.php'); ?>
<div class="row">
    <div class="col">

    </div>
    <div class="col-lg-3">
        <div class="card bg-dark text-white mt-5 mx-2">
            <div class="container">
                <div class="m-4">
                    <h3 class="text-center">Вход</h3>
                </div>

                <?php
                //Ошибки
                showErrors($errors_array ?? "");
                showSuccess($vars["success"] ?? "")
                ?>

                <form action="/user/login" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Имя пользователя</label>
                        <input type="text" class="form-control dark-input" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control dark-input" name="password" id="password">
                    </div>
                    <div class="mt-2 mb-2 d-flex justify-content-center">
                        <button class="btn btn-primary flex-fill" type="submit">Вход</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col">

    </div>
</div>
<?php require_once('views/includes/footer.php'); ?>
</body>
</html>

