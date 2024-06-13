<?php

include '../includes/connect.php';
if(isset($_GET['Deleted_id']))
{
    $id=$_GET['Deleted_id'];
    $query="DELETE FROM `users` WHERE user_id='$id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo '<script>alert("User Account Deleted Successfully");</script>';
        header('location:add-user.php');
    }
    else
    {
        echo '<script>alert("Something went wrong");</script>';
    }
}

?>