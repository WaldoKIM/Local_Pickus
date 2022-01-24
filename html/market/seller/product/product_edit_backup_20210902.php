<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');

$admin_row = $db->object("cs_admin", "", "express_check");
$mv_data	= $_GET[board_data];
$board_data	= $tools->decode( $_GET[board_data] );

$MV_SEARCH_ITEM	= $_GET[search_items];
$row = $db->object("cs_goods", "where idx='$board_data[idx]'");
// 카테고리 이름 출력
$part_stat_row = $db->object("cs_part", "where idx='$row->part_idx'");
if( $part_stat_row->part_index == 1 ) {
	$part_result = $db->select("cs_part", "where part1_code='$part_stat_row->part1_code' && part_index=1 order by idx asc", "part_name");
} else if( $part_stat_row->part_index == 2 ) {
	$part_result = $db->select("cs_part", "where (part1_code='$part_stat_row->part1_code' && part_index=1) || (part2_code ='$part_stat_row->part2_code' && part_index=2) order by idx asc", "part_name");
} else if( $part_stat_row->part_index == 3 ) {
	$part_result = $db->select("cs_part", "where (part1_code='$part_stat_row->part1_code' && part_index=1) || (part2_code ='$part_stat_row->part2_code' && part_index=2) || (part3_code='$part_stat_row->part3_code' && part_index=3) order by idx asc", "part_name");
}
$i=0;
while( $part_row = @mysqli_fetch_object( $part_result )) {
	$i++;
	$part_name.=$i."차 카테고리 : <font color='#FF0000'>".$part_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
	
// 이미지 사이즈 
$goods_images1_size=@getimagesize("../../data/goodsImages/$row->images1");
$goods_images1_width=$goods_images1_size[0]; $goods_images1_height=$goods_images1_size[1];
$goods_images2_size=@getimagesize("../../data/goodsImages/$row->images2");
$goods_images2_width=$goods_images2_size[0]; $goods_images2_height=$goods_images2_size[1];
if( $row->add_images1 ) { $goods_add_images1_size=@getimagesize("../../data/goodsImages/$row->add_images1");$goods_add_images1_width=$goods_add_images1_size[0]; $goods_add_images1_height=$goods_add_images1_size[1];}
if( $row->add_images2 ) { $goods_add_images2_size=@getimagesize("../../data/goodsImages/$row->add_images2");	$goods_add_images2_width=$goods_add_images2_size[0]; $goods_add_images2_height=$goods_add_images2_size[1];}
if( $row->add_images3 ) { $goods_add_images3_size=@getimagesize("../../data/goodsImages/$row->add_images3");	$goods_add_images3_width=$goods_add_images3_size[0]; $goods_add_images3_height=$goods_add_images3_size[1];}
if( $row->add_images4 ) { $goods_add_images4_size=@getimagesize("../../data/goodsImages/$row->add_images4");	$goods_add_images4_width=$goods_add_images4_size[0]; $goods_add_images4_height=$goods_add_images4_size[1];}
if( $row->add_images5 ) { $goods_add_images5_size=@getimagesize("../../data/goodsImages/$row->add_images5");	$goods_add_images5_width=$goods_add_images5_size[0]; $goods_add_images5_height=$goods_add_images5_size[1];}


$optArr = explode("/^CUT/^", $row->opt_data);
$icontemp = explode(",",",".$row->iconidx);
$substtemp = explode(",",",".$row->substimg);

?>
<script language="javascript">
<!--
//// 데이타 배송 시작 ///////////////////////////////////////////////////////////////////////////////////////////
// 수량 입력 폼 체크
function goodsUnlimit() {	if( document.goods_form.unlimit.checked == true ) { document.goods_form.number.value = ""; }}
function goodsNumber() { document.goods_form.unlimit.checked  = false; }

var opt_cnt = <?=count($optArr)-1?>;

//무한 옵션 ---------------------------
function mycreate() {
	if(opt_cnt > 29){
		alert('옵션은 최대 30개까지 가능합니다.');
	}else{
		document.getElementsByName("option_list")[opt_cnt].style.display="";
		opt_cnt++;
	}
} 

function myremove(n) { 
	var len,obj_input, obj_name, obj_part, elmidxValue = n;
	var choice = confirm( '옵션을 삭제 하시겠습니까?');
	if(choice) {
		document.getElementsByName("option_list")[n].style.display="none";
		obj_input = document.forms['goods_form']['optList[]'][elmidxValue];
		obj_name =	document.forms['goods_form']['optName[]'][elmidxValue];
		obj_part = document.forms['goods_form']['option_part[]'][elmidxValue];

		obj_input.value = "";
		obj_name.value = "";
		for ( i = obj_part.length; i >= 0; i-- ) {
			obj_part[i] = null;
		}
	}else { return; }
} 
//무한 옵션 ---------------------------


// 옵션 데이타 입력
function dataInput() {
	var form=document.goods_form;
	for(var j=0;j<document.goods_form.option_input.length;j++){
		document.forms['goods_form']['hidden_option_data[]'][j].value="";
		for(var data_cnt=0; data_cnt < document.forms['goods_form']['option_part[]'][j].length; data_cnt ++) {
			document.forms['goods_form']['hidden_option_data[]'][j].value =document.forms['goods_form']['hidden_option_data[]'][j].value + document.forms['goods_form']['option_part[]'][j].options[data_cnt].value;
			document.forms['goods_form']['hidden_option_data[]'][j].value= document.forms['goods_form']['hidden_option_data[]'][j].value + "&&";
		}

	}
}


function sendit() {
	var form=document.goods_form;
	form.content.value = myeditor.outputBodyHTML();
	dataInput(); // 옵션 데이타체크
	if(form.name.value=="") {
		alert("상품 이름을 입력해 주세요.");
		form.name.focus();
	} else if( form.company.value=="" ) {
		alert("제조회사를 입력해주세요.");
		form.company.focus();
	} else if( form.old_price.value=="" ) {
		alert("시중가격을 입력해주세요.");
		form.old_price.focus();
	} else if( form.shop_price.value=="" ) {
		alert("판매할 가격을 입력해주세요.");
		form.shop_price.focus();
	} else if( form.unlimit.checked == false && form.number.value == "" ) {
		alert("판매할 수량을 선택해주세요.");
		form.number.focus();
	} else if(form.unlimit.checked && form.number.value){
		alert("판매수량의 무제한과 수량입력중  하나만 입력해주세요.");
		form.number.focus();
<? if( $admin_row->express_check==2 ) { ?>
	} else if( form.box.value=="" ) {
		alert("배송가중치 입력해주세요.");
		form.box.focus();
<? } ?>
	} else if( form.content.value=="" ) {
		alert("상품의 상세 정보를 입력해주세요.");
		form.content.focus();
	} else {
		form.submit();
	}
}
//// 데이타 배송 종료 //////////////////////////////////////////////////////////////////////////////////////////

function goodsImagesView( check, w, h ){
	window.open("product_images_view.php?goods_data=<?=$mv_data?>&images_check="+check,"","scrollbars=no,width="+w+",height="+h+",top=200,left=200");
}


//// 옵션관련 시작 //////////////////////////////////////////////////////////////////////////////////////////////
//선택시 수정항목에 미리 뿌려주기
function targettxt(value, elmidxValue){
	txtsub = value.split(":");
	if(txtsub.length>1){
		document.forms['goods_form']['optList[]'][elmidxValue].value = txtsub[0];
		document.forms['goods_form']['optPrice[]'][elmidxValue].value = txtsub[1];
	}else{
		document.forms['goods_form']['optList[]'][elmidxValue].value = value;
		document.forms['goods_form']['optPrice[]'][elmidxValue].value = "";
	}
}

// 옵션 추가
function optionInput(n){
	var len,obj_input, obj_name, obj_part, elmidxValue = n;
	obj_input = document.forms['goods_form']['optList[]'][elmidxValue];
	obj_name =	document.forms['goods_form']['optName[]'][elmidxValue];
	obj_price =	document.forms['goods_form']['optPrice[]'][elmidxValue];
	obj_part = document.forms['goods_form']['option_part[]'][elmidxValue];

	if(obj_name.value.length < 1) {	alert("옵션명을 입력하여야 합니다."); obj_name.focus(); return; }
	if(obj_input.value.length < 1) { alert("옵션내용을 입력하여야 합니다."); obj_input.focus(); return; }
	len = obj_part.length;
	obj_part.length = len+1;
	if(obj_price.value.length>1){
		obj_part.options[len].value = obj_input.value+":"+obj_price.value;
		obj_part.options[len].text = obj_input.value+":"+obj_price.value;
	}else{
		obj_part.options[len].value = obj_input.value;
		obj_part.options[len].text = obj_input.value;
	}
	obj_input.value=obj_price.value="";
	obj_input.focus();
}

// 옵션 수정
function optionEdit(n){
	var len,obj_input, obj_name, obj_part, elmidxValue = n;

	obj_input = document.forms['goods_form']['optList[]'][elmidxValue];
	obj_name =	document.forms['goods_form']['optName[]'][elmidxValue];
	obj_price =	document.forms['goods_form']['optPrice[]'][elmidxValue];
	obj_part = document.forms['goods_form']['option_part[]'][elmidxValue];

	if(obj_part.selectedIndex < 0){
		alert("수정할 대상을 선택하여 주세요.");
	}else{
		if(obj_name.value.length < 1) {	alert("옵션명을 입력하여야 합니다."); obj_name.focus(); return; }
		if(obj_input.value.length < 1) { alert("옵션내용을 입력하여야 합니다."); obj_input.focus(); return; }
		len = obj_part.length;

		thisIndex = obj_part.selectedIndex;

		if(obj_price.value.length>1){
			obj_part.options[thisIndex].value = obj_input.value+":"+obj_price.value;
			obj_part.options[thisIndex].text = obj_input.value+":"+obj_price.value;
		}else{
			obj_part.options[thisIndex].value = obj_input.value;
			obj_part.options[thisIndex].text = obj_input.value;
		}
		obj_input.value="";
		obj_price.value="";
		obj_input.focus();
	}
}

// 옵션 삭제
function optionDel(n){
	var len,obj_input, obj_name, obj_part, elmidxValue = n;

	obj_part = document.forms['goods_form']['option_part[]'][elmidxValue];

	var obj_now = obj_part.selectedIndex;//현재 리스트 객체
	if (obj_now==-1){
		alert("삭제할 옵션내용을 선택하세요.");
		return;
	}
	obj_part.options[obj_part.selectedIndex] = null;
}

//// 옵션관련 종료 //////////////////////////////////////////////////////////////////////////////////////////////

// 추가 이미지
function addImagesCheck() {
	var form=document.goods_form;
	if( form.add_images_check.checked ) {
		document.all.add_images_view.style.display=""; 
	} else {
		document.all.add_images_view.style.display="none"; 	
	}
}
// 첨부파일
function fileCheck() {
	var form=document.goods_form;
	if( form.file_check.checked ) {
		document.all.file_view.style.display=""; 
	} else {
		document.all.file_view.style.display="none"; 
	}
}
//// 입력 품 VIEW 체크  종료 //////////////////////////////////////////////////////////////////////////////


////  웹FTP 새창 오픈  시작 ///////////////////////////////////////////////////////////////////////////////
function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}
////  웹FTP 새창 오픈  종료 /////////////////////////////////////////////////////////////////////////////////


