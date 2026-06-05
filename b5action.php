<?php
$r = $_POST['a1'];
$m = $_POST['a2'];
$n = $_POST['a3'];
$p = $_POST['a4'];
$fon =$_FILES['f1']['name'];
$tn =$_FILES['f1']['tmp_name'];
if(move_uploaded_file($tn,$fon))
{
$con=mysqli_connect('mysql.railway.internal', 'root', 'GJifTuTKslzyFAUQochWGXciqLxvOpEU', 'railway');

	$q="insert into form values('$r','$m','$n','$p','$fon')";
	echo "Uploaded";
	$res=mysqli_query($con,$q);
	if($res)
		echo "Save";
}
{

	echo "error ";
}	
 ?>