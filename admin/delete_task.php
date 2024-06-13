<?php
include '../includes/connect.php';
if(isset($_GET['Task_id']))
{
    $id=$_GET['Task_id'];
    $query="DELETE FROM `task` WHERE task_id='$id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo '<script>alert("Deleted Successfully");</script>';
        header('location:index.php');
    }
    else
    {
        echo '<script>alert("Something went wrong");</script>';
    }
}

?>