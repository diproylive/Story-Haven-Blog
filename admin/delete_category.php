<?php
include '../includes/connect.php';

if(isset($_GET['Delete_Category']))
{
    $id=$_GET['Delete_Category'];
    $query="DELETE FROM `categories` WHERE cat_id='$id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo '<script>alert("Category Deleted Successfully");</script>';
        header('location:category.php');
    }
    else
    {
        echo '<script>alert("Something went wrong");</script>';
        header('location:category.php');
    }
}

?>