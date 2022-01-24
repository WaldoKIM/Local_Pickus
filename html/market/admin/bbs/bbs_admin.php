<?
include("../header.php");
$notDelboard = array("","faq","qna","notice");
?>

<script language="JavaScript">
<!--
// 삭제
function bbsDel(data) {
	var delCheck = confirm("게시판 정보가 모두 삭제됩니다\n\n삭제 하시겠습니까?");
	if( delCheck ) {
		location.href="bbs_admin_del.php?idx="+data;
	} else  { return; }
}

// 수정
function bbsEdit(data) {
	var editCheck = confirm("게시판 정보를 수정하겠습니까 ?\n\n수정 하시겠습니까?");
	if( editCheck ) {
		 location.href="bbs_admin_edit.php?idx="+data;
	} else  { return; }
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
              <td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">게시판관리</td>
            </tr>
			<tr>
				<td height="1" bgcolor="#666666">
				</td>
			</tr>
			<tr>
				<td height="25">
				</td>
			</tr>
            <tr>
              <td height="5" class="padding_5">
                <table width="100%" bgcolor="white">
                <tr>
                  <td height="35" class='sub_titleM'><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">게시판리스트</td>
                </tr>
                <tr>
                  <td colspan="3" class='noneoolim'>
					<!--도움말-->
						<table width="100%" class='tipbox'>
							<tr>
								<td bgcolor="#E9F2F8">
									<table width="100%">
										<tr>
											<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
										</tr>
										<tr>
											<td>사이트에서 이용할 게시판을 생성, 삭제 하실 수 있습니다. 생성시 권한을 통하여 회원의 등급별 읽기, 쓰기, 삭제 권한을 부여하실 수 있습니다.&nbsp;<br>
											<font color='red'>※ 게시판 이름을 클릭하시면 해당 게시판리스트로 이동합니다.</font><br>
											<font color='red'>※ 기본으로 생성된 게시판은 삭제를 금합니다.</font><br>
											<font color='red'>※ 신규 게시판생성후 메뉴종합관리에서 해당 게시판메뉴를 만들어 줍니다.</font><br>
											<font color='red'><u>※ 게시판생성 완료후 사용자페이지에 보여지게 하기위해서는</font></u> <span class='searchB'>메뉴종합관리 > 메뉴등록(수정) > 링크설정 > 프로그램링크를 선택</span><u><font color='red'>하여 해당 게시판를 링크해주세요.</u></font><br>
											<font color='red'>※ 초기설치시 기본으로 생성된 게시판은 삭제하실수 없습니다. <span class='searchB'>(코드 : qna, photogallery, news, faq, nomalphoto)</span></font><br><font color='blue'>※ 초기생성된 게시판을 사용자페이지에 사용하지 않을시에는 <u>메뉴종합관리에서 해당게시판 사용(유/무)에서 숨김&삭제를 선택</u>해주세요.</font><br><br>
											※ 회사전경게시판은 전용게시판으로 글쓰기/수정/삭제는 관리자 페이지에서만 가능하합니다.<font color='red'>(사용자페이지에서 상세페이지 이동은 없습니다.)</font></td>
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
                <tr>

                  <td valign="top" class="padding_5" width="100%">
                    <p align="right">&nbsp;<a href="bbs_admin_reg.php" class='oolimbtn-botton1'>신규 게시판 추가하기</a></p>
					<table width="100%">
						<tr>
						  <td height="25"></td>
						</tr>
                    </table>
                   <table width="100%" class="table_all">
                    <tr align="center"> 
                      <td bgcolor="#E4E7EF"  class='contenM tabletd_all'  class='contenM tabletd_all'>번호 </td>
                      <td bgcolor="#E4E7EF"  class='contenM tabletd_all'  class='contenM tabletd_all'>이 름[스킨]</td>
                      <td width="80" bgcolor="#E4E7EF"  class='contenM tabletd_all'>코 드</td>
                      <td width="60" bgcolor="#E4E7EF"  class='contenM tabletd_all'>타 입</td>
                      <td width="50" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>자료실</td>
                      <td width="50" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>접근</td>
                      <td width="50" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>쓰기</td>
                      <td width="50" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>읽기</td>
                      <td width="70" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>등록글수</td>
                      <td width="100" bgcolor="#E4E7EF"  class='contenM tabletd_all noneoolim'>관 리</td>
                    </tr>
                    <?
					$i=0; // 번호 초기화
					$result = $db->select("cs_bbs", "order by code asc");
					while( $row = mysqli_fetch_object( $result)) {
						$i++; // 번호 증가
						
						// 게시판 타입출력
						if( $row->bbs_type == 1 ) { $type = "일반형"; } else if( $row->bbs_type == 2 ) { $type = "이벤트형"; }	else if( $row->bbs_type == 3 ) {	$type = "갤러리형"; } 								
						// 자료실 사용유무
						if( $row->bbs_pds ) {	$pds_check = "<img src='../images/bbs_use.gif' align='absmiddle'>"; } else { $pds_check = "<img src='../images/bbs_notuse.gif' align='absmiddle'>"; }								
						// 접근 권한
						if($row->bbs_access==99){
							$access_check = "비공개";
						}else{
							$user_name = $db->object( "cs_user_list", "where idx=$row->bbs_access"); 
							if(!$user_name->name){$access_check = "비회원";}else{$access_check = $user_name->name;}
						}

						// 쓰기 권한
						if($row->bbs_write==99){
							$write_check = "비공개";
						}else{
							$user_name = $db->object( "cs_user_list", "where idx=$row->bbs_write"); 
							if(!$user_name->name){$write_check = "비회원";}else{$write_check = $user_name->name;}
						}
						// 읽기 권한
						if($row->bbs_read==99){
							$read_check = "비공개";
						}else{
							$user_name = $db->object( "cs_user_list", "where idx=$row->bbs_read"); 
							if(!$user_name->name){$read_check = "비회원";}else{$read_check = $user_name->name;}
							$list_cnt_value = $db->cnt("cs_bbs_data", "where code = '$row->code'");
						}

						if($db->cnt("cs_bbs_data", "where code = '$row->code' and TO_DAYS(reg_date)=TO_DAYS(NOW())")) {
							$new_list_img = "&nbsp;&nbsp;" ;
						} else {
							$new_list_img="";
						}
                    ?>                    
                    <tr align="center"> 
                      <td bgcolor="white" class='sensO tabletd_all'><?=$i;?></td>
                      <td bgcolor="white" class='sensP tabletd_all'><a href="bbs_list.php?code=<?=$row->code;?>"><?=$row->name;?></a><?=$new_list_img;?>[<?=$row->skin;?>]<a href="bbs_list.php?code=<?=$row->code;?>" class='searchC noneoolim'>게시판바로가기 <img src="../images/next_w_arrow.png"  border=0></a></td>
                      <td bgcolor="white" class='sensO tabletd_all'><?=$row->code;?></td>
                      <td bgcolor="white" class='sensO tabletd_all'><?=$type;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><?=$pds_check;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><?=$access_check;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><?=$write_check;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><?=$read_check;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><?=$list_cnt_value;?></td>
                      <td bgcolor="white" class='sensO tabletd_all noneoolim'><a href="javascript:bbsEdit(<?=$row->idx;?>);" class="menusmall_btn3">설정</a>&nbsp;<a href="javascript:<?if(!array_search($row->code, $notDelboard)){?>bbsDel(<?=$row->idx;?>)<?}else{?>alert('기본게시판은 삭제하실 수 없습니다.');<?}?>" class="menusmall_btn4">삭제</a></td>
                    </tr>
                    <?}?>                    
                    </table>
                  </td>
                </table>
              </td>
            </tr>
			<tr>
				<td height="40"></td>
			</tr>
			<tr>
				<td class='noneoolim'>
				<!--------페이지정보출력--------->
				<table width="100%">
					<tr>
						<td class='pageinfo_box'>
							<table width="100%">
								<tr>
									<td>
										<p><img src="../img/pageinformation_title.gif" width="118" height="21" border="0"></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px; padding-bottom:5px;">


										<table width="100%">
											<tr>
												<td class='pageinfoB' style="padding:20px;">
													<b class='pageinfoA'>게시판 : 게시판은 기본게시판, FAQ게시판, 일반겔러리게시판, 
													겔러리전용게시판 4개의 스킨이 기본으로 제공됩니다. 
													<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;아래 스킨별로 사용자 임의되로 수정가능합니다.
												</td>
											</tr>
											<tr>
												<td style="padding:20px;">

													<table width="100%">
														<tr>
															<td width="30">
															</td>
															<td style="padding-bottom:5px;" class='pageinfoB'>
																<span class='pageinfoC'>- skin_board1 ( 일반게시판 )<br>&nbsp;&nbsp;&nbsp;http://사용자도매인/board/skin_board1/list.inc.php (게시판리스트),<br> 
																&nbsp;&nbsp;&nbsp;write.inc.php (글쓰기),&nbsp;&nbsp;view.inc.php (글읽기), 
																&nbsp;edit.inc.php (글수정),&nbsp;&nbsp;passwd.inc.php 
																(비밀번호확인)<br>
															</td>
														</tr>
														<tr>
															<td width="30">
															</td>
															<td style="padding-bottom:5px;" class='pageinfoB'>
																<span class='pageinfoC'>- skin_faq ( 자주하는 질문과 답변 전용게시판 )<br>&nbsp;&nbsp;&nbsp;http://사용자도매인/board/skin_board1/list.inc.php (게시판리스트),<br> 
																&nbsp;&nbsp;&nbsp;write.inc.php (글쓰기),&nbsp;&nbsp;view.inc.php (글읽기), 
																&nbsp;edit.inc.php (글수정),&nbsp;&nbsp;passwd.inc.php 
																(비밀번호확인)<br>
															</td>
														</tr>
														<tr>
															<td width="30">
															</td>
															<td style="padding-bottom:5px;" class='pageinfoB'>
																<span class='pageinfoC'>- skin_gallery1 ( 일반겔러리 게시판 )<br>&nbsp;&nbsp;&nbsp;http://사용자도매인/board/skin_board1/list.inc.php (게시판리스트),<br> 
																&nbsp;&nbsp;&nbsp;write.inc.php (글쓰기),&nbsp;&nbsp;view.inc.php (글읽기), 
																&nbsp;edit.inc.php (글수정),&nbsp;&nbsp;passwd.inc.php 
																(비밀번호확인)&nbsp;<br>
															</td>
														</tr>
														<tr>
															<td width="30">
															</td>
															<td style="padding-bottom:5px;" class='pageinfoB'>
																<span class='pageinfoC'>- skin_screengallery (  회사전경 게시판 )<br>&nbsp;&nbsp;&nbsp;http://사용자도매인/board/skin_board1/list.inc.php (게시판리스트),<br> 
																&nbsp;&nbsp;&nbsp;write.inc.php (글쓰기),&nbsp;&nbsp;view.inc.php (글읽기), 
																&nbsp;edit.inc.php (글수정),&nbsp;&nbsp;passwd.inc.php 
																(비밀번호확인)&nbsp;&nbsp;
															</td>
														</tr>
														<tr>
															<td width="30">
															</td>
															<td style="padding-bottom:5px;" class='pageinfoB'>
																<span class='pageinfoC'>- skin_news ( 뉴스전용게시판 )<br>&nbsp;&nbsp;&nbsp;http://사용자도매인/board/skin_news/list.inc.php (게시판리스트),<br> 
																&nbsp;&nbsp;&nbsp;write.inc.php (글쓰기),&nbsp;&nbsp;view.inc.php (글읽기), 
																&nbsp;edit.inc.php (글수정),&nbsp;&nbsp;passwd.inc.php 
																(비밀번호확인)&nbsp;&nbsp;
															</td>
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
				</table>
				<!--------페이지정보출력--------->
			</td>
		</tr>
	</table>
            
	</article>
	
</div>



<? include('../footer.php'); ?>
