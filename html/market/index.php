<?
// 기본 클래스 불러오기
include('./common.php');
// 관리자 정보 불러오기
/* with KJS dance*/
error_reporting(E_ALL);
ini_set('display_errors', 1); 
$design_stat = $db->object("cs_design", "");
$db->insert("cs_connect", "ip='$_SERVER[REMOTE_ADDR]', url='$_SERVER[HTTP_REFERER]', register=now()");
//$db->insert("cs_connect", "ip='$_SERVER[REMOTE_ADDR]', url='$_SERVER[HTTP_REFERER]', register=now()");
$skin_url = str_replace($admin_stat->shop_domain,'', $admin_stat->shop_url);
$skin_url = str_replace('/','', $skin_url);
?>
<html>
<head>
<?
	$shop_ico="../data/designImages/".$design_stat->bookmarkicon;
	$shop_bookmark="../data/designImages/".$design_stat->icoicon;
	$shop_og="../data/designImages/".$design_stat->bookmarkicon;
?>
<link href="<?=$shop_ico?>" rel="apple-touch-icon" />
<link rel="shortcut icon" href="<?=$shop_ico?>" type="image/x-icon">

<title><?=$design_stat->title_bar;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="<?=$design_stat->meta_title;?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?=$design_stat->title_bar;?>">
<meta property="og:description" content="<?=$MetaDescription;?> ">
<meta property="og:image" content="http://<?=$_SERVER[SERVER_NAME];?>/data/designImages/<?=$design_stat->title_logo;?>">
<meta property="og:url" content="">  

<link rel="SHORTCUT ICON" href="http://<?=$_SERVER[SERVER_NAME];?>/data/designImages/<?=$design_stat->ico;?>" type="image/x-icon">
</head>
<script language="JavaScript">
<!--
window.status='<?=$design_stat->status_bar;?>';
//-->
</script>

<?
if($admin_stat->frametype==0) $tools->metaGo("./".$skin_url);
?>

<frameset rows="0,*" frameborder="NO" border="0" framespacing="0">
  <frame src="nohtml.php" name="" scrolling="NO" noresize>
  <? if($admin_stat->shop_url) {?><frame src="<?=$skin_url;?>/index.php" name="main"><?}?>
</frameset>
<noframes><body>

</body></noframes>
</html>


