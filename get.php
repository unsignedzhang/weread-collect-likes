<?php
header("Content-Type: application/json");
$servername = "localhost";
$username = "weread";
$password = "weread";
$dbname = "weread";
 
$last_saturday = date("Ymd", strtotime("last saturday"));
$inprogress = "";
$completed = "";
$id = "";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from submit where done=0 and type=1 and period='$last_saturday' order by rand() limit 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		$id = $row["id"];
    }
} else {
    $id = "null";
}
// 获取进行中数量
$sql = "select * from submit where type=1 and period='$last_saturday' and done=0";
$result = $conn->query($sql);
$inprogress = $result->num_rows;
// 获取已完成数量
$sql = "select * from submit where type=1 and period='$last_saturday' and done=1";
$result = $conn->query($sql);
$completed = $result->num_rows;

mysqli_close($conn);



echo json_encode(array(
	"code" =>200,
    "last_saturday" => $last_saturday,   
    "id" => $id,
    "inprogress" => $inprogress,
    "completed" => $completed,
    ));
?>