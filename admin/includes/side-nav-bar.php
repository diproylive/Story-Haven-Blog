<?php  
ob_start();
error_reporting(E_ALL);
?>


<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="./index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>dCoder</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/<?php if(isset($_SESSION['admin_data'])){ echo $_SESSION['admin_data']['5'];}?>" alt="img/user.jpg" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php if(isset($_SESSION['admin_data'])){ echo $_SESSION['admin_data']['1'];}?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Blog Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user_post.php" class="dropdown-item">All Post</a>
                            <a href="category.php" class="dropdown-item">Add Category</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Blog User</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user.php" class="dropdown-item">Users</a>
                            <a href="add-user.php" class="dropdown-item">Modify Users</a>
                            <a href="#" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./signup.php" class="dropdown-item">Create An Admin Account</a>
                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>