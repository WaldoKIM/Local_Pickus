<?php
require_once('../lib/imgCut.class.php');
require_once('../common.php');
//$_GET=&$HTTP_GET_VARS;
$ThumbEncode	= $tools->decode( $_GET[ThumbEncode] );
//필요한 값 셋팅
$tableName = $ThumbEncode[table];
$imgName = $ThumbEncode[img];
$idx = $ThumbEncode[idx];
$directory = $ThumbEncode[dire];
$width = $ThumbEncode[w];
$height = $ThumbEncode[h];

$Info = $db->object("$tableName","where idx='$idx'");

$im = &new thumClass;
$fileRoot = "../data/".$directory."/".$Info->{$imgName};
$im->create_image($fileRoot, $width, $height);
?>
