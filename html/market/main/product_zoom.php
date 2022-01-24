<? include('../common.php');
 
$mv_data	= $_GET[goods_data];
$admin_stat = $db->object("cs_admin", "");
$goods_data	= $tools->decode($_GET[goods_data]);
$goods_stat=$db->object("cs_goods", "where idx=$goods_data[idx]", "*");
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
$cookie_name = $_SESSION[VIEW_LIST];
//최근 살펴본 상품 등록하기[1일]
$idx_value = $idx."&&";
$cookie_value = $HTTP_COOKIE_VARS[$cookie_name];
$cut_value = "0&&".$HTTP_COOKIE_VARS[$cookie_name];
$idx_arr = explode("&&", $cut_value);
if(strlen(array_search($idx, $idx_arr)) > 0){
$idx_value = $cookie_value;
}else{
$idx_value = $idx_value.$cookie_value;
$idx_value = substr($idx_value, 0, 50);
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<style>
    .product-view img{width:100%}
    .product-title{height:60px;background:#222;font-size:1em;font-weight:300;line-height:60px;color:#fff;padding-left:15px}
    .product-view h3{font-weight:400;color:#4c4c4c;font-size:2.5em;margin-top:27px;text-align:center;width:60%;margin:27px auto;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
</style>
<script language="javascript" src="../lib/popup.js"></script>
<script language="javascript">
	<!--
	function SaveCookie(name, value, expire) {
		var eDate = new Date();
		eDate.setDate(eDate.getDate() + expire);
		document.cookie = name + '=' + value + '; expires=' + eDate.toGMTString()+ '; path=/';
	}
	function start_cookie(){
		SaveCookie("<?=$cookie_name?>", "<?=$idx_value?>", 1);
		parent.ajaxtodayview();
	}
	start_cookie();
	//-->
</script>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="product-view">
    <div class="product-title">제품미리보기</div>
	<h3><?=$db->stripSlash($goods_stat->name);?></h3>
    <div style="padding:10px;">
        <?=$goods_stat->content?>
    </div>
</div>