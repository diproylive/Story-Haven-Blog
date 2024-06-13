

<?php 
ob_start();
error_reporting(E_ALL);
session_start();

include '../includes/connect.php';


if(isset($_GET['keywords'])){
    $keywords = $_GET['keywords'];
    $sql = "SELECT * FROM `users` WHERE user_name LIKE '%$keywords%' OR user_full_name LIKE '%$keywords%' OR user_email LIKE '%$keywords%' OR user_phone LIKE '%$keywords%' ORDER BY `user_id` DESC";

    $result = mysqli_query($con, $sql);

    $count = mysqli_num_rows($result);

    $no = 0;
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin DashBoard || User Search</title>
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


        <!-- Sidebar Start -->


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
                    <a href="./index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Blog Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user_post.php" class="dropdown-item">Post</a>
                            <a href="category.php" class="dropdown-item">Add Category</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Blog User</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user.php" class="dropdown-item active">User</a>
                            <a href="add-user.php" class="dropdown-item">Modify Users</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
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
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
           <?php include 'includes/top-nav-bar.php'; ?>
            <!-- Navbar End -->



            <!-- table start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4 text-center">All User Table</h6>
                        <hr>
                            <div class="table-responsive">
                                <table class="table" border='5'>
                                    <thead>
                                        <tr>
                                            <th scope="col">Serial No</th>
                                            <th scope="col"><b class="text-white">Name</b></th>
                                            <th scope="col"><b class="text-white">User Name</b></th>
                                            <th scope="col" class="text-white">Email</th>
                                            <th scope="col" class="text-white">Phone No</th>
                                            <th scope="col" class="text-white">Address</th>
                                            <th scope="col" class="text-white">Profile Photo</th>
                                            <th scope="col" class="text-white">Status</th>
                                            <th scope="col" class="text-white">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php
                                            if ($count){
                                                while ($row = mysqli_fetch_array($result)){


                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ++$no?></th>
                                                        <td><?php echo $row['user_full_name'];?></td>
                                                        <td class="text-white"><?php echo $row['user_name'];?></td>
                                                        <td><?php echo $row['user_email'];?></td>
                                                        <td><?php echo $row['user_phone'];?></td>
                                                        <td><?php echo $row['user_address'];?></td>
                                                        <td><img src = "../img/<?php echo $row['user_photo'];?>" width=50 title="<?php echo $row['user_photo'];?>"></td>
                                                        <td>
                                                            <?php
                                                                if ($row['user_status'] == 1){
                                                                    echo '<span class="badge bg-success">Active</span>';
                                                                }else{
                                                                    echo '<span class="badge bg-danger">Inactive</span>';
                                                                }
                                                               ?>
                                                            </td>
                                                            <td colspan='2'>
                                                            <button class="btn btn-sm btn-danger text-white">
                                                                <a href ="delete_user_post.php?Deleted_id=<?php echo $row['user_id'];?>" title="Delete <?php echo $row['user_full_name'];?>" class="text-white">Delete</a>
                                                            </button>
                                                        </td>
                                                    </tr>


                                                 <?php   
                                                }
                                            }
                                            else{
                                                 echo '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
                                            } 
                                            ?>
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


            


            <!-- Footer Start -->
            
            <?php include 'includes/footer.php'; ?>

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