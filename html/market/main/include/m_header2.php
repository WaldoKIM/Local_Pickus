<script type="text/javascript" src="./js/jquery.flexslider.js"></script>
<script type="text/javascript" src="./js/mobile/layout.js"></script>
<script language="javascript">
	<!--
	// iframe resize
	function autoResize(i) {
		(i).height = 200;
		var iframeHeight = (i).contentWindow.document.body.scrollHeight;
		(i).height = iframeHeight + 20;
	}

	var barra_busqueda = $('.search_bar_newsearch input');
	//var bar = $('#bar');
	//var icono = $('.sosa-mag_right');
	barra_busqueda.focusin(function() {
		barra_busqueda.css('width', '300px');
		//bar.css('color', '#ffffff');
	});
	barra_busqueda.focusout(function() {
		barra_busqueda.css('width', '145px');
		//bar.css('color', '#ffffff')
	});
	var barra_busqueda_mobile = $('.search_bar_newsearch_mobile');
	var bar_mobile = $('#bar_mobile');
	var icono = $('.sosa-mag_rightM');
	barra_busqueda_mobile.focusin(function() {
		barra_busqueda_mobile.css('width', '50%');
		bar_mobile.css('color', '#000');
	});
	barra_busqueda_mobile.focusout(function() {
		barra_busqueda_mobile.css('width', '50%');
		bar_mobile.css('color', '#000');
	});
	// 
	-->
</script>
<script type="text/javascript">
	$(document).ready(function() {
		//등록할 로고 이미지로 로고영역 max설정
		$(".mobile_header .top_area h1 img").each(function() {
			$(this).load(function() {
				var imgWidth = this.naturalWidth;
				$('.mobile_header .top_area h1').css({
					'max-width': imgWidth
				})
			});
		});
		//스크롤시 검색 숨기기
		var st = $('header.mobile_header').offset();
		$(window).scroll(function() {
			if ($(document).scrollTop() > st.top) {
				$('.mobile_header').addClass('fixed');
				$('.mobile_header .top_area div.right_area a.search_btn').css({
					'visibility': 'visible'
				});
			} else {
				$('.mobile_header').removeClass('fixed');
				$('.mobile_header .top_area div.right_area a.search_btn').css({
					'visibility': 'hidden'
				});
			}
		});
		//검생창 open
		$(".right_area a.search_btn").click(function() {
			$('.m_toggle_shopcate').animate({
				'right': '0'
			}, 600);
			$('.m_toggle_shopcate .m_search2').slideDown(800);
			$('.m_toggle_shopcate .m_search2 input').focus();
			return false
		});
		//모바일 검색1
		$("input[name=m_search_input]").keydown(function(key) {
			if (key.keyCode == 13) {
				MobileSearch();
			}
		});
		$(".mobile_header .top_search a").click(function() {
			MobileSearch();
			return false
		});
		MobileSearch = function() {
			var mo_search_text = $("input[name=m_search_input]").val()
			if (mo_search_text == false) {
				alert('검색어를 입력하세요.')
			} else {
				location.href = "product_search.php?search=" + mo_search_text;
			}
		};
		//Toggle Menu
		$('.mobile_header a.menu_btn').click(function() {
			$('.m_toggle_shopcate').animate({
				'right': '0'
			});
			return false;
		});
		$('.m_toggle_shopcate .m_toggle_close').click(function() {
			$('.m_toggle_shopcate').animate({
				'right': '-100%'
			});
			$('.has_two_depth a.one-link').removeClass('on');
			$('ul.two_depth').slideUp();
			$('.has_three_depth a.two-link').removeClass('on');
			$('ul.three_depth').slideUp();
		});
		$('.has_two_depth a.one-link').click(function() {
			$('.has_two_depth a.one-link').removeClass('on');
			$('ul.two_depth').slideUp();
			//$(this).next('ul.two_depth').slideDown();
			$(this).next('ul.two_depth').show();
			$(this).addClass('on');
			return false;
		});
		$('.has_three_depth a.two-link').click(function() {
			$('.has_three_depth a.two-link').removeClass('on');
			$('ul.three_depth').slideUp();
			$(this).next('ul.three_depth').slideDown();
			$(this).addClass('on');
			return false;
		});
		$('.m_top_btn').click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 500);
			return false
		});
	});
