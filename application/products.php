<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');

if(isset($_GET['category']))
{

    $category_slug = $_GET['category'];
    $category_data = getSlugActive("category",$category_slug);
    $category = mysqli_fetch_array($category_data);

    if($category)
    {
        $cid = $category['id'];
        ?>

        <div class="py-3">
            <div class="container">
                <h6>
                    <a href="index.php">Home / </a>
                    <a href="category.php">Category /</a> 
                    <?= $category['category_name']; ?></h6>
            </div>
        </div>
            
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?= $category['category_name']; ?></h2>
                        <hr>
                        <div class="productRow row">
                            <?php
                                $products = getProdByCategory($cid);
                                if(mysqli_num_rows($products) > 0){
                                    foreach($products as $item){
                                        ?>
                                            <div class="col-md-3 mb-4">
                                                    <div class="productCard card shadow">
                                                        <div class="productImage">
                                                            <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="productName"><?= $item['name']; ?></h4>
                                                                <p><?= $item['description']; ?></p>
                                                                <span class="price"><span class="pesoSign">₱ </span><?= $item['selling_price']; ?></span>
                                                                <a id="<?php echo $item['id'] ?>" class="viewBtn fa-solid fa-plus"></a>
                                                                <!--    <a href="viewproduct.php?product=<?= $item['slug']; ?>" class="fa-solid fa-plus"></a>-->
                                                            </div>
                                                    </div>
                                            </div>
                                            

                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <div class="py-5">
                                        <div class="container">
                                            <div class="hero-row">
                                                <div class="column1">
                                                    <h1>Ohh snap!</h1>
                                                    <p>We'll do our best to learn this cuisine!</p>
                                                </div>
                                                <div class="column2">
                                                    <img src="assets/images/cg-error.png" alt="banner" width="500px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <?php
    }
    else
    { ?>
        <div class="py-5">
            <div class="container">
                <div class="hero-row">
                    <div class="column1">
                        <h1>Ohh snap!</h1>
                        <p>We'll do our best to learn this cuisine!</p>
                    </div>
                    <div class="column2">
                        <img src="assets/images/cg-error.png" alt="banner" width="500px">
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
else
{ ?>
    <div class="py-5">
            <div class="container">
                <div class="hero-row">
                    <div class="column1">
                        <h1>Ohh snap!</h1>
                        <p>We'll do our best to learn this cuisine!</p>
                    </div>
                    <div class="column2">
                        <img src="assets/images/cg-error.png" alt="banner" width="500px">
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
    <div class="modal" tabindex="-1" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
    </div>


    <!-- loader part  -->
<div class="loader-container">
    <img src="assets/images/preloader.gif" alt="">
</div>         


<?php
include('includes/footer.php');  ?>   
<script>
    function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
  setInterval(loader, 1500);
}

window.onload = fadeOut;

</script>