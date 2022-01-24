<?php
include_once('./_common.php');

/*
if (!$is_member)
	alert("로그인 후 사용이 가능합니다.");
*/ 

if($nickname == "" || $email == "" || $phone == ""){
    echo "<script>alert('잘못된 접근방식입니다.');location.replace('/')</script>";
//    exit();
}else{

$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
$mm = sql_fetch($sql);

if($mm){
	if($mm['mb_level'] != "0" && $mm['mb_level'] != "8")
	{
		alert("소비자 회원은 견적신청하실 수 없습니다.",G5_URL);
	}
}

$sql = " insert into {$g5['estimate_list']} set
			sub_key = '$sub_key',
			email = '$email',
			nickname = '$nickname',
			phone = '$phone',
			content = '$content',
			state = '1',
			e_type = '$e_type',
			simple_yn = '$simple_yn',
			writetime = now(),
			deadline = date_add(now(), interval 3 day) ";

sql_query($sql);

if (!$is_member) {
	$sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
	$mm = sql_fetch($sql);
	if(!$mm){
	    $sql = " insert into {$g5['member_table']} set 
	    				mb_id = '$email',
	                    mb_password_type = 'md5',
	                    mb_name = '$nickname',
	                    mb_email = '$email',
	                    mb_level = '8',
	                    mb_hp = '$phone',
	                    mb_datetime = now(),
	                    mb_email_certify = now(),
	                    mb_open = '1' ";	
	    sql_query($sql);	

        set_session('ss_mb_id', $email);

        set_session('ss_mb_reg', $email);
        	    
	}
}

alert("견적이 신청되었습니다.","./my_estimate_list.php");

}
?> 
