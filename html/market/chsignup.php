<?php
include("common.php");
require_once('./lib/chsignup.class.php');
$im = &new chsignup;
$im->set_font('./cheditor/adler.ttf');
$_SESSION['text'] = $im->create_image();
?>
