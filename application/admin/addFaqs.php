<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Add FAQs
                    <a href="faqs.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="">
                                <label class="mb-0">Question</label>
                                <input type="text" required name="question" placeholder="Enter Question" class="form-control mb-2 question-bold">
                            </div>
                            <div class="mb-3">
                                <label class="mb-0">Answer</label>
                                <textarea rows="3" name="answer" id="answer" placeholder="Enter Answer" class="form-control mb-2"></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_faqs_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>