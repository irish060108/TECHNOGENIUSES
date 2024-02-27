<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){

 
if (isset($_POST['lrn']) &&
	isset($_POST['fname']) &&
	isset($_POST['lname']) &&
	isset($_POST['mname']) &&
	isset($_POST['username']) &&
	isset($_POST['student_id']) &&
	isset($_POST['address']) &&
	isset($_POST['gender']) &&
	isset($_POST['email_address']) &&
	isset($_POST['date_of_birth']) &&
	isset($_POST['parent_fname']) &&
	isset($_POST['parent_lname']) &&
	isset($_POST['parent_mname']) &&
	isset($_POST['parent_phone_number']) &&
	isset($_POST['grades'])) {

	include "DB_connection.php";
	include "teacherrr.php";
	include "studenttt.php";

	$lrn = $_POST['lrn'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mname = $_POST['mname'];
	$uname = $_POST['username'];
	$student_id = $_POST['student_id'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$email_address = $_POST['email_address'];
	$date_of_birth = $_POST['date_of_birth'];
	$parent_fname = $_POST['parent_fname'];
	$parent_lname = $_POST['parent_lname'];
	$parent_mname = $_POST['parent_mname'];
	$parent_phone_number = $_POST['parent_phone_number'];
	$grades = "";
	foreach ($_POST['grades'] as $grade) {
		$grades .=$grade;

	}
	$section = $_POST['section'];

	$data = 'student_id='.$student_id;

	if (empty($lrn)) {
		$em = "LRN is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (!lrnIsUnique($lrn, $conn, $student_id)) {
		$em = "LRN is taken! try another";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($fname)) {
		$em = "First Name is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em = "Last Name is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em = "Username is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn, $student_id)) {
		$em = "Username is taken! try another";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
		$em = "Address is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($gender)) {
		$em = "Gender is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($email_address)) {
		$em = "Email Address is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($date_of_birth)) {
		$em = "Date of Birth is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($parent_fname)) {
		$em = "Parent First Name is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($parent_lname)) {
		$em = "Parent Last Name is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($parent_mname)) {
		$em = "Parent Middle Name is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else if (empty($parent_phone_number)) {
		$em = "Parent Phone Number is required";
		header("Location: student-edit.php?error=$em&$data");
		exit;
	}else {
		$sql = "UPDATE students SET 
		username = ?, lrn = ?, fname=?, lname=?, mname=?, address=?, gender=? , email_address=?, date_of_birth=?, parent_fname=?, parent_lname=?, parent_mname=?, parent_phone_number=? ,grade=?, section=?
		WHERE student_id=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $lrn, $fname, $lname, $mname, $address,$gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_mname, $parent_phone_number, $grade, $section, $student_id]);
		$sm = "Successfully Updated!";
		header("Location: student-edit.php?success=$sm&$data");
		exit;
	}

	}else{
		$em = "An Error Occured";
	header("Location: student.php?error=$em");
	exit;
}
	}else {
	header("Location: logout.php");
	exit;
} 
	}else {
	header("Location: logout.php");
	exit;
} 
