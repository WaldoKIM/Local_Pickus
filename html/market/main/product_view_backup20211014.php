
<? include('./include/head.inc2.php');?>

<?
$mv_data	= $_GET["goods_data"];
$goods_data	= $tools->decode( $_GET["goods_data"] );
if($_GET["idx"] )						{ $idx = $_GET["idx"]; }			else if($goods_data["goods_idx"] ){ $idx = $goods_data["goods_idx"]; }	else { $idx = $goods_data["idx"]; }
if($_GET["part_idx"] )			{ $part_idx = $_GET["part_idx"]; }						else { $part_idx = $goods_data["part_idx"]; }


$cookie_name = $_SESSION["VIEW_LIST"];
//최근 살펴본 상품 등록하기[1일]
$idx_value = $idx."&&";
$cookie_value = $_COOKIE[$cookie_name];
$cut_value = "0&&".$_COOKIE[$cookie_name];
$idx_arr = explode("&&", $cut_value);
if(strlen(array_search($idx, $idx_arr)) > 0){
$idx_value = $cookie_value;
}else{
$idx_value = $idx_value.$cookie_value;
$idx_value = substr($idx_value, 0, 50);
}
// 카테고리 정보
if(!$part_idx) { $tools->errMsg("잘못된 접근입니다");}
$part_stat = $db->object("cs_part", "where idx=$part_idx");

// 상품 이전 다음 이동
$goods_stat = $db->object("cs_goods", "where idx=$idx");

if($_GET["goods_move_page"]=="next" && $_GET["goods_code"]) {
	$goods_stat = $db->object("cs_goods","where display=1 and part_idx=$goods_stat->part_idx and ranking < $goods_stat->ranking order by ranking desc limit 1");
	$goods_prev_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking > $goods_stat->ranking");
	$goods_next_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking < $goods_stat->ranking");
} else if($_GET["goods_move_page"]=="prev" && $_GET["goods_code"]) {
	$goods_stat = $db->object("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking > $goods_stat->ranking order by ranking asc limit 1");
	$goods_prev_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking > $goods_stat->ranking");
	$goods_next_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking < $goods_stat->ranking");
} else {
	$goods_stat = $db->object("cs_goods", "where idx=$idx");
	$goods_prev_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking > $goods_stat->ranking and idx <> $idx");
	$goods_next_cnt = $db->cnt("cs_goods", "where display=1 and part_idx=$goods_stat->part_idx and ranking < $goods_stat->ranking and idx <> $idx");
}

// 엔코딩
$goods_data = $tools->encode("idx=".$goods_stat->idx."&part_idx=".$goods_stat->part_idx);

// 상품 조회수
$db->update("cs_goods", "click=$goods_stat->click+1 where idx=$goods_stat->idx");

$optArr = explode("/^CUT/^", $goods_stat->opt_data);
$arrIcon = explode(",",",".$goods_stat->iconidx);
$arrIcon2 = explode(",",",".$goods_stat->substimg);

