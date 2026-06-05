<?php
$r = $_GET['a1'];
$m = $_GET['a2'];
$n = $_GET['a3'];
$p = $_GET['a4'];
$q = $_GET['a5'];
$con = mysqli_connect('mysql.railway.internal', 'root', 'GJifTuTKslzyFAUQochWGXciqLxvOpEU', 'railway');
$a = "insert into studentinfo values ('$r','$m','$n','$p','$q')";
$res = mysqli_query($con,$a);
if($res){
    echo"information saved successfully";
}
else{
    echo"error while saving database";
}
?>