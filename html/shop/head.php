
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/setting.css">
<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
?>

<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout;?> <?php echo $is_thema_font;?>">

	<!-- LNB -->
	<aside class="at-lnb">
		<div class="at-container">
            <div class="top">
                <ul class="top_left">
                    <li><a href="#">모바일 쇼핑몰</a></li>
                </ul>
                <ul class="top_right">
                    <ul>
                    <?php if($is_member) { // 로그인 상태 ?>
                        <li><a href="javascript:;" onclick="sidebar_open('sidebar-user');"><b><?php echo $member['mb_nick'];?></b></a></li>
                        <?php if($member['admin']) {?>
                            <li><a href="<?php echo G5_ADMIN_URL;?>">관리</a></li>
                        <?php } ?>
                        <?php if($member['partner']) { ?>
                            <li><a href="<?php echo $at_href['myshop'];?>">마이샵</a></li>
                        <?php } ?>
                        <li class="sidebarLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
                            <a href="javascript:;" onclick="sidebar_open('sidebar-response');"> 
                                알림 <b class="orangered sidebarCount"><?php echo $member['response'] + $member['memo'];?></b>
                            </a>
                        </li>
                    <?php } else { // 로그아웃 상태 ?>
                        <li><a href="<?php echo $at_href['login'];?>" onclick="sidebar_open('sidebar-user'); return false;">로그인</a></li>
                        <li><a href="<?php echo $at_href['reg'];?>">회원가입</a></li>
                        <li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost">정보찾기 </a></li>
                    <?php } ?>
                    <?php if(IS_YC) { // 영카트 사용하면 ?>
                        <?php if($member['cart'] || $member['today']) { ?>
                            <li>
                                <a href="<?php echo $at_href['cart'];?>" onclick="sidebar_open('sidebar-cart'); return false;"> 
                                    쇼핑 <b class="blue"><?php echo number_format($member['cart'] + $member['today']);?></b>
                                </a>
                            </li>
                        <?php } ?>
                        <li><a href="<?php echo $at_href['change'];?>"><?php echo (IS_SHOP) ? '커뮤니티' : '쇼핑몰';?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $at_href['connect'];?>">접속 <?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">'.number_format($stats['now_mb']).'</b>)' : ''; ?></a></li>
                    <?php if($is_member) { ?>
                        <li><a href="<?php echo $at_href['logout'];?>">로그아웃 </a></li>
                    <?php } ?>
                </ul>
            </div>            


			<!-- LNB Left -->
			<div class="pull-left displaynone">
				<ul>
					<li><a href="javascript:;" id="favorite">즐겨찾기</a></li>
					<li><a href="<?php echo $at_href['rss'];?>" target="_blank">RSS 구독</a></li>
					<?php
					  $tweek = array("일", "월", "화", "수", "목", "금", "토");
					?>	
					<li><a><?php echo date('m월 d일');?>(<?php echo $tweek[date("w")];?>)</a></li>
				</ul>
			</div>
			<!-- LNB Right -->
			<div class="pull-right displaynone">
				<ul>
                    <?php if($is_member) { // 로그인 상태 ?>
                        <li><a href="javascript:;" onclick="sidebar_open('sidebar-user');"><b><?php echo $member['mb_nick'];?></b></a></li>
                        <?php if($member['admin']) {?>
                            <li><a href="<?php echo G5_ADMIN_URL;?>">관리</a></li>
                        <?php } ?>
                        <?php if($member['partner']) { ?>
                            <li><a href="<?php echo $at_href['myshop'];?>">마이샵</a></li>
                        <?php } ?>
                        <li class="sidebarLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
                            <a href="javascript:;" onclick="sidebar_open('sidebar-response');"> 
                                알림 <b class="orangered sidebarCount"><?php echo $member['response'] + $member['memo'];?></b>
                            </a>
                        </li>
                    <?php } else { // 로그아웃 상태 ?>
                        <li><a href="<?php echo $at_href['login'];?>" onclick="sidebar_open('sidebar-user'); return false;">로그인</a></li>
                        <li><a href="<?php echo $at_href['reg'];?>">회원가입</a></li>
                        <li><a href="<?php echo $at_href['lost'];?>" class="win_password_lost">정보찾기 </a></li>
                    <?php } ?>
                    <?php if(IS_YC) { // 영카트 사용하면 ?>
                        <?php if($member['cart'] || $member['today']) { ?>
                            <li>
                                <a href="<?php echo $at_href['cart'];?>" onclick="sidebar_open('sidebar-cart'); return false;"> 
                                    쇼핑 <b class="blue"><?php echo number_format($member['cart'] + $member['today']);?></b>
                                </a>
                            </li>
                        <?php } ?>
                        <li><a href="<?php echo $at_href['change'];?>"><?php echo (IS_SHOP) ? '커뮤니티' : '쇼핑몰';?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $at_href['connect'];?>">접속 <?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">'.number_format($stats['now_mb']).'</b>)' : ''; ?></a></li>
                    <?php if($is_member) { ?>
                        <li><a href="<?php echo $at_href['logout'];?>">로그아웃 </a></li>
                    <?php } ?>
                </ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</aside>

	<!-- PC Header -->
	<header class="header">
        <div class="layout_fix">
    		<div class="at-container">
                <ul class="ul">
    			<!-- PC Logo -->
    			<li class="li logo">
                    <div class="logo_box">
        				<a href="<?php echo $at_href['home'];?>">
        					<img src="/thema/Basic/images/logo.png">
        				</a>
                    </div>
    			</li>
    			<!-- PC Search -->
    			<li class="li search">
                    <div class="search_area">
                        <div class="form_box">
            				<form name="tsearch" method="get" onsubmit="return tsearch_submit(this);" role="form" class="form">
            				<input type="hidden" name="url"	value="<?php echo (IS_YC) ? $at_href['isearch'] : $at_href['search'];?>">
            					<div class="input-group input-group-sm search_form">
            						<input type="text" name="stx" class="form-control input-sm btn_search" value="<?php echo $stx;?>" placeholder="상품을 검색해보세요.">
            						<span class="input-group-btn ic">
            							<input type="submit" class="btn btn-sm" value=""></input>
            						</span>
            					</div>
            				</form>
            				<div class="header-keyword displaynone">
            					<?php echo apms_widget('basic-keyword', 'basic-keyword', 'q=베이직테마,아미나빌더,그누보드,영카트'); // 키워드 ?>
            				</div>
                        </div>
                    </div>
    			</li>
                <li class="li side_nav">
                <div class="keyword_box">
                    <div class="wrapping">
                        <a href="/?pn=product.search.list&amp;search_word=%EA%B0%80%EA%B5%AC" class="link">가구</a>
                        <a href="/?pn=product.search.list&amp;search_word=%EB%83%89%EC%9E%A5%EA%B3%A0" class="link">냉장고</a>
                        <a href="/?pn=product.search.list&amp;search_word=%EC%84%B8%ED%83%81%EA%B8%B0" class="link">세탁기</a>
                        <a href="/?pn=product.search.list&amp;search_word=%EA%B0%80%EC%A0%84" class="link">가전</a>
                    </div>
                </div>
                </li>
                <li class="li right">
                    <div class="login_btn">
                        <a href="#" target="_blank" class="btn">업체 로그인</a>
                    </div>
                </li>
    			<div class="clearfix"></div>
                </ul>
    		</div>
        </div>
	</header>

	<!-- Mobile Header -->
	<header class="m-header">
		<div class="at-container">
			<div class="header-wrap">
				<div class="header-icon">
					<a href="javascript:;" onclick="sidebar_open('sidebar-user');">
						<i class="fa fa-user"></i>
					</a>
				</div>
				<div class="header-logo en">
					<!-- Mobile Logo -->
					<a href="<?php echo $at_href['home'];?>">
						<b>아미나</b>
					</a>
				</div>
				<div class="header-icon">
					<a href="javascript:;" onclick="sidebar_open('sidebar-search');">
						<i class="fa fa-search"></i>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</header>

	<!-- Menu -->
    <div class="nav if_main  ">
    <div class="layout_fix">
        <ul class="table">
            <li class="td this_ctg js_box_navctg ">

                <!-- ◆◆◆ 상품카테고리 버튼 -->
                <div class="ctg_all js_btn_navctg" onclick="return false;">
                    <span class="btn_all">
                        <span class="img_btn">
                            <span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/menu_ic.gif" alt=""></span>
                            <span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/menu_ic2.gif" alt=""></span>
                        </span>
                        <span class="tx">전체 카테고리</span>
                    </span>
                </div>

                <!-- ◆◆◆ 상품카테고리 열기 / 3차 메뉴 있을때 dd에 if_ctg3 클래스 추가 -->
                <div class="all_open">
                    <div class="in_box">
                    <!-- dl 반복 / dl 6개 이상일때 dl 6개씩 in_box클래스 반복 -->
                    
                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=147" class="ctg1 js_slide_cate_more">
                                <span class="tit">가전</span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=206" class="ctg2">냉장고</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=203" class="ctg2">세탁기</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=217" class="ctg2">에어컨</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=205" class="ctg2">
                                노트북/PC 주변기기                         </a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=204" class="ctg2">
                                카메라                         </a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=207" class="ctg2">음향가전/학습기기</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=246" class="ctg2">게임/타이틀</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=434" class="ctg2">웨어러블</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=147" class="ctg2 js_slide_cate_more">상품 전체 보기</a></dd>
                    </dl>

                    
                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=1" class="ctg1 js_slide_cate_more">
                                <span class="tit">가구                                </span>
                            </a>
                        </dt>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=155" class="ctg2">여성의류</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=219" class="ctg2">남성의류</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=213" class="ctg2">언더웨어/잠옷</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=1" class="ctg2 js_slide_cate_more">상품 전체 보기</a></dd>
                    </dl>

                    
                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=2" class="ctg1 js_slide_cate_more">
                                <span class="tit">주방집기                              </span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=145" class="ctg2">신발</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=195" class="ctg2">여성가방</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=197" class="ctg2">남성가방</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=198" class="ctg2">지갑</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=2" class="ctg2 js_slide_cate_more">상품 전체 보기</a></dd>
                    </dl>

                    
                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=438" class="ctg1 js_slide_cate_more">
                                <span class="tit">가구/인테리어</span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=439" class="ctg2">침실가구</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=440" class="ctg2">거실/주방가구</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=441" class="ctg2">수납가구</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=442" class="ctg2">침구단품</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=443" class="ctg2">커튼</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=444" class="ctg2">서재/사무용가구</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=445" class="ctg2">DIY자재/용품</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=446" class="ctg2">침구세트</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=447" class="ctg2">아동/주니어가구</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=438" class="ctg2 js_slide_cate_more">상품 전체 보기</a></dd>
                    </dl>

                    <dl></dl><dl></dl>

                </div>
                <!-- / 상품카테고리 -->
                <script>
                    // 상품카테고리 열고닫기 ARA
                    $(document).on('click','.js_btn_navctg',function(){
                        var targetClass = '.js_box_navctg'; // 클릭 시 타겟이 되는 클래스 (css 선택자 지정할때처럼 선택 지정자)
                        var addClassName = 'if_open_navctg'; // 클릭 시 추가되는 클래스 (명만 써주시면됩니다.)
                        var chk = $(targetClass).hasClass(addClassName);
                        if( chk == false){ $(targetClass).addClass(addClassName); }
                        else {  $(targetClass).removeClass(addClassName);  }
                    });
                </script>
                <!-- / 상품카테고리 열기 -->


            </div></li>
            <li class="td this_gnb">


                <!-- ◆◆◆ 일반메뉴 -->
                <div class="gnb_menu">
                    <ul>
                        <li><a href="/bbs/content.php?co_id=company" class="btn"><span class="tx">피커스 소개</span></a></li>
                        <li><a href="/?pn=product.list&amp;_event=main_category_best" class="btn"><span class="tx">추천상품</span></a></li>
                        <li><a href="/?pn=product.list&amp;_event=main_product&amp;dmsuid=12" class="btn"><span class="tx">새로 등록된 상품</span></a></li>
                                            </ul>
                </div>
                <!-- / 일반메뉴 -->



                <!-- ◆◆◆ 오른쪽메뉴 -->
                <div class="right_menu">
                    <ul>
                        <li>
                            <a href="http://www.repickus.com/main/main.do" target="_blank" class="btn"><span class="txt">중고 판매 비교하기</span></a>
                        </li>
                        <li>
                            <a href="http://www.repickus.com/estimate/registEstimate.do" target="_blank" class="btn right"><span class="txt">중고 구매 비교하기</span></a>
                        </li>
                    </ul>
                </div>
                <!-- / 오른쪽메뉴 -->


            </li>
        </ul>
    </div>
