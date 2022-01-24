<?
	include("../header.php");
	include($ROOT_DIR."/lib/page_class.php");
	//$_GET=&$HTTP_GET_VARS;
	//$_POST=&$HTTP_POST_VARS;
	$mv_data	= $_GET[bbs_data];
	$bbs_data	= $tools->decode( $_GET[bbs_data] );
	if( $_GET[idx] )					{ $idx = $_GET[idx]; }											else { $idx = $bbs_data[idx]; }
	if( $_GET[code] )					{ $code = $_GET[code]; }									else { $code = $bbs_data[code]; }
	if( $_GET[listNo] )				{ $listNo = $_GET[listNo]; }									else { $listNo = $bbs_data[listNo]; }
	if( $_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $bbs_data[startPage]; }
	if( $_POST[search_item] )	{ $search_item = $_POST[search_item]; }			else { $search_item	= $bbs_data[search_item]; }
	if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
	if( $_GET[cate] )	{ $cate = $_GET[cate]; }		else { $cate	= urldecode($SEARCH_ITEM[cate]); }
	if($cate &&  $cate!="null"){
		$cate_query = " and category='$cate'";
	}
	$bbs_data = $tools->encode("listNo=".$listNo."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".urlencode($search_order)."&_&cate=".urlencode($cate));
	// 게시판 환경
	if(!$code) { $tools->errMsg("잘못된 접근입니다");}
	$bbs_stat		=	$db->object("cs_bbs", "where code='$code'");
?>
<script id="dynamic"></script> <!-- 이거 빼먹지 말것 -->

