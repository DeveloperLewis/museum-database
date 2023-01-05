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
            <h2>Инвентарь</h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                    <div id="articles-panel">

                        <?php
                    
                        if ($vars['success'] ?? null) {
                            showSuccess($vars['success']);
                        }
                        ?>

                        <div class="mb-4">
                            <div class="row">

                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="btn btn-danger" href="/"><i class="fa-solid fa-arrow-left"></i> Назад</a>
                                        <a class="btn btn-primary" href="/inventory/new">Добавить новый предмет</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="lato-strong">Номер предмета</th>
                                    <th scope="col" class="lato-strong">Название</th>
                                    <th scope="col" class="lato-strong">Страна происхождения</th>
                                    <th scope="col" class="lato-strong">Возраст</th>
                                    <th scope="col" class="lato-strong">Стоимость</th>
                                    <th scope="col" class="lato-strong">Дата получения</th>
                                    <th scope="col" class="lato-strong">Местонахождение(номер комнаты)</th>
                                    <th scope="col" class="lato-strong">Технический статус</th>
                                    <th scope="col" class="lato-strong">Техническое обслуживание</th>
                                    <th scope="col" class="lato-strong">Удалить</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                //Показать все записи в таблице
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

                                        //Кнопка журнала технического обслуживания
                                        echo '<form action="/maintenance" method="get">';
                                        echo '<input type="hidden" value="' . $items['item_id'] .'" name="id">';
                                        echo '<td><button class="btn btn-success" type="submit">Logs</button></td>';
                                        echo '</form>';

                                        //Кнопка удаления 
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