<?php
$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
//echo $url."web";
header("Status: 301 Moved Permanently");
header("Location: web");
exit;
?>