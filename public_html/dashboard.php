<?php
require_once("controller/controller.php");
$call->checkUserLoggedIn();

function htime() {
    $time = date("H:i:s");
    $timeArray = explode(":", $time);
    if ($timeArray[0] < 12) {
        return "morning";
    } elseif ($timeArray[0] < 18) {
        return "afternoon";
    } else {
        return "evening";
    }
}

$greeting = "";
switch (htime()) {
    case "morning":
        $greeting = "Good morning!";
        break;
    case "afternoon":
        $greeting = "Good afternoon!";
        break;
    case "evening":
        $greeting = "Good evening!";
        break;
}

if($call->getUserData('gender') == 'male') {
    $title = "Mr.";
} elseif ($call->getUserData('gender') == 'female'){
    $title = "Mrs.";
} else {
    $title = "You";
}

if (isset($_GET['delid']) && !empty($_GET['delid'])) {
    $delid = $_GET['delid'];
    $msgd = $call->deleteUser($delid);
} else {
    $msgd = "";
}

// Sorting functionality
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
$sql = $call->sql_query("SELECT * FROM $user ORDER BY $sort $order");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            /* overflow-x: hidden; */
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
        .dashboard-card {
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1400px;
        }
        .menux{
            max-width: 900px !important;
        }
        .profile-image {
    border: 4px solid #4a5568;
    transition: all 0.3s ease; /* Smooth transition for all properties */
    object-fit: cover;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Initial subtle shadow */
}

.profile-image:hover {
    transform: rotate(5deg) scale(1.1); /* Slight rotation and scaling */
    box-shadow: 7px 7px 15px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
    border-color: #6b7280; /* Optional: Change border color on hover */
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
        <div class="dashboard-card menux p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="display-6 fw-bold text-dark">
                        Hello <?php echo $greeting; ?> <?php echo $title ?> <?php echo $call->getUserData('middlename') ?>
                    </h2>
                    <p class="text-muted">Welcome to your personalized dashboard</p>
                </div>
                
                <div class="dropdown">
                <img 
        src="uploads/<?php $call->getUserData('profileImage') ? print $call->getUserData('profileImage') : print 'userAvater.jpg'; ?>" 
        alt="Profile" 
        class="profile-image rounded-circle" 
        width="100px" 
        height="100px"
        data-bs-toggle="dropdown"
    >
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="editprofile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="proimage.php">Change Image</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="dashboard-card p-4">
    <?php if (isset($msgd) && !empty($msgd)) {
        $alertClass = $msgd == 1 ? 'alert-success' : 'alert-danger';
        ?>
        <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
            <?php echo $msgd; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>middle Name</th>
                    <th>Phone number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($sql) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($row['middlename']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal<?php echo $i; ?>">
        Show More
    </button>
    <a href="chat.php?receiver_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Chat</a>
    <?php if ($row['phone'] === $_SESSION['logged_in']): ?>
        <a href="dashboard.php?delid=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
    <?php endif; ?>
</td>
                    </tr>

                    <!-- Modal for each user -->
                    <div class="modal fade" id="userModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="userModalLabel<?php echo $i; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel<?php echo $i; ?>">User Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img 
                                    src=" uploads/<?php $row['profileImage'] ? print $row['profileImage']: print'userAvater.jpg'  ?>" 
                                    alt="Profile" 
                                    class="rounded-sm" 
                                    style="object-fit: contain;"
                                    width="100%" 
                                    height="400px"
                                    >
                                    
                                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($row['firstname']); ?></p>
                                    <p><strong>Middle Name:</strong> <?php echo htmlspecialchars($row['middlename']); ?></p>
                                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($row['lastname']); ?></p>
                                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                                    <p><strong>Undergraduate Level:</strong> <?php echo htmlspecialchars($row['Undergraduatelevels']); ?></p>
                                    <p><strong>Undergraduate Field:</strong> <?php echo htmlspecialchars($row['Undergraduatefields']); ?></p>
                                    <p><strong>Graduate Level:</strong> <?php echo htmlspecialchars($row['Graduatelevels']); ?></p>
                                    <p><strong>Graduate Field:</strong> <?php echo htmlspecialchars($row['Graduatefields']); ?></p>
                                    <p><strong>Job:</strong> <?php echo htmlspecialchars($row['Job']); ?></p>
                                    <p><strong>Artisan Craft:</strong> <?php echo htmlspecialchars($row['Artisancraft']); ?></p>
                                    <p><strong>Traders Goods:</strong> <?php echo htmlspecialchars($row['tradersgoods']); ?></p>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $i++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center text-muted'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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