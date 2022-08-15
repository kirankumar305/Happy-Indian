<?php
include "connection.php";
$date = date_default_timezone_set('Asia/Kolkata');
$today_date=date("F j, Y, g:i a");
function getIpAddress()
{
$ipAddress = '';
if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
} else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
foreach ($ipAddressList as $ip) {
if (! empty($ip)) {
$ipAddress = $ip;
break;
}
}
} else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
} else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
} else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
} else if (! empty($_SERVER['HTTP_FORWARDED'])) {
$ipAddress = $_SERVER['HTTP_FORWARDED'];
} else if (! empty($_SERVER['REMOTE_ADDR'])) {
$ipAddress = $_SERVER['REMOTE_ADDR'];
}
return $ipAddress;
}
$ip_addr = getIpAddress();
if( isset( $_POST['Name'] ) )
{
$Reg_Name = $_POST['Name'];
$query = mysqli_query($con,"INSERT INTO `visitors`(`name`, `ip`, `time`) VALUES ('$Reg_Name', '$ip_addr', '$today_date')");
if (isset($query)) {
echo "done";
}
}
if( isset( $_POST['Reg_Name'] ) )
{
$Reg_Name = strtoupper($_POST['Reg_Name']);
$Reg_Location = $_POST['Reg_Location'];
$Contact = $_POST['Reg_Contact'];
$Reg_Contact = "+91 ".$Contact."";
$Reg_Name_Len = strlen($_POST['Reg_Name']);
$image = "lib/img/Certificate.png";
$createimage = imagecreatefrompng($image); $white = imagecolorallocate($createimage, 205, 245, 255);
$blue = imagecolorallocate($createimage, 0, 0, 128);
$rotation = 0;
$origin_x = 455;
$origin_y=383;
$font_size = 45;
$i = 1;
$j = 650;
while ($i <= 50 && $Reg_Name_Len<=20) {
if ($i==$Reg_Name_Len) {
$origin_x = $j;
}
$i++;
$j=$j-14;
}
$x = 1;
$y = 750;
while ($x <= 50 && $Reg_Name_Len>20) {
if ($x==$Reg_Name_Len) {
$origin_x = $y;
$font_size = 35;
}
$x++;
$y=$y-16;
}
$certificate_text = $Reg_Name;
$drFont = dirname(__FILE__)."/lib/font/font.ttf";
$text = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $blue,$drFont, $certificate_text);
$file_location = "Certificates/Certificate-".time().".png";
imagepng($createimage,$file_location, 3);
$query = mysqli_query($con,"INSERT INTO `certificates`(`c_name`, `c_ip`, `c_location`, `c_contact`, `c_file`, `c_time`) VALUES ('$Reg_Name','$ip_addr','$Reg_Location','$Reg_Contact','$file_location','$today_date')");
$query = mysqli_query($con,"SELECT `id`, `c_file`, `c_contact` FROM `certificates` WHERE `c_contact` = '$Reg_Contact' ORDER BY `id` DESC LIMIT 1");
$fetch = mysqli_fetch_assoc($query);
$output = $fetch['c_file'];
if (isset($query)) {
echo $output;
}
}

if (isset($_POST['admin_submit'])) {
    $happy_email=$_POST['happy_email'];
    $happy_password=$_POST['happy_password'];
    $sql="SELECT * FROM `admin`";
    $result=mysqli_query($con,$sql);
    $line=mysqli_fetch_assoc($result);
    if($line['happy_email']==$happy_email && $line['happy_password']==$happy_password)
    {
        echo "There";
    }
}
 ?>