		<link rel="stylesheet" type="text/css" href="/thema/Basic/css/style.css">

		<script>
	(function() {
		var w = window;
		if (w.ChannelIO) {
			return (window.console.error || window.console.log || function() {})('ChannelIO script included twice.');
		}
		var d = window.document;
		var ch = function() {
			ch.c(arguments);
		};
		ch.q = [];
		ch.c = function(args) {
			ch.q.push(args);
		};
		w.ChannelIO = ch;

		function l() {
			if (w.ChannelIOInitialized) {
				return;
			}
			w.ChannelIOInitialized = true;
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
			s.charset = 'UTF-8';
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		}
		if (document.readyState === 'complete') {
			l();
		} else if (window.attachEvent) {
			window.attachEvent('onload', l);
		} else {
			window.addEventListener('DOMContentLoaded', l, false);
			window.addEventListener('load', l, false);
		}
	})();

	ChannelIO('boot', {
		"pluginKey": "72479109-3846-4884-9753-4b1ef825171c", //please fill with your plugin key
		"userId": "<?php echo $member['mb_name'] ?>", //fill with user id
		"profile": {
			"name": "<?php echo $member['mb_email'] ?>", //fill with user name
			"mobileNumber": "<?php echo $member['mb_hp'] ?>", //fill with user phone number
			"CUSTOM_VALUE_1": "", //any other custom meta data
			"CUSTOM_VALUE_2": ""
		}
	});
