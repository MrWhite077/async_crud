<?php
include("../db_connect.php");

$id = file_get_contents('php://input');
$sql="DELETE FROM `async_crud` WHERE id=$id";
$conn->query($sql);
echo json_encode(['status'=>200,'result'=>"data delete successfully"]);
// echo json_encode($id);