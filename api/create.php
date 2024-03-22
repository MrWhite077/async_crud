<?php
include("../db_connect.php");
// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data
$jsonData = json_decode($data);

// Check if JSON data is valid
// if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
//     echo json_encode(array("error" => "Invalid JSON data"));
//     exit;
// }
$ProductName=$jsonData->productName;
$productQuantity=$jsonData->productQuantity;
$category=$jsonData->category;
$price=$jsonData->price;


// if (empty($name)) {
//     echo json_encode(['status'=>400,'result'=>'please enter name']);
// }
// if (empty($productQuantity)) {
//     echo json_encode(['status'=>400,'result'=> 'please enter productQuantity']);
// }
// if (empty($category)) {
//     echo json_encode(['status'=>400,'result'=>'please select category']);
// }
// if (empty($price)) {
//     echo json_encode(['status'=>400,'result'=>'please enter price']);
// }
// else{

//     $sql="INSERT INTO `async_crud`(`Product Name`, `product Quantity`, `category`, `Price`) VALUES ('$ProductName','$productQuantity','$category','$price')";
//      $conn->query($sql);
//     echo json_encode(['status'=>200,'result'=>'data saved in database successfully !']);
// }
$errors = array();
if (empty($ProductName)) {
    $errors[] = 'Please enter product name';
}
if (empty($productQuantity)) {
    $errors[] = 'Please enter product quantity';
}
if (empty($category)) {
    $errors[] = 'Please select category';
}
if (empty($price)) {
    $errors[] = 'Please enter price';
}
// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['status' => 400, 'errors' => $errors]);
    exit;
}

// Insert data into database
$sql = "INSERT INTO `async_crud`(`Product Name`, `product Quantity`, `category`, `Price`) VALUES ('$ProductName','$productQuantity','$category','$price')";
if ($conn->query($sql)) {
    echo json_encode(['status' => 200, 'result' => 'Data saved in database successfully']);
} else {
    echo json_encode(['status' => 500, 'error' => 'Error saving data in database']);
}

// Terminate script execution
exit;