</script>
		<!--픽스바-->
		<!-- with KJS dance-->
		<?//if($_SESSION[LEVEL] == 5 OR $_SESSION[LEVEL] == 6){?>-
		<div class="fixbar">
			<div class="fixbar_flex">
				<a class="fixbar_btn" href="https://repickus.com/estimate/estimate_list2.php"><img src="./img/list_btn.png" alt=""><p>견적리스트</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/partner_estimate_list.php"><img src="./img/estimate_btn.png" alt=""><p>내견적현황</p></a>
				<a class="fixbar_btn" href="https://repickus.com/market/seller/product/product_add.php"><img src="./img/register_btn.png" alt=""><p>물품등록</p></a>
				<a class="fixbar_btn" href="https://repickus.com/bbs/mypage_btn.php"><img src="./img/mypage_btn.png" alt=""><p>마이페이지</p></a>
			</div>
		</div>
		<?//} else if($_SESSION[LEVEL] == 1){ ?>
		<div class="fixbar">
			<div class="fixbar_flex">
				<a class="fixbar_btn" href="https://repickus.com/"><img src="./img/home_btn.png" alt=""><p>홈</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/my_estimate_list.php"><img src="./img/my_estimate_btn.png" alt=""><p>내신청현황</p></a>
				<a class="fixbar_btn" href="https://repickus.com/estimate/estimate_register.php"><img src="./img/register_btn.png" alt=""><p>견적신청</p></a>
				<a class="fixbar_btn" href="https://repickus.com/market/main/"><img src="./img/market_btn.png" alt=""><p>마켓</p></a>
				<a class="fixbar_btn" href="https://repickus.com/bbs/mypage.php"><img src="./img/mypage_btn.png" alt=""><p>마이페이지</p></a>
			</div>
		</div>
		<?// } ?>
			
			<!--픽스바끝-->
			<footer class="footer-container">
			<!--모바일 퀵메뉴-->
			<ul style="display:none;" class="mobile_quick_menu">
				<li><a href="#" class="menu_btn"><i class="fas fa-bars"></i></a></li>
				<li><a href="#"><i class="far fa-heart"></i></a></li>
				<li><a href="/"><i class="fas fa-home"></i></a></li>
				<li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
				<li><a href="#">MY</a></li>
			</ul>
			<!--//모바일 퀵메뉴-->	
			<!--하단 SNS 영역-->
			<div class="footer-top" style="display:none">
				<div class="home-about-me">
					<div style="text-align:center; padding:20px;">
						 <?=$admin_stat->shop_name;?>는 통신판매중개자이며, 통신판매의 당사자가 아닙니다. 상품, 상품정보, 거래에 관한 의무와 책임은 판매회원에게 있습니다.<br>
                          본 사이트의 상품/판매회원/중개 서비스/거래 정보, 콘텐츠, UI 등에 대한 무단복제, 전송, 배포, 스크래핑 등의 행위는 저작권법, 콘텐츠산업 진흥법 등
                            관련법령에 의하여 엄격히 금지됩니다.
					</div>				
					<div class="tm-about-text" style="padding-right:20px;">				
						<?if($db->cnt( "cs_mobile_main", "where 1 order by ranking asc")){?>
						<?
						$mainCnt = 0;
						$mainresult	= $db->select( "cs_mobile_main", "where open=1 order by ranking asc" );
						while( $mainrow = mysqli_fetch_object($mainresult)) {
							$mainCnt++;
							$iconinfo = $db->object("cs_mobile_icon", "where idx='$mainrow->icon'");
							$iconsize = @getimagesize("../data/designImages/".$iconinfo->icon);
						?>
						<a href="<?=$mainrow->linkurl?>" target="_blank"><img src="../data/designImages/<?=$iconinfo->icon?>" title="<?=$mainrow->name?>" border="0" style='padding:10px'></a>
						<?}?>
					<?}else{?>
					<?}?>
					</div>
				</div>
			</div> 
			<!--//하단 SNS End-->
			<section id="contact" class="section vc_custom_1420745234151">
				<div class="container" style="display:none">
					<div class="row">
						<div class="to_animate" data-animation="fadeIn" style='width:90%;margin:0 auto;'>
							<!--하단 카피라이트 시작-->
							<div class="footer_top" id="footer">
								<div class="footer-area1">
									<h6>Community</h6>
									<ul>
										<? if($db->cnt( "cs_bbs", "where code!='notice'" )) {?>								
										<?
										$bbs_result = $db->select("cs_bbs", "where code!='notice' order by code asc");
										while( $bbs_row = @mysqli_fetch_object( $bbs_result )) {
										?>
										<li class='community_boardmain'><img src="images/icon_subject2.png" border="0"><a href="bbs_list.php?code=<?=$bbs_row->code;?>"><?=$bbs_row->name;?></a></li>
										<? } ?>
										<?}?>
									</ul>
								</div>
								<div class="footer-area2">
									<h6>Banking <span class='footer-area_font'>Info</span></h6>
									<ul>
										<!--계좌안내-->
										<table width="100%">
											<tr>
												<td>
												<?
												$bankResult = $db->select( "cs_banklist", "where main_marking=1 order by idx asc");
												while( $bankRow = @mysqli_fetch_object($bankResult) ) {?>
												<table width="100%">
												<tr>
													<td>
													<tr>
														<td class='footer_Bank'><img src="images/icon_subject2.png" border="0">은행명:<?=$bankRow->bank_name?></td>
													</tr>
													<tr>
														<td class='footer_Bank'><img src="images/icon_subject2.png" border="0">계좌번호:<span class='footer_link_number'><?=$bankRow->bank_account?></span></td>
													</tr>
													<tr>
														<td class='footer_Bank'><img src="images/icon_subject2.png" border="0">예금주:<?=$bankRow->name?></td>
													</tr>
													<tr>
														<td height="5"></td>
													</tr>
													<tr>
														<td height="8" background="skinimage/customer_line.png"></td>
													</tr>
													<tr>
														<td height="5"></td>
													</tr>
												</table>
												<?}?>
												</td>
											</tr>
										</table>
										<!--계좌안내-->
									</ul>
								</div>
								<div class="footer-area3">
									<h6>CS <span class='footer-area_font'>Center</span></h6>
									<ul>
										<li class="address">
											<!--고객센터안내-->
											<table width="100%">
												<tr>
													<td height="40">														
														<a href="tel:<?=$admin_stat->shop_tel1;?>"><?
														if(!function_exists('str_split')) {
														function str_split($string,$string_length=1) {
														if(strlen($string)>$string_length || !$string_length) {
														do {
														$c = strlen($string);
														$parts[] = substr($string,0,$string_length);
														$string = substr($string,$string_length);
														}
														while($string !== false);
														}
														else {
														$parts = array($string);
														}
														return $parts;
														}
														}
														$shopTel = str_split($admin_stat->shop_tel1);
														for($i=0; $i < count($shopTel); $i++){
														if(!preg_match("/([0-9])/",$shopTel[$i])){
														?><span style='vertical-align:top;padding:0 6px;font-size:11pt;' class='main_cscenter_m1_tel'>-</span><?}else{?><span class='main_cscenter_m1_tel'><?=$shopTel[$i]?></span><?}?><?}?></a>					
													</td>
												</tr>
												<tr>
													<td>
														<table width="100%">
															<tr>
																<td class='link_ff'><?=$tools->strHtmlBr($admin_stat->week);?></td>
															</tr>
															<tr>
																<td style='padding-top:6px;'><a href="mail_to_admin.php" class='company_smallBtn04'>Contact Us</a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<!--고객센터안내-->
										</li>
									</ul>
								</div>
							</div> 
							<!--//하단 카피라이트 End-->
						</div>
					</div>
				</div>
			</section>
			<!--하단 메뉴-->
			<section style="display:none;" id="copyright" class="bottom_menu_area">
				<div class="row">
					<div class='topguidemenu'>
						<?
						$cartCnt = "";
						$navfootcnt	= $db->cnt("cs_navigation", "where openf=1 order by ranking asc" );
						$navresult	= $db->select("cs_navigation", "where openf=1 order by ranking asc" );
						while( $navrow = mysqli_fetch_object($navresult)) {
							$cartCnt++;
							if($navrow->tablename=="cs_page"){
								if($db->cnt("cs_page", "order by idx desc" )){
									$result1	= $db->select("cs_page", "order by idx desc" );
									while( $navrow1 = mysqli_fetch_object($result1)) {
									?>
									<a href="pageview.php?url=<?=$navrow1->page_index;?>" style='display: inline-block;'><?=$navrow1->title?></a><span class='text-sm-footer-line'>&nbsp;</span>
								<?}}?>
							<?}else{?>
						<a href="<?=$navrow->url?>" style='display: inline-block;'><?=$navrow->title?></a><?if($navfootcnt!=$cartCnt){?><span class='text-sm-footer-line'>&nbsp;</span><?}?>
						<?}}?>
					</div>
				</div>
			</section>
			<!--//하단 메뉴-->
		
		<div style="margin-top:100px !important;" class="footer if_main">
		<!-- 푸터메뉴 -->
		<div class="bottom_menu mobile_none">
			<div style="width: 1200px; margin: 0 auto; position: relative;" class="layout_fix">
				<div class="left_menu">
					<ul>
						<!--<li><a href="/?pn=member.login.form&_rurl=%2F%3F" class="btn">로그인</a></li>
						<li><a href="/?pn=member.join.agree" class="btn">회원가입</a></li>
						<li><a href="/?pn=service.guest.order.list" class="btn">주문조회</a></li> -->

						<li><a href="/bbs/content.php?co_id=company" class="btn">회사소개</a></li>
						<li><a href="/bbs/content.php?co_id=provision" class="btn">이용약관</a></li>
						<li><a href="/bbs/content.php?co_id=privacy" class="btn">개인정보처리방침</a></li>
						<li><a href="/bbs/content.php?co_id=deny" class="btn">이메일무단수집거부</a></li>
					</ul>
				</div>

				<!-- sns -->
				<div class="sns_box">
					<ul>
						<!-- 관리자에서 sns링크 걸어둘 경우 노출 /  링크 없으면 li 삭제 -->
						<li>
							<a href="https://www.instagram.com/official_pickus/" class="sns" style="width: 100%;" title="인스타그램" target="_blank"><img src="/images/b_insta.png" alt="인스타그램"></a>
						</li>
						<li>
							<a href=" https://www.facebook.com/pickus2" class="sns" style="width: 100%;" title="페이스북" target="_blank"><img src="/images/b_facebook.png" alt="페이스북"></a>
						</li>
						<li>
							<a href="http://blog.naver.com/pickus" class="sns" style="width: 100%;" title="블로그" target="_blank"><img src="/images/b_blog.png" alt="블로그"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<style type="text/css">
			.gdrNna {
				bottom: 90px !important;
			}

			.footer .sns_box .sns img {
				width: auto;
			}

			#fixed_kakao {

				position: fixed;
				bottom: 95px;
				right: 70px;
				z-index: 100
			}

			#fixed_kakao img {
				width: 165px;
			}

			@media(max-width: 768px) {
				#fixed_kakao {
					right: 6px;
					bottom: 100px;
				}

				#fixed_kakao img {
					width: 53px;
				}

				.mobile_none {
					display: none;
				}
			}
			@media(min-width:769px){
				.mobile{
					display:none;
				}
			}
			@media(max-width:768px){
				.web{
					display:none;
				}
			}	
		</style>
		<!--with KJS dance-->
		<?//php if ($_SESSION[LEVEL] == 5) { ?>
			<style type="text/css">
				#fixed_kakao {
					display: none;
				}
			</style>
		<?// } ?>
		<div id="fixed_kakao">
			<a target="_blank" href="http://pf.kakao.com/_qBNaxl/chat"><img src="/images/btn_kakao.png" class="mobile"><img style="width:62px;" src="/images/btn_kakao.png" class="web"></a>
		</div>
		<div style="width: 1200px; margin: 0 auto; position: relative;"class="layout_fix mobile_none">
			<ul class="copyright">
				<li style="width: 45%;" class="li info">
					<!-- 회사/사이트 정보 -->
					<ul class="info_box">
						<li>
							<div class="logo_box">
								<dl>
									<dt>
										<img src="/images/928194268.png" alt="">
									</dt>
									<dd>
										<div class="shop_name">피커스</div>
									</dd>
								</dl>
							</div>
						</li>
						<li>
							<span class="txt">상호명 : 디휴브</span>
							<span class="txt">대표: 천정훈</span>
							<span class="txt">대표전화: 1800-5528</span>
						</li>
						<li>
							<span class="txt">통신판매업 신고번호 : 제 2017-고양일산동-1604호</span>
							<span class="txt">
								사업자 등록번호: 291-39-00208 <a href="#none" onclick="window.open('http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=2913900208', 'communicationViewPopup', 'width=750, height=700;'); return false;" class="btn">사업자정보확인</a>
							</span>
						</li>
						<li>
							<span class="txt">소재지 : 경기도 고양시 일산동구 동국로 32 동국대학교 산학협력관 203호</span>
							<span class="txt">개인정보처리책임자: 천정훈 (cs@repickus.com)</span>
							<!-- <span class="txt">Hosting by 상상너머</span> -->
						</li>
						<li class="copy">Copyright(c) dehuv All Rights Reserved.</li>
					</ul>
				</li>
				<li style="text-align: left;" class="li pg">
					<!-- PG정보 -->
					<div class="pg_box">
						<div style="display:none;" class="inner">
							<div class="ic_pg"><img src="/images/pg_kg.jpg" alt=""></div>
							<div class="pc_txt">
								<a href="#none" onclick="window.open('https://mark.inicis.com/mark/escrow_popup.php?mid=', 'escrow_popup', 'width=565, height=683, scrollbars=no, left=200, top=50'); return false;" class="btn">구매안전 서비스<br>가입&nbsp;&nbsp;사실&nbsp;&nbsp;확인</a>
							</div>
						</div>

						<div class="tip">상품에 대하여 민원, 환불 등은 '디휴브' 에서<br> 처리하며 모든 책임은 디휴브'에 있습니다.<br>
							민원 담당자 연락처: 천정훈(성명) <br>1800-5528(유선 연락처)</div>
					</div>
				</li>
			</ul>

		</div>
	</div>
			<section style="display:none;" id="copyright" class="grey_section bg_image bottom_copyright" style="<?if($design_stat->footerbg==1){?>background-color:#<?=$design_stat->footerbg_color?><?}else{?>background-image:url( ../data/designImages/<?=$design_stat->footerbg_img?>);<?}?>">
				<div class="container">					
					<div class="row">
					<div class="col-sm-12 text-center to_animate f_copy2 desktop_ver">
						<div style="text-align:center; padding:20px;">
							 <?=$admin_stat->shop_name;?>는 통신판매중개자이며, 통신판매의 당사자가 아닙니다. 상품, 상품정보, 거래에 관한 의무와 책임은 판매회원에게 있습니다.<br>
                          본 사이트의 상품/판매회원/중개 서비스/거래 정보, 콘텐츠, UI 등에 대한 무단복제, 전송, 배포, 스크래핑 등의 행위는 저작권법, 콘텐츠산업 진흥법 등
                            관련법령에 의하여 엄격히 금지됩니다.
						</div>
							<!--하단 사업자 정보-->
							<div class='footer_logo'>
								<?
								$Temp_A = explode(".",$design_stat->title_logo2); 
								if($design_stat->title_logo2) {
								$logo_img="<a href='index.php'><img src='../data/designImages/$design_stat->title_logo2' border='0' align='absmiddle'></a>";
								}else{
								$logo_img="<div align='center'><font color='red'>디자인설정 > 메인디자인설정<br>하단 로고를 등록해 주세요.</font></div>";
								}
								?>
								<?=$logo_img;?>
							</div>
							<?
							$pginfo = $db->object("cs_pgsetup","");
							?>
                            <div class="foot_info"  style="padding-left:20px;">
                                <span class="shop_name"><?=$admin_stat->shop_name;?></span>
                                <ul>
                                    <li>대표자 : <?=$admin_stat->shop_ceo;?></li>
                                    <li class="line">|</li>
                                    <li>사업장주소 : <?=$admin_stat->shop_address;?></li>
                                    <li class="line">|</li>
                                    <? if($admin_stat->shop_tel1) {?>
                                    <li>대표전화 : <?=$admin_stat->shop_tel1;?></li>
                                    <?}?>
                                    <li class="line">|</li>
                                    <? if($admin_stat->shop_fax) {?>  
                                    <li>FAX : <?=$admin_stat->shop_fax;?></li>
                                    <?}?>
                                </ul>
								<ul>
									<? if($admin_stat->kakao_chnl) {?>                              
                                    <li>카카오톡 채널 : <a href="http://<?=$admin_stat->kakao_chnl;?>" target="_blank"><?=$tools->strHtmlBr($admin_stat->kakao_chnl);?></a></li>
                                    <?}?>
									 <? if($admin_stat->kakao_id) {?>  
									<li class="line">|</li>                                   
                                    <li>카카오톡 ID : <?=$admin_stat->kakao_id;?></li>
                                    <?}?>								
								</ul>
                                <ul>
                                    <li>개인정보관리책임 : <?=$admin_stat->safeguard_admin;?></li>
                                    <li class="line">|</li>
                                    <li>사업자번호 : <?=$admin_stat->shop_num;?></li>
                                    <li class="line">|</li>
                                    <li>통신판매신고 : <?=$admin_stat->shop_license;?></li>
                                    <li class="line">|</li>
                                    <li><?if($admin_stat->hostingurl){?><a href="<?=$admin_stat->hostingurl?>" target="_new">호스팅제공:<?=$admin_stat->hostingname;?></a><?}else{?>호스팅제공:<?=$admin_stat->hostingname;?><?}?></li>
                                </ul>
                                <table>
                                    <tr>
                                        <td>대표자 : <?=$admin_stat->shop_ceo;?></td>
                                    </tr>
                                    <tr>
                                        <td>사업장주소 : <?=$admin_stat->shop_address;?></td>
                                    </tr>
                                    <tr>
                                        <? if($admin_stat->shop_tel1) {?>
                                        <td>대표전화 : <?=$admin_stat->shop_tel1;?></td>
                                        <?}?>
                                    </tr>
                                    <tr>
                                        <? if($admin_stat->shop_fax) {?>
                                        <td>FAX : <?=$admin_stat->shop_fax;?></td>
                                        <?}?>
                                    </tr>
                                    <tr>
										<td>카카오톡 채널 : <a href="http://<?=$admin_stat->kakao_chnl;?>" target="_blank"><?=$tools->strHtmlBr($admin_stat->kakao_chnl);?></a></td>
									</tr>
									<tr>
										<td>카카오톡 ID : <?=$tools->strHtmlBr($admin_stat->kakao_id);?></td>
									</tr>
									<tr>
                                        <td>개인정보관리책임 : <?=$admin_stat->safeguard_admin;?></td>
                                    </tr>
                                    <tr>
                                        <td>사업자번호 : <?=$admin_stat->shop_num;?></td>
                                    </tr>
                                    <tr>
                                        <td>통신판매신고 : <?=$admin_stat->shop_license;?></td>
                                    </tr>
                                    <tr>
                                        <?if($admin_stat->hostingurl){?>
                                        <td>호스팅제공:<?=$admin_stat->hostingname;?></td>
                                        <?}else{?>
                                        <td>호스팅제공:<?=$admin_stat->hostingname;?></td>
                                        <?}?>
                                    </tr>
                                </table>
                                <div class="foot_link">
                                    <a href='javascript:onopen("<?=str_replace("-","",$admin_stat->shop_num);?>")'>사업자정보확인</a>
                                    <a href='pageview.php?url=safeguard'>개인정보보호정책</a>
                                </div>
                            </div>
							<?if($pginfo->pg_true=="1"){?><a href="javascript:go_check()" class='company_smallBtn00'>예스크로제공업체: KCP<?}?></a>
							<?
							if($pginfo->pg_ich_escr==1 || $pginfo->pg_vich_escr==1){?>
							 <!--에스크로배너--><script language="JavaScript">
								function go_check()
								{
									var status  = "width=500 height=450 menubar=no,scrollbars=no,resizable=no,status=no";
									var obj     = window.open('', 'kcp_pop', status);
									document.shop_check.method = "post";
									document.shop_check.target = "kcp_pop";
									document.shop_check.action = "http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp";
									document.shop_check.submit();
								}
								</script><form name="shop_check" method="post" action="http://admin.kcp.co.kr/Modules/escrow/kcp_pop.jsp"><input type="hidden" name="site_cd" value="<?if($pginfo->pg_true=="1"){?><?=$pginfo->pg_code?><?}else{?>T0000<?}?>">
								</form><!--//에스크로배너--><?}?>
							<p class='f_copy_en'>Copyright (c) <?=$admin_stat->shop_name;?>. All Rights Reserved.  <a href='mail_to_admin.php' class='f_copy_en f_copy_centerL' style='display:none'>Contact <?=$admin_stat->shop_email;?> for more information.</a></p>
							<!--하단 사업자 정보 끝-->
						</div>
					</div>
				</div>
			</section>
		</footer>
	 <span style="display: none; visibility: hidden;" class="testimonial_default_width"></span>
	 <span style="display: none; visibility: hidden;" class="special_default_width"></span>
<script language="javascript">
  // 제품검색
  var overlayOne = $('#overlayContent').overlay();
  var overlayTwo = $('#overlayContentTwo').overlay({
    overlayTriggerId: "#overlayTriggerTwo",
    overlayCloseId: "#overlayCloseTwo"
  });
  //overlayTwo.destroy();
	// 아이프레임 세로 자동 리사이징
	function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.body.scrollHeight;
	frm.style.height = contentHeight + 20 + "px";
	}
</script>
<script type="text/javascript">
	$(document).ready(function (){
		//Toggle Menu
		$('.mobile_quick_menu a.menu_btn').click(function () {
			$('.m_toggle_shopcate').animate({ 'left':'0' });
			return false;
		});
    });
</script>
</div><!--//container-fluid-->
</body>
</html>