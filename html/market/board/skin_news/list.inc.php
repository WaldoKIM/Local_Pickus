<script language="javascript">
	<!--
	function cate_search(value) {
		location.href="?board_data=<?=$bbs_data?>&search_items=<?=$SEARCH_DATA2?>&cate="+value;
	}
	
	function img_view(value, number) {
		window.open("view_img.php?board_data="+value+"&imgNum="+number, "","scrollbars=no, width=500, height=450");
	}
	//-->
</script>
<div class='spaceline01'></div>
<table width="100%">
	<tr>
		<td>
		<!-- header Include -->
		<? if($bbs_admin_stat->header != "NULL") { ?><?=$bbs_admin_stat->header;?><? }?>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td align="left">
								<!--셀렉트메뉴-->
								<?if($bbs_admin_stat->category){?>
								<div class='btncenter_container4M' name='모바일일때 중앙정렬'>
									<div id='cssmenu'>
										<ul>
										   <li class='active has-sub'>
											  <ul>
												 <li class='has-sub'><a><?if($cate){?><?=$cate?><?}else{?>분류를 선택하여 주세요.<?}?></a>
													<ul>
													   <?if($cate){?><li><a href="javascript:cate_search('')">전체보기</a></li><?}?>
														<?
														$B = explode("&&",$bbs_admin_stat->category);
														for($i=0;$i<count($B)-1;$i++){
														if($B[$i]!=$cate){
															$new_cnt++;
														?>
													   <li><a href="javascript:cate_search('<?=$B[$i]?>')"><?=$B[$i]?></a></li>
														<?}}?>
													</ul>
												 </li>
											  </ul>
										   </li>
										</ul>
									</div>
								</div>
								<?}?>
								<!--셀렉트메뉴-->
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
		</td>
	</tr>
	<tr>
		<td class='faqnone_table'><hr /></td>
	</tr>
	<tr>
		<td>
		<table width="100%" style='border-collapse: collapse' align="center">
			<tr>
				<td height='1' bgcolor='333333'>
				</td>
			</tr>
			<tr align="center" height="36" valign='top' style="padding-top:10px;">
				<!-- bbs loop start -->
				<?
					$table				= "cs_bbs_data";
					// 리스트갯수
					$listScale			=	$bbs_admin_stat->list_height;
					// 페이지 갯수
					$pageScale		=	$bbs_admin_stat->list_page;
					// 스타트 페이지
					if( !$startPage ) { $startPage = 0; }
					// 토탈페이지
					$totalPage = floor($startPage / ($listScale * $pageScale));
					// 검색
					if( empty($search_item) || $search_item == 0 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
						$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 1 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%'" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 2 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%'" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 4 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%'" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%' order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 3 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%')" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 6 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%')" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 5 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%')" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					} else if( $search_item == 7 ) {
						$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%')" );
						$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%') order by ref desc, re_step ASC LIMIT $startPage, $listScale" );
					}
					
					// 페이지넘버
					if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
					// 라인색상 초기화
					$colorIndex=0;
					// 답변 화살표
					$arowImage="<img src=images/bbs_reicon2.gif border=0 style='vertical-align:middle;'>";
					// 루프 시작
					while($bbs_row = mysqli_fetch_object($result)) {
						
						//라인색상 초기화
						if($colorIndex%2) $bgColor=$bbs_admin_stat->list_line1; else $bgColor=$bbs_admin_stat->list_line2;
						
						// 마우스 오버 색상
						$mouseColor		=		$bbs_admin_stat->mouse_over;
						$new_check			=		$bbs_admin_stat->new_check;
						$cool_check			=		$bbs_admin_stat->cool_check;
						
						$subject				=		$tools->strCut($bbs_row->subject, 200);
						
						//		$subject				=		$tools->strHtmlNo($subject);
						$name					=		$bbs_row->name;
						$read_cnt				=		$bbs_row->read_cnt;
						$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
						$coment_cnt		=		$db->cnt("cs_bbs_coment", "where link=$bbs_row->idx");
						
						$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo);
						
						//비밀글
						$hold_img="";
						$link_direct = "";
						if($bbs_row->hold==1){
							$hold_img = "<img src='images/key_icon.gif' hspace='5' border='0' style='vertical-align:middle;'>";
							if($_SESSION[USERID]==$bbs_row->userid && $_SESSION[USERID]!=""){$link_direct = "1";}
							if(!$_SESSION[USERID] && !$bbs_row->userid){ $link_direct = "2";}
						}else{
							$link_direct = "1";
						}
						
						//2011-11-25 패치수정부분 시작						
					if($_SESSION[USERID]!=$bbs_stat->userid){					
						$oob = $db->object("cs_bbs_data", "where idx='$bbs_row->idx'");
						if($db->cnt("cs_bbs_data", "where idx='$oob->ref' and userid='$_SESSION[USERID]'")){
							$link_direct = "1";
						}
					}
					//2011-11-25 패치수정부분 시작

					//new IMG
						if( $new_check ) {	$new_img			=		$page->bbsNewImg( $bbs_row->reg_date, $bbs_admin_stat->new_mark, "<img src='./images/new_news.gif' style='vertical-align:middle;'>" ); }
						
						// hit IMG
						if( $cool_check ) {	$cool_img				=		$page->bbsCoolImg( $bbs_admin_stat->cool_mark, $read_cnt, "<img src='./images/hit3.gif' style='vertical-align:middle;'>" ); }
						
						// 답변 re image view
						if($bbs_row->re_level > 0) { $wid = 7 * $bbs_row->re_level; $level_img="<img src='images/level.gif' width=".$wid." height=8 border='0'>$arowImage"."&nbsp;"; } else { $level_img="";}
						$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&code=".$code."&search_item=".$search_item."&search_order=".$search_order);
					?>
				<tr align="center" bgcolor="<?=$bgColor?>" style="padding-left: 0; padding-top: 20; padding-bottom: 20" onMouseOver=this.style.backgroundColor="<?=$mouseColor?>"  onMouseOut=this.style.backgroundColor="">
					<td height="31" align="left">
					<table width="100%">
						<tr>
							<td width="15%" style="padding-left:10px; padding-top:5px; padding-bottom:5px;">
							<?if($idx==$bbs_row->idx){?>
							<?}?>
							<a href="<?if($link_direct=="1"){?>?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else if($link_direct=="2"){?>?boardT=pv&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else{?>javascript:alert('권한이 없습니다.')<?}?>">
							<span class='bbs_newsA'><?=$db->stripSlash($subject);?></span></a>&nbsp;<? if($coment_cnt) {?><?}?></td>
						</tr>
						<tr>
							<td width="75%" class="bbs4" style='text-align:justify;'>
							<!-- 파일이 그림일 경우 출력(gif/jpg),이미지가 없으면 내용만 출력 -->
							<?if($bbs_row->bbs_file!="none"){?><a href="<?if($link_direct=="1"){?>?boardT=v&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else if($link_direct=="2"){?>?boardT=pv&board_data=<?=$bbs_data;?>&search_items=<?=$SEARCH_DATA?><?}else{?>javascript:alert('권한이 없습니다.')<?}?>"><img src="../data/bbsData/<?=$bbs_row->bbs_file;?>" <?=$bbs_images_width;?> <?=$bbs_images_height;?> border="0" align="left" class='resize_item images_oolim'></a><?}?><span class='bbs_newsB'><?=$tools->strCut(strip_tags($bbs_row->content), 1000)?></span><span class='bbs_newsD'><?=$tools->strCut(strip_tags($bbs_row->content), 300)?></span>&nbsp;&nbsp;<br>
							<table>
							<tr>
								<td class='bbsnnews_date'><?=$name?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$reg_date?>&nbsp;&nbsp;&nbsp;&nbsp;조회:<?=$read_cnt?></td>
								<td style='display:inline-block;'>
									<table>
										<tr>
											<?
											$sns_result		= $db->select("cs_bbs_sns", "where open=1 order by ranking asc" );
											$i=1;
											while( $snsrow = mysqli_fetch_object($sns_result) ) {
												if(array_search($snsrow->idx,$snstemp)){
												$iconinfo = $db->object("cs_mobile_icon", "where idx='$snsrow->icon'");
												$iconsize = @getimagesize("../data/designImages/".$iconinfo->icon);
												$snsusbject = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $subject);
												if($snsrow->noedit==1){
												?>
											<td  style='padding-left:3px;'>
											<div id="fb-root"></div>
											<script>(function(d, s, id) {
											  var js, fjs = d.getElementsByTagName(s)[0];
											  if (d.getElementById(id)) return;
											  js = d.createElement(s); js.id = id;
											  js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&appId=<?=$snsrow->linkurl?>&version=v2.0";
											  fjs.parentNode.insertBefore(js, fjs);
											}(document, 'script', 'facebook-jssdk'));

											</script>
											<div class="fb-like" data-href="<?=$_SERVER['REQUEST_URI']?>" data-layout="button" data-action="recommend" data-show-faces="false" data-share="true"></div>	
											</td>
												<?}else{?>
											<td style='padding-left:3px;'>
												<script language="javascript">
												document.write("<td style='padding-left:2px;'>");
												var content = "<?=$snsrow->linkurl?>";
												content = content.replace('__{SNSTITLE}__', encodeURIComponent("<?=addslashes(strip_tags($snsusbject))?>"));
												content = content.replace('__{SNSURL}__', encodeURIComponent('http://<?=$admin_stat->shop_domain?>/<?=$skin_url?>/<?=$TARGETFILENAME?>?page_idx=<?=$_GET[page_idx]?>&idx=<?=$idx?>&code=<?=$code?>&boardT=v'));
												document.write("<a href='"+content+"' target='_new'><img src='../data/designImages/<?=$iconinfo->icon?>' border='0' alt='<?=$snsrow->name?>' style='vertical-align:middle;'></a>")
												document.write("</td>");
												</script>
											</td>
											<?}}}?>
										</tr>
									</table>								
								</td>
							</tr>
							</table>
							</td>
						</tr>
					</table>
					
					</td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
				<tr>
					<td height="1" bgcolor='dddddd'></td>
				</tr>
				<tr>
					<td height="30"></td>
				</tr>
				<?
				$hot_img=""; $listNo--; $colorIndex++;
				}
				?>
				
				<!-- bbs loop end -->
			</table>
			
		<div class='spaceline02'></div>

		<table width="100%">
			<tr>
				<td height="30" align="center" class="bbs5">
				<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "이전", "다음", "", $SEARCH_DATA);?></td>
			</tr>
			<? if($bbs_admin_stat->bbs_write<=$_SESSION[LEVEL]) {?>
			<tr>
				<td align="center" height="50">
					<table>
						<tr>
							<td><a href="?boardT=w&board_data=<?=$bbs_data?>&search_items=<?=$SEARCH_DATA?>" class='oolimbtn-botton1'>글쓰기</a></td>
						</tr>
					</table>
				</td>
			</tr><?}?>
		</table>

		<script language="javascript">
			<!--
			function searchCheck( box) {
				if( box.checked == false ) {
					bbs_search_form.search_item.value = eval(bbs_search_form.search_item.value) - eval(box.value);
				} else {
					bbs_search_form.search_item.value = eval(bbs_search_form.search_item.value) +eval(box.value);
				}
			}
			
			function search(){
				if(bbs_search_form.search_subject.checked == false && bbs_search_form.search_content.checked == false && bbs_search_form.search_name.checked == false)	{
					alert("검색을 체크해 주십시오.");
				} else if(bbs_search_form.search_order.value=="")	{
					alert("검색할 내용을 입력해 주십시오.");
					bbs_search_form.search_order.focus();
				} else {
					bbs_search_form.submit();
				}
			}
			//-->
		</script>
		<div class='spaceline01'></div>
		<table style='margin:0 auto;'>
			<form name="bbs_search_form" method="get" action="?">
			<input type="hidden" name="search_item" value="0">
			<input type="hidden" name="board_data" value="<?=$bbs_data?>">
			<input type="hidden" name="search_items" value="<?=$SEARCH_DATA?>">
			<tr>
				<td style='text-align:center;font-size:10pt;'>
					<input type="checkbox" name="search_subject" value="1" onClick="searchCheck(bbs_search_form.search_subject);">제목
					<input type="checkbox" name="search_content" value="2" onClick="searchCheck(bbs_search_form.search_content);">내용
					<input type="checkbox" name="search_name" value="4" onClick="searchCheck(bbs_search_form.search_name);">이름
					<input name="search_order" type="text" class="formText form_search"> <a href="javascript:search();" class="searchB" style="width:60px;">검색</a>
				</td>
			</tr>
			</form>
		</table>

		</td>
	</tr>
</table>
<!-- 내용출력 끝 //-->
