<?php

// 找到上一个星期四的日期
$last_thursday = strtotime("last thursday");

// 如果当前日期在本周四之后，则找到上上个星期四的日期
// if (date("w") <= 4) {
    // $last_thursday = strtotime("-1 week", $last_thursday);
// }

// 输出日期，格式为年月日
echo "#小程序://微信读书/1pvs4ra2vjLusFt";
echo '<a style="font-size: 13px; font-weight: 900; color: grey;" href="weread://share?jumpUrl=https://weread.qq.com/wrpage/huodong/abtest/zudui?collageId=397624501_20230506&tag=&shareVid=397624501"># 长按二维码识别 #</a>'

?>