$qnacnt = $db->cnt("cs_goods_qna", "where goods_idx=$idx");
$reviewcnt = $db->cnt("cs_goods_review", "where goods_idx=$idx");
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=0.25, user-scalable=yes, target-densitydpi=device-dpi">
<script language="javascript">
	<!--
	// 리뷰작성
	function reviewWinOpen() {
		window.open("product_review.php?goods_data=<?=$goods_data;?>", "","scrollbars=no, width=484, height=400, top=200, left=200");
	}
	// 구매 링크 리스트
	function goodsBuySendit(check){
		var form=document.goods_form;
		var k=0;
		for(var i=1; i<document.forms['goods_form']['option_select[]'].length; i++) {
			if(document.forms['goods_form']['option_select[]'][i].value=='none') {
				k=1;
			}
		}
		<?if(!$goods_stat->opt_data){?>
		if(form.buy_goods_cnt.value=="" || form.buy_goods_cnt.value=="0" || form.buy_goods_cnt.value==0) {
			alert("구입수량을 입력해 주십시오.");
			form.buy_goods_cnt.focus();
		}else <?}?>if(k==1 && form.opt_check.value==""){
			for(var i=1; i<document.forms['goods_form']['option_select[]'].length; i++) {
				if(document.forms['goods_form']['option_select[]'][i].value=='none') {
					alert('옵션을 선택해주세요');
					document.forms['goods_form']['option_select[]'][i].focus();
					break;
				}
			}
		}
		<? if(!$goods_stat->unlimit && !$goods_stat->opt_data) { ?>
		else if(form.buy_goods_cnt.value > <?=$goods_stat->number;?>) {
			alert("상품 재고수량이 부족합니다.");
			form.buy_goods_cnt.focus();
		}<?}?>else{
			if(check==1) { // 장바구니추가
				form.action="cart.php?cart_method=1&goods_data=<?=$goods_data;?>";
				form.submit();
			} else if(check==2) { // 즉시 구매
				form.action="order_once_ok.php?trade_method=2&goods_data=<?=$goods_data;?>";
				form.submit();
			} else if(check==3) { // withlist 추가
				form.action="my_wishlist.php?wishlist_method=1&goods_data=<?=$goods_data;?>";
				form.submit();
			}
		}
	}
	function SaveCookie(name, value, expire) {
		var eDate = new Date();
		eDate.setDate(eDate.getDate() + expire);
		document.cookie = name + '=' + value + '; expires=' + eDate.toGMTString()+ '; path=/';
	}
	function start_cookie(){
		SaveCookie("<?=$cookie_name?>", "<?=$idx_value?>", 1);
		ajaxtodayview();
		recall();
	}
	function priceCheck(){
		var form=document.goods_form;
		var totalPrice = Number(<?=$goods_stat->shop_price?>);
		for(var data_cnt=0; data_cnt < document.forms['goods_form']['option_select[]'].length; data_cnt ++) {
			optionCut = document.forms['goods_form']['option_select[]'][data_cnt].value.split(":");
			if(optionCut[1]){
				totalPrice = Number(totalPrice) + Number(trim(optionCut[1]));
			}
		}
		form.hidden_price.value = totalPrice;
		document.all.viewPrice.innerHTML = commify(totalPrice)+"원";
	}
	function commify(n) {
	  var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
	  n += '';                          // 숫자를 문자열로 변환
	  while (reg.test(n))
		n = n.replace(reg, '$1' + ',' + '$2');
	  return n;
	}
	function trim(str) {
		return str.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
	}
	start_cookie();

	<?//2021-04-29 다중선택 구매 추가 sinn?>
	<?
	mt_srand((double)microtime()*1000000);
	$opt_code=chr(mt_rand(65, 90));
	$opt_code.=chr(mt_rand(65, 90));
	$opt_code.=chr(mt_rand(65, 90));
	$opt_code.=chr(mt_rand(65, 90));
	$opt_code.=chr(mt_rand(65, 90));
	$opt_code.=time();
	?>
		
	function add_cart(goods_data, part_name, option_select){
		var formData = jQuery("#goods_form").serialize();
		document.goods_form.opt_check.value=1;
		$.ajax({
			type: "POST",
			url: "ajax_cart_tmp.php?goods_data="+goods_data+"&opt_code=<?=$opt_code;?>",
			//data: "goods_data="+ goods_data+"&buy_goods_cnt="+form.buy_goods_cnt.value+"&part_name="+form.part_name.value,//+"&option_select[]="+form.option_select[].value, 
			//data: {'goods_data':goods_data,'buy_goods_cnt':form.buy_goods_cnt.value,'part_name':part_name,'option_select':option_select},
			//enctype: 'multipart/form-data',
			data: formData,
			cache: false,
			success: function(html)
			{
				//$("div#cart_list").append(html);
				$("div#cart_list").html(html);
			}
		});
	}	
	
	function opt_cnt(goods_data, opt_idx, cnt){
		$.ajax({
			type: "GET",
			url: "ajax_cart_tmp.php",
			data: "goods_data="+goods_data+"&opt_code=<?=$opt_code;?>&opt_idx="+opt_idx+"&cnt="+cnt,
			cache: false,
			success: function(html)
			{
				$("div#cart_list").html(html);
			}
		});
	}	
	<?//2021-04-24 추가 sinn end?>
	//-->
