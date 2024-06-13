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
    <title>Blog || Notification</title>
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
<style>

:root {
  --gradient: linear-gradient(to left top, #DD2476 10%, #FF512F 90%) !important;
}

body {
  background: #111 !important;
}

.card {
  background: #222;
  border: 1px solid #dd2476;
  color: rgba(250, 250, 250, 0.8);
  margin-bottom: 2rem;
}

.btn {
  border: 5px solid;
  border-image-slice: 1;
  background: var(--gradient) !important;
  -webkit-background-clip: text !important;
  -webkit-text-fill-color: transparent !important;
  border-image-source:  var(--gradient) !important; 
  text-decoration: none;
  transition: all .4s ease;
}

.btn:hover, .btn:focus {
      background: var(--gradient) !important;
  -webkit-background-clip: none !important;
  -webkit-text-fill-color: #fff !important;
  border: 5px solid #fff !important; 
  box-shadow: #222 1px 0 10px;
  text-decoration: underline;
}
    </style>

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
                    <a href="notification.php" class="nav-item nav-link active"><i class="fa fa-bell me-2"></i>Notifications</a>
                    <a href="404.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <a href="../friends/display_friends.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>All Blogger</a>
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
            <?php include '../includes/top-nav-bar.php' ?>
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
                    <input class="form-control bg-secondary border-3" type="search" placeholder="Find Blogger Post" name="keywords" maxlength="50" autocomplate="off" value="<?= $keywords?>">
                    <button class="btn btn-primary p-2" type="submit" name="search"><i class="fa fa-search"></i></button>
                </form>



            <!--table-->
                
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="h-100 bg-secondary rounded p-4">
                        <h6 class="mb-4">Basic Table</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Notifications</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        if(isset($_GET['keywords']))
                                        {
                                            $keywords = $_GET['keywords'];

                                        
                                        $sql2 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id WHERE blog_title LIKE '%$keywords%' OR user_name LIKE '%$keywords%' OR user_full_name LIKE '%$keywords%' OR cat_name LIKE '%$keywords%' ORDER BY `blog_id` DESC";
                                                                
                                        $res2 = mysqli_query($con, $sql2);
                                        $count2 = mysqli_num_rows($res2); 
                                        if($count2)
                                        {
                                                while($row2 = mysqli_fetch_array($res2))
                                        {
                                            ?>

                                        <tr>
                                            <th scope="row"><?php echo ++$n;?></th>
                                            <td>
                                                <a href="notification.php?noti_id=<?php echo $row2['blog_id']; ?>" >
                                                    <?php echo $row2['user_full_name']; ?> Recent added a new post : <b><?php echo strip_tags(substr($row2['blog_title'],0,50))."..."  ?>  </b>
                                                </a>
                                            </td>
                                            <td><?php echo date('d-M-Y', strtotime($row2['date'])); ?></td>
                                            <td>
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i>
                                                
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#">Remove This</a></li>
                                                
                                                </ul>
                                            </td>
                                        </tr>

                                        <?php
                                        }
                                    }
                                }
                                    ?>
                                    
                                </tbody>
                            </table>
                    </div>
                </div>

                <?php
                if(isset($_GET['noti_id']))
                {
                    $noti_id = $_GET['noti_id'];
                    $sql3 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id WHERE `blog_id`='$noti_id'";
                                                            
                    $result3 = mysqli_query($con, $sql3);
                    $count3 = mysqli_num_rows($result3); 
                    
                    $ro=mysqli_fetch_array($result3);
                    
                }
                ?>
                <div class="col-md-4">
                          <div class="card" style="width: 18rem;">
                          <h5 class="text-center">   Post</h5>
                            <img src="../img/<?php echo $ro['blog_photo'];?>" class="card-img-top" alt="../img/alt1.png">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $ro['blog_title'];?></h5>
                              <small class="text-sm ml-6 card-muted"><?php echo $ro['cat_name'];?></small>
                              <h6 class="card-subtitle mb-2 text-muted"></h6>
                              <p class="card-text"><?php echo strip_tags(substr($ro['blog_description'],0,80))."..." ?>.</p>
                              <a href="../read_more.php?Read_id=<?php echo $ro['blog_id'];?>" class="btn mr-2"><i class="fas fa-link"></i> See Post</a>
                              
                              <h6 class="card-name mb-2 text"><?php echo $ro['user_full_name'];?></h6>
                              <small class="text-sm text-muted"><?php echo date('d-M-Y', strtotime($ro['date'])); ?></small>
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
        <a href="notification.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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