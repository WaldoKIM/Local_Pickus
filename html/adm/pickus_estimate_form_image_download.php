<?php
$sub_menu = "400210";
include_once('./_common.php');

$sql = "select * from {$g5['estimate_list_photo']} a where idx = '$idx'";
$photo = sql_fetch($sql);
$IMAGE_PATH = G5_DATA_PATH.'/estimate/'.$photo['photo'];
$IMAGE_SIZE = getimagesize($IMAGE_PATH);
if($IMAGE_SIZE) {
	$FILETYPE = strtolower(substr($IMAGE_PATH,strlen($IMAGE_PATH)-3,3));
	if($FILETYPE == "peg"){
		$FILETYPE = "jpeg";
	}
    $FILENAME = 'download.'.$FILETYPE;
    header("Content-Type: ".$IMAGE_SIZE['mime']);
    header("Content-Disposition: attachment;filename=$FILENAME");
    header("Content-Length: ".filesize($IMAGE_PATH));
    readfile($IMAGE_PATH);

}
?>
