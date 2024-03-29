<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){


if (isset($_POST['fname']) &&
	isset($_POST['lname']) &&
	isset($_POST['username']) &&
	isset($_POST['pass']) &&
	isset($_POST['address']) &&
	isset($_POST['employee_number']) &&
	isset($_POST['date_of_birth']) &&
	isset($_POST['gender']) &&
	isset($_POST['phone_number']) &&
	isset($_POST['qualification']) &&
	isset($_POST['email_address']) &&
	isset($_POST['section']) &&
	isset($_POST['subjects']) &&
	isset($_POST['grades'])) {

	include DB_connection.php';
	include "teacherrr.php";

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['username'];
	$pass = $_POST['pass'];
	$address = $_POST['address'];
	$employee_number = $_POST['employee_number'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$qualification = $_POST['qualification'];
	$email_address = $_POST['email_address'];

	$subjects = "";
	foreach ($_POST['subjects'] as $subject) {
		$subjects .=$subject;
	}
	$grades = "";
	foreach ($_POST['grades'] as $grade) {
		$grades .=$grade;

	}	
	$section = $_POST['section'];
	$data = 'uname='.$uname.'$fname='.$fname.'$lname='.$lname.'$address='.$address.'$en='.$employee_number.'$db='.$date_of_birth.'$gender='.$gender.'$pn='.$phone_number.'$q='.$qualification.'$ea='.$email_address.'$dj='.$date_of_joined;
		if (empty($fname)) {
		$em = "First Name is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em = "Last Name is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em = "Username is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em = "Username is taken! try another";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
		$em = "Address is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($employee_number)) {
		$em = "Employee Number is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($date_of_birth)) {
		$em = "Date of Birth is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($phone_number)) {
		$em = "Phone Number is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($qualification)) {
		$em = "Qualification is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($gender)) {
		$em = "Gender is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($email_address)) {
		$em = "Email Address is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em = "Password is required";
		header("Location: teacher-add.php?error=$em&$data");
		exit;
	}else {
		// hashing the password
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO
				teachers(username, password, fname, lname, subjects, grades, section, address, employee_number, date_of_birth, phone_number, qualification, gender, email_address)
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $pass, $fname, $lname, $subjects, $grades, $section, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address]);
		$sm = "New Teacher Registered Successfully";
		header("Location: teacher-add.php?success=$sm");
		exit;
	}

	}else{
		$em = "An Error Occured";
	header("Location: teacher-add.php?error=$em");
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
