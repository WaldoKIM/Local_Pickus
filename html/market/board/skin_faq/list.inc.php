<style type="text/css">
.faq_area .search{width:100%;display:inline-block;position:relative}
.faq_area .search h3.faq_tit{font-size:48px;font-weight:300;letter-spacing:-1px;text-align:center;line-height:1em;font-family:'RixSGo M';float:left}
.faq_area .search form{width:860px;float:right;text-align:left}
.faq_area .search form ul{width:100%;display:inline-block}
.faq_area .search form ul li{width:100%;display:inline-block;position:relative}
.faq_area .search form ul li.check_field{font-size:12pt;margin-top:5px}
.faq_area .search form ul li.check_field input[type=checkbox]{transform:scale(1.3);-webkit-transform:scale(1.3)}
.faq_area .search form ul li.check_field label{display:inline-block;margin:0 15px 0 3px}
.faq_area .search form ul li.enter_field input{width:100%;box-sizing:border-box;padding:15px 50px 11px 15px;border:3px solid #000;font-size:12pt;outline:none}
.faq_area .search form ul li.enter_field a{position:absolute;right:20px;font-size:28px;top:50%;margin-top:-14px;line-height:1em;color:#000}
.faq_area .category{width:100%;text-align:left;display:inline-block;margin:40px 0 15px 0;position:relative}
.faq_area .category .now_cate{display:none}
.faq_area .category ul{width:100%;display:inline-block}
.faq_area .category ul li{display:inline-block;vertical-align:middle}
.faq_area .category ul li a{font-size:11pt;color:#222}
.faq_area .category ul li.line{font-size:10pt;color:#ccc;margin:0 15px}
.faq_area .faq_data{width:100%;display:inline-block;border-top:3px solid #222;text-align:left}
.faq_area .faq_data div.content-collapse_sens{border-bottom:1px solid #ccc;box-sizing:border-box}
.faq_area .faq_data div.content-collapse_sens a{display:inline-block;cursor:pointer;padding:10px;font-size:10pt}
.faq_area .faq_data div.content-collapse_sens a#calendar_list_tableTD_on:hover{background:none;color:#3684c6}
.faq_area .faq_data div.content-collapse_sens.open_sens a#calendar_list_tableTD_on{background:none!important}
.faq_area .faq_data div.content_sens{padding:20px 30px;background:#f8f8f8;box-sizing:border-box;display:none;border-top:1px solid #ccc;font-size:10pt}
@media all and (max-width:1200px){
	.faq_area .search h3.faq_tit{width:100%;margin-bottom:20px}
	.faq_area .search form{width:100%}
}
@media all and (max-width:840px){
	.faq_area .search{margin:25px 0}
	.faq_area .search h3.faq_tit{display:none}
	.faq_area .search form{width:100%}
	.faq_area .search form ul li.enter_field input{font-size:1.4em}
	.faq_area .search form ul li.enter_field a{font-size:2em;right:2%}
	.faq_area .category{margin:0 0 15px 0}
	.faq_area .category ul li a{font-size:1.4em}
	.faq_area .faq_data div.content-collapse_sens a{font-size:1.4em}
	.faq_area .faq_data div.content_sens{font-size:1.4em}
}
</style>

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
		if(bbs_search_form.search_order.value=="")	{
			alert("검색할 내용을 입력해 주십시오.");
			bbs_search_form.search_order.focus();
		} else {
			bbs_search_form.search_item.value = '7';
			bbs_search_form.submit();
		}
	}

	function cate_search(value) {
		location.href="?board_data=<?=$bbs_data?>&search_items=<?=$SEARCH_DATA3?>&cate="+value;
	}
	//-->
</script>
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
?>
<? if($bbs_admin_stat->header != "NULL") { ?><?=$bbs_admin_stat->header;?><? }?>
<!--faq출력-->
<div class="faq_area">
	<!--검색-->
	<div class="search">
		<h3 class="faq_tit">FAQ</h3>
		<form name="bbs_search_form" method="get" action="?">
			<input type="hidden" name="search_item" value="0">
			<input type="hidden" name="board_data" value="<?=$bbs_data?>">
			<input type="hidden" name="search_items" value="<?=$SEARCH_DATA?>">
			<ul>
				<li class="enter_field">
					<input name="search_order" type="text" placeholder="검색 후 문의가 해결되지 않으면 1:1 상담을 이용하세요." value="<?=$search_order?>">
					<a href="javascript:search();"><i class="fas fa-search"></i></a>
				</li>
				<li class="check_field" style="display:none;">
					<input type="checkbox" name="search_subject" value="1" onClick="searchCheck(bbs_search_form.search_subject);"><label>제목</label>
					<input type="checkbox" name="search_content" value="2" onClick="searchCheck(bbs_search_form.search_content);"><label>내용</label>
					<input type="checkbox" name="search_name" value="4" onClick="searchCheck(bbs_search_form.search_name);"><label>이름</label>
				</li>
			</ul>
		</form>
	</div>
	<!--//검색-->
	<!--Category-->
	<?if($bbs_admin_stat->category){?>
	<div class='category'>
		<ul>
			<li><a href="javascript:cate_search('')" class="select">전체</a></li>
			<?
			$B = explode("&&",$bbs_admin_stat->category);
			for($i=0;$i<count($B)-1;$i++){
			if($B[$i]!=$cate){
				$new_cnt++;
			?>
			<li class="line">|</li>
			<li><a href="javascript:cate_search('<?=$B[$i]?>')"><?=$B[$i]?></a></li>
			<?}}?>
		</ul>
	</div>
	<?}?>
	<!--//Category-->


	<div class="faq_data">
		<?
		// 페이지넘버
		if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
		// 라인색상 초기화
		$colorIndex=0;
		// 답변 화살표
		$arowImage="┗";
		// 루프 시작
		while($bbs_row = mysqli_fetch_object($result)) {
			$bbs_data = $tools->encode("idx=".$bbs_row->idx."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&code=".$code."&search_item=".$search_item."&search_order=".$search_order);
		?>
		<div class="content-collapse_sens">
			<!--질문-->
			<a data-toggle id='calendar_list_tableTD_on'><span style='display:inline-block;'><?=$db->stripSlash($bbs_row->subject);?></span></a>
			<div class="content_sens" id="faq<?=$bbs_row->idx?>">
			<!--답변-->
			<?=$db->stripSlash($bbs_row->content)?>
			</div>
		</div>
		<?}?>
	</div>

	<table border="0" width="100%">
		<tr>
			<td height='20'></td>
		</tr>
		<tr>
			<td align="center" height='55'>
				<? $page->board( $totalPage, $totalList, $listScale, $pageScale, $startPage, "", "이전", "다음", "", $SEARCH_DATA);?>
			</td>
		</tr>
	</table>
</div>
<script>
	contentCollapse.init();
</script>	
