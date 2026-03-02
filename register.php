<?php 
require_once("controller/controller.php");

if (isset($_POST["submit"]) && !empty($_POST["submit"])){

  $firstName = $_POST['firstname'];
  $middleName = $_POST['middlename'];
  $lastName = $_POST['lastname'];
$gender = strtolower($_POST['inlineRadioOptions']);
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
//   $occupation = $_POST['occupation'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $Undergraduatelevels = $_POST['Undergraduatelevels'];
  $Undergraduatefields = $_POST['Undergraduatefields'];
  $Graduatelevels = $_POST['Graduatelevels'];
  $Graduatefields = $_POST['Graduatefields'];
  $Job = $_POST['Job'];
  $Artisancraft = $_POST['Artisancraft'];
  $tradersgoods = $_POST['tradersgoods'];

  if (!empty($firstName ) && !empty($middleName) && !empty( $gender) && !empty($password) && !empty($cpassword)  && !empty($phone)){
  $msg = $call->registerUser($firstName, $middleName, $lastName,$gender, $password,$cpassword,$phone,$email,$Undergraduatelevels,$Undergraduatefields,$Graduatelevels,$Graduatefields,$Job,$Artisancraft, $tradersgoods);
  } else {
   $msg = "please fill the required fields";
   
  }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration Form</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="Registration.css">
   <link rel="stylesheet" href="Media.css">
</head>
<body>
   
   <!-- Code For Registration Form-->
   <section>
      <div class="container The-form-container rounded-5 my-0 my-md-5">
         <form class="p-3 overflow-auto Registration-form" method="post">

         <?php if (isset($msg) && !empty($msg)) 
    {
      if ($msg == 0) {
        ?> <p style="color: green ;border: 1px solid green;"><?php echo "success" ?></p>
        <?php 
            } else {
                ?> <p style="color: red ;border: 1px solid red"> <?php echo $msg;  ?></p> 
                <?php
            }
     } else {
        ?> 
      
         <h2 style="color: white;">Register</h2> 
         <?php
    }?>

            <div class="row pt-5">
               <div class="col-12 The-info-text text-center mb-3">
                  <h3 class="fw-bold">Enter your collective information below</h3>
               </div>

               <div class="col-4 md-col-12">
                  <input type="text" class="form-control form-control" name="firstname" placeholder="First name"  required aria-label="First name">
               </div>
         
               <div class="col-4 md-col-12">
                  <input type="text" class="form-control form-control" name="middlename" placeholder="Middle name"  required aria-label="Middle name">
               </div>
         
               <div class="col-4 mb-4 md-col-12">
                  <input type="text" class="form-control form-control" name="lastname" placeholder="Last name">
               </div>
   
               <div class="col-6 md-col-12">
                  <input type="text" class="form-control form-control" name="phone" placeholder="Phone number"  required aria-label="Phone numbers">
               </div>

               <div class="col-6 md-col-12">
                  <input type="text" class="form-control form-control" name="email" placeholder="Email (Optional)">
               </div>
   
               
               <label for="inputAddress" class="form-label mb-3">Gender:</label>
               <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"  value="male">
  <label class="form-check-label" for="inlineRadio1">male</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female">
  <label class="form-check-label" for="inlineRadio2">female</label>
</div>
<div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="password"  required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">repeat_Password</label>
    <input type="password" class="form-control" id="inputPassword4" name="cpassword"  required>
  </div>
               
               <!-- Code for Qualifications/Occupation-->
               <div class="col-12 The-info-text text-center mt-5">
                  <h3 class="fw-bold">Qualifications/Occupation</h3>
               </div>

               <div class="row g-3 align-items-center justify-content-center">
                  <div class="w-75 The-input-container">
                     <div>
                       <label for="" class="col-form-label fw-bold">Undergraduate (Optional)</label>
                     </div>
      
                     <!-- Levels -->
                     <div class="mb-3">
                        
                        <input type="text" class="form-control" id="inputAddress" placeholder="Level" name="Undergraduatelevels">
                     </div>
                     
                     <!-- Field of study -->
                     <div>
                       
                         <input type="text" class="form-control" id="inputAddress" placeholder="Field of study" name="Undergraduatefields">
                     </div>
                  </div>



                  <!-- Code for Graduates -->
                  <div class="w-75 The-input-container">
                     <div class="mt-4 ">
                        <label for="" class="col-form-label fw-bold">Graduate (Optional)</label>
                     </div>
   
                     <div class="mb-3">
                       
                         <input type="text" class="form-control" id="inputAddress" placeholder="Level of degree" name="Graduatelevels">
                     </div>

                     
                     <!-- Field of study -->
                     <div>
                     
                         <input type="text" class="form-control" id="inputAddress" placeholder="Field of study" name="Graduatefields">
                       </select>
                     </div>

                     <div class="mt-3">
                       
                         <input type="text" class="form-control" id="inputAddress" placeholder="Job (If any)" name="Job">
                     </div>
                  </div>

                  
                  <!-- Artisan -->
                  <div class="w-75 mt-4 The-input-container">
                     <div>
                        <label for="" class="col-form-label fw-bold">Artisan (Optional)</label>
                     </div>
   
                     <div>
                         <input type="text" class="form-control" id="inputAddress" placeholder="Type of craft" name="Artisancraft">
                     </div>
                  </div>


                  <!-- Traders -->
                  <div class="w-75 The-input-container">
                     <div>
                        <label for="" class="col-form-label fw-bold">Traders (Optional)</label>
                     </div>

                     <div>
                       
                         <input type="text" class="form-control" id="inputAddress" placeholder="Goods" name="tradersgoods">
                     </div>
                  </div>

                  <div class="text-center my-5">
                     <input class="btn btn-lg px-5 text-light fw-bold border-2 border-light" value="Submit" name="submit" type="submit">
                  </div>
                  <div class="row">
                  <p class="col col-md-6 text-start">have  Registered?<a class="text-decoration-none text-light Forgot-link fw-medium" href="login.php">login</a></p> 
                  <p  class="col col-md-6 text-end"><a class="text-decoration-none text-light Forgot-link fw-medium" href="index.php">home</a></p> 

                  </div>
                                 </div>
            </div>
         </form>
      </div>
   </section>
   
   <!-- Bootstrap Js link -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>