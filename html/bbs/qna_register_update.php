<?php
include_once('./_common.php');
if ($is_guest) {
	$sql = " insert into {$g5['qna_table']} (
			nickname,
			email,
			phone,
			res_type,
			title,
			password,
			chk_member,
			res_content,
			updatetime
		) values (
			'$nickname',
			'$email',
			'$phone',
			'$res_type',
			'$title',
			'$password',
			2,
			'$res_content',
			now()
		) ";
} else {
	$sql = " insert into {$g5['qna_table']} (
			nickname,
			email,
			phone,
			res_type,
			title,
			res_content,
			updatetime
		) values (
			'{$member['mb_name']}',
			'{$member['mb_email']}',
			'{$member['mb_hp']}',
			'$res_type',
			'$title',
			'$res_content',
			now()
		) ";
}

sql_query($sql);

$admin = 'admin@repickus.com';
$qa_title = '가 등록되었습니다';
insert_notify($admin, '0', '1:1 문의' . $qa_title . '', '', '', '', '');


alert("1:1 문의가 등록되었습니다. 빠른시일내로 답변드리겠습니다.", G5_BBS_URL . '/qna.php');
