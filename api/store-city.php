<?php
$data= json_decode(file_get_contents('php://input'),true);
$name=$data['name'];
$district=$data['district'];
$founding=$data['founding'];
$status=$data['status'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dw";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}
$sql = "INSERT INTO city (name, districtId, date, status) VALUES ('" . $name . "','" . $district . "','" . $founding . "','" . $status . "')";
header('Content-Type: application/json; charset=utf-8');
if ($conn->query($sql) === TRUE) {
    $data = new stdClass();
    $data->message = 'Action Success!';
    http_response_code(201);
    echo json_encode($data);
} else {
    $data = new stdClass();
    $data->message = 'Action fail';
    http_response_code(500);
    echo json_encode($data);
}
$conn->close();
?>
