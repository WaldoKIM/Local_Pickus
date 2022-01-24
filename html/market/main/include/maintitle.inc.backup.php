<style>
	/********************************************메인 로테이트 베너 영역*****************************/
	.main_banner {
		width: 100%;
		height: 457px;
		overflow: hidden;
		display: inline-block;
		position: relative
	}

	.main_banner .flex-viewport {
		height: 100%;
		height: 457px;
		overflow: hidden;
	}

	.main_banner ul.slides li {
		text-align: center;
		background-repeat: no-repeat;
		background-position: center center;
		background-size: cover
	}

	.main_banner div.ban_data {
		width: 1200px;
		height: 457px;
		display: inline-block;
		position: relative
	}

	.main_banner div.ban_img {
		height: 457px;
		line-height: 457px;
		position: absolute;
		right: 0;
		top: 0
	}

	.main_banner div.text_img {
		height: 457px;
		line-height: 457px;
		position: absolute;
		left: 0;
		top: 0
	}

	.main_banner .flex-control-nav {
		width: 100%;
		position: absolute;
		bottom: 30px;
		text-align: center
	}

	.main_banner .flex-control-nav li {
		display: inline-block;
		width: 8px;
		height: 8px;
		margin: 0 5px
	}

	.main_banner .flex-control-nav li a {
		display: block;
		width: 100%;
		height: 100%;
		background: url(./images/main_banner_bullet.png) no-repeat;
		text-indent: -9999999px;
		cursor: pointer
	}

	.main_banner .flex-control-nav li a.flex-active {
		background-position: -8px 0
	}

	.main_banner .flex-direction-nav li a {
		width: 30px;
		height: 56px;
		top: 50%;
		position: absolute;
		margin-top: -33px;
		padding: 10px;
		outline: none
	}

	.main_banner .flex-direction-nav li.left_btn a {
		left: 10%
	}

	.main_banner .flex-direction-nav li.right_btn a {
		right: 10%
	}

	.er_small_title {
		/*메인배너 서브 타이틀*/
		font-size: 16pt;
		text-align: left;
		margin-top: 180px;
		line-height: 1em;
		font-family: 'RixSGo M', 'NanumBarunGothic', 'NanumBarunGothicBold', "Dotum", 'Gulim', sans-serif;
	}

	.er_big_color {
		/*메인배너 메인 타이틀*/
		font-size: 34pt;
		text-align: left;
		line-height: 1em;
		margin: 25px 0 35px 0;
		font-family: 'RixSGo B', 'NanumBarunGothic', 'NanumBarunGothicBold', "Dotum", 'Gulim', sans-serif;
	}

	.er_big_normal {
		/*메인배너 설명 텍스트*/
		font-size: 14pt;
		text-align: left;
		line-height: 1.4em;
		margin-bottom: 50px;
		font-family: 'RixSGo M', 'NanumBarunGothic', 'NanumBarunGothicBold', "Dotum", 'Gulim', sans-serif;
	}

	/*메인배너 링크버튼*/
	.botton-rotate {
		text-align: center;
		text-transform: uppercase;
		color: #5a5a5a;
		border: 1px solid #5a5a5a;
		padding: 10px 55px 8px 55px;
		font-size: 12pt;
		min-width: 180px;
		display: inline-block
	}

	.botton-rotate:hover {
		background: #5a5a5a;
		color: #fff
	}

	/*Tablet*/
	@media all and (max-width:1200px) {
		.main_banner div.ban_data {
			width: 100%
		}

		.er_small_title {
			text-align: center
		}

		.er_big_color {
			text-align: center
		}

		.er_big_normal {
			text-align: center
		}

		.main_banner .flex-direction-nav li.left_btn a {
			left: 5%
		}

		.main_banner .flex-direction-nav li.right_btn a {
			right: 5%
		}
	}

	/*Mobile*/
	@media all and (max-width:840px) {
		.main_banner .flex-direction-nav li a {
			display: none
		}
	}
</style>
<script type="text/javascript" src="./js/jquery.flexslider.js"></script>

