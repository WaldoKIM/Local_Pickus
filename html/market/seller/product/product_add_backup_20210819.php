<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
$admin_row = $db->object("cs_admin", "");

if($_POST[display_view]){
	$pageInfo = $db->object("cs_part","where part1_code='$_POST[part_code]' or part2_code='$_POST[part_code]' or part3_code='$_POST[part_code]'");
	$fieldArr = explode("@", $pageInfo->fieldlist);
}
?>
<script language="javascript">
<!--
//// 데이타 배송 시작 ///////////////////////////////////////////////////////////////////////////////////////////
// 수량 입력 폼 체크
function goodsUnlimit() {	if( document.goods_form.unlimit.checked == true ) { document.goods_form.number.value = ""; }}
function goodsNumber() { document.goods_form.unlimit.checked  = false; }


var opt_cnt = 0;

//무한 옵션 ---------------------------
function mycreate() {
	document.getElementsByName("option_list")[opt_cnt].style.display="";
	opt_cnt++;
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
//	} else if( form.company.value=="" ) {
//		alert("제조회사 또는 원산지를 입력해주세요.");
//		form.company.focus();
//	} else if( form.old_price.value=="" ) {
//		alert("시중가격을 입력해주세요.");
//		form.old_price.focus();
	} else if( form.shop_price.value=="" ) {
		alert("판매할 가격을 입력해주세요.");
		form.shop_price.focus();
//	} else if( form.unlimit.checked == false && form.number.value == "" ) {
//		alert("판매할 수량을 선택해주세요.");
//		form.number.focus();
//	} else if(form.unlimit.checked && form.number.value){
//		alert("판매수량의 무제한과 수량입력중  하나만 입력해주세요.");
//		form.number.focus();
<? if( $admin_row->express_check==2 ) { ?>
	} else if( form.box.value=="" ) {
		alert("배송가중치 입력해주세요.");
		form.box.focus();
<? } ?>
	} else if(form.images1.value==""){
		alert("상품 기준 이미지를 등록해주세요.");
		form.images1.focus();
	} else if(form.resize.checked==false && form.images2.value==""){
		alert("상품 상세 이미지를 등록해주세요.");
		form.images2.focus();
	} else if(form.resize.checked==false && form.images3.value==""){
		alert("상품 확대 이미지를 등록해주세요.");
		form.images3.focus();
	} else if(form.file_check.checked&& form.goods_file.value==""){
		alert("상품 파일을 압축하여 등록해주세요.");
	} else if( form.content.value=="" ) {
		alert("상품의 상세 정보를 입력해주세요.");
		form.content.focus();
	} else {
		form.submit();
	}
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

