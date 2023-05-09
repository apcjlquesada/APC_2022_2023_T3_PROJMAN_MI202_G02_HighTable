<?php 
include('functions/userfunctions.php');
include('includes/header.php');

?>
<div class="py-5">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="hero-row">
            <div class="column1">
                <h1>Tuloy Po!</h1>
                <p>Planning for an upcoming birthday, office lunch, or even a simple gathering with your family and friends?</p>
                <a class="btn btn-primary btn-green hero-btn" href="category.php">Shop Now</a>
            </div>
            <div class="column2">
                <img src="assets/images/cg-hero.png" alt="banner" width="500px">
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container deliveryinfo-container" data-aos="fade-left" data-aos-duration="2000">
        <div class="deliveryinfo-row">
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-location2.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Curated for the best experience in select locations.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-deliver.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Fresh, on-time delivery with scheduling options, no same-day delivery.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-clock.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Delivery from 9AM-7PM for on-time and efficient service.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="popular-container container" data-aos="fade-right" data-aos-duration="2000">
        <div class="row">
            <div class="col-md-12"></div>
                <h4>Popular Dish</h4>
                <div class="owl-carousel">
                    <?php 
                        $popularProducts = getAllPopular();
                        if(mysqli_num_rows($popularProducts) > 0){
                            foreach ($popularProducts as $item) {
                                ?>
                                    <div class="item">
                                        <div class="productCard card shadow">
                                                        <div class="productImage">
                                                            <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="productName"><?= $item['name']; ?></h4>
                                                                <span class="price"><span class="pesoSign">₱ </span><?= $item['selling_price']; ?></span>
                                                                <a href="category.php" id="<?php echo $item['id'] ?>" class="viewBtn fa-solid fa-eye"></a>
                                                            </div>
                                                    </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5" data-aos="fade-left" data-aos-duration="2000">
    <div class="container" >
        <div class="hero-row">
            <div class="column1">
                <img src="assets/images/cg-about.png" alt="banner" width="500px">
            </div>
            <div class="column2">
                <h3>About Us</h3>
                <p>
                    Since April  of 2020, we have been happily ready to serve you with sumptuous and ready to eat meals at reasonable prices! Since COVID-19 encouraged everyone to stay indoors, we decided to offer our food out to the Laguna Bel Air community, to get a taste of our homecooked meals and ever since then, the name of <em>Chubby Gourmet</em> spread out and has now even reached to our friends in the city!
                </p>
                <p>
                    If you wish to get a taste of our hearty meals, book us for your next celebration and leave the cooking to us. 
                </p>
            </div>
        </div>
    </div>
</div>

          
    
<?php include('includes/footer.php');  ?>   
<script>

$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
});

</script>
