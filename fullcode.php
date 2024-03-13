<?php
$servername = "localhost";
$username = "weread";
$password = "weread";
$dbname = "weread";
 

$id=$_GET["id"];
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "update submit set done=1 where id='$id'";
$result = $conn->query($sql);

mysqli_close($conn);




?>