<?php
include_once('./_common.php');

//토큰
$token = $_REQUEST['setToken'];

//이메일
$mb_email = $_SESSION['ss_mb_id'];

if(empty($mb_email)){
	$arr = array(
		"ret" => true,
		"msg" => "로그인을 해주세요..",
	);
	echo(json_encode($arr));
	exit();
}

//echo var_dump($token);
//exit();

//해당 유저의 토큰이 있는지 체크
$sql = " select count(*) as cnt from {$g5['member_token_table']} where mb_email = '{$member['mb_id']}' and token = '{$token}'";
$row = sql_fetch($sql);

//토큰이 없는 경우만 insert
if (!$row['cnt']) {
	//이메일 정보가 있는 경우만
	if(isset($mb_email)){

		//토큰 저장
		$sql = "insert into {$g5['member_token_table']} set mb_email = '{$member['mb_id']}', token = '{$token}'";
		$result = sql_query($sql, false);
	}
}


$arr = array(
	"ret" => true,
	"msg" => '로그인 되었습니다.',
);
echo(json_encode($arr));
exit();

?>