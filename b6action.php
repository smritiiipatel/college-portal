<?php
$a = $_GET['t1'];
$b = $_GET['t2'];
$con = mysqli_connect('localhost','root','goodluck','notes');
$q = "select * from studentinfo where name='$a' and rollno ='$b'";
$res = mysqli_query($con,$q);
if($row = mysqli_fetch_array($res)){
    echo"<script>window.location='b8.php';</script>";
}
else{
    echo"error enter correct password or name.";
}
?>

