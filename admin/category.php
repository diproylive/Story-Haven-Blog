<?php
session_start();
include 'includes/header.php';
//include 'includes/side-nav-bar.php'; 
include '../includes/connect.php';

?>
<div class="container-fluid position-relative d-flex p-0">
    <?php include 'includes/loading-page.php'; ?>

    <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>dCoder</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/<?php if(isset($_SESSION['admin_data'])){ echo $_SESSION['admin_data']['5'];}?>" alt="" style="width: 40px; height: 40px;">
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
                        <a href="" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Blog Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user_post.php" class="dropdown-item">All Post</a>
                            <a href="category.php" class="dropdown-item active">Add Category</a>
                            <!-- <a href="element.html" class="dropdown-item">Other Elements</a> -->
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Blog User</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user.php" class="dropdown-item">Uses</a>
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




<div class="content">
    <?php include 'includes/top-nav-bar.php';
    ?>
      <!-- categories from -->
        <div class="container-fluid pt-4 px-4">


        <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Categories</h6>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Add Categories</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="add_cat" placeholder="Add Category" required
                                        aria-describedby="emailHelp">
                                </div>
                        </div>
                                <button type="submit" class="btn btn-primary" name="add">Add (+)</button>
                            </form>
                        </div>


                        <?php
                        if(isset($_POST['add']))
                        {
                            $add_cat = $_POST['add_cat'];

                            $sql = "SELECT * FROM `categories` WHERE `cat_name` = '$add_cat'";
                            $result = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($result);
                            if($count)
                            {
                                echo '<script>alert("Category Already Exits")</script>';
                            }
                            else
                            {
                                $sql1 = "INSERT INTO `categories`(cat_name) VALUES('$add_cat')";
                                $result1 = mysqli_query($con, $sql1);
                                if($result1)
                                {
                                    //echo '<script>alert("Category Added Successfully")</script>';
                                    echo '<script>window.location.href="category.php";</script>';
                                }
                                else
                                {
                                    echo '<script>alert("Category Not Added")</script>';
                                    echo '<script>window.location.href="category.php";</script>';
                                }
                            }
                            
                        } 
                        ?>

                        <div class="col-sm-12 col-xl-6 mt-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">All Categories</h6>
                            <table class="table">
                               
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Category</th>
                                        <th scope="colspan=2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                         $sql = "SELECT * FROM `categories`";
                                         $result = mysqli_query($con, $sql);
                                         $count=0;
                                         if ($result)
                                         {
                                             while ($row = mysqli_fetch_assoc($result))
                                             {
                                                 ?>
                                                    <tr>
                                                        <th scope="row"><?php echo ++$count ?></th>
                                                        <td><?php echo $row['cat_name']; ?></td>
                                                        <td>
                                                            <button class="btn btn-danger">
                                                                <a href="delete_category.php?Delete_Category=<?php echo $row['cat_id']; ?>" title="Delete" class="text-white">
                                                                Delete
                                                                </a>
                                                            </button>

                                                        </td>
                                                    </tr>

                                                <?php
                                             }
                                            }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>


                    </div>
                
</div>
            <!-- Sale & Revenue End -->



             <!-- Sales Chart Start -->
             
            <!-- Widgets End -->






     
           <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js">
        const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
    </script>
</body>

</html>