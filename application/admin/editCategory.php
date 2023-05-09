<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $category = getByID("category", $id);
                    
                    if(mysqli_num_rows($category) > 0){
                        $data = mysqli_fetch_array($category);

                        ?>
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-white">Edit Category
                                        <a href="category.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                            <div class="col-md-6">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?= $data['category_name'] ?>" placeholder="Enter Category name" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Slug</label>
                                                <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter slug" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <textarea rows="3" name="description" placeholder="Enter description" class="form-control"><?= $data['category_desc'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Upload Image</label>
                                                <input type="file" name="image" class="form-control" accept="image/*">
                                                <label for="">Current Image</label>
                                                <input type="hidden" name="old_image" value="<?= $data['category_image'] ?>">
                                                <img src="../uploads/<?= $data['category_image'] ?>" width="80px" height="80px" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Status</label>
                                                <input type="checkbox" <?= $data['status'] ? "Checked":"" ?> name="status">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Popular</label>
                                                <input type="checkbox" <?= $data['category_popular'] ? "Checked":"" ?> name="popular">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" name="update_category_btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        <?php
                    }
                    else{
                        echo "Category not found";
                    }
                   
            }
            else{
                echo "ID missing from url";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>