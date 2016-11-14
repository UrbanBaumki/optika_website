<?php
session_start();
session_destroy();
echo "Uspešna odjava";
header("Refresh: 1; url=../index.php");
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>