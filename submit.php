<?php
header("Content-Type: application/json");
$servername = "localhost";
$username = "weread";
$password = "weread";
$dbname = "weread";
 
$last_saturday = date("Ymd", strtotime("last saturday"));
$createtime = date("Y-m-d H:i:s");
$vid = $_REQUEST["url"];
if(is_less_than_ten_digits($vid)){
// 创建组队链接
$url="";
$string = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx8ffef4695bc01c1b&redirect_uri=https%3A%2F%2Fweread.qq.com%2Fwrpage%2Fhuodong%2Fabtest%2Fzudui%3FcollageId%3D[vid]_[last_saturday]%26tag%3D%26shareVid%3D[vid]%26wrRefCgi%3D&response_type=code&scope=snsapi_base&state=ok_userinfo&connect_redirect=1#wechat_redirect";
$url = str_replace("[vid]", $vid, $string);
$url = str_replace("[last_saturday]", $last_saturday, $url);

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 检测是否已存在
$sql = "select * from submit where type=1 and period='$last_saturday' and user='$vid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "提交失败，VID已存在";
}

else {
$sql = "INSERT INTO submit (create_time, period, url,type,user)
VALUES ('$createtime', '$last_saturday', '$url',1,'$vid')";

if ($conn->query($sql) === TRUE) {
    echo "成功";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	echo "错误";
}
}
mysqli_close($conn);
}
else echo "错误";

function is_less_than_ten_digits($var) {
  if (is_numeric($var) && strlen($var) < 11 && strlen($var) > 5) {
    return true;
  }
  return false;
}
?>