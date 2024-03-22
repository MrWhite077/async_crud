<?php

include("../db_connect.php");

$id = file_get_contents('php://input');
$sql="SELECT * FROM `async_crud` WHERE id=$id";
$result=$conn->query($sql);
$data=$result->fetch_assoc();

$newData = [];

$newData['id'] = $data['id'];
$newData['name'] = $data['Product Name'];
$newData['qty'] = $data['product Quantity'];
$newData['category'] = $data['category'];
$newData['price'] = $data['Price'];

echo json_encode(['status'=>200,'result'=>json_encode($newData)]);