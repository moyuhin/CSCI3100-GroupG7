<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $name= $response[0];
    $email = $response[1];
    $pw = $response[2];
    include '../component/dbOpen.php';

    $sql="INSERT INTO `NormalUser`(`Name`, `Password`, `Email`) VALUES ('$name','$pw', '$email');";
    mysqli_query($conn, $sql) or die(mysqli_connect_error());
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num != 1) {
        echo json_encode(array(
            'success' => 'false'
        ));
    }else{
        echo json_encode(array(
            'success' => 'true',
            'name' => $name,
            'pw' => $pw
        ));
    }
?>
