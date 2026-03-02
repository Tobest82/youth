<?php 
require_once("controller/controller.php");

if(isset($_POST['submit'])){

    $info = mysqli_real_escape_string($call->dbconnect(), $_POST['phone']);
    $password = mysqli_real_escape_string($call->dbconnect(), $_POST['password']);

if(!empty($info)  && !empty($password)){ 

$msg   = $call->userLogin($info,$password);

} else {
   $msg= "Please fill in all fields.";

}


}




?>






<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap Link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <!-- Font awesome link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Css links -->
   <link rel="stylesheet" href="Login.css">
   <link rel="stylesheet" href="Media.css">
   <title>Login</title>
</head>
<body>

   <!-- Code for the form -->
   <section class="form-section">
      <img class="img-fluid" src="Images/Form image-1.jpg" alt="">

      <div class="container-fluid">
         <form class="border-3 p-5 rounded-5 Login-form" method="post">
         <?php 
if(isset($msg) && !empty($msg) ) { ?>
 <p style="color:red !important;border:1px red solid;"><?php echo $msg ?> </p>
<?php } else{ ?>

    <h2 style="color: white;">Login</h2>
    <?php
} ?>


            <div class="d-flex align-items-center justify-content-center user-icon-container">
               <i class="fa-solid fa-user fa-6x text-light mb-4"></i>
            </div>

            <div class="mb-5 text-light Email-and-password">
               <i class="fa-solid fa-envelope me-2"></i>
               <label for="exampleFormControlInput1" class="form-label">Phone or Email</label>
               <input type="text" class="form-control" id="exampleFormControlInput1" required name="phone" placeholder="input your phone number or email">
            </div>

            <div class="mb-4 text-light Email-and-password">
               <i class="fa-solid fa-lock me-2"></i>
               <label for="exampleFormControlInput1" class="form-label">Password</label>
               <input type="password" class="form-control" id="exampleFormControlInput1" name="password"  required placeholder="123****">
            </div>

            <div class="form-check text-light mb-4">
               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
               <div class="">

                  <div class="row">
                     <div class="col col-md-3">
                        <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                     </div>

                     <div class="col col-md-3 text-center">
                     
               <a class="text-decoration-none text-light Forgot-link fw-medium" href="index.php">Home</a>
            
                     
                     </div>
                     <div class="col col-md-3 text-center">
                     
               
                        <a class="text-decoration-none text-light Forgot-link fw-medium" href="#">Forgot password?</a>
                     </div>
                     <div class="col col-md-3 text-end">
                        <a class="text-decoration-none text-light Forgot-link fw-medium" href="register.php">Registration?</a>
                     </div>
                  </div>
               </div>
            </div>
           

            <div class="d-flex align-items-center justify-content-center">
               <a href="Registration.html">
                  <input class="btn btn-lg text-light fw-bold px-5" name="submit" value="submit" type="submit">
               </a>
            </div>

         </form>
      </div>
   </section>
    
   <!-- Bootstrap Js Link -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>