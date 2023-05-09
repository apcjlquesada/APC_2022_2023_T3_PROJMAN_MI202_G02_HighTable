<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Frequently Asked Questions
                    <a href="addFaqs.php" class="btn btn-outline-light float-end">Add FAQs</a>
                    </h4>
                </div>
                <div class="card-body" id="faqs_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Questions</th>
                                <th>Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $faqs = getAll("faqs");

                                if(mysqli_num_rows($faqs) > 0){
                                    foreach($faqs as $item){
                                        ?>
                                            <tr>
                                                <td><?= $item['question'] ?></td>
                                                <td class="d-none-block text-truncate overflow-hidden" style="max-width: 170px;"><?= $item['answer'] ?></td>
                                                <td>
                                                    <a href="editFaqs.php?id=<?= $item['id'] ?>" class="btn btn-success ms-3"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <button type="button" class="btn btn-danger delete_faqs_btn ms-2" value="<?= $item['id']; ?>"><i class="fa-solid fa-trash"></i></button>
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