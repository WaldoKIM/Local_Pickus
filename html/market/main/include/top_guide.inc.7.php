<style type="text/css">
#toggle_menu{
	position:fixed;
	top:0px;
	right:50%;
	width:60px;
	height:60px;
	margin-right:-30px;
	cursor:pointer;
	z-index:9999;
	visibility:visible;
	background-color:#<?=$design_stat->toggle_menu_color1?>;/*************PC 토글메뉴 버튼상단 색상******************/
	-webkit-transition:background 0.2s ease-in-out 0s;
	-moz-transition:background 0.2s ease-in-out 0s;
	-o-transition:background 0.2s ease-in-out 0s;
	-ms-transition:background 0.2s ease-in-out 0s;
	transition:background 0.2s ease-in-out 0s;
}
#toggle_menu.sticked{
	top:5px;right:35px;
	background-color:#<?=$design_stat->toggle_menu_color1?>;/*************PC 토글메뉴 버튼상단 색상 스크롤했을때 ******************/
}
#toggle_menu.sticked.header-hidden{
	background-color:#<?=$design_stat->toggle_menu_color1?>;/*************PC 토글메뉴 버튼상단 색상 스크롤하고 클릭 했을때 ******************/
}
#toggle_menu:hover{
	background-color:#<?=$design_stat->toggle_menu_color2?>;/*************PC 토글메뉴 버튼상단 색상******************/
}
#toggle_menu span,#toggle_menu span:before,#toggle_menu span:after{
	display:block;
	width:20px;
	height:2px;
	position:absolute;
	background-color:#<?=$design_stat->toggle_menu_color3?>;/*************PC 토글메뉴 삼디다스 줄무늬 색상******************/
	content:'';
	left:0;
}
#toggle_menu span{
	left:20px;
	top:50%;
	margin-top:-1px;
}
#toggle_menu span:before{
	top:-4px;
}
#toggle_menu span:after{
	top:4px;
}
.header_top_menu{width:100%;display:inline-block;border-bottom:1px solid #d6d6d6;text-align:center}
.header_top_menu .menu_con{width:1200px;display:inline-block;padding:8px 0 0 0}
.header_top_menu .menu_btn{float:left}
.header_top_menu .menu_btn a{display:inline-block;color:#343434;font-size:12px;vertical-align:middle}
.header_top_menu .menu_btn .line{display:inline-block;color:#dbdbdb;font-size:6px;margin:0 10px 0 12px;vertical-align:middle}
.header_top_menu span.count{width:14px;height:14px;background:#000;color:#fff;font-size:6px;line-height:14px;display:inline-block;border-radius:100%;vertical-align:middle;margin-left:3px}
.header_top_menu_font{font-size:10pt;color:#<?=$design_stat->guide_text_color?>}
.header_top_menu_font:hover{color:#<?=$design_stat->guide_text_color_hover?>}
a.header_top_menu_font{color:#<?=$design_stat->guide_text_color?>}
a.header_top_menu_font a:link{color:#<?=$design_stat->guide_text_color?>}
a.header_top_menu_font a:visited{color:#<?=$design_stat->guide_text_color?>}
.header_top_menu_diver{padding-right:10px}
.oolim_topline{padding-right:3em}
/*Tablet*/
@media all and (max-width:1200px){
    .header_top_menu .menu_con{width:100%;padding:8px 2% 0 2%;box-sizing:border-box}
	.header_top_menu .menu_btn{margin-top:3px}
	.noneoolim_seform_pc{margin-right:0}
	.menumobile_nonemenu a{display:inline-block}
}
</style>
<div id="Desktop-Header">
	<section id="topline" class="table_section" style='background:#<?=$design_stat->guide_bg_color?>;'>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 oolim_topline">
					<div class="header_top_menu">
						<div class="menu_con">
							<div class="menu_btn">
								<? if($_SESSION[USERID]){?>
									<a href="login_ok.php?logout=1">로그아웃</a><span class="line">|</span>
								<? } else{?>
									<a href="login.php">로그인</span></a><span class="line">|</span>
								<? }?>
								<? if($_SESSION[USERID]){?>
									<a href="my_member_edit.php">회원정보수정</a>
								<? } else{?>
									<a href="join.php">회원가입</a>
								<? }?>
								
								<?if($_SESSION[LEVEL] == 5){?>
								<span class="line">|</span><a href="../seller/order/trade.php" onfocus='this.blur()' target="_blank">판매관리</a>
								<?}?>
								
								<?
								$cartCnt = "";
								$navresult	= $db->select("cs_navigation", "where openg=1 order by ranking asc" );
								while( $navrow = mysql_fetch_object($navresult)){
									if(!$_SESSION[USERID]){
										$query2 = "code='$_SESSION[CART]'";
									}else{
										$query2 = "userid='$_SESSION[USERID]'";
									}
									if($navrow->url=="cart.php"){
										$cartCnt = $db->cnt("cs_cart", "where 1 and $query2");
									}else{
										$cartCnt = "";
									}
								?>
								<span class="line">|</span><a href="<?=$navrow->url?>" onfocus='this.blur()'><?=$navrow->title?></a><?if($cartCnt){?><span class="count"><?=$cartCnt?></span><?}?>
								<?}?>
							</div>
							<!-- pc 검색 폼-->
							<span id="sosa-mag_right_search" class="search_bar_newsearch noneoolim_seform_pc">
								<input type="text" id="search" name="search_pc" id="search_pc" onKeyDown="searchInputSendit();" placeholder=''>
								<a href="javascript:bookmarkaddsite('http://<?=$admin_stat->shop_domain;?>', '<?=$admin_stat->shop_name;?>');"  class="favorite">즐겨찾기</a>
								<?/*
								<a href="#" class="today_view">오늘 본 상품</a>
								*/?>
							</span>
							<!-- pc 검색 폼-->
							<!-- Mobile 검색 폼-->
							<span id="overlayTrigger" class='noneoolim_seform__mobile'><a href="#" class='main_topmobile_box' >상품검색</a></span>
						</div>
					</div>
				</div>
				<!--Logo-->
				<div class="col-sm-6">
					<!--pc로고-->
					<div class="menupc_nonemenu">
						<?include("./include/banner_code3.inc.php");//로고 좌측 배너?>
						<?include('include/logo.inc.php');?>
						<?include("./include/banner_code4.inc.php");//로고 우측 배너?>
					</div>
					<!--모바일로고--><div class="menumobile_nonemenu" style='width:100%;'><? include('include/logo_m.inc.php');?></div>
				</div>
				<!--//Logo-->
			</div>
		</div>
	</section>
	<div style="display:none" id="overlayContent">
		<table style='margin:0 auto'>
			<tr>
			  <td><input name="search_mo" id="search_mo" type="text" class='formText formText_subject' placeholder='*쇼핑몰 상품검색'></td>
			  <td><a href="javascript:searchSendit('search_mo');"  style='width:60px;font-size:11pt; line-height:34px;' class='btn-add'>검색</a></td>
			</tr>
		</table>
		 <button class="overlay-close" id="overlayClose"><i class='fa-close'></i></button>
	</div>
<script language="javascript">
<!--
// iframe resize
function autoResize(i){
	(i).height=200;
	var iframeHeight= (i).contentWindow.document.body.scrollHeight;
	(i).height=iframeHeight+20;
}
function searchSendit(target){
	var search = "";
	if(target=="search_pc"){
		search = document.all.search_pc.value;
	}else{
		search = document.all.search_mo.value;
	}
	if(search==""){
		alert("검색어를 입력해 주십시오.");
	} else{
		location.href="product_search.php?search="+search;
	}
}
function searchInputSendit(){
	if(event.keyCode==13){
		searchSendit('search_pc');
	}
}
//-->
</script>
<script language="JavaScript">
<!--
	var barra_busqueda = $('.search_bar_newsearch input');
	//var bar = $('#bar');
	//var icono = $('.sosa-mag_right');
	barra_busqueda.focusin(function(){
		barra_busqueda.css('width', '300px');
		//bar.css('color', '#ffffff');
	});
	barra_busqueda.focusout(function(){
		barra_busqueda.css('width', '145px');
		//bar.css('color', '#ffffff')
	});
	var barra_busqueda_mobile = $('.search_bar_newsearch_mobile');
	var bar_mobile = $('#bar_mobile');
	var icono = $('.sosa-mag_rightM');
	barra_busqueda_mobile.focusin(function(){
		barra_busqueda_mobile.css('width', '50%');
		bar_mobile.css('color', '#000');
	});
	barra_busqueda_mobile.focusout(function(){
		barra_busqueda_mobile.css('width', '50%');
		bar_mobile.css('color', '#000');
	});
// -->
</script>