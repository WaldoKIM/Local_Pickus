<?
//가로 줄 상수
$WIDTHCNT = 4;

$searchSQL .= " and code='$code'";
$Arr_search_item = array();
if($search_item){
	$searchSQL .= " and concat($search_item) like '%$search_order%'";
	$Arr_search_item = explode(",",",".$search_item);
}
if($cate){
	$cate_query = " and category='$cate'";
}
?>
<script language="javascript">
	<!--
	function cate_search(value) {
		location.href="?board_data=<?=$bbs_data?>&search_items=<?=$SEARCH_DATA2?>&cate="+value;
	}
	//-->
</script>
<script type="text/javascript">
function ajaxitem(bbs_data, search_data){
	ajaxitemlist(bbs_data, search_data);
	ajaxitempage(bbs_data, search_data);
}

function ajaxitemlist(bbs_data, search_data){
	$.ajax({
		type: "GET",
		url: "ajax_bbs_list.php",
		data: "search_items="+search_data+"&board_data="+ bbs_data, 
		cache: false,
		success: function(html)
		{
			$("div#isotope_container2").append(html);
		}
	});
}

function ajaxitempage(bbs_data, search_data){
	$.ajax({
		type: "GET",
		url: "ajax_bbs_page.php",
		data: "pagename=bbs_list.php&search_items="+search_data+"&board_data="+ bbs_data, 
		cache: false,
		success: function(html)
		{
			$("div#isotope_container3").html(html);
		}
	});
}

window.onload = function () {
	ajaxitem('<?=$mv_data?>', '<?=$SEARCH_DATA?>');
}
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
</table>
<hr />
<div id="isotope_container2" class="masonry-layout" style='margin:0 auto;width:100%;'>
	<!-- 아작내용 출력 -->
</div>
<!--isotope_container-->

<div class='spacelin11'></div>

<!-- 더보기 및 페이징 출력 -->

<div id="isotope_container3" style='margin:0 auto;width:100%;'>


</div>



<span class="brand_default_width" style="display: none; visibility: hidden;"></span>



<div>
<div class='spaceline12'></div>


<table width="100%">
	<tr>
		<td>
		<table width="100%">
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
		</td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td align="center">
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
				if(bbs_search_form.search_item.value == "")	{
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
		<table style='margin:0 auto;'>
			<form name="bbs_search_form" method="get" action="?">
			<input type="hidden" name="search_item" value="0">
			<input type="hidden" name="board_data" value="<?=$bbs_data?>">
			<input type="hidden" name="search_items" value="<?=$SEARCH_DATA?>">
			<tr>
				<td style='text-align:center;font-size:10pt;color:#333'>
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
</div>
<!-- 내용출력 끝 //-->