////  TEXTAREA 입력 폼 크기 조정 시작 /////////////////////////////////////////////////////////////////
function textarea_resize( formname, size ) {
	if( size=='reset' ){
		formname.rows = 10;
	}else{
		var value = formname.rows + size;
		if(value>9) formname.rows = value;
		else return;
	}
}

//항목 추가하기
	function fieldlistAdd(){
		var target;
		for(i=0;i<<?=$DEFAULTADDFIELD?>;i++){
			if(document.getElementsByName("addlist")[i].style.display==""){
				target = i;
			}
		}
		if(target>=0){
			target = target+1;
		}else if(!target){
			target = 0;
		}

		if(target==15){
			alert("항목은 15개까지 가능합니다.");
		}else{
			document.getElementsByName("addlist")[target].style.display="";
		}
	}

	//항목 제거하기
	function fieldlistRemove(){
		var target;
		for(i=0;i<<?=$DEFAULTADDFIELD?>;i++){
			if(document.getElementsByName("addlist")[i].style.display==""){
				target = i;
			}
		}
		document.forms['goods_form']['fieldname[]'][target].value = "";
		document.forms['goods_form']['fielddata[]'][target].value = "";
		document.getElementsByName("addlist")[target].style.display="none";
	}

	function resizecheck(){
		if(document.forms['goods_form'].resize.checked==true){
			document.getElementById("itemimg1").style.display="none";
			document.getElementById("itemimg2").style.display="none";
		}else{
			document.getElementById("itemimg1").style.display="";
			document.getElementById("itemimg2").style.display="";
		}
	}