</script>
<div id="Mobile-Header">
	<header style="display:none;" class="mobile_header">
		<div class="top_area">
			
			<!--Logo-->
			<h1><? include('include/logo_m.inc.php'); ?></h1>
			<!--//Logo-->
			<div class="right_area">
				<!--장바구니-->
				<?
				$cartCnt = "";
				$navresult	= $db->select("cs_navigation", "where openg=1 order by ranking asc");
				while ($navrow = mysqli_fetch_object($navresult)) {
					if (!$_SESSION[USERID]) {
						$query2 = "code='$_SESSION[CART]'";
					} else {
						$query2 = "userid='$_SESSION[USERID]'";
					}
					if ($navrow->url == "cart.php") {
						$cartCnt = $db->cnt("cs_cart", "where 1 and $query2");
					} else {
						$cartCnt = "";
					}
				?>
					<a href="<?= $navrow->url ?>" class="cs_link">
						<i class="fas fa-shopping-cart"></i>
						<? if ($cartCnt) { ?>
							<span class="count"><?= $cartCnt ?></span>
						<? } ?>
					</a>
				<? } ?>
				<!--//장바구니-->
			</div>
			<div class="left_area">
				<a href="#" class="menu_btn"><i class="fas fa-bars"></i></a>
			</div>
		</div>
		<div class="top_search">
			<input type="text" name="m_search_input" class="m_search_input" placeholder=''>
			<a href="#"><i class="fas fa-search"></i></a>
		</div>
		<!--Menu-->
		<div class="m_cate_menu">
			<ul class="slides">
				<li><a href="/" class="on">홈</a></li>
				<? include('m_shopcate.inc.php'); ?>
			</ul>
		</div>
		<!--//Menu-->
		<!--Toggle Menu-->
		<div class="m_toggle_shopcate">
			<!--Top-->
			<div class="top_info">
				<? if ($_SESSION[USERID]) { ?>
					<a href="../../bbs/logout.php">[로그아웃]</a>
				<? } else { ?>
					<a href="../../bbs/login.php?login_go=index.php">[로그인]<span>로그인 해주세요</span></a>
				<? } ?>
				<span class="m_toggle_close"><i class="fas fa-times"></i></span>
			</div>
			<!--//Top-->
			<!--Member Menu-->
			<ul style="padding:0 !important;" class="member_menu">
				<? if ($_SESSION[USERID]) { ?>
					<? if ($_SESSION[LEVEL] == 1) { ?>
						<li><a href="../../bbs/mypage.php"><i class="far fa-user icon"></i>회원정보수정<i class="fas fa-angle-right arrow"></i></a></li>
					<?} else if ($_SESSION[LEVEL] == 5) { ?>
						<li><a href="../../bbs/mypage_partner.php"><i class="far fa-user icon"></i>마이페이지<i class="fas fa-angle-right arrow"></i></a></li>
					<? } ?>	
				<? } else { ?>
					<li><a href="../../bbs/register_customer_form.php"><i class="far fa-user icon"></i>회원가입<i class="fas fa-angle-right arrow"></i></a></li>
				<? } ?>
				<?
				$cartCnt = "";
				$navresult	= $db->select("cs_navigation", "where openg=1 order by ranking asc");
				while ($navrow = mysqli_fetch_object($navresult)) {
					if (!$_SESSION[USERID]) {
						$query2 = "code='$_SESSION[CART]'";
					} else {
						$query2 = "userid='$_SESSION[USERID]'";
					}
					if ($navrow->url == "cart.php") {
						$cartCnt = $db->cnt("cs_cart", "where 1 and $query2");
					} else {
						$cartCnt = "";
					}
				?>
				<? if ($_SESSION[LEVEL] == 1) { ?>
					<li><a href="<?= $navrow->url ?>" onfocus='this.blur()'><?= $navrow->title ?><i class="fas fa-angle-right arrow"></i></a></li>
				<? } ?>
				<? } ?>
				<? if ($_SESSION[LEVEL] == 5 or $_SESSION[LEVEL] == 6) { ?>
					<li><a href="../seller/order/trade.php"><i class="far fa-user icon"></i>판매관리<i class="fas fa-angle-right arrow"></i></a></li>
				<? } ?>
			</ul>
			<!--//Member Menu-->
			<!--Cate Menu-->
			<ul style="padding:0 !important;" class="cate_list">
				<? include('m_toggle_shopcate.inc.php'); ?>
			</ul>
			<!--//Cate Menu-->
			<!--ADD Menu-->
			<ul style="padding:0 !important;" class="add_menu">
				<?
				$navresult	= $db->select("cs_navigation", "where open=1 order by ranking asc");
				while ($navrow = mysqli_fetch_object($navresult)) {
					if ($navrow->tablename != "cs_part_fixed") { ?>
						<li>
							<a href="<?= $navrow->url ?>" class='sf-menu_link'><?= $navrow->title ?><i class="fas fa-angle-right"></i></a><? }
																																		if ($navrow->tablename) {
																																			if ($navrow->tablename == "cs_page") {
																																				if ($db->cnt("cs_page", "order by idx desc")) {
																																			?>
								<? } ?>
							<? } else if ($navrow->tablename == "cs_bbs") { ?>
							<? } else if ($navrow->tablename == "cs_part_fixed") { ?>
						</li>
						<?
																																				$result1	= $db->select("cs_part_fixed", "where part_display_check=1 order by part_ranking asc");
																																				while ($navrow1 = mysqli_fetch_object($result1)) {
						?>
							<li><a href="<?= $navrow1->urllink ?>" class='sf-menu_link'><?= $navrow1->part_name ?><i class="fas fa-angle-right"></i></a></li>
						<? } ?>
					<? } ?>
				<? } ?>
				<? if ($navrow->tablename == "cs_part_fixed") { ?></li><? }
																} ?>
			</ul>
			<!--//ADD Menu-->
			<!--오늘 본 상품-->
			<div class="m_todaylist">
				<h3>오늘 본 상품</h3>
				<ul>
					<?
					$show_cookie_name = $_SESSION[VIEW_LIST];
					$show_arr = explode("&&", $_COOKIE[$show_cookie_name]);
					$show_cnt = 3;
					if ($show_cnt > count($show_arr) - 1) {
						$view_cnt = count($show_arr) - 1;
					} else {
						$view_cnt = $show_cnt;
					}
					if ($_COOKIE[$show_cookie_name]) {
						for ($i = 0; $i < $view_cnt; $i++) {
							$goods_info = $db->object("cs_goods", "where idx='$show_arr[$i]'");
							$quick_data = $tools->encode("idx=" . $goods_info->idx . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&part_idx=" . $goods_info->part_idx . "&search_item=" . $search_item);
							$ThumbEncode = $tools->encode("idx=" . $goods_info->idx . "&table=cs_goods&img=images1&dire=goodsImages&w=60&h=30");
							$todayList++;
					?>
							<li>
								<a href='product_view.php?part_idx=<?= $goods_info->part_idx; ?>&goods_data=<?= $quick_data; ?>'>
									<dl>
										<dt><img src="../data/goodsImages/<?= $goods_info->images1 ?>" style="width:60px;" border='0'></dt>
										<dd>
											<span class="prd_name"><?= $tools->strCut($goods_info->name, 55); ?></span>
											<!--제품명-->
											<span class="prd_price"></span>
											<!--가격-->
										</dd>
									</dl>
								</a>
							</li>
					<? }
					} ?>
					<? if ($todayList == 0) { ?>
						<li class="none_data">오늘 본 상품이 없습니다.</li>
					<? } ?>
				</ul>
			</div>
			<!--//오늘 본 상품-->
		</div>
		<!--//Toggle Menu-->
	</header>
	<!--메인인트로 베너 시작-->
	<? if ($TARGETFILENAME == "index.php") include('include/maintitle.inc.php'); ?>
	<!--메인인트로 베너 End-->
	<div class="m_top_btn"><i class="fas fa-arrow-up"></i></div>
</div>