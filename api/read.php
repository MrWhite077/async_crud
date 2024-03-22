    <?php
   include("../db_connect.php");

    $sql="SELECT * FROM async_crud";

    $result=$conn->query($sql);


    $data=[];
    while ($row=$result->fetch_assoc()) {
        array_push($data,$row);
    }
    echo json_encode($data);
    