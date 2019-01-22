<?php
 
// get database connection
include_once 'database.php';
 
// instantiate user object
include_once 'details.php';
 
$database = new Database();
$db = $database->getConnection();
 
$details = new User($db);
 
// set user property values
$details->name = $_POST['name'];
$details->email =$_POST['email'];
$details->ph =$_POST['ph'];
$details->hloc =$_POST['hloc'];
$details->deg =$_POST['deg'];
$details->clg =$_POST['clg'];

// create the user



print_r(json_encode($user_arr));
$data = $_POST['name'];
$data1 = $_POST['email'];
$data2 = $_POST['hloc'];
$data3 = $_POST['ph'];
$data4 = $_POST['deg'];
$data5 = $_POST['clg'];

$inp = file_get_contents('det.json');
$tempArray = json_decode($inp);
array_push($tempArray, $data);
array_push($tempArray, $data1);
array_push($tempArray, $data2);
array_push($tempArray, $data3);
array_push($tempArray, $data4);
array_push($tempArray, $data5);

$jsonData = json_encode($tempArray);
file_put_contents('det.json', $jsonData);

?>