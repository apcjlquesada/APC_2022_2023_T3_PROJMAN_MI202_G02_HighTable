<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<script>
    $(document).ready(function() {
        $('.add-button').click(function() {
            var id = $(this).data('id');
            var qty = $('#ingredient_add' + id).val();

            $.ajax({
                url: 'updateInventoryAdd.php',
                type: 'POST',
                data: {
                    id: id,
                    qty: qty
                },
                success: function(response) {
                    $('#available_qty' + id).text(response);
                }
            });
        });

        $('.minus-button').click(function() {
            var id = $(this).data('id');
            var qty = $('#ingredient_minus' + id).val();

            $.ajax({
                url: 'updateInventoryMinus.php',
                type: 'POST',
                data: {
                    id: id,
                    qty: qty,
                    action: 'minus'
                },
                success: function(response) {
                    $('#available_qty' + id).text(response);
                }
            });
        });
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Inventory
                    <a href="addInventory.php" class="btn btn-outline-light float-end">Add Ingredient</a>
                    </h4>
                </div>
                <div class="card-body" id="inventory_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ingredient</th>
                                <th>Available Qty</th>
                                <th class="w-20">Add Qty</th>
                                <th class="w-20">Pull Out Qty</th>
                                <th>Measurement</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $inventory = getAll("inventory");

                                    if(mysqli_num_rows($inventory) > 0){
                                        foreach($inventory as $item){
                                            ?>
                                                <tr>
                                                    <td><?= $item['name'] ?></td>
                                                    <td id="available_qty<?= $item['id']; ?>"><?= $item['qty'] ?></td>
                                                    <td>
                                                        <input type="number" class="mt-2 w-70" id="ingredient_add<?= $item['id']; ?>" name="add_qty">
                                                        <button type="button" class="m-1 add-button btn btn-success btn-sm" data-id="<?= $item['id']; ?>" onclick="refreshPage()">+</button>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="mt-2 w-70" id="ingredient_minus<?= $item['id']; ?>" name="minus_qty">
                                                        <button type="button" class="m-1 minus-button btn btn-danger btn-sm" data-id="<?= $item['id']; ?>" onclick="refreshPage()">-</button>
                                                    </td>
                                                    <td><?= $item['measurement'] ?></td>
                                                    <td><?= $item['updated_at'] ?></td>
                                                    <td>
                                                        <a href="editInventory.php?id=<?= $item['id'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <button type="button" class="btn btn-danger delete_inventory_btn" value="<?= $item['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                                    </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No records found.";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>