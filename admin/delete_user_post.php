<?php
include '../includes/connect.php';

if(isset($_GET['Deleted_id']))
{
    $id=$_GET['Deleted_id'];
    $img = "../img/".$_POST['img'];
    $query="DELETE FROM `blog1` WHERE blog_id='$id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        unlink($img);
        echo '<script>alert("Post Deleted Successfully");</script>';
        header('location:user_post.php');
    }
    else
    {
        echo '<script>alert("Something went wrong");</script>';
        header('location:user_post.php');
    }
}

?>