<script language="JavaScript">
	<!--
	function allCheck()
	{
		var f = document.forms['listform'];
		if(typeof(f.del_list) == 'object') {
			if(f.allchk.checked) {
				if(f.del_list.length) for (var i=0;i<f.del_list.length;i++) f.del_list[i].checked=true;
				else f.del_list.checked=true
			} else {
				if(f.del_list.length) for (var i=0;i<f.del_list.length;i++) f.del_list[i].checked=false;
				else  f.del_list.checked=false;
			}
		} else {
			if(f.allchk.checked) {
				alert('선택할 글이 없습니다.');f.allchk.checked = false;return;
			} else return;
		}
	}
	
	function actSelect()
	{
		var f = document.forms['listform'];
		var arr_del_list = new Array();
		var i,j;
		if(typeof(f.del_list) == 'object') {
			if(f.del_list.length) {
			for (i=0,j=0;i<f.del_list.length;i++) { if(f.del_list[i].checked) { arr_del_list[i] = f.del_list[i].value;j++; }}
				if(!j) { alert('글을 선택하여 주세요.');return; }
				else f.arr_del_list.value = arr_del_list.join('@');
			} else {
				if(!f.del_list.checked) { alert('글을 선택하여 주세요.');return; }
			}
			if(j==1) f.arr_del_list.value = '';
			if(confirm('삭제하시겠습니까?')) f.submit();
		} else {
			alert('선택할 글이 없습니다.');	return;
		}
	}
	
	function selectch(table, field, idx, value, ch){
		if(ch=="N" && value==""){
			alert("값을 반드시 입력하여 주세요."); return;
		}else if(table=="" || field=="" || idx==""){
			alert("중요 정보가 없습니다. 새로고침 후 이용하여 주세요."); return;
		}else{
			dynamic.location.href =  "../dir.dbunityselect.php?table="+table+"&field="+field+"&idx="+idx+"&value="+value;
		}
	}


	function cate_search(value) {
		location.href="?bbs_data=<?=$bbs_data;?>&cate="+value;
	}
	
	function img_view(value, number) {
		window.open("../view_img.php?board_data="+value+"&imgNum="+number, "","scrollbars=no, width=500, height=450");
	}

	//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/bbs_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
						<table width="100%">
							<tr>
								<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5"><?=$bbs_stat->name;?> 게시판관리
								</td>
							</tr>
							<tr>
								<td height="1" bgcolor="#666666"></td>
							</tr>
							<tr>
								<td height="25"></td>
							</tr>
							<tr>
								<td height="5" class="padding_5">
								<table width="100%" bgcolor="white">
									<tr>
										<td height="35" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><?=$bbs_stat->name;?> 게시판리스트</td>
									</tr>
									<tr>
										<td height="10" colspan="3">
											<!--도움말-->
												<table width="100%" class='tipbox'>
													<tr>
														<td bgcolor="#E9F2F8">
															<table width="100%">
																<tr>
																	<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																</tr>
																<tr>
																	<td><?=$bbs_stat->name;?> 게시판에 등록된 게시물을 관리 하실 수 있습니다.</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											<!--//도움말-->
										</td>
									</tr>
									<tr>
										<td height="25" colspan="3">
										
										</td>
									</tr>
									<form method="get" action="bbs_list_ok.php" name="listform">
									<input type="hidden" name="code" value="<?=$code;?>">
									<input type="hidden" name="arr_del_list">
									<input type="checkbox"  name="del_list" style="display:none;">
									<tr>
										<td valign="top" class="padding_5">
										<?if($bbs_stat->category){?>카테고리선택 :
										<select name='category' size='1' onchange="cate_search(this.value)" class='file_text'>
											<option value="null">&nbsp;선택</option>
											<?
												$B = explode("&&",$bbs_stat->category);
												for($i=0;$i<count($B)-1;$i++){
												?>
											<option value="<?=trim($B[$i])?>" <?if($B[$i]==$cate){?>selected<?}?>>&nbsp;<?=$B[$i]?></option>
											<?}?>
										</select>
										<?}?>
										<table>
											<tr>
												<td>
														<table>
															<tr>
																<td class='oolimbtn-botton2'>
																전체선택 : <input type="checkbox" name="allchk" onClick="allCheck();this.blur()"></td><td><a href="javascript:actSelect()" class='oolimbtn-botton3'>선택항목 삭제</a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
												<td style='padding:10px'></td>
											</tr>
										</table>

										
								<!--이벤트게시판 리스트출력-->
										<? if( $bbs_stat->bbs_type=="2") {?>
										<table width="100%" class="table_all">
											<tr>
												<?
													$table				= "cs_bbs_data";
													// 리스트갯수
													$listScale			=	$bbs_stat->list_height;
													// 페이지 갯수
													$pageScale		=	$bbs_stat->list_page;
													// 스타트 페이지
													if( !$startPage ) { $startPage = 0; }
													// 토탈페이지
													$totalPage = floor($startPage / ($listScale * $pageScale));
													// 검색
													if( empty($search_item) || $search_item == 0 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
														$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by idx desc,  ref desc,re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 1 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%'" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%' order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 2 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%'" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%' order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 4 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%'" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%' order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 3 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%')" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%') order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 6 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%')" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%') order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 5 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%')" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%') order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													} else if( $search_item == 7 ) {
														$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%')" );
														$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%') order by idx desc,   ref desc, re_step ASC LIMIT $startPage, $listScale" );
													}
													
													// 페이지넘버
													if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
													// 루프 시작
													$new_cnt = 0; $new_tr = 0; $td_width = 1 ; // 가로리스트 수
													while ($bbs_row = mysqli_fetch_object($result)) {
														$new_cnt++;
														$subject				=		$bbs_row->subject;
														$name					=		$bbs_row->name;
														$read_cnt			=		$bbs_row->read_cnt;
														$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
														
														$bbs_images_size=@getimagesize("../../data/bbsData/$bbs_row->bbs_file");
														$bbs_images_width=""; $bbs_images_height="";
														$bbs_images_width_size=620;
														$bbs_images_height_size=120;
														
														if( $bbs_images_size[0] == $bbs_images_size[1] ) { $bbs_images_width = "width=".$bbs_images_width_size; $bbs_images_height = "height=".$bbs_images_height_size; } else if( $bbs_images_size[0] > $bbs_images_size[1] ) { $bbs_images_width = "width=".$bbs_images_width_size; } else if( $bbs_images_size[0] < $bbs_images_size[1]) { $bbs_images_height = "height=".$bbs_images_height_size;}
														$bbs_data = $tools->encode("idx=".$bbs_row->idx."&_&startPage=".$startPage."&_&listNo=".$listNo."&_&table=".$table."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".urlencode($search_order));
													?>
												<td class='sensP tabletd_all2' style='padding:20px;'><a href="bbs_view.php?bbs_data=<?=$bbs_data;?>">
													<?if($bbs_row->bbs_file!="none"){?><img src="../../data/bbsData/<?=$bbs_row->bbs_file;?>" <?=$bbs_images_width;?> <?=$bbs_images_height;?> border="0"><?}else{?><img src="../images/noimage_photo.gif"><?}?></a><br>
														<table>
															<tr>
																<td style='padding-top:10px'></td>
															</tr>
															<tr>
																<td class='oolimbtn-botton6'>삭제: <input type="checkbox"  name="del_list" value="<?=$bbs_row->idx;?>"></td>
															</tr>
															<tr>
																<td style='padding-bottom:10px'></td>
															</tr>
														</table>
													<a href="bbs_view.php?bbs_data=<?=$bbs_data;?>"><span style="font-size:10pt;"><?=$subject;?></span></a>&nbsp;&nbsp;&nbsp;<font color="gray">작성자 : <?=$name;?></font>
												</td>
											</tr>
											<?}?>
										</table>
								<!---------- 사진게시판(일반사진,사진전용게시판) 리스트출력 ------------>
										<? }else if( $bbs_stat->bbs_type=="3") {?>
											<hr />
											<div class="oolimbox-wrapper_gallery oolimbox-grid5">
												<?
												$table				= "cs_bbs_data";
												// 리스트갯수
												$listScale			=	$bbs_stat->list_height;
												// 페이지 갯수
												$pageScale		=	$bbs_stat->list_page;
												// 스타트 페이지
												if( !$startPage ) { $startPage = 0; }
												// 토탈페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));
												// 검색
												if( empty($search_item) || $search_item == 0 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
												$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by idx desc, ref desc,re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 1 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%'" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 2 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%'" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 4 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%'" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 3 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%')" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 6 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%')" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 5 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%')" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 7 ) {
												$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%')" );
												$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												}
												
												// 페이지넘버
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
												// 루프 시작
												$new_cnt = 0; $new_tr = 0; $td_width = 6; // 가로리스트 수
												while ($bbs_row = mysqli_fetch_object($result)) {
												$new_cnt++;
												$subject				=		$bbs_row->subject;
												$name					=		$bbs_row->name;
												$read_cnt			=		$bbs_row->read_cnt;
												$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
												
												$bbs_images_size=@getimagesize("../../data/bbsData/$bbs_row->bbs_file");
												$bbs_images_width=""; $bbs_images_height="";
												$bbs_images_width_size=120;
												$bbs_images_height_size=120;
												
												if( $bbs_images_size[0] == $bbs_images_size[1] ) { $bbs_images_width = "width=".$bbs_images_width_size; $bbs_images_height = "height=".$bbs_images_height_size; } else if( $bbs_images_size[0] > $bbs_images_size[1] ) { $bbs_images_width = "width=".$bbs_images_width_size; } else if( $bbs_images_size[0] < $bbs_images_size[1]) { $bbs_images_height = "height=".$bbs_images_height_size;}
												$bbs_data = $tools->encode("idx=".$bbs_row->idx."&_&startPage=".$startPage."&_&listNo=".$listNo."&_&table=".$table."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".$search_order);
												?>
											<article class="oolimbox-col_5dan" style='text-align:center'>								

													<?if($bbs_row->bbs_file!="none"){?><a href="../../data/bbsData/<?=$bbs_row->bbs_file;?>" rel="lightbox"><img src="../../data/bbsData/<?=$bbs_row->bbs_file;?>" <?=$bbs_images_width;?> <?=$bbs_images_height;?> class='resizeS'></a><?}else{?><img src="../images/noimage_photo.gif"><?}?>
													<br>
													<?if($bbs_stat->category){?>
														<select name='category' size='1' onchange="selectch('cs_bbs_data', 'category', '<?=$bbs_row->idx?>', this.value, 'N')" class='formSelect'>
															<option value="none">&nbsp;선택</option>
															<?
																$B = explode("&&",$bbs_stat->category);
																for($i=0;$i<count($B)-1;$i++){
																?>
															<option value="<?=$B[$i]?>"  <?if($bbs_row->category==$B[$i]){?>selected<?}?>
															>&nbsp;<?=$B[$i]?>
															</option>
															<?}?>
														</select>
													<?}?>
													<br>										
													<font color='red'>삭제: </font><input type="checkbox"  name="del_list" value="<?=$bbs_row->idx;?>"><br><a href="bbs_view.php?bbs_data=<?=$bbs_data;?>"><?=$subject;?></a><br><font color="gray">작성자 : <?=$name;?></font>												
													
											</article>
											<?}?>
										</div>

										<hr />
							<!--------- 일반형(질답게시판,자유게시판,공지사항) 게시판리스트 ------------>
										<? }else {?>
										<table width="100%" class="table_all">
											<tr height=1>
												<td colspan="<? if( $bbs_stat->bbs_pds ) { echo "6";} else { echo "5";}?>">
												</td>
											</tr>
											<tr align="center">
												<td width="50" height="35"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
												선택
												</td>
												<td width="400" height="35"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
												제 목
												</td>
												<td width="135" height="35"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
												이 름
												</td>
												<td width="135" height="35"  bgcolor="#E4E7EF" class='contenM tabletd_all'>
												작성일
												</td>
												<td width="50"  bgcolor="#E4E7EF" class='contenM tabletd_all'>조회수</td>
												<!-- 자료실 체크 -->
												<? if( $bbs_stat->bbs_pds ) {?>
												<td width="30" height="35"  bgcolor="#E4E7EF" class='contenM tabletd_all'>파일</td>
												<? }?>
											</tr>
											
											<!-- 게시판 목록에서 공지형 글 ---------------------------------------------------------------------------------------------------------------------------------------------------------------->
											<?
											$table				= "cs_bbs_data";
											$notice_result		= $db->select( $table, "where code='$code' and notice > 0 $cate_query order by idx desc" );
											while( $row = mysqli_fetch_object($notice_result) ) {
											$new_check		=		$bbs_stat->new_check;
											$subject			=		$row->subject;
											$name				=		$row->name;
											$read_cnt		=		$row->read_cnt;
											$reg_date		=		$tools->strDateCut( $row->reg_date );
											$coment_cnt		=		$db->cnt("cs_bbs_coment", "where link=$row->idx");
											
											if( $new_check ) { $new_img =	$page->bbsNewImg( $row->reg_date, $bbs_stat->new_mark, "<img src='../images/new3.gif' align='absmiddle'>" ); }
											$bbs_data = $tools->encode("idx=".$row->idx."&_&startPage=".$startPage."&_&listNo=".$listNo."&_&table=".$table."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".$search_order);
											?>
											<tr>
												<td height="25" class='sensO'><img src="../images/ani_arrow.gif" align="absmiddle"></td>
												<td width="400" height="40" class='sensP tabletd_all'>
												<a href="bbs_view.php?bbs_data=<?=$bbs_data;?>"><font color="#333333"><?=$db->stripSlash($subject);?></font></a>&nbsp;<? if($coment_cnt) {?><span class="cp_bk">(<?=$coment_cnt;?>)</span><?}?>&nbsp;<?=$new_img?>
												</td>
												<td width="135" height="40" class='sensO tabletd_all'>
												<?=$name?>
												</td>
												<td width="135" height="40" class='sensO tabletd_all'>
												<?=$reg_date?>
												</td>
												<td width="50" height="40" class='sensO tabletd_all'>
												<?=$read_cnt?>
												</td>
												<!-- 자료실 이미지 출력 -->
												<? if( $bbs_stat->bbs_pds ) {?>
												<td height="40" class='sensO tabletd_all'>
												<? if( $row->bbs_file != "none" ) {?><img src="./../images/disk.gif"><?}?>
												</td>
												<? }?>
											</tr>
											<?  $hot_img="";	} ?>
											<!-- 게시판 목록에서 공지형 글 ---------------------------------------------------------------------------------------------------------------------------------------------------------------->
											
											<!-- 게시판 목록 ---------------------------------------------------------------------------------------------------------------------------------------------------------------->
											<?
												$table				= "cs_bbs_data";
												// 리스트갯수
												$listScale			=	$bbs_stat->list_height;
												// 페이지 갯수
												$pageScale		=	$bbs_stat->list_page;
												// 스타트 페이지
												if( !$startPage ) { $startPage = 0; }
												// 토탈페이지
												$totalPage = floor($startPage / ($listScale * $pageScale));
												// 검색
												if( empty($search_item) || $search_item == 0 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
													$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by idx desc, ref desc,re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 1 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%'" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and subject like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 2 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%'" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and content like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 4 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%'" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and name like '%$search_order%' order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 3 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%')" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (subject like '%$search_order%' or content like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 6 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%')" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 5 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%')" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (name like '%$search_order%' or subject like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												} else if( $search_item == 7 ) {
													$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%')" );
													$result		= $db->select( $table, "where code='$code' and notice < 1 $cate_query and (content like '%$search_order%' or name like '%$search_order%' or subject like '%$search_order%') order by idx desc, ref desc, re_step ASC LIMIT $startPage, $listScale" );
												}
												
												// 페이지넘버
												if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
												// 라인색상 초기화
												$colorIndex=0;
												// 답변 화살표
												$arowImage="┗";
												// 루프 시작
												while( $bbs_row = mysqli_fetch_object($result)) {
													//라인색상 초기화
													if($colorIndex%2) $bgColor=$bbs_stat->list_line1; else $bgColor=$bbs_stat->list_line2;
													// 제목
													$subject				=		$bbs_row->subject;
													$name					=		$bbs_row->name;
													// 조회수
													$read_cnt			=		$bbs_row->read_cnt;
													// 작성일
													$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
													// 코멘드 글수
													$coment_cnt		=		$db->cnt("cs_bbs_coment", "where link=$bbs_row->idx");
													//new IMG
													if($bbs_stat->new_check) {$new_img =$page->bbsNewImg( $bbs_row->reg_date, $bbs_stat->new_mark, "<img src='../images/new3.gif' align='absmiddle'>" ); }
													// hit IMG
													if($bbs_stat->cool_check) {$cool_img	=$page->bbsCoolImg( $bbs_stat->cool_mark, $read_cnt, "<img src='../images/hit3.gif' align='absmiddle'>" ); }
													//비밀글
													$hold_img="";
													if($bbs_row->hold==1){
														$hold_img = "<img src='../images/admin_pwicon.gif' align='absmiddle'>";
													}
													// 답변 re image view
													if($bbs_row->re_level > 0){ $wid = 7 * $bbs_row->re_level; $level_img="<img src='../images/level.gif' width=".$wid." height=8 border='0'>$arowImage"."&nbsp;"; } else $level_img="";
													// 게시판 정보 엔코딩
													$bbs_data = $tools->encode("idx=".$bbs_row->idx."&_&startPage=".$startPage."&_&listNo=".$listNo."&_&table=".$table."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".$search_order);
												?>
											<tr>
												<td width="50" height="25" class='sensO tabletd_all'>
												<input type="checkbox"  name="del_list" value="<?=$bbs_row->idx;?>">
												</td>
												<td width="400" height="25" align="left" class='sensP tabletd_all'>
												<?=$level_img?><?=$cool_img?><a href="bbs_view.php?bbs_data=<?=$bbs_data;?>"><?=$db->stripSlash($subject);?></a>&nbsp;<? if($coment_cnt) {?><span class="cp_bk">(<?=$coment_cnt;?>)</span><?}?>&nbsp;<?=$new_img?><?=$hold_img?>
												</td>
												<td width="135" height="25" class='sensO tabletd_all'>
												<?=$name?>
												</td>
												<td width="135" height="25" class='sensO tabletd_all'>
												<?=$reg_date?>
												</td>
												<td width="50" height="25" class='sensO tabletd_all'>
												<?=$read_cnt?>
												</td>
												<!-- 자료실 이미지 출력 -->
												<? if( $bbs_stat->bbs_pds ) {?>
												<td width="30" height="25" align=center class='sensO tabletd_all'>
												<? if( $bbs_row->bbs_file != "none" ) {?><img src="./../images/disk.gif"><?}?>
												</td>
												<? }?>
											</tr>
											<?
											$hot_img=""; $listNo--; $colorIndex++;
											}
											?>
										</table>
										<?}?></form>

										<div class='spaceline02'></div>
										
										<div style='display: block; width:100%; height:40px;text-align:center'><? $page->bbsAdmin( $code, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "이전", "다음", $search_item, urlencode($search_order) ,urlencode($cate));?></div>
										
										<div class='spaceline07'></div>
										
										<div class="oolimbox-wrapper oolimbox-grid2" style='margin:1em;'>	
										
											<article class="oolimbox-col_3dan">
												<a href="javascript:actSelect()" class='oolimbtn-botton3'>선택항목 삭제</a>
											</article>
										
											<article class="oolimbox-col_2dan" style='text-align:right;'>
												<a href="bbs_write.php?bbs_data=<?=$mv_bbs=$tools->encode("idx=".$bbs_row->idx."&_&startPage=".$startPage."&_&listNo=".$listNo."&_&table=".$table."&_&code=".$code."&_&search_item=".$search_item."&_&search_order=".$search_order);?>" class='oolimbtn-botton2'>글쓰기</a>
											</article>
										</div>

										<div class='spaceline07'></div>
										<script language="javascript">
											<!--
											function searchCheck( box) {
												if( box.checked == false ) {
													search_form.search_item.value = eval(search_form.search_item.value) - eval(box.value);
												} else {
													search_form.search_item.value = eval(search_form.search_item.value) +eval(box.value);
												}
											}
											function search(){
												if(search_form.search_subject.checked == false && search_form.search_content.checked == false && search_form.search_name.checked == false)	{
													alert("검색을 체크해 주십시오.");
												} else if(search_form.search_order.value=="")	{
													alert("검색할 내용을 입력해 주십시오.");
													search_form.search_order.focus();
												} else {
													search_form.submit();
												}
											}
											//-->
										</script>

										<table height="28" border="0" align="center">
											<form name="search_form" method="post" action="<?=$_SERVER[PHP_SELF];?>?bbs_data=<?=$bbs_data?>">
											<input type="hidden" name="search_item" value="0">
											<tr>
												<td>
												&nbsp;<input type="checkbox" name="search_subject" value="1" onClick="searchCheck(search_form.search_subject);">제목 <input type="checkbox" name="search_content" value="2" onClick="searchCheck(search_form.search_content);">내용 <input type="checkbox" name="search_name" value="4" onClick="searchCheck(search_form.search_name);">이름 <input name="search_order" type="text" size="15" class="formText">&nbsp;<a href="javascript:search();" class='search_bbs'>검색</a>
												</td>
											</tr>
											</form>
										</table>



										</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						
	</article>
	
</div>



<? include('../footer.php'); ?>