function subitemuse(){
	if(document.forms['goods_form']['subitemtarget'][0].checked==false){
		document.getElementById("subitemsystem").style.display="";
	}else{
		document.getElementById("subitemsystem").style.display="none";
	}
}

// 관련상품 순위 변경 ( up or down )
function  subitemmove(index,to) {
	var list = index;
	var total = list.length-1;
	var index = list.selectedIndex;

	if (to == +1 && index == total) return false;
	if (to == -1 && index == 0) return false;

	var items = new Array;
	var values = new Array;

	for (i = total; i >= 0; i--) {
		items[i] = list.options[i].text;
		values[i] = list.options[i].value;
	}

	for (i = total; i >= 0; i--) {
		if (index == i) {

			alert
			list.options[i + to] = new Option(items[i],values[i], 0, 1);
			list.options[i] = new Option(items[i + to], values[i + to]);
			i--;
		}
		else
		{
			list.options[i] = new Option(items[i], values[i]);
		}
	}

	get_result();
}

function gruopChange(){
	for ( i = document.all['subitems'].length; i >= 0; i-- ) {
		document.all['subitems'][i] = null;
	}
	dynamic.location.href = "dir.select.php?searchtxt="+document.all.searhtxt.value+"&part_idx="+document.all.subcate.value;
}

function gor() 
{ 
	j=document.goods_form.subitemslist.length;
    for(var i=0;i<document.goods_form.subitems.length;i++)    { 
        if(document.goods_form.subitems.options[i].selected && document.goods_form.subitems.options[i].value){ 
        document.goods_form.subitems.options[i].selected=false; 
        chk_same=0; 
            for(var k=0;k<document.goods_form.subitemslist.length;k++){ 
                if(document.goods_form.subitems.options[i].value==document.goods_form.subitemslist.options[k].value){ 
				  chk_same=1;                 
                }     
            }             

            if(!chk_same){ 
            document.goods_form.subitemslist.options[j]=new Option(document.goods_form.subitems.options[i].text,document.goods_form.subitems.options[i].value); 
            j++; 
            } 
        } 
    } 
	get_result() 
}
	
function gol(){ 
	buff=new Array(); 
	j=0; 
    for(var i=document.goods_form.subitemslist.length-1;i>=0;i--){ 
        if(document.goods_form.subitemslist.options[i].selected && document.goods_form.subitemslist.options[i].value){ 
			document.goods_form.subitemslist.options[i] = null; 
        } 
    } 
	get_result()
} 

function get_result(){ 
	eventlist=new Array(); 
    for(var i=0;i<document.goods_form.subitemslist.length;i++){ 
		eventlist[i]=document.goods_form.subitemslist.options[i].value; 
    } 
	eventlist=eventlist.join(","); 
	document.goods_form.itemlist.value=eventlist;
} 

function ajaxArea2(data){
	$.ajax({
		type: "GET",
		url: "ajax_area2.php",
		data: "area1="+ data, 
		cache: false,
		success: function(html)
		{
			$("select#area2").html(html);
		}
	});
}

