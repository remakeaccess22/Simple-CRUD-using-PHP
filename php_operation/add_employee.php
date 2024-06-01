<?php
session_start();
require_once('../database/dbconnection.php');
$response = array();

$fname=mysqli_real_escape_string($conn,$_POST['fname']);
$lname=mysqli_real_escape_string($conn,$_POST['lname']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$phone_number=mysqli_real_escape_string($conn,$_POST['phone_number']);
$hire_date=mysqli_real_escape_string($conn,$_POST['hire_date']);
$job_id=mysqli_real_escape_string($conn,$_POST['job_id']);
$salary=mysqli_real_escape_string($conn,$_POST['salary']);
$commission_pct=mysqli_real_escape_string($conn,$_POST['commission_pct']);
$manager_id=mysqli_real_escape_string($conn,$_POST['manager_id']);
$department_id=mysqli_real_escape_string($conn,$_POST['department_id']);
 
 
 $status = "";
 $error = "";


 if($fname=="" || $lname=="" || $email=="" || $password=="" || $phone_number=="" || $hire_date=="" || $job_id=="" || $salary=="" || $commission_pct=="" || $manager_id=="" || $department_id==""){
   $status = "error";
   $error = "Empty Fields";
 }

    $sql = "INSERT INTO employees(first_name,last_name,email,password,phone_number,hire_date,job_id,salary,commission_pct,manager_id,department_id) VALUES('$fname','$lname','$email', '$password', '$phone_number', '$hire_date', '$job_id', '$salary', '$commission_pct', '$manager_id', '$department_id')";
    $query = $conn->query($sql);
    if($query){
        $status = "success";
        $error = "";
    }
    else {
        $status = "error";
        $error = "Cant add data! Please try again!";
        $error .= " Error: " . $sql . "<br>" . $conn->error; // Add this line
  }
 


 $response[]=array(
         "status"=>($status),
         "error"=>($error)
         );


echo json_encode($response);

 
?>