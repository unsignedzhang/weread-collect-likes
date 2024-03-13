<?php
$id=$_GET["id"];
// 引入QR Code Generator库
require 'phpqrcode/qrlib.php';

// 随机获取一个本期的联名卡链接
header("Content-Type: text/html;charset=utf-8");
$servername = "localhost";
$username = "weread";
$password = "weread";
$dbname = "weread";
 
 $last_saturday = date("Ymd", strtotime("last saturday"));
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from submit where id='$id'";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
		// 要生成二维码的网址
		$url = $row["url"];
		// 设置二维码的尺寸和边距
		$size = 10;
		$margin = 2;
		// 生成二维码图像并输出到浏览器
		QRcode::png($url, false, QR_ECLEVEL_Q, $size, $margin);
    }
} else {
    echo "0 结果";
	
}

mysqli_close($conn);



?>
