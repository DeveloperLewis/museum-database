<?php
/* @var $errors_array */
/* @var $vars */
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('views/includes/header.php')?>
<body>
<?php require_once('views/includes/nav.php'); ?>

<div class="container">
    <div class="m-4">
        <div class="text-center m-4 text-white">
            <h2>Staff Members</h2>
        </div>

        <?php
            showSuccess($vars['success'] ?? null);
        ?>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">
                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
                                        <a class="btn btn-primary" href="/staff/new">Add New Staff Member</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="lato-strong">Staff Id</th>
                                        <th scope="col" class="lato-strong">First Name</th>
                                        <th scope="col" class="lato-strong">Last Name</th>
                                        <th scope="col" class="lato-strong">Address</th>
                                        <th scope="col" class="lato-strong">Contact Number</th>
                                        <th scope="col" class="lato-strong">Position</th>
                                        <th scope="col" class="lato-strong">Salary</th>
                                        <th scope="col" class="lato-strong">Employment Date</th>
                                        <th scope="col" class="lato-strong">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //Display all articles in the table
                                    $staffModel = new \models\StaffModel();
                                    if ($staff_array = $staffModel->getAllDsc() ?? null) {
                                        foreach ($staff_array as $staff) {
                                            echo "<tr>";
                                            echo "<td>" . $staff["staff_id"] . "</td>";
                                            echo "<td>" . $staff["first_name"] . "</td>";
                                            echo "<td>" . $staff["last_name"] . "</td>";
                                            echo "<td>" . $staff["address"] . "</td>";
                                            echo "<td>" . $staff["contact_number"] . "</td>";
                                            echo "<td>" . $staff["position"] . "</td>";
                                            echo "<td>" . $staff["salary"] . "</td>";
                                            echo "<td>" . $staff["employment_date"] . "</td>";

                                            //Delete button with form
                                            echo '<form action="/transactions/delete" method="post">';
                                            echo '<input type="hidden" value="' . $staff['staff_id'] .'" name="id">';
                                            echo '<td><button class="btn btn-danger" type="submit">X</button></td>';
                                            echo '</form>';
                                            echo '</tr>';
                                            echo "</td>";
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('views/includes/footer.php'); ?>
</body>
</html>