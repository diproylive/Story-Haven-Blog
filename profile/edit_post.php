<?php
ob_start();
error_reporting(E_ALL);
session_start();
include '../includes/connect.php';

//get id
if (isset($_GET['Edit_id'])) {
    $ii = $_GET['Edit_id'];
    // Rest of your code...
}
if(isset($_GET['Edit_id'])){
    $ii=$_GET['Edit_id'];
    $sql2 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id WHERE blog1.blog_id='$ii'";
                                            
    $res = mysqli_query($con, $sql2);
    $count2 = mysqli_num_rows($res); 
    $ro = mysqli_fetch_array($res);

}

$id = $_SESSION['user_data']['0'];

if(!isset($_SESSION['user_data']))
{
    echo '<script>alert("Please Login");</script>';
    header('location:../user_login.php');
}


$sql1 = "SELECT * FROM `users`";

$result1 = mysqli_query($con, $sql1);
$count = mysqli_num_rows($result1);
$a = mysqli_fetch_array($result1);

if(isset($_SESSION['user_data']))
{
    $user_id=$_SESSION['user_data']['0'];
}
$sql ="SELECT * FROM `categories`";

$result=mysqli_query($con,$sql);



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
    <title>Blog || Edit Post || Read Post</title>
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
        <?php include '../admin/includes/loading-page.php'?>
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
                    <a href="my_profile.php?id=<?php echo $a['user_id'];?>">
                        <h6 class="mb-0"><?php if(isset($_SESSION['user_data'])){ echo $_SESSION['user_data']['2'];}?></h6>
                        <span>My Profile</span>
                    </a>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Newsfeed</a>
                    <a href="../add_post.php" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Add Post</a>
                    <a href="../notifications/notification.php" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notifications</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Others</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-cog me-2"></i>Setting</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="profile_setting.php?profile_id=<?php echo $u['user_id'];?>" class="dropdown-item">Profile Setting</a>
                            <a href="../user_logout.php" class="dropdown-item">Log Out</a>
                            <a href="../404.php" class="dropdown-item">404 Error</a>
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


             <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Publish Post</h6>
                        <form method="POST" enctype="multipart/form-data" action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder=" Title" name="blog_title" value="<?= $ro['blog_title']?>">
                                <label for="floatingInput">Blog Title</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Body/Description"
                                    id="blog_des" style="height: 150px;" name="blog_des"><?php echo $ro['blog_description'];?>
                                </textarea>
                                <label for="floatingTextarea">Blog Description</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select Profile Photo(only jpg,png and jpeg)</label>
                                <input class="form-control bg-dark" type="file" id="formFile" name="blog_photo">
                                <img src="../img/<?php echo $ro['blog_photo'];?>" alt="" style="width: 100px; height: 100px;">
                            </div>
                            
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" name="category" required>
                                    
                                    <option value="<?php echo $ro['cat_id'];?>">Choose categories</option>
                                    <?php
                                    
                                    if ($result){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                           ?>
                                            <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                    
                                    
                                </select>
                                <label for="floatingSelect">Select Categories</label>
                            </div>
                            <div class="form-floating mb-3">
                                <button type="submit" class="btn btn-primary" name="edit" >Edit Post</button>
                                <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
                            </div>
                            
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
<a href="edit_post.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>

</body>

</html>


<?php
if(isset($_POST['edit']))
{   
    $ii=$_GET['Edit_id'];
    $title = $_POST['blog_title'];
    $des = $_POST['blog_des'];
    $file_name = $_FILES['blog_photo']['name'];
    $tmp_name = $_FILES['blog_photo']['tmp_name'];
    $file_size = $_FILES['blog_photo']['size'];
    $img_extention = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $allow_type = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    $dest = "../img/".$file_name;
    $category = $_POST['category'];
    if(!empty($file_name))
    {
        if (in_array($img_extention, $allow_type)){
            if ($file_size < 8000000){
                $unlink = "../img/".$ro['blog_photo'];
                unlink($unlink);
                if (move_uploaded_file($tmp_name, $dest)) {
                    $s = "UPDATE `blog1` SET `blog_title`='$title',`blog_photo`='$file_name',`cat_id`='$category',`user_id`='$id',`blog_description`='$des' WHERE `blog_id`='$ii'";
    
                    $r = mysqli_query($con, $s);
    
                   
                    if ($r) {
                        echo "<script>alert('Post Updated Successfully')</script>";
                        echo "<script>window.location.href='my_profile.php'</script>";
                    }
                    else{
                        echo "<script>alert('Something went wrong')</script>";
                        echo "<script>window.location.href='edit_post.php'</script>";
                    }
                }
                else{
                    echo "<script>alert('Something went wrong')</script>";
                    echo "<script>window.location.href='edit_post.php'</script>";
                }
            }
            else{
                echo "<script>alert('File size too large')</script>";
                echo "<script>window.location.href='edit_post.php'</script>";
            }
        }
        else{
            echo "<script>alert('Invalid file type')</script>";
            echo "<script>window.location.href='edit_post.php'</script>";
        }

    }
    else
    {
        $st = "UPDATE `blog1` SET `blog_title`='$title',`cat_id`='$category',`user_id`='$id',`blog_description`='$des' WHERE blog1.blog_id='$ii'";
    
                    $r = mysqli_query($con, $st);
    
                   
                    if ($r) {
                        echo "<script>alert('Post Updated Successfully')</script>";
                        echo "<script>window.location.href='my_profile.php'</script>";
                    }
                    else{
                        echo "<script>alert('Something went wrong')</script>";
                        echo "<script>window.location.href='edit_post.php'</script>";
                    }

    }

}

if(isset($_POST['reset'])){
    echo "<script>window.location.href='edit_post.php'</script>";
}


?>