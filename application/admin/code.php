<?php

include('../config/dbcon.php');
include('../functions/myfunctions.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



if(isset($_POST['add_category_btn'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = $name.'.'.$image_ext;

    $category_query = "INSERT INTO category (category_name,slug,category_desc,status,category_popular,category_image)
    VALUES ('$name','$slug','$description','$status','$popular','$filename')";

    $category_query_run = mysqli_query($con, $category_query);

    if($category_query_run){
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("addCategory.php", "Category Added Successfully");
    }
    else{
        redirect("addCategory.php", "Something went wrong");
    }
}
else if(isset($_POST['update_category_btn'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != ""){
        $update_filename = $new_image;
    }
    else{
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE category SET category_name='$name', slug='$slug', category_desc='$description', status='$status', category_popular='$popular', category_image='$update_filename', updated_at=NOW() WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run){
        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("editCategory.php?id=$category_id", "Updated Successfully");
    }
    else{
        redirect("editCategory.php?id=$category_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_category_btn'])){
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM category WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['category_image'];
    
    $delete_query = "DELETE FROM category WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Deleted Successfully");
        echo 200;
    }
    else{
        //redirect("products.php", "Something went wrong");
        echo 500;
    }
}
else if(isset($_POST['add_product_btn'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $slug != "" && $description != ""){

        $product_query = "INSERT INTO products (category_id,name,slug,description,original_price,selling_price,image,status,popular) 
        VALUES ('$category_id','$name','$slug','$description','$original_price','$selling_price','$filename','$status','$popular')";

        $product_query_run = mysqli_query($con, $product_query);
        
        if($product_query_run){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("addProduct.php", "Product Added Successfully");
        }
        else{
            redirect("addProduct.php", "Something Went Wrong");
        }
    }
    else{
        redirect("addProduct.php", "All fields are required");
    }
}
else if(isset($_POST['update_product_btn'])){
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != ""){
        $update_filename = $new_image;
    }
    else{
        $update_filename = $old_image;
    }
    
    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', description='$description', original_price='$original_price', selling_price='$selling_price', status='$status', popular='$popular', image='$update_filename', updated_at=NOW() WHERE id='$product_id' ";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if($update_product_query_run){
        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("editProduct.php?id=$product_id", "Updated Successfully");
    }
    else{
        redirect("editProduct.php?id=$category_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_product_btn'])){
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];
    
    $delete_query = "DELETE FROM products WHERE id='$product_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Deleted Successfully");
        echo 200;
    }
    else{
        //redirect("products.php", "Something went wrong");
        echo 500;
    }
}
else if(isset($_POST['add_inventory_btn'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $qty = $_POST['qty'];
    $measurement = $_POST['measurement'];
    $status = isset($_POST['status']) ? '1':'0';

    if($name != "" && $slug != "" && $qty != "" && $measurement != ""){

        $inventory_query = "INSERT INTO inventory (name,slug,qty,measurement,status) 
        VALUES ('$name','$slug','$qty','$measurement','$status')";

        $inventory_query_run = mysqli_query($con, $inventory_query);
        redirect("addInventory.php", "Item Added Successfully");
    }
    else{
        redirect("addInventory.php", "All fields are required");
    }
}
else if(isset($_POST['update_inventory_btn'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $qty = $_POST['qty'];
    $measurement = $_POST['measurement'];
    $status = isset($_POST['status']) ? '1':'0';
    
    $update_inventory_query = "UPDATE inventory SET name='$name', slug='$slug', qty='$qty', measurement='$measurement', status='$status', updated_at=NOW() WHERE id='$id' ";
    $update_inventory_query_run = mysqli_query($con, $update_inventory_query);
    redirect("addInventory.php", "Updated Successfully");

}
else if(isset($_POST['delete_inventory_btn'])){
    $inventory_id = mysqli_real_escape_string($con, $_POST['id']);

    $inventory_query = "SELECT * FROM inventory WHERE id='$inventory_id'";
    $inventory_query_run = mysqli_query($con, $inventory_query);
    $inventory_data = mysqli_fetch_array($inventory_query_run);

    $delete_query = "DELETE FROM inventory WHERE id='$inventory_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run){
        echo 200;
    }
    else{
        echo 500;
    }

}
else if(isset($_POST['add_faqs_btn'])){
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if($question != "" && $answer != ""){

        $faqs_query = "INSERT INTO faqs (question,answer) 
        VALUES ('$question','$answer')";

        $faqs_query_run = mysqli_query($con, $faqs_query);
        redirect("addFaqs.php", "Item Added Successfully");
    }
    else{
        redirect("addFaqs.php", "All fields are required");
    }
}
else if(isset($_POST['update_faqs_btn'])){
    $id = $_POST['id'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    
    $update_faqs_query = "UPDATE faqs SET question='$question', answer='$answer', updated_at=NOW() WHERE id='$id' ";
    $update_faqs_query_run = mysqli_query($con, $update_faqs_query);
    redirect("faqs.php", "Updated Successfully");

}
else if(isset($_POST['delete_faqs_btn'])){
    $faqs_id = mysqli_real_escape_string($con, $_POST['id']);

    $faqs_query = "SELECT * FROM faqs WHERE id='$faqs_id'";
    $faqs_query_run = mysqli_query($con, $faqs_query);
    $faqs_data = mysqli_fetch_array($faqs_query_run);

    $delete_query = "DELETE FROM faqs WHERE id='$faqs_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run){
        echo 200;
    }
    else{
        echo 500;
    }
}
else if(isset($_POST['update_order_btn'])){
    
    
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];
    $notice = $_POST['notice'];
    $email = $_POST['email'];

    $updateOrder_query = "UPDATE orders, order_items  SET status='$order_status', order_items_status='$order_status', notice='$notice', updated_at=NOW() WHERE tracking_no='$track_no' AND orders.id = order_items.order_id ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);
    
    //Load Composer's autoloader
    require '../vendor/autoload.php';
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'rysalw4m@gmail.com';                     //SMTP username
    $mail->Password   = 'miawearustjppfkt';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;       

    $mail->setFrom('rysalw4m@gmail.com');
    $mail->addAddress($email);     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Order Status for Order No. {$track_no}" ;
    
    if($order_status == 0 ){
        $print_status = 'Processing';
    }else if($order_status== 1 ){
        $print_status = 'In transit';
    }else if($order_status== 2 ){
        $print_status = 'Completed';
    }else if($order_status== 3 ){
        $print_status = 'Cancelled';
    }

    $email_template = "
    <!doctype html>
        <html lang='en'>
        <head>
            <!--Required meta tags -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Chubby Gourmet</title>

            <!--Bootstrap CSS -->
            <link href='assets/css/bootstrap.min.css' rel='stylesheet'>
            <link href='assets/css/design.css' type='text/css' rel='stylesheet'>
            <link href='assets/css/custom.css' rel='stylesheet'>

            <!-- font awesome cdn link  -->
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
            
            <link href='assets/css/owl.theme.default.min.css' rel='stylesheet'>
            <link href='assets/css/owl.carousel.min.css' rel='stylesheet'>

            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
            <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>

            <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/>
            <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css'/>
            
        </head>
            <body>
                <div>
                    <img src='http://drive.google.com/uc?export=view&id=1ki9fKeqLcG2SyW6CpBVwAv5Hw2E-FWM0' alt='Chubby Gourmet' width='150px'>
                </div>
                <h2 class='m-5' style='color: green;'>Good day!</h2>
                <h3 class='m-5' style='color: black;'>Order No. $track_no</h3>
                <p class='m-4' style='color:black;'> The status of your order is now <strong>$print_status</strong>.
            
                </p>
                <p class='m-4' style='color:black;'>$notice</p>
                <hr>
                <p class='m-4' style='color:black;'>You may view your orders by clicking the button below.</p>
                <div style='display: flex; justify-content:center;'>
                    <a style='text-align: center;
                    background-color: green;
                    color: #fff;
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                    text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table/High-Table-master/CG-Webapp-main/my-orders.php'>View My Orders</a>
                </div>
                <p class='m-4' style='color:black;'>Send us an email if you have other concerns. We are willing to help!</h6>
                <p class='m-4' style='color:black;'>Cheers,</h6>
                <p class='m-4' style='color:black;'>Chubby Gourmet</h6>




            </body>
    </html>
    ";

    $mail->Body    = $email_template;

    $mail->send();
    redirect("view-order.php?t=$track_no", "Updated Successfully");

    
}
else if(isset($_POST['add_address_btn'])){
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $delivery_fee = $_POST['delivery_fee'];
    $status = isset($_POST['status']) ? '1':'0';

    if($region != "" && $province != "" && $city != "" && $barangay != ""){

        $address_query = "INSERT INTO address (region,province,city,barangay,delivery_fee,status) 
        VALUES ('$region','$province','$city','$barangay','$delivery_fee','$status')";

        $address_query_run = mysqli_query($con, $address_query);
        redirect("addAddress.php", "Address Added Successfully");
    }
    else{
        redirect("addAddress.php", "All fields are required");
    }
}
else if(isset($_POST['update_address_btn'])){
    $id = $_POST['id'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $delivery_fee = $_POST['delivery_fee'];
    $status = isset($_POST['status']) ? '1':'0';
    
    $update_address_query = "UPDATE address SET region='$region', province='$province', city='$city', barangay='$barangay', delivery_fee='$delivery_fee', status='$status', updated_at=NOW() WHERE id='$id' ";
    $update_address_query_run = mysqli_query($con, $update_address_query);
    redirect("addAddress.php", "Updated Successfully");

}
else if(isset($_POST['delete_address_btn'])){
    $address_id = mysqli_real_escape_string($con, $_POST['id']);

    $address_query = "SELECT * FROM address WHERE id='$address_id'";
    $address_query_run = mysqli_query($con, $address_query);
    $address_data = mysqli_fetch_array($address_query_run);

    $delete_query = "DELETE FROM address WHERE id='$address_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run){
        echo 200;
    }
    else{
        echo 500;
    }

}

else if(isset($_POST['update_admin_btn'])){
    $role_as = $_POST['role_as'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Check if email already registered
    //$check_email_query = "SELECT email FROM customer WHERE email='$email'";
    //$check_email_query_run = mysqli_query($con, $check_email_query);

    //if(mysqli_num_rows($check_email_query_run) > 0){
       // $_SESSION['message'] = "Email already registered";
        //header('Location: ../edit-profile.php');
   // }
   // else{
        if($password == $confirm_password){
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

            //Insert user data
            $update_admin_query = "UPDATE user SET password='$password' WHERE role_as='1'";
            $update_admin_query_run = mysqli_query($con,$update_admin_query);
    
            if($update_admin_query){
                $_SESSION['message'] = "Updated Successfully";
                header('Location: adminSettings.php');
            }
            else{
                $_SESSION['message'] = "Something went wrong";
                header('Location: changePassword.php');
            }
        }
        else{
            $_SESSION['message'] = "Password do not match";
            header('Location: changePassword.php');
        }
}

else{
    header('Location: ../index.php');
}
?>