<?
$content = "
		<table width='851' border='0' align='center' cellpadding='0' cellspacing='0'>
			<tr>
				<td height='150' align='center' bgcolor='#FFFFFF' class='menu'><br>
					<table width='800' border='0' cellspacing='0' cellpadding='0'>
						<tr>
							<td height='25'>등록된 정보</td>
						</tr>
					</table>
					<table width='800' border='1' cellpadding='0' cellspacing='0' bordercolor='#BDBEBD' class='menu' style='border-collapse: collapse'>
						<tr>
							<td width='120' height='25' align='center' bgcolor='F7F3F7'>도메인</td>
							<td height='25'>&nbsp;HTTP:$_POST[shop_domain]</td>
							<td width='120' height='25' align='center' bgcolor='F7F3F7'>사용자 스킨 URL</td>
							<td height='25'>&nbsp;HTTP:$_POST[shop_url]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>쇼핑몰 상호</td>
							<td height='25'>&nbsp;$_POST[shop_name]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>사업자번호</td>
							<td height='25'>&nbsp;$_POST[shop_num]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>대표자명</td>
							<td height='25'>&nbsp;$_POST[shop_ceo]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>통신판매업허가번호</td>
							<td height='25'>&nbsp;$_POST[shop_license]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>이메일</td>
							<td height='25'>&nbsp;$_POST[shop_email]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>개인정보관리책임자</td>
							<td height='25'>&nbsp;$_POST[safeguard_admin]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>업 태</td>
							<td height='25'>&nbsp;$_POST[shop_status]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>종 목</td>
							<td height='25'>&nbsp;$_POST[shop_item]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>전화번호</td>
							<td height='25'>&nbsp;$_POST[shop_tel1]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>전화번호2</td>
							<td height='25'>&nbsp;$_POST[shop_tel2]</td>
						</tr>
						<tr>
							<td height='25' align='center' bgcolor='F7F3F7'>휴대폰</td>
							<td height='25'>&nbsp;$_POST[shop_phone]</td>
							<td height='25' align='center' bgcolor='F7F3F7'>팩 스</td>
							<td height='25'>&nbsp;$_POST[shop_fax]</td>
						</tr>
						<tr>	
							<td height='25' align='center' bgcolor='F7F3F7'>사업장 주소</td>
							<td height='25' colspan='3'>&nbsp;$_POST[shop_address]</td>
						</tr>
					</table><br>
				</td>
			</tr>
		</table>
	";
	$mail->to = "admin@oolim.net";
	$mail->from = $_POST[shop_ceo];
	$mail->subject = $_POST[shop_domain]." 사용자설치정보입니다.";
	$content = $tools->strHtml($content);
	$mail->body = $content;
	if(!$mail->send()) {
		$tools->msg('메일서버에 이상증상으로 인하여 정보 업데이트가 되지 않았습니다.');
	}else{
		// 디비입력
		if( $db->cnt("cs_admin", "")) {
			if( $db->update("cs_admin", $sql) ) {
				$tools->alertJavaGo("[ ID ][ PW ][ URL ][ SKINURL ]정보는 업데이트가 제한되어 있습니다. 저장 완료 되었습니다.", "basic_setup.php");
			} else {
				$tools->errMsg('비상적으로 입력 되었습니다.'); 
			}
		} 
		else { if( $db->insert("cs_admin", $sql) ) { $tools->alertJavaGo("저장 완료 되었습니다.", "basic_setup.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
		$sendCheck = 1;
	}
?>
