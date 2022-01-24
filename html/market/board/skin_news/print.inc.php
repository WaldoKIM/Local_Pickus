<?	// 게시판 접근 권한 설정
	$bbs_stat			= $db->object("cs_bbs_data", "where idx=$idx");
	
	$name			= $bbs_stat->name;
	$email			= $bbs_stat->email;
	$reg_date	= $tools->strDateCut($bbs_stat->reg_date, 4);
	$subject		= $bbs_stat->subject;
	
	// 내용 출력 방식
	$content		= $bbs_stat->content;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
		<!----------게시판뷰상단콘텐츠----------->
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td height="1" bgcolor="#818181">
						</td>
					</tr>
					<tr>
						<td height="30" style="padding-right:10px; padding-left:14px; padding-top:3px;">
						<p class="bbs_newsA"><b><?=$db->stripSlash($subject);?></p>
						</td>
					</tr>
					<tr>
						<td height="25" style="padding-right:10px; padding-left:10px; padding-top:3px;">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="20%">
								<p><span class="bbs1"><img src='images/left_menu_icon_off.gif' border='0' align='absmiddle'>작성일 : </span>&nbsp;<span class="bbs3"><?=$reg_date;?></span></p>
								</td>
								<td class="bbs1">
								<p><img src='images/left_menu_icon_off.gif' border='0' align='absmiddle'>작성자 : <font color='959595'><?=$name;?></font> <? if( $email != "NULL") { ?><a href="mailto:<?=$email?>" onMouseOver="javascript:window.status='메일';return true;"><img src="images/icon_mail.gif" border="0"></a><?}?></p>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td height="1" bgcolor="#BEBEBE">
						</td>
					</tr>
					<tr>
						<td height="2" bgcolor="#EFEFEF">
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		<!----------게시판뷰상단콘텐츠---------->
		</td>
	</tr>
	<tr>
		<td height='10'>
		</td>
	</tr>
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="menu">
			<!-- 파일이 그림일 경우 출력(gif/jpg) -->
			<?
				$add_file = explode( ".", $bbs_stat->bbs_file );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->bbs_file);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','')"><img src="../data/bbsData/<?=$bbs_stat->bbs_file;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<!-- 파일이 그림일 경우 출력(gif/jpg) 1-->
			<?
				$add_file = "";
				$add_file = explode( ".", $bbs_stat->add_file1 );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->add_file1);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','1')"><img src="../data/bbsData/<?=$bbs_stat->add_file1;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<!-- 파일이 그림일 경우 출력(gif/jpg) 2-->
			<?
				$add_file = "";
				$add_file = explode( ".", $bbs_stat->add_file2 );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->add_file2);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','2')"><img src="../data/bbsData/<?=$bbs_stat->add_file2;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<!-- 파일이 그림일 경우 출력(gif/jpg) 3-->
			<?
				$add_file = "";
				$add_file = explode( ".", $bbs_stat->add_file3 );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->add_file3);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','3')"><img src="../data/bbsData/<?=$bbs_stat->add_file3;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<!-- 파일이 그림일 경우 출력(gif/jpg) 4-->
			<?
				$add_file = "";
				$add_file = explode( ".", $bbs_stat->add_file4 );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->add_file4);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','4')"><img src="../data/bbsData/<?=$bbs_stat->add_file4;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<!-- 파일이 그림일 경우 출력(gif/jpg) 5-->
			<?
				$add_file = "";
				$add_file = explode( ".", $bbs_stat->add_file5 );
				if( strtolower($add_file[1]) == "gif" || strtolower($add_file[1]) == "jpg" ) {
					$view_img = @getimagesize("../data/bbsData/".$bbs_stat->add_file5);
					if(  $view_img[0] > 600 ) {$view_img_width	= "width=600"; }
				?>
			<tr>
				<td height="25" align="center">
				<a href="javascript:img_view('<?=$MV_DATA;?>','5')"><img src="../data/bbsData/<?=$bbs_stat->add_file5;?>" <?=$view_img_width;?> border='0'></a>
				</td>
			</tr>
			<tr>
				<td height="15" align="center">
				</td>
			</tr>
			<?}?>
			<tr>
				<td align="center" style="padding-top:10px; padding-bottom:10px;">
				<table width="680" border="0" cellspacing="0" cellpadding="0">
					<tr height='200' valign='top'>
						<td width="680" id="fontSzArea">
						<?=$db->stripSlash($content);?>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="1" bgcolor="#818181">
		</td>
	</tr>
	<tr>
		<td colspan="2" height="2" bgcolor="#EFEFEF">
		</td>
	</tr>
</table>
