<?php 
// jike belum login

if (isset($_SESSION['log'])) {
	
}else{
	header('location:login.php');  
}
?>