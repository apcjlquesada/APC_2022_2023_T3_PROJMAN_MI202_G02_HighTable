<?php 
include('functions/userfunctions.php');
include('includes/header.php');

?>

<link href="assets/css/accordion.css" rel="stylesheet">

<div class="py-5" >
    <div class="container">
        <p class="text-center title">
            Frequently Asked Questions
        </p>
        <p class="text-center desc">
            Have a question you don't see answered here? Drop us a note at <a href="mailto:chubbygourmet@gmail.com">chubbygourmet@gmail.com</a>
        </p>
        <div class="row mt-5 mb-4">
		    <?php 
                $faqs = getAllFAQs();
                foreach ($faqs as $faq): ?>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-item-header"> 
                                <?php echo $faq['question']; ?>
                            </div>  
                            <div class="accordion-item-body">
                                <div class="accordion-item-body-content">
                                    <?php echo $faq['answer']; ?>
                                </div>    
                            </div>
                        </div>
                    </div>
		    <?php endforeach; 
            ?>
        </div>
    </div>
</div>

    
<?php include('includes/footer.php');  ?> 
<script src="assets/js/accordion.js"></script>  
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