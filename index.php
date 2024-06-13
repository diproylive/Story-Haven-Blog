<?php
session_start();
include 'includes/connect.php';

if(!isset($_SESSION['user_data']))
{
    echo '<script>alert("Please Login");</script>';
    header('location:user_login.php');
}
if(isset($_SESSION['user_data'])){ 
  $idd= $_SESSION['user_data']['0'];
  $sq = "SELECT * FROM `users` WHERE user_id = '$idd'";
  $resul = mysqli_query($con, $sq);
  $count = mysqli_num_rows($resul);
  if($count){
    $u = mysqli_fetch_array($resul);
  }
}

$sql = "SELECT * FROM `users`";

$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
$a = mysqli_fetch_array($result);
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Blog</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/<?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['8'];}?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <a href="profile/my_profile.php?id=<?php echo $a['user_id'];?>">
                        <h6 class="mb-0"><?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['2'];}?></h6>
                        <span>My Profile</span>
                    </a>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Newsfeed</a>
                    <a href="add_post.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Add Post</a>
                    <a href="notifications/notification.php" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notifications</a>
                    <a href="404.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <a href="friends/display_friends.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>All Blogger</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog me-2"></i>Setting</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile/profile_setting.php?profile_id=<?php echo $u['user_id'];?>" class="dropdown-item">Profile Setting</a>
                            <a href="user_logout.php" class="dropdown-item">Log Out</a>
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
            <?php include 'includes/top-nav-bar.php' ?>
            <!-- Navbar End -->


            <!-- Newsfeed start -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">  
                  <div class="container mx-auto mt-4">
                    <div class="row">

                    <!--loop -->
                    <?php
                    $sql2 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id ORDER BY `blog_id` DESC";
                                            
                    $result2 = mysqli_query($con, $sql2);
                    $count2 = mysqli_num_rows($result2); 
                    if($count2)
                    {
                        while($row2 = mysqli_fetch_assoc($result2))
                        {
                            ?>
                            <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                              <img src="img/<?php echo $row2['blog_photo']; ?>" class="card-img-top size" width =500 height=300  alt="https://th.bing.com/th/id/OIP.lkVN1WDlcV2jQCq-9LT7-wHaIJ?w=178&h=196&c=7&r=0&o=5&dpr=1.3&pid=1.7">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo ucfirst($row2['blog_title']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row2['cat_name']; ?></h6>
                                <p class="card-text"><?php echo strip_tags(substr($row2['blog_description'],0,80))."..." ?></p>
                                <a href="read_more.php?Read_id=<?php echo $row2['blog_id'];?>" class="btn mr-2"><i class="fas fa-link"></i>Read More</a>
                                <a href="read_more.php?Read_id=<?php echo $row2['blog_id'];?>" class="btn mr-2" id="comments"><i class="fa fa-commenting-o"></i>Comments</a>
                                
                                <h6 class="card-name mb-2 text-green"><?php echo $row2['user_name']; ?></h6>
                                <small class="text-sm text-muted"><?php echo date('d-M-Y', strtotime($row2['date'])); ?></small>
                              </div>
                            </div>
                        </div>
  
                        <!--loop ends -->
<?php

                        }
                    }
                    ?>
                      <div class="col-md-4">
                          <div class="card" style="width: 18rem;">
                            <img src="https://i.imgur.com/ZTkt4I5.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Category</h6>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              <a href="read_more.php" class="btn mr-2"><i class="fas fa-link"></i> Read More</a>
                              
                              
                              <h6 class="card-name mb-2 text-muted">name</h6>
                              <small class="text-sm">12-april-2024</small>
                            </div>
                          </div>
                      </div>

                      <!--loop ends -->
                      

                      <!-- resent post 
                      <div class="col-md-4">
                          <div class="card" style="width: 18rem;">
                            <div class="card-body">


                            </div>
                          </div>
                      </div>
                      -->

                        
                    </div>
                  </div>
                </div>
          </div>

  


                </div>                

            </div>


           
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
    <script src="js/main.js"></script>
</body>

</html>