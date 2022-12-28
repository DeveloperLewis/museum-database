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
            <h2>Transactions</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">
                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="lato-strong">Transaction Id</th>
                                        <th scope="col" class="lato-strong">Type</th>
                                        <th scope="col" class="lato-strong">Category</th>
                                        <th scope="col" class="lato-strong">Payment Method</th>
                                        <th scope="col" class="lato-strong">Amount</th>
                                        <th scope="col" class="lato-strong">Date</th>
                                        <th scope="col" class="lato-strong">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    //Display all articles in the table
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

                                            //Delete button with form
                                            echo '<form action="/transactions/delete" method="post">';
                                            echo '<input type="hidden" value="' . $transactions['transaction_id'] .'" name="id">';
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