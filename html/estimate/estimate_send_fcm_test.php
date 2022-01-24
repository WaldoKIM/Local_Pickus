<?php
include_once('./_common.php');


$g5['title'] = '견적신청안내';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<div class="sub_title login">
	<h1>견적신청</h1>
	<h5>신속하고 간편한 무료비교견적</h5>
</div><!-- sub_title -->
<?php
	send_fcm("admin@repickus.com", "메시지 보내기 완료", '');
	
?>

<?php

include_once('./_tail.php');
?>
