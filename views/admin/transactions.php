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
            <h2>Транзакции</h2>
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
                                        <th scope="col" class="lato-strong">Номер транзакции</th>
                                        <th scope="col" class="lato-strong">Вид</th>
                                        <th scope="col" class="lato-strong">Категория</th>
                                        <th scope="col" class="lato-strong">Метод оплаты</th>
                                        <th scope="col" class="lato-strong">Количество</th>
                                        <th scope="col" class="lato-strong">Дата</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //Показать все записи в таблице
                                    $transactionModel = new \models\TransactionModel();
                                    if ($transaction_array = $transactionModel->getAllDsc() ?? null) {
                                        foreach ($transaction_array as $transactions) {
                                            echo "<tr>";
                                            echo "<td>" . $transactions["transaction_id"] . "</td>";
                                            echo "<td>" . $transactions["type"] . "</td>";
                                            echo "<td>" . $transactions["category"] . "</td>";
                                            echo "<td>" . $transactions["payment_method"] . "</td>";
                                            echo "<td>" . $transactions["amount"] . "</td>";
                                            echo "<td>" . $transactions["date"] . "</td>";
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