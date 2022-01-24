<?php
include_once('./_common.php');

$rc_email = $member['mb_email'];

$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and rc_email = '$rc_email' ";
$ep = sql_fetch($sql);

$sql = " select count(*) cnt from {$g5['estimate_propose']} where estimate_idx = '$idx'";
$ss = sql_fetch($sql);

$sql = " select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

$e_type = $list['e_type'];

if($ep){
	alert('이미 참여한 견적입니다.', G5_URL.'/estimate/partner_estimate_list.php');
}

$attach_file = "";
if ($_FILES['attfile']['name']) {
	$datetime = G5_TIME_YMD;
	$cur_year = date("Y", strtotime($datetime));
	$cur_month = date("m", strtotime($datetime));
	$cur_day = date("d", strtotime($datetime));

	$img_dir_year = G5_DATA_PATH.'/estimate/'.$cur_year;
	@mkdir($img_dir_year, G5_DIR_PERMISSION);
	@chmod($img_dir_year, G5_DIR_PERMISSION);

	$img_dir_month = $img_dir_year.'/'.$cur_month;
	@mkdir($img_dir_month, G5_DIR_PERMISSION);
	@chmod($img_dir_month, G5_DIR_PERMISSION);

	$img_dir = $img_dir_month.'/'.$cur_day;
	@mkdir($img_dir, G5_DIR_PERMISSION);
	@chmod($img_dir, G5_DIR_PERMISSION);

	$attach_file = estimate_file_upload($_FILES['attfile']['tmp_name'], $_FILES['attfile']['name'], $img_dir);
}


$sql = " select * from {$g5['estimate_list']} where idx = '$idx' ";
$estimate = sql_fetch($sql);

$price_cha = $price - $price_pe;

if($e_type == '1'){


	$sql = " insert into {$g5['estimate_propose']} (
			estimate_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			price_minus,
			content,
			selected,
			attach_file,
			proposetime,
			free,
			price_cha
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['email']}',
			'{$estimate['nickname']}',
			'$price',
			'$price_pe',
			'$content',
			'0',
			'$attach_file',
			now(),
			'$chk_free',
			'$price_cha'
		) ";

}else if($chk_free == '1'){
	$sql = " insert into {$g5['estimate_propose']} (
			estimate_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			content,
			selected,
			attach_file,
			proposetime,
			free,
			price_cha
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['email']}',
			'{$estimate['nickname']}',
			'$price',
			'$content',
			'0',
			'$attach_file',
			now(),
			'$chk_free',
			'0'
		) ";


}else{
	$sql = " insert into {$g5['estimate_propose']} (
			estimate_idx,
			rc_email,
			rc_nickname,
			email,
			nickname,
			price,
			price_minus,
			content,
			selected,
			attach_file,
			proposetime,
			free,
			price_cha
		) values (
			'$idx',
			'{$member['mb_email']}',
			'{$member['mb_biz_name']}',
			'{$estimate['email']}',
			'{$estimate['nickname']}',
			'$price',
			'$price_pe',
			'$content',
			'0',
			'$attach_file',
			now(),
			'$chk_free',
			'$price_cha'
		) ";
}

sql_query($sql);

insert_notify($estimate['email'], '11', $estimate['title'].' 업체 견적이 들어왔습니다.','',$idx, '','cp2');

$sql = "select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx'";
$cnt = sql_fetch($sql);

//echo var_dump($ss);
//exit();

if($cnt['cnt'] == 1){
	kakaotalk_send($list['phone'], 'SJT_058802',  $estimate['title']);
}

if($ss['cnt'] == '0'){
	$msg = $estimate['title'].' 업체 견적이 들어오고 있습니다.';
}else{
	$msg = $estimate['title'].' 업체 견적이 들어왔습니다.';
}

// alert('견적에 참여하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

?>


<script>
	$(document).ready(function(){
		$.ajax({
			url : "ajax_do_fcm.php",
			type : "post",
			dataType : "json",
			data : 
			{
				message : <?php echo($msg); ?>
			},
			error:function(request,status,error){
				alert("code = "+ request.status + 
					" message = " + request.responseText + 
					" error = " + error); // 실패 시 처리
			},

		}).done(function(data) {
			if(data.ret == true){
				//alert(data.msg);
			}else{
				//alert(data.msg);
			}
		});
	})
</script>
<?
$mbrand = $_POST["brand"];
$mmodel_name = $_POST["model_name"];
$mmodel_code = $_POST["model_code"];
$myear = $_POST["year"];
$mprice = $_POST["price"];
$mcategory2 = $_POST["category2"];
$mcategory3 = $_POST["category3"];
$midx = $_POST["idx"];
?>
<head>
    <script>
        function goResult() {
            var openwin = window.open('proc_win.html', 'proc_win', '');
            document.pay_info.submit();
            openwin.close();
        }
    </script>
</head>

<body onload="goResult()">
    <form name="pay_info" method="post" action="./ajax.mongo_estimate.php">
		<input type="hidden" name="idx" value="<?= $midx ?>"> 
        <input type="hidden" name="brand" value="<?= $mbrand ?>"> 
        <input type="hidden" name="model_name" value="<?= $mmodel_name ?>">
		<input type="hidden" name="model_code" value="<?= $mmodel_code ?>"> 
		<input type="hidden" name="year" value="<?= $myear ?>"> 
		<input type="hidden" name="price" value="<?= $mprice ?>"> 
		<input type="hidden" name="category2" value="<?= $mcategory2 ?>"> 
		<input type="hidden" name="category3" value="<?= $mcategory3 ?>">  
    </form>
</body>

</html>