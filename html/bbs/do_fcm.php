<?php
include_once('./_common.php');

//해당 유저의 토큰이 있는지 체크
$sql = " select * from {$g5['member_token_table']} where mb_email = '{$member['mb_id']}' order by idx desc";
$row = sql_fetch($sql);

//토큰
$token = $row['token'];

function app_push($token, $message) {
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header = array("Content-Type:application/json", "Authorization:key=AAAADwsN1WI:APA91bEpuvnHFK4fsqnr9aR3p9vLh39dfG4X7JRu1si-974e46del2w94tNXLk1BOLa6bzxku4b0JODuTb9aRgrL7t1NIVPGGLkWLfKF7FZ57pAeRQnuFfxj3EE6CJsn9ZAEnsi37TDm");

$data = json_encode(array(
	"to" => $token,
	"notification" => array(
	"body"   => $message,)
));
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close ( $ch );

$arr = array(
	"ret" => true,
	"msg" => '성공',
);

echo(json_encode($arr));
//exit();
}


?>