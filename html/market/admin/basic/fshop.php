<?php
	include('../../common.php');
	header("Content-type: text/xml;charset=UTF-8");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	$xml_out = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

	if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]){
		$xml_out .= "<Data rtn=\"unknown\"/>";
	} else {
		$result = $db->select("cs_admin", "");
		for($i=0 ; $i<@mysql_num_fields($result) ; $i++) {
			$resultData = @mysql_result($result,0,$i);
			$resultData = $enweek = str_replace("<","&lt;",$resultData);	//시작태그 처리(xml오류);
			$resultData = $enweek = str_replace('"','',$resultData);		//내용중 쌍따옴표 삭제
			${@mysql_field_name($result,$i)} = $resultData;
		};

		$xml_out .= "<Data rtn=\"success\"";
		$xml_out .= " dom=\"".$shop_domain."\"";
		$xml_out .= " skn=\"".$shop_url."\"";
		$xml_out .= " hsn=\"".$shop_name."\"";
		$xml_out .= " esn=\"".$shop_en_name."\"";
		$xml_out .= " sno=\"".$shop_num."\"";
		$xml_out .= " ssno=\"".$shop_license."\"";
		$xml_out .= " sn1=\"".$shop_ceo."\"";
		$xml_out .= " sn2=\"".$safeguard_admin."\"";
		$xml_out .= " ema=\"".$shop_email."\"";
		$xml_out .= " tl1=\"".$shop_tel1."\"";
		$xml_out .= " tl2=\"".$shop_tel2."\"";
		$xml_out .= " fax=\"".$shop_fax."\"";
		$xml_out .= " mob=\"".$shop_phone."\"";
		$xml_out .= " sst=\"".$shop_status."\"";
		$xml_out .= " sit=\"".$shop_item."\"";
		$xml_out .= " add=\"".$shop_address."\"";
		$xml_out .= " wek=\"".$week."\"";
		$xml_out .= " lcn=\"".$sens_license."\"";
		$xml_out .= " trc=\"".$trade_code."\"";
		$xml_out .= " sst=\"".$shop_status."\"";
		$xml_out .= " sit=\"".$shop_item."\"";
		$xml_out .= " dbu=\"".$DB_USER."\"";
		$xml_out .= " dbp=\"".$DB_PWD."\"";
		$xml_out .= " dbn=\"".$DB_NAME."\"";
		$xml_out .= "/>";
	}
	$xml_out = iconv("UTF-8", "euc-kr", $xml_out); 
	echo $xml_out;
?>
