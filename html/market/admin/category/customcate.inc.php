<table width="100%">
	<tr> 
		<td>
			<table width="100%">
				<tr> 
					<td class="sub_titleM" height="70"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0"><font color='A747BB'>사용자정의 HTML 목록</font>  &nbsp; <?if($u){?><a href="menusort.proc.php?menusort=<?=$u?>" class="menusmall_btn3">위로</a><?}?> <?if($d){?><a href="menusort.proc.php?menusort=<?=$d?>" class="menusmall_btn4">아래</a><?}?></td>
				</tr>
			</table>

			<table width="100%">
				<tr>
					<td style='float:left;' CLASS='noneoolim'><img src="../img/category_list_sp_title2.jpg" class='resize-banner'></td>
				</tr>
				<tr>
					<td style='height:10px;' CLASS='noneoolim'></td>
				</tr>
				<tr>
					<td style='height:60px;text-align:right'><a href="../design/page.php" class='oolimbtn-botton1'>Html페이지관리 바로가기</a></td>
				</tr>
			</table>

			<table width="100%" class="table_all_C">
				<tr align="center" bgcolor="E4E7EF"> 
					<td width="30%" height="35" align="center" class='contenM tabletd_all'>페이지 INDEX</td>
					<td height="35" align="center" class='contenM tabletd_all'>페이지 타이틀</td>
					<td width="20%" class='contenM tabletd_all'>관리</td>
				</tr>
				<?
				$table = "cs_page";
				$list_check = $totalCnt	= $db->cnt( $table, "" );
				$result	= $db->select( $table, "order by idx desc" );
				while( $row = mysqli_fetch_object($result)) {
				?>
				<tr id='calendar_list_tableTD_on'>
					<td height="25" class='tabletd_all tabletd_smallT'><a href="http://<?=$admin_stat->shop_url?>/<?if($row->fixed==1){?>mail_to_admin.php<?}else{?>pageview.php?url=<?=$row->page_index;?><?}?>" target="_new"><?if($row->fixed==1){?>mail_to_admin.php<?}else{?>pageview.php?url=<?=$row->page_index;?><?}?></a></td>
					<td height="25" class='tabletd_all tabletd_Lmall'><?=$row->title;?></td>
					<td height="25" class='tabletd_all tabletd_Lmall'>
						<select name="position" class="input" onChange="javascript:positionchange('<?=$row->idx?>', this.value);">
							<option value="1" <?if($row->position==1){?>selected<?}?>>미적용</option>
							<option value="2" <?if($row->position==2){?>selected<?}?>>상단메뉴</option>
							<option value="3" <?if($row->position==3){?>selected<?}?>>하단메뉴</option>
							<option value="4" <?if($row->position==4){?>selected<?}?>>상.하단모두</option>
						</select>
					</td>
				</tr>
				<?
					$totalCnt--;
				}
				?>
			</table><br>
		</td>
	</tr>
	<tr>
		<td height='30'></td>
	</tr>
	<tr>
		<td bgcolor='#dddddd' height='1'></td>
	</tr>
	<tr>
		<td height='30'></td>
	</tr>
</table>
