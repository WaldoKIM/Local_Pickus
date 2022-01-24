<?php
include_once('./_common.php');


if($member['mb_level'] != "2"){
	alert("메인 창으로 이동합니다.",G5_URL);
}


$g5['title'] = '견적현황';
include_once('./_head.php');

$sql = " select a.*, concat(substr(nickname,1,1),'**') as nickname1 from {$g5['match_list']} a where idx = '$idx' ";

$master = sql_fetch($sql);

$sql = " select a.* from {$g5['match_propose']} a where idx = '$sub_idx' ";

$propose = sql_fetch($sql);

$sql = " select count(*) as cnt from {$g5['match_list_multi']} where sub_key = '{$master['sub_key']}'  ";
$detail_cnt = sql_fetch($sql);
$detailCnt = $detail_cnt['cnt'];
if($detail_cnt['cnt'] > 0 ){
	$sql = " select * from {$g5['match_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail = sql_query($sql);
}
?> 
<link rel="stylesheet" type="text/css" href="/css/jquery.bxslider.css"/>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="sub_title">
	<h1 class="main_co">매칭현황</h1>
</div><!-- sub_title -->
<div class="member com_pd">
	<div class="container">
		
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider">
						<ul id="mob_view_slider">
							<?php
							for($i=1;$i<=9;$i++)
							{
								if($master['photo'.$i]){
									echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$master['photo'.$i].'" target="_blank">'.estimate_img_thumbnail($master['photo'.$i], 350, 350).'</a></li>';
								}
							}
							?>	
						</ul>
						<div class="text" id="mobileEtype">중고 매칭</div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus"><?php echo get_match_state($master['state']);?></div>

					
					<div class="mob_info">
						<ul class="row"  id="mobileInfo1">
							<li class='col-xs-6'>
								<p class='text-center main_co'><i class='xi-money'></i> 내견적가</p>
								<p class='text-center'><?php echo display_estimate_price($propose['price']) ?></p>
							</li>
							<li class='col-xs-6'>
								<p class='text-center main_co'><i class='xi-calendar-check'></i> 고객</p>
								<p class='text-center'><?php echo $master['nickname1']; ?></p>
							</li>
						</ul>
					</div>

					<div class="customer"  id="mobileInfo2">
						<dl>
						<dt class='col-xs-1 main_co'>제목</dt><dd class="col-xs-11"><?php echo $master['title']; ?></dd>
						<dt class='col-xs-1 main_co'>지역</dt><dd class="col-xs-11"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?></dd>
						<dt class='col-xs-1 main_co'>층수</dt><dd class="col-xs-11"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>
						<dt class='col-xs-1 main_co'>장소</dt><dd class="col-xs-11"><?php echo $master['match_area']; ?></dd>
						<dt class='col-xs-1 main_co'>희망가격</dt><dd class="col-xs-11"><?php echo display_estimate_price($master['price']); ?></dd>
						<dt class="col-xs-1 main_co">견적가</dt><dd class="col-xs-11"><?php echo display_estimate_price($propose['price']) ?></dd>
					</dl>
					</div>

					<div class="customer" id="mobileButton">
						<ul class='row'>
							<li class='col-xs-6'>
								<a class='main_bg' href='javascript:doCancel()'>견적 취소</a>
							</li>
							<li class='col-xs-6'>
								<a class='main_bg' href='javascript:doModifyPrice()'>견적 수정</a>
							</li>
						</ul>
					</div>
				</div>

				<table class="web">
					<tr>
						<th class="photo">
							<ul id="view_slider">
							<?php
							for($i=1;$i<=9;$i++)
							{
								if($master['photo'.$i]){
									echo '<li>'.estimate_img_thumbnail($master['photo'.$i], 350, 350).'</li>';
								}
							}
							?>		
							</ul>
							<div class="pager_wrap">
								<ul id="bx-pager">
								<?php
								$seq = 0;
								for($i=1;$i<=9;$i++)
								{
									if($master['photo'.$i]){
										echo "<li><a data-slide-index='".$seq."' href=''>".estimate_img_thumbnail($master['photo'.$i], 350, 350)."</a></li>";
										$seq++;

									}
								}
								?>	
								</ul>
							</div>
						</th>
						<td class="info" id="mainTitle">
							<h1>중고매칭</h1>
							<dl>
								<dt class="col-xs-3">제목</dt><dd class="col-xs-9"><?php echo $master['title']; ?></dd>
								<dt class="col-xs-3">고객</dt><dd class="col-xs-9"><?php echo $master['nickname1']; ?></dd>
								<dt class="col-xs-3">지역</dt><dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?></dd>
								<dt class="col-xs-3">층수</dt><dd class="col-xs-9"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>

								<dt class="col-xs-3">견적가</dt><dd class="col-xs-9"><?php echo display_estimate_price($propose['price']) ?></dd>
								<dt class="col-xs-3">장소</dt><dd class="col-xs-9"><?php echo $master['match_area']; ?></dd>
								<dt class="col-xs-3">희망가격</dt><dd class="col-xs-9"><?php echo display_estimate_price($master['price']); ?></dd>
							</dl>
							<ul class='row'>
								<li class='col-xs-6'>
									<a class='main_bg' href='javascript:doCancel()'>견적 취소</a>
								</li>
								<li class='col-xs-6'>
									<a class='main_bg' href='javascript:doModifyPrice()'>견적 수정</a>
								</li>
							</ul>
						</td>
					</tr>
				</table>

				<h1 class="tt">상세정보</h1>

				<table class="requst_list02" id="subDetail">
				<?php
					echo "<colgroup class='web_col'>";
					echo "<col style='width: 10%' />";
					echo "<col style='width: 20%' />";
					echo "<col style='width: 20%' />";
					echo "<col style='width: 20%' />";
					echo "<col style='width: 15%' />";
					echo "<col style='width: 15%' />";
					echo "</colgroup>";
				if($detail_cnt['cnt'] > 0 ){					
					echo "<tr>";
					echo "<th class='web_td'>품목</th>";
					echo "<th>세부카테고리</th>";
					echo "<th>제조사</th>";
					echo "<th>모델명</th>";
					echo "<th>년식</th>";
					echo "<th>수량</th>";
					echo "</tr>";
					for ($i=0; $row=sql_fetch_array($detail); $i++) {
						echo "<tr>";
						echo "<td class='web_td'>".$row['item_cat']."</td>";
						echo "<td>".$row['item_cat_dtl']."</td>";
						echo "<td>".$row['manufacturer']."</td>";
						echo "<td>".$row['medel_name']."</td>";
						echo "<td>".$row['year']."</td>";
						echo "<td>".$row['item_qty']."</td>";
						echo "</tr>";
					}	
				}
					echo "<tr>";
					echo "<th>참고사항</th>";
					echo "<td class='web_td' colspan='5'>".$master['content']."</td>";
					echo "<td class='mob_td' colspan='4'>".$master['content']."</td>";
					echo "</tr>";
				?>
				</table>
			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./partner_match_list2.php?page=<?php echo $page; ?>">리스트</a>
					</li>
				</ul>
			</div>
			
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/partner_match_form2_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="idx" value="<?php echo $sub_idx; ?>">
					<div>
						<p>* 희망 견적가격을 입력하세요</p>
					</div>
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-3 title">
								견적가격
							</li>
							<li class="col-xs-9">
								<input type="text" class="input_default" id="price" name="price" value="<?php echo $propose['price']; ?>"> 
							</li>
						</ul>
					</div>								
					<div class='form-group'>
						<div class="row" id="imageList">
							<div class='col-md-4 text-center' id="divPhoto1"></div>
							<div class='col-md-4 text-center' id="divPhoto2"></div>
							<div class='col-md-4 text-center' id="divPhoto3"></div>
							<div class='col-md-4 text-center' id="divPhoto4"></div>
							<div class='col-md-4 text-center' id="divPhoto5"></div>
							<div class='col-md-4 text-center' id="divPhoto6"></div>
						</div><!-- imageList -->

						<input type="hidden" id="photo1" name="photo1" value="<?php echo $propose['photo1']; ?>">
						<input type="hidden" id="photo2" name="photo2" value="<?php echo $propose['photo2']; ?>">
						<input type="hidden" id="photo3" name="photo3" value="<?php echo $propose['photo3']; ?>">
						<input type="hidden" id="photo4" name="photo4" value="<?php echo $propose['photo4']; ?>">
						<input type="hidden" id="photo5" name="photo5" value="<?php echo $propose['photo5']; ?>">
						<input type="hidden" id="photo6" name="photo6" value="<?php echo $propose['photo6']; ?>">
						<input type="hidden" id="photo1_rotate" name="photo1_rotate" value="<?php echo $propose['photo1_rotate']; ?>">
						<input type="hidden" id="photo2_rotate" name="photo2_rotate" value="<?php echo $propose['photo2_rotate']; ?>">
						<input type="hidden" id="photo3_rotate" name="photo3_rotate" value="<?php echo $propose['photo3_rotate']; ?>">
						<input type="hidden" id="photo4_rotate" name="photo4_rotate" value="<?php echo $propose['photo4_rotate']; ?>">
						<input type="hidden" id="photo5_rotate" name="photo5_rotate" value="<?php echo $propose['photo5_rotate']; ?>">
						<input type="hidden" id="photo6_rotate" name="photo6_rotate" value="<?php echo $propose['photo6_rotate']; ?>">
					</div>
						
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-6">
								<p>상태 및 참고사항</p>
								<textarea id="content" name="content"><?php echo $propose['content']; ?></textarea>
							</li>
							<li class="col-xs-6">
								<p>배송/환불/A/S</p>
								<textarea id="delievery" name="delievery"><?php echo $propose['delievery']; ?></textarea>
							</li>
						</ul>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-6"><a href="javascript:doSavePrice()" class="main_bg" >확인</a></li>
						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->	
