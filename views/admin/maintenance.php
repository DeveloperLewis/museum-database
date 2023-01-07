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
            <h2>Журнал технического обслуживания</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <?php
                    showSuccess($vars['success'] ?? null);
                ?>

                <div class="col-md-12">
                    <div id="articles-panel">
                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/inventory"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                        <a class="btn btn-primary" href="/maintenance/new?id=<?= $_GET['id'] ?? null ?>">Добавить техническое обслуживание</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="lato-strong">Номер технического обслуживания</th>
                                        <th scope="col" class="lato-strong">Номер персонала</th>
                                        <th scope="col" class="lato-strong">Описание</th>
                                        <th scope="col" class="lato-strong">Дата</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //Показать все записи в таблице
                                    $maintenanceModel = new \models\MaintenanceModel();
                                    if ($maintenance_array = $maintenanceModel->getByItemIdDsc($_GET['id'] ?? null)) {
                                        if (is_array($maintenance_array)) {
                                            foreach ($maintenance_array as $maintenance) {
                                                echo "<tr>";
                                                echo "<td>" . $maintenance["maintenance_id"] . "</td>";
                                                echo "<td>" . $maintenance["staff_id"] . "</td>";
                                                echo "<td>" . $maintenance["description"] . "</td>";
                                                echo "<td>" . $maintenance["date"] . "</td>";
                                            }
                                        } else {
                                            echo '<div class="alert alert-danger" role="alert">';
                                            echo $maintenance_array;
                                            echo '</div>';
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
