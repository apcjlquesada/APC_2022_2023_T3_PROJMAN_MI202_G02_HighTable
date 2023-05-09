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
                    $faqs = getByID('faqs',$id);

                    if(mysqli_num_rows($faqs) > 0){
                        $data = mysqli_fetch_array($faqs);
                        ?>
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="text-white">Edit FAQs
                                    <a href="faqs.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <div class="">
                                            <label class="mb-0">Question</label>
                                            <input type="text" required name="question" value="<?= $data['question']; ?>" placeholder="Enter Question" class="form-control mb-2 question-bold">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-0">Answer</label>
                                            <textarea rows="5" name="answer" id="answer" placeholder="Enter Answer" class="form-control mb-2"><?= $data['answer']; ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="update_faqs_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        echo "Ingredient not found";
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