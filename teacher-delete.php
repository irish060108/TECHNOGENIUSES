<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])    &&
	isset($_GET['teacher_id'])) {

	if ($_SESSION['role'] == 'Admin'){
		include "DB_connection.php";
		include "teacherrr.php";

		$id = $_GET['teacher_id'];
		if (removeTeacher($id, $conn)){
			$sm = "Successfully Deleted!";
			header("Location: teachers.php?success=$sm");
			exit;
		}else {
			$em = "Unknown Error Occured";
			header("Location: teachers.php?error=$em");
			exit;
		}


	}else {
	header("Location: teachers.php");
	exit;
} 
	}else {
	header("Location: teachers.php");
	exit;
} 