</script>
<script type="text/javascript">
	$(document).ready(function () {
	   $('.product-collateral .padder h4').click(function (){
		$(this).toggleClass('on');
		$(this).next('ol').slideToggle();
	   });
	});
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
	<?
	if($part_idx) {
	if( $part_stat->part_index == 1 ) {
	$part_name_result = $db->select("cs_part", "where part1_code='$part_stat->part1_code' && part_index=1 order by idx asc", "idx, part_name");
	} else if( $part_stat->part_index == 2 ) {
	$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) order by idx asc", "idx,part_name");
	} else if( $part_stat->part_index == 3 ) {
	$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) || (part3_code='$part_stat->part3_code' && part_index=3) order by idx asc", "idx, part_name");
	}
	}
	?>
		<!--제품목록(페이지 위치)-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<? $i=0; while( $part_name_stat_row = @mysqli_fetch_object( $part_name_result )) {	++$i;?>
				<? if( $i==1 && $part_stat->part_index == 3) { $part_name_idx=$part_name_stat_row->idx;}?>
				<? if( $i==2 && $part_stat->part_index == 3) {?>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i><a href="product_list.php?part_idx=<?=$part_name_idx;?>" class="titletxt_A"><?=$part_name_stat_row->part_name;?></a></li>
				<?} else {?>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i><a href="product_list.php?part_idx=<?=$part_name_stat_row->idx;?>" class="titletxt_A"><?=$part_name_stat_row->part_name;?></a></li>
				<?}?><?}?>
			</ol>
		</div>
		<!--//제품목록(페이지 위치)-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section product_detail">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************콘텐츠 시작********************-->
					<div class="product-view">
						<div class="product-essential">
					<!--제품 이미지영역 출력 PC용-->
					<div class="product-img-box ">
						<!--큰이미지-->
						<p class="product-image">
						<?$ThumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=500&h=500");?>
						<?$ThumbEncode500 = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=500&h=500");?>
						<?if($goods_stat->resize==1){?><!--jquery.colorbox.min.js-->
						<a href="../data/goodsImages/<?=$goods_stat->images1?>"  rel="" title="" id="zoom1" class="cloud-zoom"><img style="width:300px; height:300px; margin:auto;" src="../data/goodsImages/<?=$goods_stat->images1?>" border="0" rel="" title="<?=$goods_stat->name?>" id="zoom1" class="cloud-zoom"></a>
						<?}else{?>
						<a href="../data/goodsImages/<?=$goods_stat->images1?>"  rel="" title="" id="zoom1" class="cloud-zoom">
						<img src="../data/goodsImages/<?=$goods_stat->images1?>" border="0" rel="" title="<?=$goods_stat->name?>" id="zoom1" class="cloud-zoom">
						</a>
						<?}?>
						<a style="display:none;" id="zoom-btn" class="lightbox-group zoom-btn-small" href="<?if($goods_stat->resize==1){?>../data/goodsImages/<?=$goods_stat->images1?><?}else{?>../data/goodsImages/<?=$goods_stat->images3?><?}?>" title="<?=$goods_stat->name?>">&nbsp;</a>
						</p>
						<!--큰이미지-->
						<div class="more-views additional-carousel">
							<? if($goods_stat->add_images1 || $goods_stat->add_images2 || $goods_stat->add_images3 || $goods_stat->add_images4 || $goods_stat->add_images5) {?>
							<!--썸네일이미지 이전다음보기 화살표아이콘-->
							<div class="customNavigation">
								<a class="btn prev" title='이전'>&nbsp;</a>
								<a class="btn next" title='다음'>&nbsp;</a>
							</div>
							<!--썸네일이미지 이전다음보기 화살표아이콘-->
							<div id="additional-carousel" class="product-carousel">
								<div class="slider-item">
									<div class="product-block2" ><!--큰이미지 밑에 작은이미지 첫번째 이미지-->
										<?if($goods_stat->resize==1){?><a href='../data/goodsImages/<?=$goods_stat->images1?>' class='cloud-zoom-gallery lightbox-group' title='' rel="useZoom: 'zoom1', smallImage: '../data/goodsImages/<?=$goods_stat->images1?>' "><img src="../data/goodsImages/<?=$goods_stat->images1?>" alt="" /></a>
										<?}else{?>
										<a href='../data/goodsImages/<?=$goods_stat->images3?>' class='cloud-zoom-gallery lightbox-group' title='' rel="useZoom: 'zoom1', smallImage: '../data/goodsImages/<?=$goods_stat->images2?>' "><img src="../data/goodsImages/<?=$goods_stat->images2?>" alt="" /></a>
										<?}?>
									</div>
								</div>
								<?for($i=1;$i<=5;$i++){?>
								<? if($goods_stat->{"add_images".$i}) {?>
								<?$ThumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=add_images".$i."&dire=goodsImages&w=200&h=200");?>
								<?$ThumbEncode500 = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=add_images".$i."&dire=goodsImages&w=500&h=500");?>
								<div class="slider-item"><!--큰이미지 밑에 작은이미지 2-->
									<div class="product-block2">
										<?if($goods_stat->resize==1){?>
										<a href='../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>' class='lightbox-group' title='' rel="useZoom: 'zoom1', smallImage: '../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>'">
										<img src="../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>" alt="" />
										</a>
										<?}else{?>
										<a href='../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>' class='lightbox-group' title='' rel="useZoom: 'zoom1', smallImage: '../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>'">
										<img src="../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>" alt="" />
										</a>
										<?}?>
									</div>
								</div>
								<?}?>
								<?}?>
							</div><!--additional-carousel-->
							<?}?>
							<!--묶어주는부분 삭제금지-->
							<script type="text/javascript">
							jQuery(function($) {
								$(".lightbox-group").colorbox({
								rel:		'lightbox-group',
								opacity:	0.5,
								speed:		300
								});
								$(".cloud-zoom-gallery").first().removeClass("cboxElement");
								$(".cloud-zoom-gallery").click(function() {
								$("#zoom-btn").attr('href', $(this).attr('href'));
								$("#zoom-btn").attr('title', $(this).attr('title'));
								$(".cloud-zoom-gallery").each(function() {
								$(this).addClass("cboxElement");
							});
							$(this).removeClass("cboxElement");
							});
							});
							jQuery(function($) {
							var t; $(window).resize(function() { clearTimeout(t); t = setTimeout(function() { $(".cloud-zoom-gallery").first().click(); }, 200); });
							});
							</script>
						</div><!--more-views-->
					</div><!--product-img-box-->
					<!--제품 이미지영역 출력 PC용 End-->
					<!--제품 이미지영역 출력 Mobile용-->
					<div class="product-block2_mobile_box">
					<div class="product-block2_mobile">
						<!--큰이미지-->
						<p class="product-image">
						<? if($_SESSION[USERID]) {?><a style="display:none;" href="javascript:goodsBuySendit(3);" class="interest"><i class="far fa-heart"></i></a><?} else {?><a style="display:none;" href="javascript:alert('회원 로그인 해주세요');" class="interest"><i class="far fa-heart"></i></a><? }?>
						<?$ThumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=500&h=500");?>
						<?$ThumbEncode500 = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=500&h=500");?>
						<?if($goods_stat->resize==1){?>
						<img style="width:300px; height:300px; margin:auto;" src="../data/goodsImages/<?=$goods_stat->images1?>" border="0" rel="" title="<?=$goods_stat->name?>" id="zoom_img" name="zoom_img" class="cloud-zoom"></a>
						<?}else{?>
						<img src="../data/goodsImages/<?=$goods_stat->images2?>" border="0" rel="" title="<?=$goods_stat->name?>" id="zoom_img" name="zoom_img" class="cloud-zoom">
						<?}?>
						</p>
						<!--큰이미지-->
						<div class='info_data_big'>
						<? if($goods_stat->add_images1 || $goods_stat->add_images2 || $goods_stat->add_images3 || $goods_stat->add_images4 || $goods_stat->add_images5) {?>
							<!--큰이미지 밑에 작은이미지 첫번째 이미지-->
							<?$ThumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=100&h=100");?>
							<?if($goods_stat->resize==1){?><img src="../data/goodsImages/<?=$goods_stat->images1?>" alt="" onclick="document.zoom_img.src='../data/goodsImages/<?=$goods_stat->images2?>'" class='itemview_detialimg_samll'>
							<?}else{?>
							<img src="../data/goodsImages/<?=$goods_stat->images2?>" alt="" onclick="document.zoom_img.src='../data/goodsImages/<?=$goods_stat->images2?>'" class='itemview_detialimg_samll'>
							<?}?>
							<?for($i=1;$i<=5;$i++){?>
							<? if($goods_stat->{"add_images".$i}) {?>
							<?$ThumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=add_images".$i."&dire=goodsImages&w=100&h=100");?>
							<?$ThumbEncode500 = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=add_images".$i."&dire=goodsImages&w=500&h=500");?>
							<?if($goods_stat->resize==1){?>
							<img src="../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>" onclick="document.zoom_img.src='../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>'" class='itemview_detialimg_samll'>
							<?}else{?>
							<img src="../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>" alt="" onclick="document.zoom_img.src='../data/goodsImages/<?=$goods_stat->{"add_images".$i}?>'" class='itemview_detialimg_samll'>
							<?}?>
							<?}?>
							<?}?>
						<?}?>
						<!--묶어주는부분 삭제금지-->
						</div><!--product-img-box-->
					</div><!--product-block2_mobile-->
					</div>
					<!--제품 이미지영역 출력 Mobile용 End-->
					<!--상품기본 정보 출력-->
						<div class="product-shop">
							<div id="prev-next-links">
								<!--이전페이지 아이콘 Previous Item Link-->
								<? if($goods_prev_cnt>=1) {?><a id="link-previous-product" href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>&goods_move_page=prev&part_idx=<?=$part_idx?>&goods_code=<?=$goods_stat->code;?>" title='이전페이지'>&nbsp;</a><?}?>
								<!--다음페이지 아이콘 Next Item Link-->
								<? if($goods_next_cnt>=1) {?><a id="link-next-product" href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>&goods_move_page=next&part_idx=<?=$part_idx?>&goods_code=<?=$goods_stat->code;?>" title='다음페이지'>&nbsp;</a><?}?>
							</div>
							<div class="short-description">
								<div class="std">
									<!----상품정보출력-->
									<table width="100%" class="prd_info">
										<colgroup>
											<col style="width:30%">
										</colgroup>
										<form method="post" name="goods_form" id="goods_form" >
										<input type="hidden" name="hidden_price" value="<?=$goods_stat->shop_price?>">
									<?if($goods_stat->opt_data){//2021-04-29 다중선택 구매 추가 sinn?>
										<input type="hidden" name="opt_code" value="<?=$opt_code;?>">
										<input type="hidden" name="opt_check" value="">
									<?}?>
										
										<tr class="prd_name">
											<td colspan="2">
												<span>
													<?for($i=1;$i<count($arrIcon);$i++){
														if($arrIcon[$i] > 0){
													?>
														<img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle">
													<?}}?>
												</span>
												<?=$db->stripSlash($goods_stat->name);?>
											</td>
										</tr>
										<?if($goods_stat->subst==1){?>
										<tr class="sale_price">
											<td class="cell_header">판매가격</td>
											<td class='info_data'><span class="info_data_price"><div id="viewPrice">
												<?if($goods_stat->substtxt){?><?=$goods_stat->substtxt?><?}?>
												<?for($i=1;$i<count($arrIcon2);$i++){
													if($arrIcon2[$i] > 0){
												?>
													<img src="../data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle">
												<?}}?>
												</div></span>
											</td>
										</tr>
										<?}else{?>
										<? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) {$ordercheck = 1;?>
										<tr class="sale_price">
											<td class="cell_header">판매가격</td>
											<td class='info_data'  id="viewPrice"><?=number_format($goods_stat->shop_price);?>원</td>
										</tr>
										<?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) {$ordercheck = 1;?>
										<tr class="sale_price">
											<td class="cell_header">판매가격</td>
											<td class='info_data'  id="viewPrice"><?=number_format($goods_stat->shop_price);?>원</td>
										</tr>
										<?}?>
										<? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?>
										<tr class="market_price">
											<td class="cell_header">시중가격</td>
											<td class='info_data'><span><?=number_format($goods_stat->old_price);?></span>원</td>
										</tr>
										<?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?>
										<tr class="market_price">
											<td class="cell_header">시중가격</td>
											<td class='info_data'><?=number_format($goods_stat->old_price);?><span>원</span></td>
										</tr>
										<?}?>
										<tr style="display:none;" class="point">
											<td class="cell_header">적립금</td>
											<td  class='info_data'>포인트 적립 <?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>원</td>
										</tr>
										<tr style="display:none;" class="prd_code">
											<td class="cell_header">상품코드</td>
											<td class='info_data'><?=$goods_stat->code;?></td>
										</tr>
										<tr style="display:none" class="option">
											<td></td>
											<td class='info_data'>
												<input type="hidden" name="part_name[]">
												<select name="option_select[]" class="formSelect" onchange="priceCheck(this)">
												<option value="none">옵션선택</option>
												</select>
											</td>
										</tr>
										<!-- 옵션출력 -->
										<? if($goods_stat->goods_file) {?>
										<tr class="file">
											<td class="cell_header">첨부자료</td>
											<td class='info_data'><span class='searchWi'>파일 다운로드</span>*주문완료후 마이페이지에서 다운로드가능</td>
										</tr>
										<? }?>
										<tr style="display:none;" class="brand">
											<td class="cell_header">브랜드/제조사</td>
											<td class='info_data'><?=$goods_stat->company;?></td>
										</tr>
										<?if($goods_stat->model_name) {?>
										<tr class="brand">
											<td class="cell_header">모델명</td>
											<td class='info_data'><?=$goods_stat->model_name;?></td>
										</tr>
										<tr style="border-top:1px solid #d6d6d6 !important;">
											<td colspan='2' style="padding-top: 2%;" class="info_data cell_header"><p>상품설명</p></br><p><?=$goods_stat->content?></p></td>
										</tr>
										<?}?>
										
										<? if($admin_stat->delivery_company) {?>
										<tr class="delivery">
											<td class="cell_header">배송방법</td>
											<td class='info_data'><?=$admin_stat->delivery_company;?> (<?=number_format($admin_stat->express_free)?>원 이상 무료배송)</td>
										</tr>
										<?}?>
										<tr style="display:none;" class="delivery">
											<td class="cell_header">배송비</td>
											<td class='info_data'><?if($goods_stat->deliv_fee){?><?=number_format($goods_stat->deliv_fee);?>원<?}else{?>무료배송<?}?></td>
										</tr>
										<tr style="display:none;" class="amount">
											<td class="cell_header">판매수량</td>
											<td class='info_data'><? if($goods_stat->unlimit==0) { if($goods_stat->number==0) { echo('품절'); } else { echo($goods_stat->number."&nbsp;개");}} else { echo('재고보유');}?></td>
										</tr>
										<?if($ordercheck==1){?>
										<?if($goods_stat->subst!=1 && !$goods_stat->opt_data){?>
										<tr style="display:none;" class="order_amount">
											<td class="cell_header">주문수량</td>
											<td class='info_data'>
											<input name="buy_goods_cnt" type="text" class="formText formText_count" size="5" value="1" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"> 개</td>
										</tr>
										<?}}?>
										<!-- 옵션출력 -->
										<? for($i=0;$i<count($optArr)-1;$i++){
											$optRec = explode("/^/^", $optArr[$i]);
										?>
										<tr class="option">
											<td class="cell_header"><?=$optRec[0];?></td>
											<td class='info_data'>
												<input type="hidden" name="part_name[]" value="<?=$optRec[0];?>">
												<select name="option_select[]" class="formSelect" onchange="priceCheck(this);<?//2021-04-29 다중선택 구매 추가 sinn?><?if(sizeof($optArr)-1 == $i+1){?>add_cart('<?=$goods_data;?>','<?=$optRec[0];?>',this.value);this.value='none';<?}?>">
												<option value="none">옵션선택</option>
												<?
													$option1_arr = explode("&&", $optRec[1] );
													for( $ot1=0; $ot1 < count($option1_arr)-1; $ot1++ ) {
														$optView = "";
														$optView = explode(":", $option1_arr[$ot1] );
													?>
												<option value="<?=$option1_arr[$ot1];?>"><?=$optView[0]?><?if($optView[1]){?>:<?=number_format($optView[1])?>원<?}?></option>
												<? }?>
												</select>
											</td>
										</tr>
										<?}?>
										<?//2021-04-29 다중선택 구매 추가 sinn?>
										<tr>
											<td colspan="2" >
												<div id="cart_list" name="cart_list">
													<!-- AJAX 내용 출력 -->
												</div>
											</td>
										</tr>
										

									<?}?>
										</form>
									</table>
									
									<!----상품정보출력-->
								</div><!--prev-next-links-->
							</div><!--product-shop-->
							<!--버튼 출력-->
							<div class="clearer"></div>
							<div class="order_btn_area">
								<?if($ordercheck==1){?>
								<?if($goods_stat->subst!=1){?>
									<a href="javascript:goodsBuySendit(1);" class="order_btn1">장바구니담기</a>
									<? if($_SESSION[USERID]) {?><a style="display:none;" href="javascript:goodsBuySendit(3);" class="order_btn3">관심상품등록</a><?} else {?><a style="display:none;" href="javascript:alert('회원 로그인 해주세요');" class="order_btn3">관심상품등록</a><? }?>
									<a href="javascript:goodsBuySendit(2);" class="order_btn2">바로구매하기</a>
									<a href="./seller_info.php?search=<?=$goods_stat->seller;?>" class="order_btn3" style="background:#FF7A7A; color:#fff;">판매자샵</a>
									
								<?}}?>
							</div>
							
							
								
							</div>
							<!--버튼 출력-->
						</div><!--product-essential-->
						<div class="info3col-data">
							<div class="custom_block"></div>
						</div>
					</div><!--product-view-->
					<!--상품기본 정보 출력 끝-->
					

					<SCRIPT LANGUAGE="JavaScript">
						<!--
						function hiddenView(target, value) {
							for(i=0;i<document.all[target].length;i++){
								document.all[target][i].style.display="none";
								document.all['tab_under_bar'][i].className = "product_view_font Mouse_unover_tab";
							}
							document.all[target][value].style.display="";
							document.all['tab_under_bar'][value].className = "product_view_font Mouse_over_tab";
						}
						function iframecheck(value){
							if(value=="piframe"){
								document.piframe.location.href='product_qna.iframe.php?goods_idx=<?=$goods_stat->idx?>' ;
							}else if(value=="miframe"){
								document.miframe.location.href='product_qna.iframe.php?goods_idx=<?=$goods_stat->idx?>' ;
							}else if(value=="rpiframe"){
								document.rpiframe.location.href='product_review.iframe.php?goods_idx=<?=$goods_stat->idx?>' ;
							}else if(value=="rmiframe"){
								document.rmiframe.location.href='product_review.iframe.php?goods_idx=<?=$goods_stat->idx?>' ;
							}
						}
						// iframe resize
						function autoResize(i)
						{
							(i).height=200;
							var iframeHeight= (i).contentWindow.document.body.scrollHeight;
							(i).height=iframeHeight+20;
						}
						//-->
					</SCRIPT>
					<!---하단 텝메뉴--->
					<div style="border:none !important;"class="product-collateral">
						<div class="sns-go">
								<ul>
									<li>
										<a href="#" onclick="shareKatalk();"><img src="./img/kakaolink_btn_medium.png"></a>
									</li>
									<li>
										<a href="#" onclick="javascript:window.open('http://share.naver.com/web/shareView.nhn?url=' +encodeURIComponent(document.URL)+'&title='+encodeURIComponent(document.title), 'naversharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Naver" rel="nofollow"><img src="./img/naver.png" width="35px" height="35px" alt="네이버 블로그 공유하기"></a>
									</li>
									<li>
										<a href="#" onclick="javascript:window.open('http://band.us/plugin/share?body='+encodeURIComponent(document.title)+encodeURIComponent('\r\n')+encodeURIComponent(document.URL)+'&route='+encodeURIComponent(document.URL), 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" alt="네이버 밴드에 공유하기" rel="nofollow"><img src="./img/band.png" width="35px" height="35px" alt='네이버 밴드에 공유하기'></a>
									</li>
									<li>
										<a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=' +encodeURIComponent(document.URL)+'&t='+encodeURIComponent(document.title), 'facebooksharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Facebook" rel="nofollow"><img src="./img/facebook.png" width="35px" height="35px"  alt="페이스북 공유하기"></a>
									</li>
										<li>
										<a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text=[%EA%B3%B5%EC%9C%A0]%20' +encodeURIComponent(document.URL)+'%20-%20'+encodeURIComponent(document.title), 'twittersharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Twitter" rel="nofollow"><img src="./img/twitter-icon.png" width="35px" height="35px"  alt="트위터 공유하기"></a>
									</li>																						
									<li>
										<a href="#" onclick="javascript:window.open('https://story.kakao.com/s/share?url=' +encodeURIComponent(document.URL), 'kakaostorysharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes, height=400,width=600');return false;" target="_blank" alt="Share on kakaostory" rel="nofollow"><img src="./img/kakao.png" width="35px" height="35px" alt="카카오스토리 공유하기"></a>
									</li>
								</ul>
							</div>
						<!--상품설명 영역 [모바일]-->
						<div style="display:none;" class="padder">
							<div id="product_tabs_description_tabbed_contents">
								<ol style="display:inline-block">
									<div class="std">
										<?
										for($i=1;$i<=$DEFAULTADDFIELD;$i++){
											if($goods_stat->{"fieldname".$i}){
												$view = 1;
												$lastcnt++;
											}
										}
										if($view){$N="";
										?>
										<table style="display:none;" width="100%" class="table_all">
											<tr height="30">
											<?for($i=1;$i<=$DEFAULTADDFIELD;$i++){
												if($goods_stat->{"fieldname".$i}){
												$N++;
												?>
												<td width="20%" bgcolor="#E4E7EF" class='contenM tabletd_small'><img src="images/product_skin_icon1.gif" width="7" height="8" border="0"><?=$goods_stat->{"fieldname".$i}?></td>
												<td width="30%" class='tabletd_all tabletd_small'><?=$tools->strHtmlNo($goods_stat->{"fielddata".$i})?></td>
											<?if($N%2==0){?><?if($N < $lastcnt){?></tr><tr height="30"><?}}?>
											<?}}?>
											<?if($N%2==1){?>
												<td width="20%" bgcolor="#E4E7EF" class='contenM tabletd_small'>&nbsp;</td>
												<td width="30%" class='tabletd_all tabletd_small'>&nbsp;</td>
											<?}?>
											</tr>
											<tr height="30">
												<td width="20%" bgcolor="#E4E7EF" class='contenM tabletd_small'>배송 가능 지역</td>
												<td colspan="3" class='tabletd_all tabletd_small'>
													<?if($goods_stat->area){echo $goods_stat->area;}else{echo "전국";}?>
												</td>
											</tr>
										</table>
										<br>
										<?}else{?>
										<table style="display:none;" width="100%" class="table_all">
											<tr height="30">
												<td width="20%" bgcolor="#E4E7EF" class='contenM tabletd_small'>배송 가능 지역</td>
												<td class='tabletd_all tabletd_small'>
													<?if($goods_stat->area){echo $goods_stat->area;}else{echo "전국";}?>
												</td>
											</tr>
										</table>	
										<?}?>
										<div style='overflow: hidden;'><?=$goods_stat->content?></div>
									</div>
								</ol>
							</div>
							<div id="product_tabs_tags_tabbed_contents">
								<h4>배송&middot;반품/상품고지<i class="fas fa-angle-down"></i><i class="fas fa-angle-up"></i></h4>
								<ol>
									<div class="std">
										<?=$admin_stat->delivery?>
									</div>
								</ol>
							</div>
							<div id="product_tabs_review_tabbed_contents" onclick="iframecheck('rmiframe');">
								<h4>상품평<?if($reviewcnt){?>(<span><?=$reviewcnt?></span>)<?}?><i class="fas fa-angle-down"></i><i class="fas fa-angle-up"></i></h4>
								<ol>
									<div class="std">
									<iframe src="product_review.iframe.php?goods_idx=<?=$goods_stat->idx?>" name="rmiframe" width="100%" FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 SCROLLING="no" onload="autoResize(this)" ></iframe>
									</div>
								</ol>
							</div>
							<div id="product_tabs_review_tabbed_contents" onclick="iframecheck('miframe');">
								<h4>상품문의<?if($qnacnt){?>(<span><?=$qnacnt?></span>)<?}?><i class="fas fa-angle-down"></i><i class="fas fa-angle-up"></i></h4>
								<ol>
									<div class="std">
									<iframe src="product_qna.iframe.php?goods_idx=<?=$goods_stat->idx?>" name="miframe" width="100%" FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 SCROLLING="no" onload="autoResize(this)" ></iframe>
									</div>
								</ol>
							</div>
							
						</div>
						<!--상품설명 영역 [모바일] End-->
						
						<!--상품설명 영역 [피씨용]-->
						<ul class="prd_detail_tabs">
							<li style="display:none;"class='product_view_font Mouse_over_tab' id="tab_under_bar"><a href="javascript:hiddenView('detail_content','0')"><span>상품상세정보</a></li>
							<li class='product_view_font pctabsIN' id="tab_under_bar"><a href="javascript:hiddenView('detail_content','1')">배송/환불사항</a></li>
							<li class='product_view_font pctabsIN' id="tab_under_bar"><a href="javascript:hiddenView('detail_content','2');iframecheck('rpiframe');">상품평<?if($reviewcnt){?>(<?=$reviewcnt?>개)<?}?></a></li>
							<li class='product_view_font pctabsIN' id="tab_under_bar"><a href="javascript:hiddenView('detail_content','3');iframecheck('piframe');">상품문의<?if($qnacnt){?>(<?=$qnacnt?>개)<?}?></a></li>
						</ul>
						<div class="prd_detail_tabs_content">
							<table class='detail_content'>
								<tr id="detail_content" style="display:none;">
									<td valign="top" class="prd_detail">
										<?
										for($i=1;$i<=$DEFAULTADDFIELD;$i++){
											if($goods_stat->{"fieldname".$i}){
												$view = 1;
												$lastcnt++;
											}
										}
										if($view){$N="";
										?>
										<table width="100%" class="">
											<tr height="30">
											<?for($i=1;$i<=$DEFAULTADDFIELD;$i++){
												if($goods_stat->{"fieldname".$i}){
												$N++;
												?>
												<td style='width:20%; text-align:center; background:#f8f8f8' class='contenM tabletd_small_item'><?=$goods_stat->{"fieldname".$i}?></td>
												<td style='width:30%; text-align:center;' class='tabletd_small_item_contents'><?=$tools->strHtmlNo($goods_stat->{"fielddata".$i})?></td>
											<?if($N%2==0){?><?if($N < $lastcnt){?></tr><tr height="30"><?}}?>
											<?}}?>
											<?if($N%2==1){?>
												<td style='width:20%; text-align:center; background:#f8f8f8' class='contenM tabletd_small_item'>&nbsp;</td>
												<td style='width:30%; text-align:center;' class='tabletd_small_item_contents'>&nbsp;</td>
											<?}?>
											</tr>
											<tr height="30">
												<td style='width:20%; text-align:center; background:#f8f8f8' class='contenM tabletd_small_item'>배송가능지역 </td>
												<td colspan="3" style='width:30%; text-align:center;' class='tabletd_small_item_contents'>
												<?if($goods_stat->area){echo $goods_stat->area;}else{echo "전국";}?>
												</td>
											</tr>
										</table>
										<br>
										<?}else{?>
										<table style="display:none;" width="100%" class="table_all">
											<tr height="30">
												<td width="20%" bgcolor="#E4E7EF" class='contenM tabletd_small'>배송 가능 지역</td>
												<td class='tabletd_all tabletd_small'>
													<?if($goods_stat->area){echo $goods_stat->area;}else{echo "전국";}?>
												</td>
											</tr>
										</table>	
										<?}?>
										<br>
										
									</td>
								</tr>
								<tr id="detail_content" style="display:none;">
									<td valign="top" class='oolimmobilemenu'>
										<?=$admin_stat->delivery?>
									</td>
								</tr>
								<tr id="detail_content" style="display:none;">
									<td valign="top">
									<iframe src="product_review.iframe.php?goods_idx=<?=$goods_stat->idx?>" name="rpiframe" width="100%" FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 SCROLLING="no" onload="autoResize(this)" ></iframe>
									</td>
								</tr>
								<tr id="detail_content" style="display:none;">
									<td valign="top">
									<iframe src="product_qna.iframe.php?goods_idx=<?=$goods_stat->idx?>" name="piframe" width="100%" FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 SCROLLING="no" onload="autoResize(this)" ></iframe>
									</td>
								</tr>
							</table>
						</div>
						<!--상품설명 영역 [피씨용] End-->
					</div>
					<!---하단 텝메뉴--->
					<!--!--관련상품 출력 시작-->
					<div style="margin-top: 10%;" class="main">
						<div>
							<?
							if($goods_stat->seller){include('./include/related_b_type.inc.php');}
							//if($goods_stat->subitem==2) include('./include/related_a_type.inc.php');
							//else if($goods_stat->subitem==3) include('./include/related_b_type.inc.php');							
							?>
						</div>
					</div>
					<!--관련상품 출력 End-->
					<!--********************콘텐츠 End********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->




<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<!-- 카카오톡 공유 JavaScript -->
<script>
// 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('9825a5ee6c447743885fc2117d7defeb');
function shareKatalk() {
<!-- 카카오 Link 공유 API 사용-->
Kakao.Link.sendScrap({
requestUrl: location.href
});
};
</script>

<style>
	.sns-go ul {
  list-style-type: none;
    margin: 40px 0 0 0;
    padding: 0;
    overflow: hidden;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

.sns-go li {
  	float: left;
	padding-right: 5px;
}

.sns-go img {
    border-radius: 5px;
    width: 35px;
}

.single .entry-content {
	margin-top: 0.6em;
}
</style>