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
                <form action="/maintenance/new" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Staff Member</label>
                            <input type="text" class="form-control" name="staff_id" value="">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <label>Description of Maintenance Performed</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="item_id" value="<?= $_GET['id'] ?? null?>">
                    <button class="btn btn-primary mt-2 float-end" type="submit">Add</button>
                    <a class="btn btn-danger mt-2 float-start" href="/maintenance?id=<?= $_GET['id'] ?? null ?>">Cancel</a>
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
