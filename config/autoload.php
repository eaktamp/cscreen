<?php
$hospital_code  = "10665";
$host           = "localhost";
$path_host      = $_SERVER['PHP_SELF'];
$ip             = $_SERVER['REMOTE_ADDR'];
if ($ip === "::1" ) {
    $javarun = "localhost";
}else {
    $javarun = $ip;
}
$url_java = "http://".$javarun.":8080/smartcard/data/";
$pic_java = "http://".$javarun.":8080/smartcard/picture/";
//$url = "http://172.16.28.18:8080/smartcard/data/";
//$pic = "http://172.16.28.18:8080/smartcard/picture/";

?>