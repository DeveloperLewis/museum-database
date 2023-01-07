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
                <form action="/staff/new" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" value="">
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="">
                        </div>

                        <div class="col-md-6">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="contact_number" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Job Position</label>
                            <input type="text" class="form-control" name="position" value="">
                        </div>

                        <div class="col-md-4">
                            <label>Salary</label>
                            <input type="text" class="form-control" name="salary" value="">
                        </div>

                        <div class="col-md-4">
                            <label>Employment Date</label>
                            <input type="date" class="form-control" name="employment_date" value="">
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2 float-end" type="submit">Add</button>
                    <a class="btn btn-danger mt-2 float-start" href="/staff">Cancel</a>
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