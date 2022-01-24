<?php

/* www/pass.php */

include_once('./_common.php');

$admin_id = 'admin'; // 관리자 아이디

$admin_pass = sql_password('1004'); // 변경할 비밀번호

if ($admin_id != $config['cf_admin'])

  alert('관리자 id가 잘못 입력되었습니다. '.$config['cf_admin'].' 으로 수정하세요.', G5_URL);

sql_query(" update {$g5['member_table']} set mb_password = '$admin_pass' where mb_id = '$admin_id' ");

alert('관리자 비번이 변경되었습니다. 확인 후 이 파일은 반드시 삭제하세요.', G5_URL);

?>