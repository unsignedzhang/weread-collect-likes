<?php
$id=$_GET["id"];
// ����QR Code Generator��
require 'phpqrcode/qrlib.php';

// �����ȡһ�����ڵ�����������
header("Content-Type: text/html;charset=utf-8");
$servername = "localhost";
$username = "weread";
$password = "weread";
$dbname = "weread";
 
 $last_saturday = date("Ymd", strtotime("last saturday"));
 
// ��������
$conn = mysqli_connect($servername, $username, $password, $dbname);
// �������
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from submit where id='$id'";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // �������
    while($row = $result->fetch_assoc()) {
		// Ҫ���ɶ�ά�����ַ
		$url = $row["url"];
		// ���ö�ά��ĳߴ�ͱ߾�
		$size = 10;
		$margin = 2;
		// ���ɶ�ά��ͼ������������
		QRcode::png($url, false, QR_ECLEVEL_Q, $size, $margin);
    }
} else {
    echo "0 ���";
	
}

mysqli_close($conn);



?>
