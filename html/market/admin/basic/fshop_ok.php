<?php
	include('../../common.php');
	header("Content-type: text/xml;charset=UTF-8");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	$xml_out = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

	if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]){
		$xml_out .= "<Data rtn='unknown'/>";
	} else {
	$email = urldecode($_POST[shop_email]); 
	$hname = urldecode($_POST[shop_name]); 
	$ename = urldecode($_POST[shop_en_name]); 
	$domain = urldecode($_POST[shop_domain]); 
	$surl = urldecode($_POST[shop_url]); 
	$name1 = urldecode($_POST[shop_ceo]); 
	$name2 = urldecode($_POST[safeguard_admin]); 
	$sno = urldecode($_POST[shop_num]); 
	$ssno = urldecode($_POST[shop_license]); 
	$tel1 = urldecode($_POST[shop_tel1]); 
	$tel2 = urldecode($_POST[shop_tel2]); 
	$sst = urldecode($_POST[shop_status]); 
	$sit = urldecode($_POST[shop_item]); 
	$sfax = urldecode($_POST[shop_fax]); 
	$phone = urldecode($_POST[shop_phone]); 
	$addre = urldecode($_POST[shop_address]); 
	$sweek = urldecode($_POST[week]); 

	$email = iconv("euc-kr", "UTF-8", $email); 
	$hname = iconv("euc-kr", "UTF-8", $hname); 
	$ename = iconv("euc-kr", "UTF-8", $ename); 
	$domain = iconv("euc-kr", "UTF-8", $domain); 
	$surl = iconv("euc-kr", "UTF-8", $surl); 
	$name1 = iconv("euc-kr", "UTF-8", $name1); 
	$name2 = iconv("euc-kr", "UTF-8", $name2); 
	$sno = iconv("euc-kr", "UTF-8", $sno); 
	$ssno = iconv("euc-kr", "UTF-8", $ssno); 
	$tel1 = iconv("euc-kr", "UTF-8", $tel1); 
	$tel2 = iconv("euc-kr", "UTF-8", $tel2); 
	$sst = iconv("euc-kr", "UTF-8", $sst); 
	$sit = iconv("euc-kr", "UTF-8", $sit); 
	$sfax = iconv("euc-kr", "UTF-8", $sfax); 
	$phone = iconv("euc-kr", "UTF-8", $phone); 
	$addre = iconv("euc-kr", "UTF-8", $addre); 
	$sweek = iconv("euc-kr", "UTF-8", $sweek); 
 

		$sql="shop_domain='$domain', shop_url='$surl', shop_email='$email', safeguard_admin='$name2', shop_name='$hname', shop_ceo='$name1', shop_num='$sno', shop_license='$ssno', shop_tel1='$tel1', shop_tel2='$tel2', shop_status='$sst' ,shop_item='$sit', shop_fax='$sfax', shop_phone='$phone', shop_address='$addre', week='$sweek' ";

		if( $db->cnt("cs_admin", "")) {
			if( $db->update("cs_admin", $sql) ) {
				$xml_out .= "<Data rtn='success'/>";
			} else {
				$xml_out .= "<Data rtn='wtnerr'/>";
			}
		} else {
			if( $db->insert("cs_admin", $sql) ) $xml_out .= "<Data rtn='success'/>";
			else $xml_out .= "<Data rtn='wtnerr'/>";
		}
	}
	echo $xml_out;
?>
