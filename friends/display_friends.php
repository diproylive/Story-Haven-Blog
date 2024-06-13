<?php
session_start();
include '../includes/connect.php';

if(!isset($_SESSION['user_data']))
{
    echo '<script>alert("Please Login");</script>';
    header('location:../user_login.php');
}
$sq = "SELECT * FROM `users`";

$result = mysqli_query($con, $sq);
$count = mysqli_num_rows($result);
$a = mysqli_fetch_array($result);


$sql = "SELECT * FROM `users`ORDER BY `user_id` DESC";

$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
$no = 0;


if(isset($_SESSION['user_data'])){ 
    $idd= $_SESSION['user_data']['0'];
    $sq = "SELECT * FROM `users` WHERE user_id = '$idd'";
    $resul = mysqli_query($con, $sq);
    $count = mysqli_num_rows($resul);
    if($count){
      $u = mysqli_fetch_array($resul);
    }
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Blog || Newsfeed</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Blog</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../img/<?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['8'];}?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <a href="../profile/my_profile.php?id=<?php echo $a['user_id'];?>">
                        <h6 class="mb-0"><?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['2'];}?></h6>
                        <span>My Profile</span>
                    </a>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Newsfeed</a>
                    <a href="../add_post.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Add Post</a>
                    <a href="../notifications/notification.php" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notifications</a>
                    <a href="404.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <a href="display_friends.php" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>All Blogger</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog me-2"></i>Setting</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../profile/profile_setting.php?profile_id=<?php echo $u['user_id'];?>" class="dropdown-item">Profile Setting</a>
                            <a href="../user_logout.php" class="dropdown-item">Log Out</a>
                            <a href="404.php" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'top-nav-bar.php' ?>
            <!-- Navbar End -->


            <!-- Newsfeed start -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">  
                  
                <?php
                if(isset($_GET['keywords'])){
                  $keywords = $_GET['keywords'];
                } 
                else{
                  $keywords = "";
                }
                ?>

                  <form class="d-md-flex ms-4" action="search.php" method="GET">
                    <input class="form-control bg-secondary border-3" type="search" placeholder="Find Friends" name="keywords" maxlength="50" autocomplate="off" value="<?= $keywords?>">
                    <button class="btn btn-primary p-2" type="submit" name="search"><i class="fa fa-search"></i></button>
                </form>



            <!--table-->
                
                    <div class="col-12 mt-4">
                        <div class="bg-secondary rounded h-100 p-4 mt-10">
                        <h6 class="mb-4 text-center">All Blogger </h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Serial No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View Profile</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if($count){

                                            
                                                while($a = mysqli_fetch_array($result))
                                                {
                                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo ++$no?></th>
                                            <td><b><?php echo $a['user_full_name'];?></b></td>
                                            <td><?php echo $a['user_name'];?></td>
                                            <td><?php echo $a['user_address'];?></td>
                                            <td><?php
                                                                if ($a['user_status'] == 1){
                                                                    echo '<span class="badge bg-success">Online</span>';
                                                                }else{
                                                                    echo '<span class="badge bg-danger">Offline</span>';
                                                                }
                                                               ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    <a href="view.php?id=<?php echo $a['user_id'];?>" class="text-white">
                                                        View
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                                <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr><td colspan="7" class="text-center">No Record Found</td></tr>
                                                <?php
                                            }
                                            
                                            ?>
                                        
                                        </tbody>


                                                                            </table>

                        </div>
                        </div>
                    </div>


                    <!---modal -->
                    


                    </div>
                    </div>
                </div>

  


                </div>                

            </div>


           
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="display_friends.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>