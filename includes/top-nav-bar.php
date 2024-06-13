<?php
$sql20 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id ORDER BY `blog_id` DESC LIMIT 5";
                                                            
$result20 = mysqli_query($con, $sql20);
$count20 = mysqli_num_rows($result20); 
$n=0;
?>

<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 d-flex">
                <a href="../index.php" class="navbar-brand d-flex d-lg-none me-4">
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
                <form class="d-md-flex ms-4" action="./search.php" method="GET">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search" name="keywords" maxlength="70" autocomplate="off" value="<?= $keywords?>">
                    <button class="btn btn-primary p-2" type="submit" name="search"><i class="fa fa-search"></i></button>
                </form>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/<?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['8'];}?>" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <?php
                            if($count20)
                            {
                                while($p=mysqli_fetch_array($result20))
                                {
                                    ?>
                                    <a href="read_more.php?Read_id=<?php echo $p['blog_id'];?>" class="dropdown-item">
                                            <h6 class="fw-normal mb-0"><?php echo $p['user_name']; ?> added a post</h6>
                                            <small><?php echo date('d-M-Y', strtotime($p['date'])); ?></small>
                                            </a>
                                            <hr class="dropdown-divider">

                                    <?php
                                }
                            }
                        ?>
                                            

                                         
                            
                            
                            <hr class="dropdown-divider">
                            <a href="notifications/notification.php" class="dropdown-item text-center">See all notifications</a>
                            <hr class="dropdown-divider">
                        </div>
                    </div>
                    <a href="admin/signin.php" class="nav-link" data-bs-toggle="">
                        <i class="fa fa-lock me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex"></span>
                    </a>
                    
                </div>
            </nav>