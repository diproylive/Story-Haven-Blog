<?php
session_start();
include 'includes/header.php';
include 'includes/side-nav-bar.php'; 
include '../includes/connect.php';

if(!isset($_SESSION['admin_data']))
{
    echo '<script>alert("Please Login Admin");</script>';
    header('location:signin.php');
}

$sql = "SELECT * FROM `admin`";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

$sql1 = "SELECT * FROM `users`";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM `blog1`";
$result2 = mysqli_query($con, $sql2);
$count2 = mysqli_num_rows($result2);


?>
<div class="container-fluid position-relative d-flex p-0">
    <?php include 'includes/loading-page.php'; ?>
<div class="content">
    <?php include 'includes/top-nav-bar.php';
    ?>
      <!-- Sale & Revenue Start -->
      <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0">0<?php echo $count1;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Admin</p>
                                <h6 class="mb-0">0<?php echo $count;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today User Online</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Post</p>
                                <h6 class="mb-0">0<?php echo $count2; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->



             <!-- Sales Chart Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->




             <!-- Recent Sales Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Post</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $sq2 = "SELECT * FROM `blog1` LEFT JOIN `categories` ON blog1.cat_id = categories.cat_id LEFT JOIN `users` ON blog1.user_id = users.user_id ORDER BY `blog_id` DESC";
                                            
                        $res2 = mysqli_query($con, $sq2);
                        $c2 = mysqli_num_rows($res2); 


                        ?>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Blog Title</th>
                                    <th scope="col">Blog Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($c2){
                                    
                                    while ($ro2 = mysqli_fetch_assoc($res2)){
                                       ?>
                                       <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td><?php echo date('d-M-Y', strtotime($ro2['date'])); ?></td>
                                    <td><?php echo $ro2['user_full_name']; ?></td>
                                    <td><?php echo $ro2['blog_title']; ?></td>
                                    <td><img src = "../img/<?php echo $ro2['blog_photo'];?>" width=50 title="<?php echo $ro2['user_photo'];?>"></td>
                                    <td>
                                    <?php
                                                                if ($ro2['user_status'] == 1){
                                                                    echo '<span class="badge bg-success">Active</span>';
                                                                }else{
                                                                    echo '<span class="badge bg-danger">Inactive</span>';
                                                                }
                                                               ?>
                                    </td>
                                    <td colspan='2'>
                                                            <button class="btn btn-sm btn-danger text-white">
                                                                <a href ="delete_user_post.php?Deleted_id=<?php echo $ro2['blog_id'];?>" title="Delete <?php echo $ro2['user_full_name'];?>" class="text-white">Delete</a>
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

            <!-- Recent Sales End -->



             <!-- Widgets Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-secondary rounded p-4">
                    
                    



                    </div>
                </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <form action="" method="POST">
                                    <input class="form-control bg-dark border-0" type="text" placeholder="Enter task" name="task" required>
                                    <input type="submit" class="btn btn-primary ms-2" value="Add" name="add"/>
                                </form>
                                <?php
                               if(isset($_POST['add'])){
                                    
                                    $task = $_POST['task'];
                                    $admin_id=$_SESSION['admin_data']['0'];
                                    $sq3 = "INSERT INTO `task`(`admin_id`, `admin_task`) VALUES ('$admin_id','$task')";
                                    $res3 = mysqli_query($con, $sq3);
                                    if ($res3){
                                        echo '<div class="alert alert-success" role="alert">Task Added</div>';
                                    }else{
                                        echo '<div class="alert alert-danger" role="alert">Task Not Added</div>';
                                    }
                                }
                             
                                ?>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                
                            
                                <div class="w-100 ms-3">
                                    <?php
                                    
                                    $sq4 = "SELECT * FROM `task` LEFT JOIN `admin` ON task.admin_id = admin.admin_id ORDER BY `task_id` DESC";
                                    
                                    $res4 = mysqli_query($con, $sq4);
                                    
                                    $c4 = mysqli_num_rows($res4);
                                    
                                    if ($c4){
                                        while ($ro4 = mysqli_fetch_assoc($res4)){
                                           ?>
                                            <div class="d-flex align-items-center mb-2">
                                                
                                                <div class="w-100 ms-3">
                                                    <h6 class="mb-0"><?php echo $ro4['admin_task'];?></h6><a href="delete_task.php?Task_id=<?php echo $ro4['task_id'] ?>"><input class="form-check-input m-1" type="checkbox"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <p class="mb-0"><?php echo date('d-M-Y', strtotime($ro4['task_date']));?></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                   
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->






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
    <script src="js/main.js">
        const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
    </script>
</body>

</html>