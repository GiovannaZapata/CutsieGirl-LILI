<?php
session_start();

session_destroy();
echo "deleteAllCart()";
header("Location: ../index.php");
?>