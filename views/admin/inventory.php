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
            <h2>Inventory Items</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">

                        <?php
                        //
                        if ($errors_array ?? null) {
                            showErrors($errors_array);
                        }

                        //display that article success messages
                        if ($vars['success'] ?? null) {
                            showSuccess($vars['success']);
                        }
                        ?>

                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
                                        <a class="btn btn-primary" href="/inventory/new">Add New Item</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="lato-strong">Item Id</th>
                                    <th scope="col" class="lato-strong">Name</th>
                                    <th scope="col" class="lato-strong">Origin Country</th>
                                    <th scope="col" class="lato-strong">Age</th>
                                    <th scope="col" class="lato-strong">Estimated Value</th>
                                    <th scope="col" class="lato-strong">Acquired Date</th>
                                    <th scope="col" class="lato-strong">Location Room</th>
                                    <th scope="col" class="lato-strong">Maintenance Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                //Display all articles in the table
                                $inventoryModel = new \models\InventoryModel();
                                if ($inventory_array = $inventoryModel->getAllDsc() ?? null) {
                                    foreach ($inventory_array as $items) {
                                        echo "<tr>";
                                        echo "<td>" . $items["item_id"] . "</td>";
                                        echo "<td>" . $items["name"] . "</td>";
                                        echo "<td>" . $items["origin_country"] . "</td>";
                                        echo "<td>" . $items["age"] . "</td>";
                                        echo "<td>" . $items["estimated_value"] . "</td>";
                                        echo "<td>" . $items["acquired_date"] . "</td>";
                                        echo "<td>" . $items["location_room"] . "</td>";
                                        echo "<td>" . $items["maintenance_status"] . "</td>";
                                        //Delete button with form
                                        echo '<form action="/inventory/delete" method="post">';
                                        echo '<input type="hidden" value="' . $items['item_id'] .'" name="id">';
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