<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $id = $response[0];
    include '../component/dbOpen.php';

    $sql = "SELECT normaluserid AS userId,name,email FROM `normaluser` WHERE NormalUserId='$id'";
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
            'name' => $name,
            'email' => $email,
        ));
    }
    mysqli_free_result($rs);
   mysqli_close($conn);
?>
