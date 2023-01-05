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
            <h2>Посетители</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">
                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="lato-strong">Номер посетителя</th>
                                        <th scope="col" class="lato-strong">Время входа</th>
                                        <th scope="col" class="lato-strong">Время выхода</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //Показать все записи в таблице
                                    $visitorModel = new \models\VisitorModel();
                                    if ($visitors_array = $visitorModel->getAllDsc() ?? null) {
                                        foreach ($visitors_array as $visitors) {
                                            echo "<tr>";
                                            echo "<td>" . $visitors["visitor_id"] . "</td>";
                                            echo "<td>" . $visitors["entry_date"] . "</td>";
                                            echo "<td>" . $visitors["exit_date"] . "</td>";

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