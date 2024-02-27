<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){
		include "DB_connection.php";
		include "grade.php";
		$grades = getAllGrades($conn);

		
	
		$lrn = '';
		$fname = '';
		$lname = '';
		$mname = '';
		$address = '';
		$gender = '';
		$email_address = '';
		$date_of_birth = '';
		$uname = '';
		$password = '';
		$parent_fname = '';
		$parent_lname = '';
		$parent_mname = '';
		$parent_phone_number = '';
		$section = '';

		if (isset($_GET['lrn'])) $lrn = $_GET['lrn'];
		if (isset($_GET['fname'])) $fname = $_GET['fname'];
		if (isset($_GET['lname'])) $lname = $_GET['lname'];
		if (isset($_GET['mname'])) $mname = $_GET['mname'];
		if (isset($_GET['address'])) $address = $_GET['address'];
		if (isset($_GET['gender'])) $gender = $_GET['gender'];
		if (isset($_GET['email_address'])) $email_address = $_GET['email_address'];
		if (isset($_GET['date_of_birth'])) $date_of_birth = $_GET['date_of_birth'];
		if (isset($_GET['uname'])) $uname = $_GET['uname'];
		if (isset($_GET['password'])) $password = $_GET['password'];
		if (isset($_GET['parent_fname'])) $parent_fname = $_GET['parent_fname'];
		if (isset($_GET['parent_lname'])) $parent_lname = $_GET['parent_lname'];
		if (isset($_GET['parent_mname'])) $parent_mname = $_GET['parent_mname'];
		if (isset($_GET['parent_phone_number'])) $parent_phone_number = $_GET['parent_phone_number'];
		if (isset($_GET['section'])) $section = $_GET['section'];




		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,
	initial-scale=1.0">
	<title>Admin - Add Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php
		include "navbar.php";
		
	?>
	<div class="container mt-5">
		<a href="student.php"
		   class="btn btn-dark">Go Back</a>
		   <form method="post"
		   		 class="shadow p-3 mt-5 form-w"
			  	 action="student-addd.php">
			<h3>Add New Student</h3><hr>
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
		    	   value="<?=$lrn?>"
		    	   name="lrn">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">First Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$fname?>"
		    	   name="fname">
		  </div><div class="mb-3">
		    <label class="form-label">Last Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$lname?>"
		    	   name="lname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Middle Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$mname?>"
		    	   name="mname">
		  </div>  
		  <div class="mb-3">
		    <label class="form-label">Address</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$address?>"
		    	   name="address">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Gender</label><br>
		    <input type="radio"
		    	    value="Male"
		    	    checked
		    	    name="gender"> Male
		    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="radio"
		    	    value="Female"
		    	    name="gender"> Female
		    	   
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Email Address</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$email_address?>"
		    	   name="email_address">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Date of Birth</label>
		    <input type="date" 
		    	   class="form-control"
		    	   value="<?=$date_of_birth?>"
		    	   name="date_of_birth">
		  </div>
		  <br><hr><br>
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$uname?>"
		    	   name="username">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <div class="input-group mb-3">
		    	<input type="text" 
		    	   class="form-control"
		    	   name="pass"
		    	   id="passInput">
		    	<button class="btn btn-secondary"
		    		 	id="gBtn">
		    		 	Random</button>	
		    </div>	
		  <br><hr>
		  <div class="mb-3">
		    <label class="form-label">Parent First Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$parent_fname?>"
		    	   name="parent_fname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Last Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$parent_lname?>"
		    	   name="parent_lname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Middle Name</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$parent_mname?>"
		    	   name="parent_mname">
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent Phone Number</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$parent_phone_number?>"
		    	   name="parent_phone_number">
		  </div>
		    <br><hr><br>
		</div>
		  <div class="mb-3">
		    <label class="form-label">Grade</label>
		    <div class="row row-cols-4">
		    	<?php foreach ($grades as $grade): ?>
		    	<div class="col">
		    		<input type="radio" 
		    	    	   name="grade"
		    	    	   value="<?=$grade['grade_id']?>">

		    	    	   <?=$grade['grade']?>-<?=$grade['grade_code']?>
		    		</div>
					<?php endforeach?>
		    
		  			</div>
		  			<div class="mb-3">
		    <label class="form-label">Section</label>
		    <input type="text" 
		    	   class="form-control"
		    	   value="<?=$section?>"
		    	   name="section">
		  </div>
		  		  </div>
		  <button type="submit" class="btn btn-primary">Add</button>
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
		    passInput.value = result;
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
	header("Location: login.php");
	exit;
} 
}else {
	header("Location: login.php");
	exit;
} 
 ?>
