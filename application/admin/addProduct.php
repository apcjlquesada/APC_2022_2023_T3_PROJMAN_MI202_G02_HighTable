<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Add Product
                    <a href="products.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Select Category</label>
                                <select name="category_id" class="form-select mb-2 p-2">
                                    <option selected>Select Category</option>
                                    <?php
                                        $category = getAll("category");
                                        if(mysqli_num_rows($category) > 0){
                                            foreach($category as $item){
                                                ?>
                                                    <option value="<?= $item['id']; ?>"><?= $item['category_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        else{
                                            echo "No category available";
                                        }
                                    ?> 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Name</label>
                                <input type="text" required name="name" placeholder="Enter Category name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" required name="description" placeholder="Enter description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Original Price</label>
                                <input type="text" required name="original_price" placeholder="Enter original price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Selling Price</label>
                                <input type="text" required name="selling_price" placeholder="Enter selling price" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Upload Image</label>
                                <input type="file" name="image" class="form-control mb-2" accept="image/*">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Status</label> <br>
                                <input type="checkbox"  name="status">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Popular</label> <br>
                                <input type="checkbox"  name="popular">
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>