</div>













	<nav class="at-menu displaynone">
		<!-- PC Menu -->
		<div class="pc-menu">
			<!-- Menu Button & Right Icon Menu -->
			<div class="at-container">
				<div class="nav-right nav-rw nav-height">
					<ul>
						<?php if(IS_YC) { //영카트 ?>
							<li class="nav-show">
								<a href="<?php echo $at_href['cart'];?>" onclick="sidebar_open('sidebar-cart'); return false;"<?php echo tooltip('쇼핑');?>> 
									<i class="fa fa-shopping-bag"></i>
									<?php if($member['cart'] || $member['today']) { ?>
										<span class="label bg-green en">
											<?php echo number_format($member['cart'] + $member['today']);?>
										</span>
									<?php } ?>
								</a>
							</li>
						<?php } ?>
						<li>
							<a href="javascript:;" onclick="sidebar_open('sidebar-response');"<?php echo tooltip('알림');?>>
								<i class="fa fa-bell"></i>
								<span class="label bg-orangered en"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
									<span class="msgCount"><?php echo number_format($member['response'] + $member['memo']);?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:;" onclick="sidebar_open('sidebar-search');"<?php echo tooltip('검색');?>>
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="menu-all-icon"<?php echo tooltip('전체메뉴');?>>
							<a href="javascript:;" data-toggle="collapse" data-target="#menu-all">
								<i class="fa fa-th"></i>
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php include_once(THEMA_PATH.'/menu.php');	// 메뉴 불러오기 ?>
			<div class="clearfix"></div>
			<div class="nav-back"></div>
		</div><!-- .pc-menu -->

		<!-- PC All Menu -->
		<div class="pc-menu-all">
			<div id="menu-all" class="collapse">
				<div class="at-container table-responsive">
					<table class="table">
					<tr>
					<?php 
						$az = 0;
						for ($i=1; $i < $menu_cnt; $i++) {

							if(!$menu[$i]['gr_id']) continue;

							// 줄나눔
							if($az && $az%$is_allm == 0) {
								echo '</tr><tr>'.PHP_EOL;
							}
					?>
						<td class="<?php echo $menu[$i]['on'];?>">
							<a class="menu-a" href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
								<?php echo $menu[$i]['name'];?>
								<?php if($menu[$i]['new'] == "new") { ?>
									<i class="fa fa-bolt new"></i>
								<?php } ?>
							</a>
							<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
								<div class="sub-1div">
									<ul class="sub-1dul">
									<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>

										<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
											<li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
										<?php } ?>

										<li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on'];?>">
											<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : '';?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
												<?php echo $menu[$i]['sub'][$j]['name'];?>
												<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
													<i class="fa fa-bolt sub-1new"></i>
												<?php } ?>
											</a>
										</li>
									<?php } //for ?>
									</ul>
								</div>
							<?php } ?>
						</td>
					<?php $az++; } //for ?>
					</tr>
					</table>
					<div class="menu-all-btn">
						<div class="btn-group">
							<a class="btn btn-lightgray" href="<?php echo $at_href['main'];?>"><i class="fa fa-home"></i></a>
							<a href="javascript:;" class="btn btn-lightgray" data-toggle="collapse" data-target="#menu-all"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .pc-menu-all -->

		<!-- Mobile Menu -->
		<div class="m-menu">
			<?php include_once(THEMA_PATH.'/menu-m.php');	// 메뉴 불러오기 ?>
		</div><!-- .m-menu -->
	</nav><!-- .at-menu -->

	<div class="clearfix"></div>
	
	<?php if($page_title) { // 페이지 타이틀 ?>
		<div class="at-title">
			<div class="at-container">
				<div class="page-title en">
					<strong<?php echo ($bo_table) ? " class=\"cursor\" onclick=\"go_page('".G5_BBS_URL."/board.php?bo_table=".$bo_table."');\"" : "";?>>
						<?php echo $page_title;?>
					</strong>
				</div>
				<?php if($page_desc) { // 페이지 설명글 ?>
					<div class="page-desc hidden-xs">
						<?php echo $page_desc;?>
					</div>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php } ?>

	<div class="at-body">
		<?php if($col_name) { ?>
			<div class="at-container">
			<?php if($col_name == "two") { ?>
				<div class="row at-row">
					<div class="col-md-<?php echo $col_content;?><?php echo ($at_set['side']) ? ' pull-right' : '';?> at-col at-main">		
			<?php } else { ?>
				<div class="at-content">
			<?php } ?>
		<?php } ?>
