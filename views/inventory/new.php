<?php
/* @var $errors_array */
/* @var $vars */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('views/includes/header.php'); ?>
</head>
<body>
<?php require_once('views/includes/nav.php'); ?>

<div class="container">
    <div class="col-12">

        <?php
        if ($errors_array ?? null) {
            showErrors($errors_array);
        }
        ?>

        <div class="row m-4">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 text-white">
                <form action="/inventory/new" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>Страна происхождения</label>
                        <input type="text" class="form-control" name="origin_country" value="">
                    </div>

                    <div class="col-md-4">
                        <label>Возраст</label>
                        <input type="text" class="form-control" name="age" value="">
                    </div>

                    <div class="col-md-4">
                        <label>Стоимость</label>
                        <input type="text" class="form-control" name="estimated_value" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>Дата получения</label>
                        <input type="date" class="form-control" name="acquired_date" value="">
                    </div>

                    <div class="col-md-4">
                        <label>Местонахождение(номер комнаты)</label>
                        <input type="text" class="form-control" name="location_room" value="">
                    </div>

                    <div class="col-md-4">
                        <label>Технический статус</label>
                        <input type="text" class="form-control" name="maintenance_status" value="">
                    </div>
                </div>
                    <button class="btn btn-primary mt-2 float-end" type="submit">Добавить</button>
                    <a class="btn btn-danger mt-2 float-start" href="/inventory">Удалить</a>
                </form>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</div>
</div>
<?php require_once('views/includes/footer.php'); ?>
</body>
</html>