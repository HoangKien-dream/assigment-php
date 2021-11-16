<?php
$data= json_decode(file_get_contents('php://input'),true);
$keyword = '';
if (isset($_GET['search'])){
    $keyword = $_GET['search'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dw";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}
$conn->set_charset("utf-8");
$sql = "SELECT * FROM city";
if ($keyword != null && strlen($keyword)>0){
    $sql = "SELECT * FROM city WHERE name LIKE '%$keyword%'";
}
$result = $conn->query($sql);
header('Content-Type: application/json; charset=utf-8');
if ($result->num_rows > 0) {
    $row = array();
    while ($r = $result->fetch_assoc()) {
        $row[] = $r;
    }
    echo json_encode($row);
}else{
}
$conn->close();
?>
