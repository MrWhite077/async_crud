<?php

include("../db_connect.php");


$updateDate = file_get_contents('php://input');
//  echo json_encode($updateDate);

 $updateDate = json_decode($updateDate);

$up_id=$updateDate->up_id;
$up_productName=$updateDate->up_productName;
$up_Quantity=$updateDate->up_Quantity;
$up_category=$updateDate->up_category;
$up_price=$updateDate->up_price;


$errors = array();
if (empty($up_productName)) {
    $errors[] = 'Please enter product name';
}
if (empty($up_Quantity)) {
    $errors[] = 'Please enter product quantity';
}
if (empty($up_category)) {
    $errors[] = 'Please select category';
}
if (empty($up_price)) {
    $errors[] = 'Please enter price';
}
// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['status' => 400, 'errors' => $errors]);
    exit;
}


$sql="UPDATE `async_crud` SET `Product Name`='$up_productName',`product Quantity`='$up_Quantity',`category`='$up_category',`Price`='$up_price' WHERE id =$up_id";
// $conn->query($sql);
if ($conn->query($sql)) {
    echo json_encode(['status' => 200, 'result' => 'Data saved in database successfully']);
} else {
    echo json_encode(['status' => 500, 'error' => 'Error saving data in database']);
}

// Terminate script execution
exit;
