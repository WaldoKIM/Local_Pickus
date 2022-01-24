<?
include('../common.php');

$_POST=&$HTTP_POST_VARS;

header("Content-type: text/xml;charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
	
	$admin_stat=$db->object("cs_admin", "");


	$server_addr = eregi_replace ('www.', '', $_SERVER["HTTP_HOST"]);

	$_SESSION["ADMIN_USERID"] = "";
	$_SESSION["ADMIN_PASSWD"] = "";
	$_SESSION["ADMIN_EMAIL"] = "";
	$_SESSION["ADMIN_NAME"] = "";


	$admin_userid = urldecode($_POST[id]);
	$admin_passwd = urldecode($_POST[pw]);


	if($admin_userid == $admin_stat->admin_userid && $admin_passwd == $admin_stat->admin_passwd)
	{
		$ADMIN_USERID	= $admin_stat->admin_userid;
		$ADMIN_PASSWD	= $admin_stat->admin_passwd;
		$ADMIN_EMAIL	= $admin_stat->shop_email;
		$ADMIN_NAME		= "관리자";
		$_SESSION["ADMIN_USERID"] = $ADMIN_USERID;
		$_SESSION["ADMIN_PASSWD"] = $ADMIN_PASSWD;
		$_SESSION["ADMIN_EMAIL"] = $ADMIN_EMAIL;
		$_SESSION["ADMIN_NAME"] = $ADMIN_NAME;
		
		$xml_out .= "<Data rtn=\"success\"";
		$xml_out .= " lcn=\"".$admin_stat->sens_license."\"";
		$xml_out .= " sad=\"".$server_addr."\"";
		$xml_out .= " dbu=\"".$DB_USER."\"";
		$xml_out .= " dbn=\"".$DB_NAME."\"";
		$xml_out .= "/>";
	} else {
		$xml_out .= "<Data rtn=\"fail\"/>";
	}
	echo $xml_out;
?>


		
