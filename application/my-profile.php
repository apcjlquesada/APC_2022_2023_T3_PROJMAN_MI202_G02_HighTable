<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

    
<div class="py-5">
    <div class="viewOrderContainer container">
    <div class="registrationForm card">
                        <div class="registrationHeader card-header">
                            <h4 class="text-white">My Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                              <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                $sql = "SELECT * FROM user WHERE email = '$currentUser'";

                                $gotResults = mysqli_query($con, $sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults) > 0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">First Name</label>
                                            <div class="border p-2 mb-2">
                                              <?= $row['first_name']; ?>
                                            </div>
                                        </div>    
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Last Name</label>
                                            <div class="border p-2 mb-2">
                                              <?= $row['last_name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <label for="exampleInputEmail1" class="form-label mb-0">Email address</label>
                                                <div class="border p-2 mb-2">
                                                  <?= $row['email']; ?>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Contact Number</label>
                                            
                                            <div class="border p-2 mb-2">
                                              +63<?= $row['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                        <a href="edit-profile.php" class="mt-2 updateProfile float-end">Edit Profile</a>

                                        </div>

                                        <?php
                                        }
                                      }
                                    }
                                    ?>
                                
                                    </div>

                                    <h4 class="mt-3">My Address</h4>
                                    <hr>
                                    <div class="row">
                                    <?php
$query = "SELECT * FROM user_address WHERE email='$currentUser'";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0){
  foreach($query_run as $item){
      ?>
                                        <div class="col-md-6">
                
                                            <div class="border p-2 mb-2">
                                              <?= $item['address_name']; ?> 
                                             <a href="editUserAddress.php?id=<?= $item['id'] ?>" class="float-end"><i class="fa-solid fa-pen-to-square"></i></a>
       
                                            </div>
                                            
                                        </div>
      <?php
  }
}
else{
  echo "No records found.";
}
?>
</div>
                                      <div class="col-md-12 mt-3">
                                        <a href="addUserAddress.php" class="mt-2 updateProfile float-end">New Address</a>
                                      </div>
                            </div>  
                            </div>
                        
                        </div>
                    </div>
    </div>
</div>
    
<?php include('includes/footer.php');  ?>   