<?php
require_once("controller/controller.php");
$call->checkUserLoggedIn();

if(isset($_POST["submit"]) ){
    $firstName = $_POST["firstname"];
    $middleName = $_POST["middlename"];
    $lastName = $_POST["lastname"];
    
    $gender = strtolower($_POST["gender"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $Undergraduatelevels = $_POST['Undergraduatelevels'];
    $Undergraduatefields = $_POST['Undergraduatefields'];
    $Graduatelevels = $_POST['Graduatelevels'];
    $Graduatefields = $_POST['Graduatefields'];
    $Job = $_POST['Job'];
    $Artisancraft = $_POST['Artisancraft'];
    $tradersgoods = $_POST['tradersgoods'];

    if(!empty($firstName) && !empty($middleName) && !empty($gender)  && !empty($phone)){
        $msg = $call->ProfileEdit($firstName, $middleName, $lastName,  $gender,  $phone,$email,$Undergraduatelevels,$Undergraduatefields,$Graduatelevels,$Graduatefields, $Job, $Artisancraft, $tradersgoods);
    } else {
        $msg = "Please enter all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            /* overflow-x: hidden; */
        }
        .dashboard-card {
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
        }
  
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: white;
            width: 250px;
            padding: 20px;
            transition: all 0.3s;
            z-index: 1000;
        }
        .sidebar.collapsed {
            transform: translateX(-250px); /* Hide sidebar by moving it to the left */
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .main-content.full-width {
            margin-left: 0;
        }
        .sidebar-toggle {
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1100;
    background: #333;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.sidebar-toggle:hover {
    background-color: #555;
}
.sidebar {
        width: 250px;
        background-color: #333;
        color: white;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        transition: transform 0.3s ease;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar.collapsed {
        transform: translateX(-250px); /* Hide sidebar by moving it to the left */
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #444;
        text-align: center;
    }

    .sidebar-nav {
        padding: 10px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-link:hover {
        background-color: #555;
        color: #fff;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
    }

    .nav-link span {
        margin-left: 10px;
    }

   
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px); /* Hide sidebar on smaller screens */
            }
            .sidebar.collapsed {
                transform: translateX(0); /* Show sidebar when toggled */
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<button id="sidebarToggle" class="sidebar-toggle">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4 class="text-white mb-0">Menu</h4>
    </div>
    <nav class="sidebar-nav">
        <a href="dashboard.php" class="nav-link">
            <i class="fas fa-home me-2"></i>
            <span>Home</span>
        </a>
        <a href="setting.php" class="nav-link">
            <i class="fas fa-cog me-2"></i>
            <span>Setting</span>
        </a>
        <a href="proimage.php" class="nav-link">
            <i class="fas fa-image me-2"></i>
            <span>Profile Image</span>
        </a>
        <a href="editprofile.php" class="nav-link">
            <i class="fas fa-user-edit me-2"></i>
            <span>Profile Details</span>
        </a>
        <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt me-2"></i>
            <span>Logout</span>
        </a>
    </nav>
</aside>

    <div class="main-content container-fluid py-5" id="mainContent">
        <div class="dashboard-card">
            <h2 class="text-center mb-4">Edit Profile</h2>
            <?php if (isset($msg) && !empty($msg)): ?>
                <div class="alert <?php echo $msg == 1 ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $msg == 1 ? 'Update successful' : $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $call->getUserData('firstname'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $call->getUserData('middlename'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $call->getUserData('lastname'); ?>">
                </div>
                
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $call->getUserData('gender'); ?>">
                </div>
                
                <div class="col-md-6">
                    <label for="Phonenumber" class="form-label">Phone number</label>
                    <input type="text" class="form-control" id="Phonenumber" name="phone" value="<?php echo $call->getUserData('phone'); ?>">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $call->getUserData('email'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="Undergraduatelevels" class="form-label">Undergraduate level</label>
                    <input type="text" class="form-control" id="Undergraduatelevels" name="Undergraduatelevels" value="<?php echo $call->getUserData('Undergraduatelevels'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="Undergraduatefields" class="form-label">Undergraduate field of study</label>
                    <input type="text" class="form-control" id="Undergraduatefields" name="Undergraduatefields" value="<?php echo $call->getUserData('Undergraduatefields'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="Graduatelevels" class="form-label">Graduate level</label>
                    <input type="text" class="form-control" id="Graduatelevels" name="Graduatelevels" value="<?php echo $call->getUserData('Graduatelevels'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="Graduatefields" class="form-label">Graduate field of study</label>
                    <input type="text" class="form-control" id="Graduatefields" name="Graduatefields" value="<?php echo $call->getUserData('Graduatefields'); ?>">
                </div>

                <div class="col-md-6">
                    <label for="job" class="form-label">Job</label>
                    <input type="text" class="form-control" id="job" name="Job" value="<?php echo $call->getUserData('Job'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="Artisancraft" class="form-label">Artisan Type of craft</label>
                    <input type="text" class="form-control" id="Artisancraft" name="Artisancraft" value="<?php echo $call->getUserData('Artisancraft'); ?>">
                </div>
                <div class="col-md-6">
                    <label for="tradersgoods" class="form-label">Traders goods</label>
                    <input type="text" class="form-control" id="tradersgoods" name="tradersgoods" value="<?php echo $call->getUserData('tradersgoods'); ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary w-100" name="submit">Update Profile</button>
                </div>
            </form>
        </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('full-width');
        document.body.classList.toggle('no-scroll'); // Prevent scrolling when sidebar is open
    });

    // Prevent scrolling when sidebar is open
    document.body.classList.toggle('no-scroll', !sidebar.classList.contains('collapsed'));
});
</script>
</body>
</html>