<script type="text/javascript">
	/*Main Banner*/
	(function($) {
		$(document).ready(function() {
			//Slide			
			$('.main_banner').flexslider({
				animation: "",
				pauseOnAction: false,
				pauseOnHover: true,
				controlNav: true,
				slideshow: true,
				directNav: true,
				animationSpeed: 1000,
				slideshowSpeed: 4000,
			});
			$(".main_banner .flex-direction-nav li").eq(0).addClass('left_btn');
			$(".main_banner .flex-direction-nav li").eq(1).addClass('right_btn');
			$(".main_banner .flex-direction-nav li").eq(0).find('a').html('<img src="./images/main_banner_left_btn.png" />');
			$(".main_banner .flex-direction-nav li").eq(1).find('a').html('<img src="./images/main_banner_right_btn.png" />');
		});
	})(jQuery);
</script>
<script language="javascript">
	<!--	
	function category_multview() {
		if (document.getElementById('category_mult').style.display == "none") {
			document.getElementById('category_mult').style.display = '';
		} else {
			document.getElementById('category_mult').style.display = 'none';
		}
	}

	function category_multview_out() {
		document.getElementById('category_mult').style.display = 'none';
	}
	//
	-->
</script>
<div id="mainslider">
	<div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
		<!--메인 상단 카테고리 영역-->
		<?/*
		<div class="mainslider_maintitle" style="display:none">
			<?// include("include/brand.inc.php");?>
			<?// include("include/category_layer.inc.php");?>
			<div class="mainslider_maintitle_box01">
				<span style='padding-left:1em;vertical-align:22%;'><?=$design_stat->word_text;?></span>
				<div class="btn btn-default2" data-layer-target="#blandlayer-02" title='카테고리 전체보기'></div>
			</div>
			<div class="mainslider_maintitle_box02">
				<nav>
					<ul class="sf-menu_cate">
						<? include("shopcate_l.inc.php");?>
					</ul>
				</nav>
			</div>
		</div>
		*/ ?>
		<!--//메인 상단 카테고리 영역 End-->
		<div class="main_banner" id="main_banner">
			<ul class="slides">
				<?
				$bresult	= $db->select("cs_main_flash", "where main=1 order by idx asc");
				while ($brow = mysqli_fetch_object($bresult)) {
					$target = "";
					if ($brow->target == 1) $target = "_self";
					else $target = "_new";
				?>
					<li style="background-image:url(../data/designImages/<?= $brow->bgimg ?>)">
						<div class="ban_data" onclick="location.href='<?= $brow->url ?>'" style="cursor:pointer;">
							<? if ($brow->txttype == 1) { ?>
								<? if ($brow->txtimg) { ?>
									<!--텍스트가 없을 경우-->
									<div class="text_img" data-x="left" data-y="center" data-hoffset="50" data-voffset="0" data-speed="300" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
										<img src="../data/designImages/<?= $brow->txtimg ?>" alt="">
									</div>
								<? }
							} else { ?>
								<!--서브 타이틀-->
								<div class="tp-caption er_small_title" data-x="10" data-y="center" data-voffset="0" data-speed="300" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="color:#<?= $brow->title_color ?>!important;">
									<?= $brow->subject ?>
								</div>
								<!--메인 타이틀-->
								<div class="tp-caption er_big_color" data-x="10" data-y="center" data-voffset="40" data-speed="600" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="color:#<?= $brow->title2_color ?>!important;">
									<?= $brow->title2 ?>
								</div>
								<!--설명 텍스트-->
								<div class="tp-caption er_big_normal" data-x="10" data-y="center" data-voffset="85" data-speed="600" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="color:#<?= $brow->title3_color ?>!important;">
									<?= $brow->title3 ?>
								</div>
								<!--링크버튼-->
								<div class="tp-caption er_big_normal" data-x="10" data-y="center" data-voffset="85" data-speed="600" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="color:#<?= $brow->title3_color ?>!important;">
									<? if ($brow->url) { ?><a href="<?= $brow->url ?>" target="<?= $target ?>" class="botton-rotate"><?= $brow->linktitle ?></a><? } ?>
								</div>
						</div>
					<? } ?>
					<!--배너이미지-->
					<div class="ban_img" data-x="center" data-hoffset="350" data-y="bottom" data-voffset="0" data-speed="600" data-start="1500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
						<img src="../data/designImages/<?= $brow->main_img ?>" alt="">
					</div>
					</li>
				<? } ?>
			</ul>
		</div>
	</div>
	<!--rev_slider_1_1_wrapper-->

</div>
<!--mainslider-->