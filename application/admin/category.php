<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Category
                        <a href="addCategory.php" class="btn btn-outline-light float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body" id="category_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $category = getAll("category");

                                if(mysqli_num_rows($category) > 0){
                                    foreach($category as $item){
                                        ?>
                                            <tr>
                                                <td style="width: 300px;"><?= $item['category_name'] ?></td>
                                                <td style="width: 80px;">
                                                    <img src="../uploads/<?= $item['category_image'] ?>" width="80px" height="80px" alt="<?= $item['category_name'] ?>">
                                                </td>
                                                <td style="width: 130px;"><?= $item['status'] == '0'? "Available":"Unavailable"?></td>
                                                <td style="width: 130px;">
                                                    <a href="editCategory.php?id=<?= $item['id'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <button type="button" class="btn btn-danger delete_category_btn" value="<?= $item['id']; ?>"><i class="fa-solid fa-trash"></i></button>
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