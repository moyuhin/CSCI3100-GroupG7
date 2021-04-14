<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $name = $response[0];
    $pw = $response[1];
    include '../component/dbOpen.php';

    $sql = "SELECT normaluserid AS userId,name FROM `normaluser` WHERE name='$name' and Password='$pw'";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($rs) <= 0) {
        echo json_encode(array(
        'success' => 'false',
        ));
    }
    else {
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        echo json_encode(array(
            'success' => 'true',
            'userId' => $userId,
            'name' => $name
        ));
    }
    mysqli_free_result($rs);
   mysqli_close($conn);
?>