function subitemuse(){
	if(document.forms['goods_form']['subitemtarget'][0].checked==false){
		document.getElementById("subitemsystem").style.display="";
	}else{
		document.getElementById("subitemsystem").style.display="none";
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


function partCodeCheck() {
	if(document.goods_form.part_code.value=="카테고리를 선택하세요") {
		alert('카테고리를 선택하세요');
	}
}


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
////  TEXTAREA 입력 폼 크기 조정 종료 //////////////////////////////////////////////////////////////////


////  카테고리 선택 폼 설정 시작 //////////////////////////////////////////////////////////////////////////
// 배열 선언
depth1 = new Array(); // 리스트1 출력용
depth2 = new Array(); // 리스트2 출력용
depth3 = new Array(); // 리스트3 출력용

depth1_value = new Array(); // 리스트1 값
depth2_value = new Array(); // 리스트2 값
depth3_value = new Array(); // 리스트3 값

var depth1_size = 3;
var depth2_size = 3;
var depth3_size = 3;
var sep = "$$";
// 배열 초기화

i = 0;
// depth1 의 배열 초기화
<?
$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
while( $part1_row = mysqli_fetch_object($part1_result) ) {
?>
	depth1[i] = "<?=$part1_row->part_name;?>";
	depth1_value[i] = "<?=$part1_row->part1_code;?>";
	
	j = 0;

	// depth2 의 배열 초기화
	<?
	$part2_result = $db->select( "cs_part", "where part1_code='$part1_row->part1_code' and part_index=2 order by part_ranking asc");
	while( $part2_row = mysqli_fetch_object($part2_result) ) 
	{
	?>
		if ( j == 0 )
		{
			depth2[i] = new Array(); 
			depth2_value[i] = new Array();
			depth3[i] = new Array();
			depth3_value[i] = new Array();
		}

		depth2[i][j] = "<?=$part2_row->part_name;?>" ;
		depth2_value[i][j] = "<?=$part2_row->part2_code;?>";
		
		k = 0;
		<?
		$part3_result = $db->select( "cs_part", "where part2_code='$part2_row->part2_code' and part1_code='$part1_row->part1_code' and part_index=3 order by part_ranking asc");
		while( $part3_row = mysqli_fetch_object($part3_result) ) 
		{
		?>
			if ( k == 0 )
			{
				depth3[i][j] = new Array();
				depth3_value[i][j] = new Array();
			}
			depth3[i][j][k] = '<?=$part3_row->part_name?>' ;
			depth3_value[i][j][k] = '<?=$part3_row->part3_code?>' ;
		k += 1;
	    <?}?>
	 j += 1;
	<?}?>	
i += 1;		
<? }?>

// 선택되었을때 다음 단계 카테고리 출력
function change(depth, index, target)
{
	f = document.goods_form;   // 선택된 Form;
	
	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		
		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null; 
		}
		goods_form.part_code.value = "카테고리를 선택하세요";
		if ( depth2[sp_value2] != null )
		{
	
			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}
		}
		else
		{
//			alert("2차 카테고리는 없습니다.");
			goods_form.part_code.value = depth1_value[sp_value2];
			alert("카테고리 선택 완료\n\n상품를 등록 하세요");
			goods_form.display_view.value = 1;
			goods_form.action = "product_add.php";
			goods_form.method = "post";
			goods_form.submit();
			goods_form.name.focus();
		}


		// 카테고리 2를 초기화 되면 카테로기 3은 모두 삭제한다.
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
	}
	else if ( depth == 2 && index != -1 )   // 중분류 선택 시 
	{
		sp_value = f.select2[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		sp_value3 = sp_value[2];
		
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
		goods_form.part_code.value = "카테고리를 선택하세요";
		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
		else
		{
//			alert("3차 카테고리는 없습니다.");
			goods_form.part_code.value = depth2_value[sp_value2][sp_value3];
			alert("카테고리 선택 완료\n\n상품를 등록 하세요");
			goods_form.display_view.value = 1;
			goods_form.action = "product_add.php";
			goods_form.method = "post";
			goods_form.submit();
			goods_form.name.focus();
		}
	}
	else if ( depth == 3 && index != -1 )
	{
		goods_form.part_code.value = f.select3[index].value;
		alert("카테고리 선택 완료\n\n상품를 등록 하세요");
		goods_form.display_view.value = 1;
		goods_form.action = "product_add.php";
		goods_form.method = "post";
		goods_form.submit();
		goods_form.name.focus();
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////

//추가필드
	function fieldlistSet(){
		for(i=0;i<<?=$DEFAULTADDFIELD?>;i++){
			if(opener.document.forms['goods_form']['fieldlist[]'][i].value){
				document.forms['goods_form']['fieldname[]'][i].value = opener.document.forms['goods_form']['fieldlist[]'][i].value;
				document.getElementsByName("addlist")[i].style.display="";
			}
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
									<table width="100%" border="0" align="center">
									<form action="product_add_ok.php" method="post" name="goods_form" enctype="multipart/form-data">
									<input type="hidden" name="hidden_option1_data">
									<input type="hidden" name="hidden_option2_data">
									<input type="hidden" name="display_view">

									<tr> 
										<td height="150" align="center" bgcolor="#FFFFFF" class="menu">
										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품등록</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>분류선택 : 1차 → 2차 → 3차.<br>
																							카테고리 코드 : 위의 카테고리를 선택하면 자동으로 생성됩니다.<br>
																							진열대 출력 : 상품의 디스플레이 유무를 설정합니다. 만약 판매 준비중이면 아니오를 선택하세요.<br>
																							분류선택을 하셔야 상품정보 및 상품설명을 등록폼이 보입니다.<br>
																							카테고리 선택후 자료 입력후 다시 카테고리를 변경하게 되면, 데이터가 초기화	되오니 참고하시길 부탁드리겠습니다.</td>
																					</tr>
																					
																					<tr>
																						<td>
																							<div>
																								<br>
																								### 판매 수수료 부과 안내 ###<br><br>

																								1. 상품 판매 완료<br>
																								2. 수수료 15%를 제한 판매대금을 포인트로 적립<br>
																								3. 출금 요청<br>
																								4. 회원정보에 입력된 입금계좌로 정산(공휴일 제외, 평일 6~8시에 일괄 입금처리)<br>
																								<br>
																								* 회원정보수정 페이지에서 입금계좌를 꼭 기입해주세요.<br>
																								<br>				
																							</div>																							
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->
															</td>
														</tr>
														<tr>
															<td height="5"></td>
														</tr>
													</table>
												</td>
												</tr>
											</table> 
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>분류 선택</td>
													<td class='tabletd_all tabletd_small'>
														
														<div class="oolimbox-wrapper oolimbox-grid3">
															<div class="oolimbox-col_3dan" style="text-align:center;">
																<span class='ranking_bgM'>1차카테고리</span><br>
																<select name="select1" size="10" style='width:90%;' onClick='change(1, this.form.select1.selectedIndex, this.form)'  class="itemSelect">
																		<script language = "javascript">
																		var str_depth = "";
																		for ( i = 0 ; i <= depth1.length -1 ; i++ ){	
																			str_depth1 = depth1_value[i] + sep + i;
																			document.write ("<option value='"+ depth1_value[i] + sep + i + "' >" + depth1[i] + "</option>");
																		}
																		</script>
																	</select>
																
															</div> 

															<div class="oolimbox-col_3dan"  style="text-align:center;">
																<span class='ranking_bgM'>2차카테고리</span><br>
																<select name="select2" size="10" style='width:90%;' onclick='change(2, this.form.select2.selectedIndex, this.form)' class="itemSelect"></select>
																
															</div>

															<div class="oolimbox-col_3dan" style="text-align:center;">
																<span class='ranking_bgM'>3차카테고리</span><br>
																<select name="select3" size="10" style='width:90%;' onclick='change(3, this.form.select3.selectedIndex, this.form)' class="itemSelect"></select>
																
															</div>
														</div>
														

													</td>
												</tr>
												<tr bgColor="white"> 
													<td height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>카테고리 코드</td>
													<td class='tabletd_all tabletd_small'><input name="part_code" type="text" maxlength="20" size="50" class="formText" <?=$style->colorAlign("#FF0000 ", 0);?> readOnly value="<?if($_POST[part_code]){ echo $_POST[part_code];?><?}else{?>카테고리를 선택하세요<?}?>">&nbsp;&nbsp;( <font color="#FF0000">! 주의</font> : 카테고리 선택이 완료되면 카테고리 코드가 나타납니다.)</td>
												</tr>
												<tr bgColor="white"> 
													<td height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>진열대 출력</td>
													<td class='tabletd_all tabletd_small'><input name="display" type="radio" value="1" <? if( $_POST[display] == 1) { echo("checked");}?>>예&nbsp;<input name="display" type="radio" value="0"  <? if( $_POST[display] == 0) { echo("checked");}?>>아니오&nbsp;&nbsp;(상품 전시 판매 유무 설정합니다.)</td>
												</tr>			
											</table><br>
										</td>
									</tr>
									<tr height="1"> 
										<td height="30"></td>
									</tr>
									<tr> 
										<td height="75" align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
										<table width="100%" style='<?if(!$_POST[display_view]){?>display:none;<?}?>'>
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="25">
															<table>
																<tr>
																	<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품정보</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">

																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>해당 내용을 입력하시면 됩니다.<br>추가이미지 : 상품의 추가적인 이미지가 필요할 경우 최대 5개까지 입력할 수 있습니다.<br>(반드시 체크를 해야 추가이미지 파일이 등록되니 유의하세요.)<br>
																						태그 : 검색엔진최적화에 사용될 keywords 로 사용됩니다.<br>
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->

															</td>
														</tr>
														<tr>
															<td height="5">
															</td>
														</tr>
													</table>
												</td>
												</tr>
											</table> 
											<table width="100%" class="table_all" style='<?if(!$_POST[display_view]){?>display:none;<?}?>' id="product_info" name="product_info">
												<tr bgColor="white"> 
													<td height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>상품코드</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="code" type="text"  class="formText" value="<?=time();?>" <?=$style->colorAlign("#666666 ", 0);?> readOnly>&nbsp;(자동으로 코드가 생성 됩니다.)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>상품명</td>
													<td class='tabletd_all tabletd_small' colspan="2" ><input name="name" type="text" class="formText" onKeyDown="partCodeCheck();">&nbsp;(100자 안으로 작성)</td>
												</tr>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>모델명</td>
													<td height="25" class='tabletd_all tabletd_small'><input name="model_name" type="text" class="formText" >&nbsp;(100자 안으로 작성)</td>
												</tr>												
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>태그</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="tag" type="text"  style="width:90%;" class="formText"></td>
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
																		<td><div class="box" style='height:50px'><textarea name="description" style='height:50px'></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>
												</tr>
												*/?>
												
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>제조회사</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="company" type="text" class="formText">&nbsp;제조 및 판매회사를 적어 주세요</font></td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>가격대체</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="subst" type="checkbox" value="1">&nbsp;가격표기를 대체할 문구 및 아이콘 설정합니다. <font color="red">- 설정시 구매 불가능합니다.</font></td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>대체문구</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="substtxt" type="text" class="formText">&nbsp;가격대신 표기됩니다.</td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>대체아이콘</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<?
														$notice_result		= $db->select("cs_icon_list", "where code=2 order by idx asc" );
														while( $iconRow = mysqli_fetch_object($notice_result) ) {
														?>
															<input type=checkbox name='substimg[]' value='<?=$iconRow->idx?>'> <img src="../../data/designImages/<?=$iconRow->icon?>" alt="<?=$iconRow->name?>">&nbsp;
														<?}?>
														<br><font color='red'>대체문구와 중복사용 가능합니다.</font>
													</td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>시중가격</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="old_price" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?>>&nbsp;원&nbsp;&nbsp;(시중가격을 입력해주세요)</td>
												</tr>
												
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>판매가격</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="shop_price" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?>>&nbsp;원&nbsp;&nbsp;(판매할 상품 가격을 입력해주세요)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>배송비</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="deliv_fee" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?>>&nbsp;원&nbsp;&nbsp;(배송비를 입력해주세요. 미 입력시 무료배송)</td>
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
														<input name="area" type="text" class="formText" style="width:90%;"  placeholder="미입력시 전국으로 표시"  readonly>
														<br>
														<a href="javascript:delArea(1);" class="btn_guide1">비우기</a>	
													</td>
												</tr>												
												<tr bgColor="white"   style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>묶음배송 제외</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="deliv_exc" type="checkbox" class="formText" value="1" <?=$style->align(2);?> <?=$style->strCheck(0);?>></td>
												</tr>

									
												<tr bgColor="white"  style="display:none;">
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>최소구매수량</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="mincnt" type="text" class="formText" maxlength="11" size="11" <?=$style->align(2);?> <?=$style->strCheck(0);?>>&nbsp;(설정한 수량 이상 구매가능합니다.)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" height="13" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>판매수량</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="unlimit" type="checkbox" value="1" onClick="goodsUnlimit()">무제한&nbsp;<input name="number" type="text" maxlength="11" size="11" class="formText" <?=$style->align(2);?> <?=$style->strCheck(0);?>  onClick="goodsNumber()" value="1">&nbsp;개&nbsp;&nbsp; (재고량이 없는 경우 0를 입력해 주세요[중지표시])</td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>포인트</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="point" type="text" class="formText" maxlength="11" size="7" <?=$style->align(2);?> <?=$style->strCheck(1);?>>&nbsp;% 기본 포인트 정책을 적용하려면 공란으로 비워두세요. (퍼센트[0.1,1,10,100 %] 로 입력하세요)</td>
												</tr>
												<!-- 배송가중치는 관리자에서 기본정보를 가지고 와서 출력 유무를 체크합니다. -->
												<? if( $admin_row->express_check==2 ) { ?>
												<tr bgColor="white"> 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>배송가중치</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input name="box" type="text" class="formText" maxlength="11" size="7" <?=$style->align(2);?> <?=$style->strCheck(0);?> value="100">&nbsp;%&nbsp;상품의 1BOX의 크기 대비 퍼센트[10,50,100]로 입력해주세요 (예: 50%는 1/2BOX 입니다.)</td>
												</tr>
												<?}?>
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" width="20%" height="25" align="center" bgcolor='F3DBDB' class='contenM'>상품 옵션</td>
													<td colspan="2"  class='tabletd_all tabletd_small' style='padding-top:20px'><a href="javascript:mycreate()" class='search_bbs2'>옵션추가</a><br>* 옵션명 및 내용이 정확해야만 입력이 됩니다.<br>* <font color="red">추가금액</font> : 입력한 금액만큼 옵션선택시 판매가격이 추가됩니다.[숫자만 입력하여 주세요.]

														<table style="width:100%">
															<?for($i=0;$i<30;$i++){?>
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
																												<td style='text-align:center'><select name='option_part[]' multiple onclick="targettxt(this.value, <?=$i?>)" class='itemSelect_mo2'>
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
															<?}?>
														</table>	

													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>상품이미지<br>자동리사이징</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="checkbox" name="resize" value="1" onclick="resizecheck()"> 선택시 상품이미지의 기본이미지를 기준으로 자동 리사이징이 됩니다. 
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>상품이미지</td>
													<td colspan="2" class='tabletd_all tabletd_small'>
														<table width="100%">
															<tr> 
																<td>
																	<table width="100%">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						기본이미지 : 
																						</div> 
																					</div> 

																					<div id="itemtable_itemCenter">
																						<div class="itemtable_itemCenter sensbody">
																						<input name="images1" type="file"  class="file_text_mo2">
																						</div>
																					</div>

																					<div id="itemtable_itemRight">
																						<div class="itemtable_itemRight sensbody">
																						[권장 사이즈 200 x 200 ] - 자동리사이징 사용시 500*500
																						</div>
																					</div>
																				</div> 
																				
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr id="itemimg1"> 
																<td>
																	<table height="25">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						상세이미지 : 
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
															<tr id="itemimg2"> 
																<td>
																	<table height="25">
																		<tr> 
																			<td align="right">

																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						확대이미지 : 
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
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>추가이미지</td>
													<td class='tabletd_all tabletd_small' colspan="2"><input type="checkbox" name="add_images_check" value="1" onClick="addImagesCheck();"> 추가이미지 입력보기 ( 예 : 전/후/측면/내부/외부....)</td>
												</tr>
												<tr id="add_images_view" style="display:none;" bgColor="white"> 
													<td width="20%" height="140" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'></td>
													<td height="140" colspan="2" class='tabletd_all tabletd_small'>
														<table>
															<?for($i=1;$i<=5;$i++){?>
															<tr> 
																<td align="center">
																	<table height="25">
																		<tr> 
																			<td align="right">
																			
																				<div id="itemtable_itemcont">
																					<div id="itemtable_itemLeft">
																						<div class="itemtable_itemLeft sensbody">
																						추가이미지(<?=$i?>)
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
												<tr bgColor="white" > 
													<td width="20%" height="25" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>노출아이콘</td>
													<td class='tabletd_all tabletd_small' colspan="2">
														<?
														$notice_result		= $db->select("cs_icon_list", "where code=1 order by idx asc" );
														while( $iconRow = mysqli_fetch_object($notice_result) ) {
														?>
															<input type=checkbox name='iconidx[]' value='<?=$iconRow->idx?>'> <img src="../../data/designImages/<?=$iconRow->icon?>" alt="<?=$iconRow->name?>">&nbsp;
														<?}?>
														<br><font color='red'>※new아이콘 또는 Best아이콘등 상품 제목옆에 등록할 아이콘이 선택하여 주세요.</font>
													</td>
												</tr>
												<tr bgColor="white"  style="display:none;"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>파일 등록</td>
													<td height="25" colspan="2"  class='tabletd_all tabletd_small'><input type="checkbox" name="file_check" value="1"  onClick="fileCheck()">&nbsp;파일자료를 삭제할 경우, 체크 하지 마세요(상품구매후 마이페이지에서 첨부파일을 다운 받을수 있습니다.)</td>
												</tr>
												<tr id="file_view" style="display:none;" bgColor="white"> 
													<td height="25" align="center" class='contenM tabletd_all'></td>
													<td height="25" colspan="2"  class='tabletd_all tabletd_small'>
														<div class="itemtable_itemCenter sensbody">
															<input name="goods_file" type="file"  class="file_text">&nbsp;등록할 파일이름을 영문으로 하여 올려주세요.
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
										<td height="30"></td>
									</tr>
									<tr style='<?if(!$_POST[display_view]){?>display:none;<?}?>' id="product_info2" name="product_info2"> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
											<table>
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">상품설명</td>
												</tr>
											</table>

											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>상품설명</td>
												</tr>
												<tr>
													<td class='sensO tabletd_all'>
														
															<textarea id="content" name="content" style="display:none"></textarea>
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
											</table><br>
										</td>
									</tr>
									<tr height="1"> 
										<td height="30"></td>
									</tr>
									<tr style='<?if(!$_POST[display_view]){?>display:none;<?}?>' id="product_info2" name="product_info2"> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"  style="display:none"><br> 
											<table>
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">관련상품설정</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>노출형태</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="radio" name="subitem" value="1" checked> 미사용 <input type="radio" name="subitem" value="2"> Atype <input type="radio" name="subitem" value="3"> Btype<br>
														A형태 : 한줄 진열되며, 좌우로 자동 스크롤 되는 형태입니다.<br>
														B형태 : 노출수량만큼 메인에 모두 진열됩니다. 
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="20%" bgcolor="E4E7EF"  align="center" class='contenM tabletd_all'>관련상품</td>
													<td height="35" colspan="2" class='tabletd_all tabletd_small'>
														<input type="radio" name="subitemtarget" value="1" onclick="subitemuse()"> 같은카테고리 상품에서 10개를 랜덤하게 노출합니다.<br>
														<input type="radio" name="subitemtarget" value="2" onclick="subitemuse()"> 아래항목에서 선택하시기 바랍니다. 
													</td>
												</tr>
												<tr bgColor="white" id="subitemsystem" style="display:none"> 
													<td width="20%" bgcolor="E4E7EF" height="25" align="center" class='contenM tabletd_all'>상품선택</td>
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
																					$result		= $db->select("cs_goods", "where display=1 and part_idx=$pageInfo->idx order by idx desc" );
																					while( $row = mysqli_fetch_object($result)) {
																					?>
																					<option value="<?=$row->idx?>"><?=$row->name?></option>
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
																				<select name="subitemslist" size="10" multiple style="width:100%;"></select>
																				<input type="text" name="itemlist" size="30" style="display:none">
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
									<tr style='<?if(!$_POST[display_view]){?>display:none;<?}?>'> 
										<td align="center" valign="top" bgcolor="#FFFFFF" class="menu"><br> 
											<table width="100%">
												<tr>
													<td class="sub_titleM"><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">전자상거래법 상품정보제공 고시에 대한 추가정보 입력</td>
												</tr>
											</table>
											<table width="100%">
												<tr>
													<td>
														<!--도움말-->
															<table width="100%" class='tipbox noneoolimmo'>
																<tr>
																	<td bgcolor="#E9F2F8">
																		<table width="100%">
																			<tr>
																				<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																			</tr>
																			<tr>
																				<td>
																					<table width="100%">
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
											<table width="100%">
												<tr>
													<td height="5"></td>
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
												<?for($i=0;$i<$DEFAULTADDFIELD;$i++){
												$fieldArr2 = explode("^||^", $fieldArr[$i]);
												?>
												<tr id="addlist" name="addlist" <?if(count($fieldArr)-2 < $i){?> style="display:none"<?}?>>
													<td height="25" align="center" class='contenM tabletd_all'>
														<input type="text" name="fieldname[]" class='formText' size="20" value="<?=$fieldArr2[0]?>">
													</td>
													<td height="25" class='contenM tabletd_all'>
														
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:50px'><textarea name="fielddata[]" style='height:50px'><?=$fieldArr2[1]?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>

														
													</td>
												</tr>
												<?}?>
											</table>
											<table style='margin:0 auto;<?if(!$_POST[display_view]){?>display:none;<?}?>' id="product_info3" name="product_info3">
												<tr>
													<td height='70'><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
									</form>
									</table>
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
