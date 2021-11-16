<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dw";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}
$rows = array(1 => "Ba Đình", 2 => "Đống Đá", 3 => "Hai Bà Trưng", 4 => "Cầu Giấy", 5 => "Hoàn Kiếm", 6 => "Tây Hồ");
$amount=count($rows);
for ($i=1;$i<=$amount;$i++) {
    $sql = "INSERT INTO district (id,name) VALUES ('" . $i . "','" . $rows[$i] . "')";
    header('Content-Type: application/json; charset=utf-8');
    if ($conn->query($sql)) {
        $data = new stdClass();
        $data->message = 'Action Success!';
        http_response_code(201);
        echo json_encode($data);
    } else{
        $data = new stdClass();
        $data->message = 'Action fail';
        http_response_code(500);
        echo json_encode($data);
    }
    }
$conn->close();
?>