<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/partner_match_form2_cancel.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx" value="<?php echo $sub_idx; ?>">
	<input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager'
	});

	$('#bx-pager').bxSlider({ 
		minSlides : 5, 
		maxSlides : 5, 
		slideWidth : 200, 
		slideMargin : 5, 
		controls: true,
		pager : false
	});

	$('#mob_view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: true,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : false,
		oneToOneTouch : false
	});

	for(var i=1; i<=6; i++)
	{
		var vComp    = "photo"+i;
		var vDivComp = "divPhoto"+i;
		var vText    = "사진파일 업로드";

		if($("#photo"+i).val()){
            var vHtml2 = "";
            vHtml2 += "<div class='estimate_image_bg'>";
            vHtml2 += "<div class='estimate_image_del_bg'>";
            vHtml2 += "<a href='#none' onClick='doInitImageAjax(\""+vComp+"\",\""+vDivComp+"\",\""+vText+"\");'>";
            vHtml2 += "<i class='xi-close-min'></i>";
            vHtml2 += "</a>";
            vHtml2 += "</div>";
            vHtml2 += "<img src='/data/estimate/"+$("#photo"+i).val()+"' style='width:100%;'/>";
            vHtml2 += "</div>";
            $("#"+vDivComp).empty().html(vHtml2);
		}else{
			$("#photo"+i).val("");
			$("#photo"+i+"Rotate").val("");

			doInitImageAjax(vComp, vDivComp, vText);
		}
		

	}

});

function doCancel()
{
	document.frmcancel.submit();
}

function doModifyPrice()
{
	$('#modal_price_detail').modal();
}

function doSavePrice()
{
	if(!cfnNullCheckInput($("#price").val(), "견적가격")) return;
	if(!cfnNullCheckInput($("#content").val(), "상태 및 참고사항")) return;	
	if(!cfnNullCheckInput($("#delievery").val(), "배송/환불/A/S")) return;	
	
	var nCnt = 0;
	for(var i=1; i<=6; i++)
	{
		if($("#photo"+i).val()){
			nCnt++;
		}
		
	}	
	var f = document.frmprice;
	f.submit();
}
</script>
<?php
include_once('./_tail.php');
?>