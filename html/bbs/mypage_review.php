<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] != "2")
	alert("회원만 가능합니다.", G5_URL);

include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/bbs/css/mypage.css"/>

<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">후기내역</div>
</div>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">후기내역</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</p>
		</div>
		<div class="join_wrap">
			<div class="form_wrap">
				
				<form id="fregisterform" name="fregisterform" action="/bbs/mypage_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="u">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" id="mb_biz_type" name="mb_biz_type" value="<?php echo $member['mb_biz_type'];?>">
					<input type="hidden" id="mb_level" name="mb_level" value="<?php echo $member['mb_level'];?>">		
					<input type="hidden" id="mb_id" name="mb_id" value="<?php echo $member['mb_id'];?>">
					<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'];?>">					
					<input type="hidden" id="mb_biz_name" name="mb_biz_name" value="<?php echo $member['mb_biz_name'];?>">					
					<input type="hidden" id="mb_email" name="mb_email" value="<?php echo $member['mb_email'];?>">					
					<input type="hidden" id="mb_password" name="mb_password">
					<input type="hidden" id="mb_password_type" name="mb_password_type" value="<?php echo $member['mb_password_type'];?>">			
					<input type="hidden" id="mb_biz_goods_item" name="mb_biz_goods_item" value="<?php echo $member['mb_biz_goods_item'];?>">
					<input type="hidden" id="mb_biz_goods_year" name="mb_biz_goods_year" value="<?php echo $member['mb_biz_goods_year'];?>">
					<input type="hidden" id="mb_biz_remove_item" name="mb_biz_remove_item" value="<?php echo $member['mb_biz_remove_item'];?>">
					<input type="hidden" id="mb_biz_remove_etc" name="mb_biz_remove_etc" value="<?php echo $member['mb_biz_remove_etc'];?>">
					<input type="hidden" id="mb_biz_charge_rate" name="mb_biz_charge_rate" value="<?php echo $member['mb_biz_charge_rate'];?>">
					<div class="form-group">
						<ul class="tab">
							<li class="col-xs-6">
								<a href="/bbs/mypage_partner.php">마이페이지</a>
							</li>
							<li class="col-xs-6 on">
								<a href="./mypage_review.php">후기내역</a>
							</li>
						</ul>
					</div>

				<?php include_once ('./mypage_review_top.php'); ?>	
					

				

				
						
				<?php include_once ('./mypage_review_bottom.php'); ?>
					
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>
