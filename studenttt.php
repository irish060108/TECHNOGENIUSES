<?php 

// Get Students by Id
function getStudentById($student_id, $conn){
	$sql = "SELECT * FROM students
			WHERE student_id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$student_id]);

	if ($stmt->rowCount() == 1){
		$student = $stmt->fetch();
		return $student;

	}else {
		return 0;
	}
}

// All Students 
function getAllStudents($conn){
	$sql = "SELECT * FROM students";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if ($stmt->rowCount() >= 1){
		$students = $stmt->fetchAll();
		return $students;

	}else {
		return 0;
	}

}

//Check if the LRN is Unique
function lrnIsUnique($lrn, $conn, $student_id=0){
	$sql = "SELECT lrn, student_id FROM students
			WHERE lrn=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$lrn]);

	if ($student_id == 0) {
		if ($stmt->rowCount() >= 1){
		return 0;
	}else {
		return 1;
	}	
  }else {
  	if ($stmt->rowCount() >= 1){
		$student = $stmt->fetch();
		if ($student['student_id'] == $student_id) {
			return 1;
		}else return 0;

	}else {
		return 1;
	}
  }
}

// DELETE
function removeStudent($id, $conn){
	$sql = "DELETE FROM students
			WHERE student_id=?";
	$stmt = $conn->prepare($sql);
	$re   = $stmt->execute([$id]);
	if ($re){
		return 1;

	}else {
		return 0;
	}

}
// Search
function searchStudents($key, $conn){
	$key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
	$sql = "SELECT * FROM students
			WHERE student_id LIKE ?
			OR lrn LIKE ?
			OR fname LIKE ?
			OR lname LIKE ?
			OR mname LIKE ?
			OR address LIKE ?
			OR email_address LIKE ?
			OR parent_fname LIKE ?
			OR parent_lname LIKE ?
			OR parent_mname LIKE ?
			OR parent_phone_number LIKE ?
			OR username LIKE ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key, $key]);

	if ($stmt->rowCount() == 1){
		$students = $stmt->fetchAll();
		return $students;

	}else {
		return 0;
	}
}
