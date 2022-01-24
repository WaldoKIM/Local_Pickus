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
	$totalList	= $db->cnt( $table, "where code='$code' and notice < 1 $cate_query" );
	$result		= $db->select( $table, "where code='$code'  and notice < 1 $cate_query order by ref desc,re_step ASC LIMIT $startPage, $listScale" );

	// 페이지넘버
	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
?>
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
					<td align="left">
					<!--셀렉트메뉴-->
					<?if($bbs_admin_stat->category){?>
					
						<?if($bbs_admin_stat->category){?>
						<select class="ui-select" id="sel_01" name='category' size='1' onchange="cate_search(this.value)" style='width:200px'>
						<option value="null">분류선택</option>
						<?
						$B = explode("&&",$bbs_admin_stat->category);
						for($i=0;$i<count($B)-1;$i++){
						?>
						<option value="<?=$B[$i]?>" <?if($B[$i]==$cate){?>selected<?}?>>&nbsp;<?=$B[$i]?></option>
						<?}?>
						</select>
						<?}?>
					<?}?>
					<!--셀렉트메뉴-->
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

<div class="galleriacontent">
	<div id="galleria" style="">
		<?
		// 루프 시작
		$new_cnt = 0; $new_tr = 0; $td_width = $listScale; // 가로리스트 수
		while( $bbs_row = mysqli_fetch_object($result)) {
		$new_cnt++;
		$subject				=		$tools->strCut($bbs_row->subject, 500);
		$name					=		$bbs_row->name;
		$read_cnt			=		$bbs_row->read_cnt;
		$reg_date			=		$tools->strDateCut( $bbs_row->reg_date );
		$coment_cnt		=		$db->cnt("cs_bbs_coment", "where link=$bbs_row->idx");
		
		$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo);
		$ThumbEncode = $tools->encode("idx=".$bbs_row->idx."&table=cs_bbs_data&img=bbs_file&dire=bbsData&w=800&h=490");
		$ThumbEncodes = $tools->encode("idx=".$bbs_row->idx."&table=cs_bbs_data&img=bbs_file&dire=bbsData&w=120&h=80");
		?>
		<a href="thumbnail.img.php?ThumbEncode=<?=$ThumbEncode?>">
			<img src="thumbnail.img.php?ThumbEncode=<?=$ThumbEncodes?>"
			data-big="thumbnail.img.php?ThumbEncode=<?=$ThumbEncodes?>"
			data-title="· <?=$subject?>"
			data-description="<?=strip_tags($bbs_row->content);?>"></a>
		<?}?>
	</div>
	<div>
	<table width="100%">
		<tr>
			<td height="20"></td>
		</tr>
		<tr>
			<td align="center" class="bbs5" style='padding-top:20px;border-top:1px solid #dddddd;'>
			<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "이전", "다음", "", $SEARCH_DATA);?>
			</td>
		</tr>
	</table>
	</div>
</div>

<script>
function cate_search(value) {
	location.href="?board_data=<?=$bbs_data?>&search_items=<?=$SEARCH_DATA2?>&cate="+value;
}

Galleria.loadTheme('../lib/galleria.classic.min.js');
Galleria.run('#galleria');
</script>
		</td>
	</tr>
</table>
