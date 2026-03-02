<aside class="sidebar">
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

<style>
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
    }
</style>