function inputArea() {
	var form=document.goods_form;
	if(form.area2.value == ""){
		alert("지역을 선택해 주세요.");
	}else if(form.area.value.indexOf(form.area1.value + " " +form.area2.value) != -1){
		alert("이미 선택한 지역입니다.");
	}else if( form.area.value == "") {
		form.area.value=form.area1.value + " " +form.area2.value; 
	} else {
		form.area.value= form.area.value + ", " + form.area1.value + " " + form.area2.value; 
	}
}
function delArea(data) {
	var form=document.goods_form;
	if(data == 1){
		form.area.value= "";
	}else{
		form.area.value= "<?=$row->area;?>";
	}
}
//-->
</script>
<?=$addButton?>
<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/product_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">
		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">상품관리</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
				
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
									<form action="product_edit_ok.php" method="post" name="goods_form" enctype="multipart/form-data">
									<input type="hidden" name="board_data" value="<?=$mv_data;?>">
									<input type="hidden" name="search_items" value="<?=$MV_SEARCH_ITEM;?>">
									<input type="hidden" name="returnurl" value="<?if($_GET[returnurl]){ echo $_GET[returnurl];}else{ echo "product_list.php";}?>">
									<tr> 
										<td  bgcolor="#FFFFFF" class="menu">
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품기본설정</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgcolor="E4E7EF"> 
													<td height="25"  align="center" class='contenM tabletd_all'>카테고리 이름</td>
													<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<?=$part_name;?> </td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>진열대 출력</td>
													<td class='tabletd_all tabletd_small'><input name="display" type="radio" value="1" <? if( $row->display == 1) { echo("checked");}?>>예&nbsp;<input name="display" type="radio" value="0" <? if( $row->display == 0 ) { echo("checked");}?>>아니오&nbsp;&nbsp;(상품 전시 판매 유무 설정합니다.)</td>
												</tr>			
											</table><br>
										</td>
									</tr>
									<tr height="1"> 
										<td height="35"></td>
									</tr>
									<tr> 
										<td height="75" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품정보</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>상품코드</td>
													<td class='tabletd_all tabletd_small'><input name="code" type="text" maxlength="20" size="20" class="formText" value="<?=$row->code;?>" <?=$style->colorAlign("#666666 ", 0);?> readOnly>&nbsp;(상품 코드는 수정 불가능합니다.)</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>상품명</td>
													<td height="25" class='tabletd_all tabletd_small'><input name="name" type="text" class="formText" value="<?=$db->stripSlash($row->name);?>">&nbsp;(100자 안으로 작성)</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>모델명</td>
													<td height="25" class='tabletd_all tabletd_small'><input name="model_name" type="text" class="formText" value="<?=$db->stripSlash($row->model_name);?>">&nbsp;(100자 안으로 작성)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>태그</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="tag" type="text"  style="width:90%;" class="formText" value="<?=$row->tag;?>"></td>
												</tr>
												<?/*
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>간략한설명</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:50px'><textarea name="description" style='height:50px'><?=$row->description;?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>
													</td>
												</tr>
												*/?>
												<tr bgColor="white"> 
													<td  bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>제조회사</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="company" type="text"  class="formText" value="<?=$row->company;?>">&nbsp;제조 및 판매회사를 적어 주세요</font></td>
												</tr>
												<tr bgColor="white" style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>가격대체</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="subst" type="checkbox" value="1" <?if( $row->subst==1) { echo("checked");}?>>&nbsp;가격표기를 대체할 문구 및 아이콘 설정합니다. <font color="red">- 설정시 구매 불가능합니다.</font></td>
												</tr>
												<tr bgColor="white" style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>대체문구</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="substtxt" type="text" class="formText" value="<?=$row->substtxt;?>">&nbsp;가격대신 표기됩니다.</td>
												</tr>
												<tr bgColor="white" style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>대체아이콘</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<?
														$notice_result		= $db->select("cs_icon_list", "where code=2 order by idx asc" );
														while( $iconRow = mysqli_fetch_object($notice_result) ) {
														?>
															<input type=checkbox name='substimg[]' value='<?=$iconRow->idx?>' <?if(array_search($iconRow->idx,$substtemp)) echo "checked";?>> <img src="../../data/designImages/<?=$iconRow->icon?>" alt="<?=$iconRow->name?>">&nbsp;
														<?}?>
														<br><font color='red'>대체문구와 중복사용 가능합니다.</font>
													</td>
												</tr>
												<tr bgColor="white" style="display:none;"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>시중가격</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="old_price" type="text"  class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="<?=$row->old_price;?>">&nbsp;원&nbsp;&nbsp;(시중가격을 입력해주세요)</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>판매가격</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="shop_price" type="text"  class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="<?=$row->shop_price;?>">&nbsp;원&nbsp;&nbsp;(판매할 상품 가격을 입력해주세요)</td>
												</tr>
												
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>배송비</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="deliv_fee" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="<?=$row->deliv_fee;?>" >&nbsp;원&nbsp;&nbsp;(배송비를 입력해주세요. 미 입력시 무료배송)</td>
												</tr>
												
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>지역선택</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<select name="area1" onchange="ajaxArea2(this.value);" class="formSelect">
															<option value="">선택</option>
															<?
																$area1_result = $db->select("g5_estimate_area1","order by idx asc");
																while( $area1_row = @mysqli_fetch_object($area1_result) ) {
															?>
																<option value="<?=$area1_row->area1;?>"><?=$area1_row->area1;?></option>
															<?}?>
														</select>														
														<select id="area2" name="area2" class="formSelect">
															<option value="">선택</option>
															<!-- AJAX 내용 출력 -->
														</select> <a href="javascript:inputArea();" class="btn_guide1">선택</a>	
														<br>
														<input name="area" type="text" class="formText" style="width:90%;" value="<?=$row->area;?>" placeholder="미입력시 전국으로 표시" readonly >
														<br>
														<a href="javascript:delArea();" class="btn_guide2">초기화</a>
														<a href="javascript:delArea(1);" class="btn_guide1">비우기</a>	
													</td>
												</tr>
												
												<tr bgColor="white"  style="display:none;" > 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>묶음배송 제외</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="deliv_exc" type="checkbox" class="formText" value="1" <?=$style->align(2);?> <?=$style->strCheck(0);?> <?if($row->deliv_exc){echo "checked";}?>></td>
												</tr>												
												<tr bgColor="white" style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>최소구매수량</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="mincnt" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="<?=$row->mincnt?>">&nbsp;(설정한 수량 이상 구매가능합니다.)</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="13" align="center" class='contenM tabletd_all'>판매수량</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="unlimit" type="checkbox" value="1" onClick="goodsUnlimit()" <? if( $row->unlimit == 1) { echo("checked");}?>>무제한&nbsp;<input name="number" type="text" maxlength="11" size="11"  class="formText" <?=$style->align(2);?> <?=$style->strCheck(0);?>  onClick="goodsNumber()" value="<? if( !$row->unlimit ) { echo($row->number);} ?>">&nbsp;개&nbsp;&nbsp; (재고량이 없는 경우 0를 입력해 주세요[중지표시])</td>
												</tr>
												<tr bgColor="white" style="display:none;"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>포인트</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="point" type="text"  class="formText" maxlength="11" size="7" <?=$style->align(2);?> <?=$style->strCheck(1);?> value="<?=$row->point;?>">&nbsp;% 기본 포인트 정책을 적용하려면 공란으로 비워두세요. (퍼센트[0.1,1,10,100 %] 로 입력하세요)</td>
												</tr>
												
												<!-- 배송가중치는 관리자에서 기본정보를 가지고 와서 출력 유무를 체크합니다. -->
												<? if( $admin_row->express_check==2 ) { ?>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>배송가중치</td>
													<td height="25"  class='tabletd_all tabletd_small'><input name="box" type="text"  class="formText" maxlength="11" size="7" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="<?=$row->box;?>">&nbsp;%&nbsp;상품의 1BOX의 크기 대비 퍼센트[10,50,100]로 입력해주세요 (예: 50%는 1/2BOX 입니다.)</td>
												</tr>
												<?}?>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" bgcolor='F3DBDB' class='contenM'>상품 옵션</td>
													<td class='tabletd_all tabletd_small' style='padding-top:20px'>
													
														<a href="javascript:mycreate()" class='search_bbs2'>옵션추가</a><br>* 옵션명 및 내용이 정확해야만 입력이 됩니다.<br>* <font color="red">추가금액</font> : 입력한 금액만큼 옵션선택시 판매가격이 추가됩니다.[숫자만 입력하여 주세요.]
													
														<table style="width:100%">
															<?for($i=0;$i<30;$i++){?>
															<?if(count($optArr)-1 > $i){
																$optArrList = explode("/^/^", $optArr[$i]);
																$optArrSelect = explode("&&", $optArrList[1]);
																?>
															<tr id="option_list" name="option_list" style="display:;width:100%" bgColor="white"> 
																<td>
																	<table width="100%" class='tabletd_allnew1'>
																		<tr>
																			<td width='60' align='center' bgcolor="F8E7E7" class='tabletd_allnew2 sens_xbold'>옵션분류명</td>
																			<td height='25' class='tabletd_allnew2 sensX'><input type=text name='optName[]' value="<?=$optArrList[0]?>"  class="formText">예)색상, 크기....
																			</td>
																			
																			</tr>

																			<tr><td bgcolor="F8E7E7" class='tabletd_allnew2 sens_xbold'>옵션항목</td>
																			<td class='tabletd_allnew2 sensX'>

																				<div id="customertable_divcont">
																					<div id="customertable_divLeft">
																						<div class="customertable_divLeft">
																							<div id="itemtable_itemcont">
																								<div id="itemtable_itemLeft">
																									<div class="itemtable_itemLeft">
																									<span class='sens_xbold noneoolimmoL'>옵션명<br></span><input type=text name='optList[]'  class="formText placeholder_color" placeholder="옵션명입력"><br>예)검은색, 흰색, 초록색....
																									</div> 
																								</div> 
																								<div id="itemtable_itemCenter">
																									<div class="itemtable_itemCenter">
																									<span class='sens_xbold noneoolimmoL'>추가금액<br></span><input type=text name='optPrice[]'  class="formText placeholder_color" placeholder="추가금액입력" onkeydown="return onlyNumber(event)" size='11'><br>예) 2000 -- 숫자만 입력가능.<br><font color='red'>추가비용이 없을때는 비워두세요.</font>
																									</div>
																								</div>
																								<div id="itemtable_itemRight">
																									<div class="itemtable_itemRight customertable_divcenter_1M_BB">
																									<a href="javascript:optionInput(<?=$i?>)" class='itemcont_btn2'>입력</a><a href="javascript:optionEdit(<?=$i?>)" class='itemcont_btn3'>수정</a><input type='hidden' name='hidden_option_data[]'>
																									</div>
																								</div>
																							</div>														
																						</div> 
																					</div>

																					<div id="customertable_divcenter_1">
																						<div class="customertable_divcenter_1">
																							<div id="customertable_divcont">
																								<div id="customertable_divLeft">
																									<div class="customertable_divLeft">
																										<table width="100%">
																											<tr>
																												<td style='text-align:center'><select name='option_part[]' size='5' multiple onclick="targettxt(this.value, <?=$i?>)" class='itemSelect_mo2'>
																												<?for($n=0;$n<count($optArrSelect)-1;$n++){?>
																												<option value='<?=$optArrSelect[$n]?>'><?=$optArrSelect[$n]?></option>
																												<?}?></select></td>
																											</tr>
																											<tr>
																										</table>
																									</div> 
																								</div>
																								<div id="customertable_divcenter_1">
																									<div class="customertable_divcenter_1M_BB">
																									<a href="javascript:optionDel(<?=$i?>)" class='itemcont_btn4'>선택옵션삭제</a><a href="javascript:myremove(<?=$i?>)" class='itemcont_btn1'>옵션전체삭제</a>
																									</div>
																								</div>
																							</div> 														
																						</div>
																					</div>
																				</div> 
																			 
																			</td>
																		</tr> 
																	</table>
																	<table width="100%"><tr><td height="5"></td></tr></table>
																</td>
															</tr>
															<?}else{?>
															<tr id="option_list" name="option_list" style="display:none;width:100%" bgColor="white"> 
																<td>
																	<table width="100%" class='tabletd_allnew1'>
																		<tr>
																			<td width='60' align='center' bgcolor="F8E7E7" class='tabletd_allnew2 sens_xbold'>옵션분류명</td>
																			<td height='25' class='tabletd_allnew2 sensX'><input type=text name='optName[]'  class="formText">
																			예)색상, 크기....
																			</td>
																			
																			</tr>

																			<tr><td bgcolor="F8E7E7" class='tabletd_allnew2 sens_xbold'>옵션항목</td>
																			<td class='tabletd_allnew2 sensX'>

																				<div id="customertable_divcont">
																					<div id="customertable_divLeft">
																						<div class="customertable_divLeft">
																							<div id="itemtable_itemcont">
																								<div id="itemtable_itemLeft">
																									<div class="itemtable_itemLeft">
																									<span class='sens_xbold noneoolimmoL'>옵션명<br></span><input type=text name='optList[]'  class="formText placeholder_color" placeholder="옵션명입력"><br>예)검은색, 흰색, 초록색....
																									</div> 
																								</div> 
																								<div id="itemtable_itemCenter">
																									<div class="itemtable_itemCenter">
																									<span class='sens_xbold noneoolimmoL'>추가금액<br></span><input type=text name='optPrice[]'  class="formText placeholder_color" placeholder="추가금액입력" onkeydown="return onlyNumber(event)" size='11'><br>예) 2000 -- 숫자만 입력가능.<br><font color='red'>추가비용이 없을때는 비워두세요.</font>
																									</div>
																								</div>
																								<div id="itemtable_itemRight">
																									<div class="itemtable_itemRight customertable_divcenter_1M_BB">
																									<a href="javascript:optionInput(<?=$i?>)" class='itemcont_btn2'>입력</a><a href="javascript:optionEdit(<?=$i?>)" class='itemcont_btn3'>수정</a><input type='hidden' name='hidden_option_data[]'><input type='hidden' name='option_input'>
																									</div>
																								</div>
																							</div>														
																						</div> 
																					</div>

																					<div id="customertable_divcenter_1">
																						<div class="customertable_divcenter_1">
																							<div id="customertable_divcont">
																								<div id="customertable_divLeft">
																									<div class="customertable_divLeft">
																										<table width="100%">
																											<tr>
																												<td style='text-align:center'>
																												<select name='option_part[]' multiple onclick="targettxt(this.value, <?=$i?>)" class='itemSelect_mo2'>
																												</select>
																												</td>
																											</tr>
																											<tr>
																										</table>
																									</div> 
																								</div>
																								<div id="customertable_divcenter_1">
																									<div class="customertable_divcenter_1M_BB">
																									<a href="javascript:optionDel(<?=$i?>)" class='itemcont_btn4'>선택옵션삭제</a><a href="javascript:myremove(<?=$i?>)" class='itemcont_btn1'>옵션전체삭제</a>
																									</div>
																								</div>
																							</div> 														
																						</div>
																					</div>
																				</div> 
																			 
																			</td>
																		</tr> 
																	</table>
																	<table width="100%"><tr><td height="5"></td></tr></table>
																</td>
															</tr>
															<?}?>
															<?}?>
														</table>	
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>상품이미지<br>자동리사이징</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="checkbox" name="resize" value="1" onclick="resizecheck()" <?if( $row->resize==1) { echo("checked");}?>> 선택시 상품이미지의 기본이미지를 기준으로 자동 리사이징이 됩니다. 
													</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="65" align="center" class='contenM tabletd_all'>상품이미지</td>
													<td height="65" colspan="2"  class='tabletd_all tabletd_small'>
														<table width="100%">
															<tr> 
																<td>
																	<table width="100%">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						기본이미지 : <? if( $row->images1) { ?><a href="../../data/goodsImages/<?=$row->images1;?>" rel="lightbox" class='btn_guide1'>미리보기</a><? }?>
																						</div> 
																					</div> 

																					<div id="itemtable_itemCenter">
																						<div class="itemtable_itemCenter sensbody">
																						<input name="images1" type="file"  class="file_text_mo2">
																						</div>
																					</div>

																					<div id="itemtable_itemRight">
																						<div class="itemtable_itemRight sensbody">
																						[권장 사이즈 200 x 200 ]
																						</div>
																					</div>
																				</div> 
																				
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr id="itemimg1" style="display:<?if( $row->resize==1) { echo("none");}?>"> 
																<td>
																	<table height="25" border="0" cellpadding="0" cellspacing="0">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						상세이미지 : <? if( $row->images2) { ?><a href="../../data/goodsImages/<?=$row->images2;?>" rel="lightbox" class='btn_guide1'>미리보기</a><? }?>
																						</div> 
																					</div> 

																					<div id="itemtable_itemCenter">
																						<div class="itemtable_itemCenter sensbody">
																						<input name="images2" type="file"  class="file_text_mo2">
																						</div>
																					</div>


																					<div id="itemtable_itemRight">
																						<div class="itemtable_itemRight sensbody">
																						[권장 사이즈 250 x 250 ]
																						</div>
																					</div>
																				</div> 

																			
																			
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr id="itemimg2" style="display:<?if( $row->resize==1) { echo("none");}?>"> 
																<td>
																	<table height="25" border="0" cellpadding="0" cellspacing="0">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						확대이미지 : <? if( $row->images3) { ?><a href="../../data/goodsImages/<?=$row->images3;?>" rel="lightbox" class='btn_guide1'>미리보기</a><? }?>
																						</div> 
																					</div> 

																					<div id="itemtable_itemCenter">
																						<div class="itemtable_itemCenter sensbody">
																						<input name="images3" type="file"  class="file_text_mo2">
																						</div>
																					</div>


																					<div id="itemtable_itemRight">
																						<div class="itemtable_itemRight sensbody">
																						[권장 사이즈 500 x 500 ]
																						</div>
																					</div>
																				</div> 

																			
																			
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>추가이미지</td>
													<td height="25" colspan="2"  class='tabletd_all tabletd_small'><input type="checkbox" name="add_images_check" value="1" onClick="addImagesCheck();" <? if( $row->add_images1 || $row->add_images2 || $row->add_images3 || $row->add_images4 || $row->add_images5 ) { echo("checked");}?>> 추가이미지 입력보기 ( 예 : 전/후/측면/내부/외부....)</td>
												</tr>
												<tr id="add_images_view" style="display:none;" bgColor="white"> 
													<td bgcolor="E4E7EF" height="140" align="center" class='contenM tabletd_all'></td>
													<td height="140" colspan="2"  class='tabletd_all tabletd_small'>
														<table border="0" cellspacing="0" cellpadding="0">
															<?for($i=1;$i<=5;$i++){?>
															<tr> 
																<td align="center">
																	<table height="25" border="0" cellpadding="0" cellspacing="0">
																		<tr> 
																			<td align="right">
																			
																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						추가이미지(<?=$i?>) <? if( $row->{"add_images".$i}) { ?><a href="../../data/goodsImages/<?=$row->{"add_images".$i};?>" rel="lightbox" class='btn_guide1'>미리보기</a><? }?>
																						</div> 
																					</div> 

																					<div id="itemtable_itemCenter">
																						<div class="itemtable_itemCenter sensbody">
																						<input name="add_images<?=$i?>" type="file"  class="file_text_mo2">
																						</div>
																					</div>

																					<div id="itemtable_itemRight">
																						<div class="itemtable_itemRight sensbody">
																						[권장 사이즈 500 x 500 ]
																						</div>
																					</div>
																				</div> 
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<?}?>
														</table>
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>노출아이콘</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<?
														$notice_result		= $db->select("cs_icon_list", "where code=1 order by idx asc" );
														while( $iconRow = mysqli_fetch_object($notice_result) ) {
														?>
															<input type=checkbox name='iconidx[]' value='<?=$iconRow->idx?>' <?if(array_search($iconRow->idx,$icontemp)) echo "checked";?>> <img src="../../data/designImages/<?=$iconRow->icon?>" alt="<?=$iconRow->name?>">&nbsp;
														<?}?>
														<br><font color='red'>※new아이콘 또는 Best아이콘등 상품 제목옆에 등록할 아이콘이 선택하여 주세요.</font>
													</td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>파일자료등록</td>
													<td height="25" colspan="2"  class='tabletd_all tabletd_small'><input type="checkbox" name="file_check" value="1"  onClick="fileCheck()" <? if( $row->goods_file ) { echo("checked");}?>>&nbsp;파일자료를 삭제할 경우, 체크 하지 마세요(상품구매후 마이페이지에서 첨부파일을 다운 받을수 있습니다.)</td>
												</tr>
												<tr id="file_view" style="display:none;" bgColor="white"> 
													<td height="25" align="center" class='contenM tabletd_all'>
														<? if( $row->goods_file ) { $goods_file_arr = explode("&&", $row->goods_file ); ?>FILE: <input name="goods_file_old" type="text"  class="formText" size="17" <?=$style->colorAlign("#FF0000 ", 1);?> value="<?=$goods_file_arr[1];?>"><? }?>
														<? if( $row->goods_file2 ) { $goods_file2_arr = explode("&&", $row->goods_file2 ); ?><br>FILE2: <input name="goods_file2_old" type="text"  class="formText" size="17" <?=$style->colorAlign("#FF0000 ", 1);?> value="<?=$goods_file2_arr[1];?>"><? }?>
														<? if( $row->goods_file3 ) { $goods_file3_arr = explode("&&", $row->goods_file3 ); ?><br>FILE3: <input name="goods_file3_old" type="text"  class="formText" size="17" <?=$style->colorAlign("#FF0000 ", 1);?> value="<?=$goods_file3_arr[1];?>"><? }?>
													</td>
													<td height="25" colspan="2"  class='tabletd_all tabletd_small'>
														<div class="itemtable_itemCenter sensbody">
															<input name="goods_file" type="file"  class="file_text">&nbsp;&nbsp;등록할 파일이름을 영문으로 하여 올려주세요.
														</div>
														<div class="itemtable_itemCenter sensbody">
															<input name="goods_file2" type="file"  class="file_text">
														</div>
														<div class="itemtable_itemCenter sensbody">
															<input name="goods_file3" type="file"  class="file_text">
														</div>
													</td>
												</tr>
											</table><br>
										</td>
									</tr>
									<tr height="1"> 
										<td height="35"></td>
									</tr>
									<tr> 
										<td valign="top" bgcolor="#FFFFFF" class="menu"><br>
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품설명</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" width="20%" height="25" align="center" class='contenM tabletd_all'>상품설명</td>
													<td class='sensO tabletd_all'>
														<table width="100%">
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
															<tr  height="25">
																<td align="left" class="menu">
																	<textarea id="content" name="content" style="display:none"><?=$row->content?></textarea>
																	<!-- 에디터를 화면에 출력합니다. -->
																	<script type="text/javascript" language="javascript">
																		var myeditor = new cheditor();
																		myeditor.config.editorHeight = '400px';             // 에디터 세로폭입니다.
																		myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
																		myeditor.inputForm = 'content';                     // 입력 textarea의 ID 이름입니다.
																		myeditor.run();                                     // 에디터를 실행합니다.
																	</script>
																</td>
															</tr>
															<tr> 
																<td height="3" colspan="2"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table><br>
										</td>
									</tr>
									
									<tr style="display:none"> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">관련상품설정</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>노출형태</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="radio" name="subitem" value="1" <?if($row->subitem==1){?>checked<?}?>> 미사용 <input type="radio" name="subitem" value="2" <?if($row->subitem==2){?>checked<?}?>> Atype <input type="radio" name="subitem" value="3" <?if($row->subitem==3){?>checked<?}?>> Btype<br>
														A형태 : 한줄 진열되며, 좌우로 자동 스크롤 되는 형태입니다.<br>
														B형태 : 노출수량만큼 메인에 모두 진열됩니다. 
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>관련상품</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="radio" name="subitemtarget" value="1" onclick="subitemuse()" <?if($row->subitemtarget==1){?>checked<?}?>> 같은카테고리 상품에서 10개를 랜덤하게 노출합니다.<br>
														<input type="radio" name="subitemtarget" value="2" onclick="subitemuse()" <?if($row->subitemtarget==2){?>checked<?}?>> 아래항목에서 선택하시기 바랍니다. 
													</td>
												</tr>
												<tr bgColor="white" id="subitemsystem" style="display:<?if($row->subitemtarget==1 && $row->subitem!=1){?>none<?}?>"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>상품선택</td>
													<td class='sensO tabletd_all'>
														


														<div class='oolimbox-wrapper oolimbox-grid3'>
															<div class='oolimbox-col_3dan'>
																	
																	<span style='font-size:11pt'>카테고리</span> 
																	<table style='width:95%'>
																		<tr>
																			<td style='text-align:center'>
																				<select name="subcate" id="subcate" size="10" multiple style="width:100%;" onclick="gruopChange()">
																					<?
																					$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
																					while( $part1_row = @mysqli_fetch_object($part1_result) ) {
																					?>
																					<option value="<?=$part1_row->idx?>">1차:<?=$part1_row->part_name?></option>
																						<?
																						$part2_result = $db->select( "cs_part", "where part_index=2 and part1_code='$part1_row->part1_code' order by part_ranking asc");
																						while( $part2_row = @mysqli_fetch_object($part2_result) ) {
																						?>
																						<option value="<?=$part2_row->idx?>">&nbsp;&nbsp;&nbsp;&nbsp;2차:<?=$part2_row->part_name?></option>
																							<?
																							$part3_result = $db->select( "cs_part", "where part_index=3 and part2_code='$part2_row->part2_code' and part1_code='$part2_row->part1_code'  order by part_ranking asc");
																							while( $part3_row = @mysqli_fetch_object($part3_result) ) {
																							?>
																							<option value="<?=$part3_row->idx?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3차:<?=$part3_row->part_name?></option>

																					<?}}}?>
																				</select>
																				
																				<br>
																			</td>
																		</tr>
																	</table>
																	<table style='width:100%'>
																		<tr><td style='height:30px; text-align:center'><input type="text" class="formText textDomin" name="searhtxt"><a href="javascript:gruopChange()"class='searchC'>검색 ▼</a></td></tr>
																	</table>


																</div>
																<div class='oolimbox-col_3dan'>
																	
																	<span style='font-size:11pt'>검색상품</span> 
																	<table style='width:95%'>
																		<tr>
																			<td style='text-align:center'>
																				<select name="subitems" size="10" multiple style="width:100%;">
																					<?
																					$result_goods		= $db->select("cs_goods", "where display=1 and part_idx=$row->part_idx order by idx desc" );
																					while( $row_goods = mysqli_fetch_object($result_goods)) {
																					?>
																					<option value="<?=$row_goods->idx?>"><?=$row_goods->name?></option>
																					<?}?>
																				</select>
																			</td>
																		</tr>
																	</table>
																	<table style='width:100%'>
																		<tr><td style='height:30px; text-align:center;'><a href="javascript:gor()"class='searchE'>등록</a></td></tr>
																	</table>
									
																</div>
																<div class='oolimbox-col_3dan'>

																	<span style='font-size:11pt'>등록상품</span>			
																	<table style='width:95%'>
																		<tr>
																			<td style='width:90%' style='text-align:center'>
																				<select name="subitemslist" size="10" multiple style="width:100%;">
																				<?
																				if($row->itemlist){
																				$arrTemp = explode(",", $row->itemlist);
																				$orderBy = "order by case idx";
																				foreach($arrTemp as $key=>$val) {
																					$orderBy .= " when $val then $key ";
																				}
																				$orderBy .= "end";

																				$result_item		= $db->select("cs_goods", "where idx IN(".$row->itemlist.") $orderBy" );
																				while( $row1 = mysqli_fetch_object($result_item)) {
																				?>
																				<option value="<?=$row1->idx?>"><?=$row1->name?></option>
																				<?}}?>
																				</select>
																				<input type="text" name="itemlist" size="30" style="display:none" value="<?=$row->itemlist?>">
																			</td>
																			<td style='width:10%; text-align:center'>
																				<a href="javascript:subitemmove(goods_form.subitemslist,-1)" class='searchD'><img src="../images/top_arrow.png"  border=0></a><br><br>
																				<a href="javascript:subitemmove(goods_form.subitemslist,+1)" class='searchD'><img src="../images/bottom_arrow.png" border=0></a>
																			</td>
																		</tr>
																	</table>
																	<table style='width:100%'>
																		<tr><td style='height:30px; text-align:center'><a href="javascript:gol()"class='searchE'>제거</a></td></tr>
																	</table>

																</div>
															</div>



													</td>
												</tr>
											</table><br>
										</td>
									</tr>
									<tr height="1"> 
										<td height="30"></td>
									</tr>
									<tr height="1"> 
										<td height="35"></td>
									</tr>
									<tr> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">전자상거래법 상품정보제공 고시에 대한 추가정보 입력</td>
												</tr>
											</table>
											<table cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td>
														<!--도움말-->
															<table cellpadding="0" cellspacing="0" width="100%" class='tipbox noneoolimmo'>
																<tr>
																	<td bgcolor="#E9F2F8">
																		<table cellpadding="0" cellspacing="0" width="100%">
																			<tr>
																				<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																			</tr>
																			<tr>
																				<td>
																					<table cellpadding="0" cellspacing="0" width="100%">
																						<tr>
																							<td height="5" colspan="2">
																								상품정보필드추가 : ※ <font color="red">공정거래위원회에서 공고한 전자상거래법 상품정보제공 고시</font>에 관한 판매상품의 필수(상세)정보 등록이 필요합니다.
																							</td>
																						</tr>
																						<tr>
																							<td height="5" style='padding-right:5px;'>
																								<img src="../images/item_add_field.jpg" border="0" align="left" style="border:1px solid #888888;">
																							</td>
																							<td height="5" valign="top">
																								아래 상품별 고지사항 내용을 참고하여 등록하고자 하시는 상품의 <br>추가 고지사항에 대한 상품의 추가정보를 형성하셔야 합니다. <br><br>
																								<font color="red">예)</font> 전자상품를 판매를 하신다면 아래의 링크에서 "상품정보제공의 상품군별 추가필드 항목 알아보기" 문서를 다운받아 전자상품에 해당하는 추가정보 항목을 찾으신 후 <font color='red'>'항목추가' 버튼</font>을 이용하여 항목명칭 입력후 그에 대한 정보를 입력하시기 바랍니다. 좌측의 이미지처럼 품명 및 모델명 이란 정보항목과 상성 MP3 - 001002 정보를 등록하여 상품 상세정보의 추가정보에서 노출되는 예입니다.
																								<br><br>
																								<u>항목을 반복적으로 등록하는 불편함을 피하기 위해서 입력될 항목을 정의할수 있도록 카테고리 관리에서 <font color="red">추가정보 항목정의</font>를 제공 하고 있으니 카테고리별로 등록하여 항목을 미리가져오기를 하시기 바랍니다.</u>

																								<br><br>
																								전자상거래법 추가자료<br>
																								<a href="http://www.ftc.go.kr/policy/legi/legiView.jsp?lgslt_noti_no=112" target="_new">※ 공정거래위원회에서 공고한 전자상거래법 상품정보제공 고시에 관한 내용</a><br>
																								<a href="http://e-sens.co.kr/download/itemsgroupfield.hwp"><font color="red"><font color="red">※ 상품정보제공의 상품군별 추가필드 항목 알아보기</font>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														<!--//도움말-->

													</td>
												</tr>
											</table>
											<table cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td height="5">
													</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white">
													<td colspan="2" height="90" style='text-align:center; padding-bottom:10px;'>
													<span class='contenM'>※ 공정거래위원회에서 공고한 전자상거래법 상품정보제공 고시에 관한 판매상품의 필수(상세)정보 등록이 필요합니다.</span>
													<br><br>
													<a href="javascript:fieldlistAdd()"class='search_bbs3'>항목추가 ▼</a> <a href="javascript:fieldlistRemove()"class='search_bbs1'>항목제거 ▼</a>
													</td>
												</tr>
												<tr>
													<td width="30%" height="25" class='contenM tabletd_all' bgcolor="E4E7EF">항목이름</td>
													<td width="70% "height="25" class='contenM tabletd_all' bgcolor="E4E7EF">내용</td>
												</tr>
												<?for($i=0;$i<$DEFAULTADDFIELD;$i++){?>
												<tr id="addlist" name="addlist" style="display:<?if($row->{"fieldname".($i+1)}){?><?}else{?>none<?}?>">
													<td height="25" align="center" class='contenM tabletd_all'>
														<input type="text" name="fieldname[]" class='formText' size="20" value="<?=$row->{"fieldname".($i+1)}?>">
													</td>
													<td height="25" class='contenM tabletd_all'>
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:50px'><textarea name="fielddata[]" style='height:50px'><?=$row->{"fielddata".($i+1)}?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>
														
												</tr>
												<?}?>
											</table>
											<table style='margin:0 auto;'>
												<tr>
													<td height='70'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
									</form>
								</table>
								<script language="javascript">
								<!--
								// 옵션
								var form=document.goods_form;
								// 추가 이미지
								if( form.add_images_check.checked ) {
									document.all.add_images_view.style.display=""; 
								} else {
									document.all.add_images_view.style.display="none"; 	
								}
								// 상품파일
								if( form.file_check.checked ) {
									document.all.file_view.style.display=""; 
								} else {
									document.all.file_view.style.display="none"; 
								}
								//-->
								</script>
								<!--콘텐츠출력-->
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>
