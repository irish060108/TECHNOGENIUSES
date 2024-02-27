<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role']) &&
	isset($_GET['student_id'])) {

	if ($_SESSION['role'] == 'Admin'){

		include "../DB_connection.php";
		include "data/teacher.php";
		include "data/student.php";
		include "data/grade.php";
		$grades = getAllGrades($conn);

		$student_id = $_GET['student_id'];
		$student = getStudentById($student_id, $conn);

		if ($student == 0) {
			header("Location: student.php");
			exit;
		}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,
	initial-scale=1.0">
	<title>Admin - Edit Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
		include "inc/navbar.php";
		
	?>
	<div class="container mt-5">
		<a href="student.php"
		   class="btn btn-dark">Go Back</a>
		   <form method="post"
		   		 class="shadow p-3 mt-5 form-w"
			  	 action="req/student-edit.php">
			<h3>Edit Student Info</h3><hr>
			<?php if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger" role="alert">
			  <?=$_GET['error']?>
			</div>
			<?php } ?>
			<?php if (isset($_GET['success'])) { ?>
			<div class="alert alert-success" role="alert">
			  <?=$_GET['success']?>
			</div>
			<?php } ?>
			<div class="mb-3">
		    <label class="form-label">LRN</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['lrn']?>"
		    	   name="lrn">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">First Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['fname']?>"
		    	   name="fname">
		  </div><div class="mb-3">
		    <label class="form-label">Last Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['lname']?>"
		    	   name="lname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Middle Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['mname']?>"
		    	   name="mname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['username']?>"
		    	   name="username">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Address</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['address']?>"
		    	   name="address">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Gender</label><br>
		    <input type="radio" 
		    	   value="Male"
		    	   <?php if($student['gender'] == 'Male') echo 'checked' ; ?>
		    	   name="gender"> Male
		    	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="radio" 
		    	   value="Female"
		    	   <?php if($student['gender'] == 'Female') echo 'checked' ; ?>
		    	   name="gender"> Female

		  </div>
		  <div class="mb-3">
		    <label class="form-label">Email Address</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['email_address']?>"
		    	   name="email_address">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Date of Birth</label>
		    <input type="date" 
		    	   class="form-control"
		    	   value="<?=$student['date_of_birth']?>"
		    	   name="date_of_birth">
		  </div>
		  <br><hr><br>
		  <div class="mb-3">
		    <label class="form-label">Parent First Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['parent_fname']?>"
		    	   name="parent_fname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Last Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['parent_lname']?>"
		    	   name="parent_lname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Middle Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['parent_mname']?>"
		    	   name="parent_mname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Phone Number</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['parent_phone_number']?>"
		    	   name="parent_phone_number">
		  </div>
		  <br><hr><br>
		  <input type="text" 
		  		 value="<?=$student['student_id']?>"
		  		 name="student_id"
		  		 hidden>
		    
		  <div class="mb-3">
		    <label class="form-label">Grade</label>
		    <div class="row row-cols-4">
		    	<?php 
		    	$grade_ids = str_split(trim($student['grade']));
		    	foreach ($grades as $grade){ 
		    		$checked =0;
		    		foreach ($grade_ids as $grade_id){
		    			if ($grade_id == $grade['grade_id']) {
		    				$checked =1;
		    			}
		    		}
				 ?>
		    	<div class="col">
		    		<input type="checkbox" 
		    	    	   name="grades[]"
		    	    	   <?php if($checked) echo "checked"; ?>
		    	    	   value="<?=$grade['grade_id']?>">

		    	    	   <?=$grade['grade']?>-<?=$grade['grade_code']?>
		    		</div>
					<?php  } ?>
		    
		  			</div>
		  			<div class="mb-3">
		    <label class="form-label">Section</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$student['section']?>"
		    	   name="section">
		  </div>
		  		  </div>
		  <button type="submit" class="btn btn-primary">Update</button>
		</form>

		<form method="post"
		   		 class="shadow p-3 my-5 form-w"
			  	 action="req/student-change.php"
			  	 id="change_password">
		<h3>Change Password</h3><hr>
			<?php if (isset($_GET['perror'])) { ?>
			<div class="alert alert-danger" role="alert">
			  <?=$_GET['perror']?>
			</div>
			<?php } ?>
			<?php if (isset($_GET['psuccess'])) { ?>
			<div class="alert alert-success" role="alert">
			  <?=$_GET['psuccess']?>
			</div>
			<?php } ?>
		<div class="mb-3">
			<div class="mb-3">
		    <label class="form-label">Admin Password</label>
		    	<input type="password" 
		    	   class="form-control"
		    	   name="admin_pass">	  
		</div>
		    <label class="form-label">New Password</label>
		    <div class="input-group mb-3">
		    	<input type="text" 
		    	   class="form-control"
		    	   name="new_pass"
		    	   id="passInput">
		    	<button class="btn btn-secondary"
		    		 	id="gBtn">
		    		 	Random</button>		  
		    </div>
		</div>
		<input type="text" 
		  		 value="<?=$student['student_id']?>"
		  		 name="student_id"
		  		 hidden>

		<div class="mb-3">
		    <label class="form-label">Confirm New Password</label>
		    	<input type="text" 
		    	   class="form-control"
		    	   name="c_new_pass"
		    	   id="passInput2">	  
		</div>
		<button type="submit" class="btn btn-primary">Change</button>
	</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
	</script>
	<script>
		$(document).ready(function(){
			$("#navLinks li:nth-child(3) a").addClass('active');
		});
		
		function makePass(length) {
		    var result = '';
		    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		    var charactersLength = characters.length;
		    for ( var i = 0; i < length; i++ ) {
		      result += characters.charAt(Math.floor(Math.random() * charactersLength));
		    }
		    var passInput = document.getElementById('passInput');
		    var passInput2 = document.getElementById('passInput2');
		    passInput.value = result;
		    passInput2.value = result;

		}
			var gBtn = document.getElementById('gBtn');
		    gBtn.addEventListener('click', function(e){
		    	e.preventDefault();
		    	makePass(4);
		});
	</script>
</body>
</html>

<?php 
	}else {
	header("Location: student.php");
	exit;
} 
	}else {
	header("Location: student.php");
	exit;
} 
 ?>