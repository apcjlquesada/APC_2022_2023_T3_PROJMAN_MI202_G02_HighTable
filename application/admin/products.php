<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Products
                        <a href="addProduct.php" class="btn btn-outline-light float-end">Add Product</a>
                    </h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $products = getAll("products");

                                if(mysqli_num_rows($products) > 0){
                                    foreach($products as $item){
                                        ?>
                                            <tr>
                                                <td style="width: 300px;"><?= $item['name'] ?></td>
                                                <td style="width: 20px;"><?= number_format($item['selling_price'],2); ?></td>
                                                <td style="width: 80px;">
                                                    <img src="../uploads/<?= $item['image'] ?>" width="80px" height="80px" alt="<?= $item['name'] ?>">
                                                </td>
                                                <td style="width: 130px;"><?= $item['status'] == '0'? "Available":"Unavailable"?></td>
                                                <td style="width: 130px;">
                                                    <a href="editProduct.php?id=<?= $item['id'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <button type="button" class="btn btn-danger delete_product_btn" value="<?= $item['id']; ?>"><i class="fa-solid fa-trash"></i></button>
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