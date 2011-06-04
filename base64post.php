<?php
// base64post.php
$data = split(';', $_POST['d']);
$type = $data[0];
$data64 = split(',', $data[1]);
$pic = base64_decode($data64[1]);
header("Content-type: $type");
echo $pic;
?>
