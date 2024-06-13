<?php 
ob_start();
error_reporting(E_ALL);
 ?>
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <?php
                if(isset($_GET['keywords'])){
                  $keywords = $_GET['keywords'];
                } 
                else{
                  $keywords = "";
                }
                ?>
                <form class="d-none d-md-flex ms-4" action="./search.php" method="GET">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search" name="keywords" maxlength="70" autocomplate="off" value="<?= $keywords?>">
                    <button class="btn btn-primary p-2" type="submit" name="search"><i class="fa fa-search"></i></button>
                </form>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            
                            <hr class="dropdown-divider">
                            
                            <hr class="dropdown-divider">
                            
                            <hr class="dropdown-divider">
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New Post Added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/<?php if(isset($_SESSION['admin_data'])){ echo $_SESSION['admin_data']['5'];}?>" alt="img/user.jpg" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php if(isset($_SESSION['admin_data'])){ echo $_SESSION['admin_data']['1'];}?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0 ">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="./404.php" class="dropdown-item">Settings</a>
                            <a href="./logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>