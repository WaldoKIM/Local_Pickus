<?php
include_once('./_common.php');

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$get_type = sql_fetch($sql);
$price_cha = $price - $price_pe;

if($chk_update){
	if($get_type['e_type'] == '1'){


		$sql = " update {$g5['estimate_propose']} set
				{$sql_common}
				price = '$price',
				price_minus = '$price_pe',
				price_cha = '$price_cha',
				free = '$chk_free'
			where
				idx = '$sub_idx' and rc_email = '{$member['mb_email']}'";

	}else if($chk_free =='1'){

		$sql = " update {$g5['estimate_propose']} set
				{$sql_common}
				price = '$price',
				price_minus = NULL,
				free = '$chk_free'
			where
				idx = '$sub_idx' and rc_email = '{$member['mb_email']}'";
	}else{
		$sql = " update {$g5['estimate_propose']} set
				{$sql_common}
				price = '$price',
				price_minus = '$price_pe',
				free = '$chk_free'
			where
				idx = '$sub_idx' and rc_email = '{$member['mb_email']}'";
	}

	sql_query($sql);
}else{
	$sql = " select * from  {$g5['estimate_propose']}
			where
				estimate_idx = '$idx'
				and rc_email = '{$member['mb_email']}' ";

	$sql_common = "";
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
		$sql_common .= " attach_file = '$attach_file', ";
	}
	if($chk_free =='1' && $get_type['e_type'] == '1'){
		$sql = " update {$g5['estimate_propose']} set
				{$sql_common}
				price = '$price',
				price_minus = NULL,
				content = '$content',
				meet = '0',
				price_cha = '$price_cha',
				free = '$chk_free'
			where
				idx = '$sub_idx' and  rc_email = '{$member['mb_email']}'";

	}else{
		$sql = " update {$g5['estimate_propose']} set
				{$sql_common}
				price = '$price',
				price_minus = '$price_pe',
				content = '$content',
				meet = '0',
				price_cha = '$price_cha',
				free = '$chk_free'
			where
				idx = '$sub_idx' and  rc_email = '{$member['mb_email']}'";

	}
	sql_query($sql);
}

$sql = "select * from {$g5['estimate_list']} where idx = '$idx'";
$list = sql_fetch($sql);

insert_notify($list['email'], '11', $list['title'].' 업체 견적이 수정되었습니다.','',$idx, '','cp5');

alert('완료하였습니다.', G5_URL.'/estimate/partner_estimate_form.php?idx='.$idx);

$msg =  $list['title'].' 업체 견적이 수정되었습니다.';

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