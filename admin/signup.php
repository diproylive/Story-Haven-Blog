<?php
ob_start();
error_reporting(E_ALL);  
include '../includes/connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin signin/Signup</title>
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

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>dCoder</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingText" name="name" placeholder="Name" required>
                            <label for="floatingText">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="cpassword" placeholder="Password" required>
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="floatingText" name="admin_photo">
                            <label for="floatingText">Select Profile Photo(only jpg,png and jpeg)</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
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
<?php
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $file_name = $_FILES['admin_photo']['name'];
    $tmp_name = $_FILES['admin_photo']['tmp_name'];
    $file_size = $_FILES['admin_photo']['size'];
    $img_extention = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $allow_type = ['jpg', 'png', 'jpeg'];
    $dest = "img/".$file_name;
    
    $sql = "SELECT * FROM `admin` WHERE admin_email = '$email'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    if($count)
    {
        echo "<script>alert('Email Already Exist');</script>";
    }
    else
    {
        if($password == $cpassword)
        {
            if (in_array($img_extention, $allow_type)){
                if ($file_size <= 8000000){
                    if (move_uploaded_file($tmp_name, $dest)) {
                        $sql2 = "INSERT INTO `admin`(`admin_name`, `admin_email`, `admin_password`, `admin_cpassword`, `admin_photo`) VALUES ('$name','$email','$password','$cpassword','$file_name')";
                        $result2 = mysqli_query($con, $sql2);
                        if ($result2) {
                            echo "<script>alert('Record Insert Successfully')</script>";
                            echo "<script>window.location.href='signin.php'</script>";
                        }
                        else{
                            echo "<script>alert('Record Insert Failed')</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Something went wrong')</script>";
                    }
                }
                else
                {
                    echo "<script>alert('File size too large')</script>";
                }
            }
            else
            {
                echo "<script>alert('Invalid file type')</script>";
            }
        }
        else
        {
            echo "<script>alert('Password not match');</script>";
        }
    }

}
?>