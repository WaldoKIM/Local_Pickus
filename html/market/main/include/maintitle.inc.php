<style>
	/********************************************메인 로테이트 베너 영역*****************************/
	.main_banner {
		width: 100%;
		height: 100%
		overflow: hidden;
		display: inline-block;
		position: relative
	}

	.main_banner .flex-viewport {
		height: 100%;
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
		bottom: 0;
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
		<div class="main_banner" id="main_banner">
			<ul class="slides">
				<li>
					<picture>
						<source media="(max-width: 321px)" srcset="/bbs/images/i5.png">
						<source media="(max-width: 376px)" srcset="/bbs/images/i678.png">
						<source media="(max-width: 415px)" srcset="/bbs/images/iplus.png">
						<img src="/bbs/images/web1.png">
					</picture>
				</li>
				<li>
					<picture>
						<source media="(max-width: 321px)" srcset="/bbs/images/i52.png">
						<source media="(max-width: 376px)" srcset="/bbs/images/i6782.png">
						<source media="(max-width: 415px)" srcset="/bbs/images/iplus2.png">
						<img src="/bbs/images/web2.png">
					</picture>
				</li>
				<li>
					<picture>
						<source media="(max-width: 321px)" srcset="/bbs/images/i5.png">
						<source media="(max-width: 376px)" srcset="/bbs/images/i678.png">
						<source media="(max-width: 415px)" srcset="/bbs/images/iplus.png">
						<img src="/bbs/images/web1.png">
					</picture>
				</li>
			</ul>
		</div>
	</div>
	<!--rev_slider_1_1_wrapper-->

</div>
<!--mainslider-->