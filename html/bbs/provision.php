<?php
include_once('./_common.php');

$g5['title'] = "이용약관";

include_once('./_head.php');

$sql = " select * from {$g5['content_table']} where co_id = 'provision' ";
$row = sql_fetch($sql);
$provision = $row['co_content'];

?>
<link rel="stylesheet" type="text/css" href="../css/board.css"/>
<link rel="stylesheet" type="text/css" href="../css/member.css"/>
<div class="sub_title login">
	<h5>이용약관</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		<?php echo $provision ; ?>
	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>
