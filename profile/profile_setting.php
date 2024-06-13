<?php
session_start();
include '../includes/connect.php';

$id = $_SESSION['user_data']['0'];

if(isset($_SESSION['user_data']['0']))
{
    $idd = $_SESSION['user_data']['0'];
}

if(!isset($_SESSION['user_data']))
{
    echo '<script>alert("Please Login");</script>';
    header('location:../user_login.php');
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
    <title>Blog || My Profile</title>
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










.social-cover{
    position:absolute;
    left:0;
    right:0;
    top:0;
    bottom:0
    ;background-color:rgba(0, 0, 0, 0.7);  
      
}

.cover-container {
    height:350px;
    margin-top:-25px;
    background-image:url(https://source.unsplash.com/550x380/?nature);
    background-size:cover;
    position:relative;
    margin-bottom:25px;
    background-position:center; 
    margin-top:10px;
}

.btn-brightblue.btn-inverse.btn-outlined {
    color: #fff;
    border-color: #fff;
}

.border-black75 {
    border-color: #3F3F3B!important;
}

.btn-brightblue.btn-outlined {
    color: #003BFF;
    background: 0 0;
}

.social-avatar {
    top: 0;
    right: 0;
    bottom: 0;
    width: 300px;
    position: absolute;
    background: -webkit-linear-gradient(top,rgba(0,0,0,.3) 0,rgba(0,0,0,.5) 100%);
    background: linear-gradient(top,rgba(0,0,0,.3) 0,rgba(0,0,0,.5) 100%);
}

.img-avatar{
    display:block;
    border-radius:100px;
    border:2px solid #fff;
    margin:auto;
    margin-top:50px;    
}

.social-desc {
    top: 0;
    left: 0;
    bottom: 0;
    right: 300px;
    position: absolute;
}

.social-desc div {
    margin-left: 10%;
    margin-top: 100px;
}

.fg-focus-white:focus, 
.fg-hover-white:hover, 
.fg-white, 
.fg-white .tab-container.plain .nav-tabs .b-tab.active a, 
.fg-white .fg-tab-active .tab-container .nav-tabs .b-tab.active a, 
.fg-white .tab-container .nav-tabs .b-tab a {
    color: #fff;
}
.fg-white{
    opacity:0.8;
}


.btn-orange75.btn-inverse.btn-outlined {
    color: #fff;
    border-color: #fff;
}

.btn-orange75.btn-outlined {
    color: #EE682F;
    background: 0 0;
}

.btn.btn-rounded {
    line-height: 1;
    border-radius: 100px;
    height: auto!important;
    padding: 15px!important;
}

.btn>.rubix-icon {
    line-height: 1;
    font-size: 18px;
}

.social-like-count {
    cursor: pointer;
    display: inline-block;
}

.social-like-count>span {
    margin-left: 25px;
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
                        <img class="rounded-circle" src="../img/<?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['8'];}?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <a href="my_profile.php?id=<?php echo $a['user_id'];?>">
                        <h6 class="mb-0"><?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['2'];}?></h6>
                        <span>My Profile</span>
                    </a>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Newsfeed</a>
                    <a href="../add_post.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Add Post</a>
                    <a href="../notifications/notification.php" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notifications</a>
                    <a href="../404.php" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <a href="../friends/display_friends.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>All Blogger</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog me-2"></i>Setting</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile_setting.php?profile_id=<?php echo $u['user_id'];?>" class="dropdown-item">Profile Setting</a>
                            <a href="../user_logout.php" class="dropdown-item">Log Out</a>
                            <a href="../404.php" class="dropdown-item">404 Error</a>
                            <a href="../blank.html" class="dropdown-item">Blank Page</a>
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
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Basic Form</h6>
                            <form method="POST" enctype="multipart/form-data" action="">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"
                                        aria-describedby="nameHelp" value="<?php echo $u['user_full_name'];?>">
                                </div>
                                
                                <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Address"
                                    id="address" style="height: 150px;" name="address"><?php echo $u['user_address'];?>
                                </textarea>
                                <label for="floatingTextarea">Address</label>
                            </div>
                                <div class="mb-3">
                                    <label for="profession" class="form-label">Profession</label>
                                    <input type="text" class="form-control" id="profession" name="profession" placeholder="Enter Your Profession"
                                        aria-describedby="nameHelp" value="<?php echo $u['profession'];?>">
                                </div>
                            <div class="mb-3">
                                    <label for="number" class="form-label">Phone No</label>
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Enter Your phone No"
                                        aria-describedby="numberHelp" value="<?php echo $u['user_phone'];?>">
                                    
                                    </div>
                                    <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Your Email"
                                        aria-describedby="emailHelp" value="<?php echo $u['user_email'];?>">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <div class="mb-3">
                                <label for="formFile" class="form-label">Select Profile Photo(only jpg,png and jpeg)</label>
                                <input class="form-control bg-dark" type="file" id="formFile" name="user_photo">
                                <img src="../img/<?php echo $u['user_photo'];?>" alt="https://th.bing.com/th/id/OIP.DSvKh0zhStpGU9IJ2oLUxAHaH0?rs=1&pid=ImgDetMain" style="width: 100px; height: 100px;">
                            </div>
                            <label for="basic-url" class="form-label">Your Facebook Profile URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                <input type="text" class="form-control" id="basic-url" name = "fb" aria-describedby="basic-addon3" value="<?php echo $u['facebook'];?>">
                            </div>
                            <label for="basic-url" class="form-label">Your Instragram Profile URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                <input type="text" class="form-control" id="basic-url" name ="in" aria-describedby="basic-addon3" value="<?php echo $u['instagram'];?>">
                            </div>
                            <label for="basic-url" class="form-label">Your Youtube Profile URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                <input type="text" class="form-control" id="basic-url" name="yt" aria-describedby="basic-addon3" value="<?php echo $u['youtube'];?>">
                            </div>
                            <label for="basic-url" class="form-label">Your vanity URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                <input type="text" class="form-control" id="basic-url" name="ot" aria-describedby="basic-addon3" value="<?php echo $u['others'];?>">
                            </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="done" >Done</button>
                            </form>
                        </div>
                    </div>
                    
               
                 
                </div>
          </div>

  


                </div>                

            </div>


           
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="profile/my_profile.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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

<?php
if(isset($_POST['done']))
{   
    $idd= $_SESSION['user_data']['0'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $profession = $_POST['profession'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $fb = $_POST['fb'];
    $in = $_POST['in'];
    $yt = $_POST['yt'];
    $ot = $_POST['ot'];

    $file_name = $_FILES['user_photo']['name'];
    $tmp_name = $_FILES['user_photo']['tmp_name'];
    $file_size = $_FILES['user_photo']['size'];
    $img_extention = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $allow_type = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    $dest = "../img/".$file_name;
    
    if(!empty($file_name))
    {
        if (in_array($img_extention, $allow_type)){
            if ($file_size < 8000000){
                $unlink = "../img/".$u['user_photo'];
                unlink($unlink);
                if (move_uploaded_file($tmp_name, $dest)) {
                    $s = "UPDATE `users` SET `user_full_name`='$name',`user_email`='$email',`user_address`='$address',`user_phone`='$number',`user_photo`='$file_name',`profession`='$profession',`facebook`='$fb',`instagram`='$in',`youtube`='$yt',`others`='$ot' WHERE `user_id`='$idd'";
    
                    $r = mysqli_query($con, $s);
    
                   
                    if ($r) {
                        echo "<script>alert('Profile Updated Successfully')</script>";
                        echo "<script>window.location.href='profile_setting.php'</script>";
                    }
                    else{
                        echo "<script>alert('Something went wrong')</script>";
                        echo "<script>window.location.href='profile_setting.php'</script>";
                    }
                }
                else{
                    echo "<script>alert('Something went wrong')</script>";
                    echo "<script>window.location.href='profile_setting.php'</script>";
                }
            }
            else{
                echo "<script>alert('File size too large')</script>";
                echo "<script>window.location.href='profile_setting.php'</script>";
            }
        }
        else{
            echo "<script>alert('Invalid file type')</script>";
            echo "<script>window.location.href='profile_setting.php'</script>";
        }

    }
    else
    {
        $st = "UPDATE `users` SET `user_full_name`='$name',`user_email`='$email',`user_address`='$address',`user_phone`='$number',`user_photo`='[value-9]',`profession`='$profession',`facebook`='$fb',`instagram`='$in',`youtube`='$yt',`others`='$ot' WHERE `user_id`='$idd'";
    
                    $r = mysqli_query($con, $st);
    
                   
                    if ($r) {
                        echo "<script>alert('Profile Updated Successfully')</script>";
                        echo "<script>window.location.href='profile_setting.php'</script>";
                    }
                    else{
                        echo "<script>alert('Something went wrong')</script>";
                        echo "<script>window.location.href='profile_setting.php'</script>";
                    }

    }

}


?>