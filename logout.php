<?php 
session_start();
session_unset();
header("HTTP/1.1 301 Moved Permanently");
header('Location: .');
?>