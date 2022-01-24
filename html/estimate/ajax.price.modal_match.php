<?php
include_once("./_common.php");

$sql = " select * from g5_estimate_match_propose_detail where no_estimate='$no_estimate' and rc_email='$rc_email' ";
$result = sql_fetch($sql);

$sql= "select count(*) as cnt from g5_estimate_match_propose_detail where no_estimate='$no_estimate' and rc_email='$rc_email'";
$count = sql_fetch($sql);

$sql = " select * from g5_estimate_match_propose where no_estimate='$no_estimate' and rc_email='$rc_email' ";
$propose = sql_fetch($sql);

$sql = " select * from g5_estimate_list_photo_match where no_estimate='$no_estimate' and rc_email='$rc_email' ";
$photo = sql_query($sql);

$sql = " select * from g5_estimate_list_photo_match where no_estimate='$no_estimate' and rc_email='$rc_email' ";
$photos = sql_query($sql);
?>
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
<style type="text/css">
	.img_pros{width: 25%; position: relative; float: left; margin-right: 1%; border:1px solid #ededed;}
	p.tit_modal_match{font-size: 20px; padding: 10px 0; color: #1379cd !important; margin-bottom: 10px;}
	#del_fee{margin-bottom: 15px; padding-left: 10px; border-radius: 10px;}
	.add_line{background-color:#707070; color: #fff !important; padding: 10px; margin:10px 0;}
	.delete_item{overflow: hidden; background-color: #ccc; margin-right: 15px; }
	.add_pro{padding: 5px 0;}
	.add_pro input{border-radius: 10px; padding-left: 10px;}
	.add_pro td{text-align: center;}
	.requst_list{margin-top: 60px;}
	.add_name,.add_qty{margin-bottom: 5px;}
	.pc{display: block;}
	.mobile{display: none;}
	.one_line{overflow: hidden;}
	.one_line p.tit_modal_match{width: 40%; float: left;}
	.one_line ul{float: right; width: 60%;}
	.match_slider {position: relative;}
	.match_slider .swiper-slide{border:0; padding:0;}
	.modal-dialog{overflow: hidden;}
	.swiper-slide a img{width:100% !important; height:12rem !important;}
	@media(max-width: 768px){
		.pc{display: none;}
		.mobile{display: block;}
	}
</style>

<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_match_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="no_estimate" value="<?php echo $no_estimate; ?>">
	<div class="form-group">
		<div class="top_photos">
			<p class="tit_modal_match">상품 사진</p>
			<div class="row match_slider light_box">
				<div class=" swiper-wrapper">
				<?php 
					//echo sql_fetch_array($photo);
					for ($i=0; $row_photos=sql_fetch_array($photo); $i++) { 
						
						echo '<div class="swiper-slide estimate_photo estimate_image_bg col-md-4 text-center"><a href="/data/estimate/'. $row_photos['photo'] . '"><img src="/data/estimate/'. $row_photos['photo'] . '"></a></div>'; 
					}
				?>
				</div>
				 <!-- Add Arrows -->
	                    <div class="swiper-button-next"></div>
	                    <div class="swiper-button-prev"></div>
				<!-- <div class="mobile">
					<div class="bxslider">
					<?php 
						for ($i=0; $row_photo=sql_fetch_array($photos); $i++) { 

							echo '<div class="estimate_photo estimate_image_bg col-md-4 text-center"><img src="/data/estimate/'. $row_photo['photo'] . '"></div>'; 
						}
					?>
					</div>
				</div> -->
			</div>
		</div>
	</div>

	<div class="form-group" style="border-bottom: 0;">
		<p class="tit_modal_match">물품내역</p>
		<div class="row" id="multiList">
			<div class='form_new add_pro'>
				<table>
					<tr>
						<th>품목명</th>
						<th>가격</th>
					</tr>
					<tr>
						<td><?php echo $result['item0']; ?></td>
						<td><?php echo number_format($result['amt0']); ?>원</td>
					</tr>
					<?php 
					if($result['item1']){
						echo '<tr><td>' . $result['item1'] . '</td>';
						echo '<td>' . number_format($result['amt1']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item2']){
						echo '<tr><td>' . $result['item2'] . '</td>';
						echo '<td>' . number_format($result['amt2']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item3']){
						echo '<tr><td>' . $result['item3'] . '</td>';
						echo '<td>' . number_format($result['amt3']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item4']){
						echo '<tr><td>' . $result['item4'] . '</td>';
						echo '<td>' . number_format($result['amt4']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item5']){
						echo '<tr><td>' . $result['item5'] . '</td>';
						echo '<td>' . number_format($result['amt5']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item6']){
						echo '<tr><td>' . $result['item6'] . '</td>';
						echo '<td>' . number_format($result['amt6']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item7']){
						echo '<tr><td>' . $result['item7'] . '</td>';
						echo '<td>' . number_format($result['amt7']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item8']){
						echo '<tr><td>' . $result['item8'] . '</td>';
						echo '<td>' . number_format($result['amt8']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item9']){
						echo '<tr><td>' . $result['item9'] . '</td>';
						echo '<td>' . number_format($result['amt9']) . '원</td></tr>';
					}
					?>
					<?php 
					if($result['item10']){
						echo '<tr><td>' . $result['item10'] . '</td>';
						echo '<td>' . number_format($result['amt10']) . '원</td></tr>';
					}
					?>
				</table>
				
			</div>
		</div>
	</div>
	<div class="form-group one_line">
		<p class="tit_modal_match ">배송비</p>
		<ul class="row">
			<li class="col-xs-9">
				<input readonly="" value="<?php echo $propose['shipping'] . '원' ?> " type="text" name="shipping_pro" id="del_fee">
			</li>
		</ul>
	</div>
	<div class="form-group one_line" style="border:0 !important">
		<p class="tit_modal_match ">AS 보증/교환</p>
		<ul class="row">
			<li class="col-xs-9">
				<?php if($propose['pro_as'] == '1'){

					echo '<input readonly="" value="' . 가능 . '" type="text" name="shipping_pro" id="del_fee">';
					echo '<input readonly="" value="' . $propose['month_as'] . '개월" type="text" name="shipping_pro" id="del_fee">';
				}else if($propose['pro_as'] == '2'){
					echo '<input readonly="" value="' . 불가능 . '" type="text" name="shipping_pro" id="del_fee">';
				}else{
					echo '<input readonly="" value="' . 미선택 . '" type="text" name="shipping_pro" id="del_fee">';
				} ?>
			</li>
		</ul>
	</div>
	<table style="margin-top: 20px;">
		<th>총비용</th>
		<td>
			<?php echo number_format($result['amt0'] + $result['amt1'] + $result['amt2'] + $result['amt3'] + $result['amt4'] + $result['amt5'] + $result['amt6'] + $result['amt7'] + $result['amt8'] + $result['amt9'] + $result['amt10'] + $propose['shipping']);?>원
		</td>
	</table>
</form>

<div class="btn_wrap">
	<ul class="row">
		<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
	</ul>
</div>
<script type="text/javascript">
	$(function(){
		new Swiper('.match_slider', {
	     slidesPerView: 3,
	     observer: true, 
		 observeParents: true,
	     navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
	    });
	  $(".light_box a").lightbox();
	});
</script>