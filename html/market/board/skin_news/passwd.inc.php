<script language="javascript">
<!--
function passubmit() {
	var form=document.bbs_passwd_form;
	if(form.pwd.value==""){
		alert('패스워드를 입력하여 주세요.');
		return;
	} else {
		form.submit();			
	}
}
//-->
</script>


<div class='spaceline01'></div>
<table style='margin:0 auto;'>
	<? if($_GET[boardT]=="pd" && $_GET[T2]=="c") {	?>
	<form name="bbs_passwd_form" action="bbs_coment_ok.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" method="post">
	<input type="hidden" name="coment_idx" value="<?=$_GET[coment_idx];?>">
	<input type="hidden" name="coment_del" value="1">
	<? } else if( $_GET[boardT]=="pd" && $_GET[T2]=="b" ) {	?>
	<form name="bbs_passwd_form" action="view_del.php?board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" method="post">
	<? } else if( $_GET[boardT]=="pe" && $_GET[T2]=="b" ) {	?>
	<form name="bbs_passwd_form" action="?boardT=e&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" method="post">
	<? } else if( $_GET[boardT]=="pv") {	?>
	<form name="bbs_passwd_form" action="?boardT=v&board_data=<?=$MV_DATA;?>&search_items=<?=$MV_SEARCH_ITEM;?>" method="post">
	<? }?>
	<tr>
		<td height="36" style="padding-right:10px; padding-left:10px;"  align='center'>수정, 삭제, 비밀글읽기를 위해서는 글작성시 입력한 비밀번호를 입력하셔야 합니다.</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="2" bgcolor="#333333">
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="21" style="padding-right:10px; padding-left:10px;" width="100%">

			<table style='margin:0 auto;'>
				<tr>
					<td width="20%" class='oolimmobilemenuM'>비밀번호:</td>
					<td width="40%" style="padding-right:10px; padding-left:10px;"><input type="password" name="pwd" class="formText loginsmall_size"></td>
					<td width="30%"><a href="javascript:passubmit()" class='searchB' style="width:90%;">확인</a></td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="#333333"></td>
	</tr>
</table>
<div class='spaceline01'></div>
