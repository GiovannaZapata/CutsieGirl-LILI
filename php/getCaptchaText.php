<?php
session_start();
echo isset($_SESSION['captcha_text'])? $_SESSION['captcha_text'] : ":'v";
?>