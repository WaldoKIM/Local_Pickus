<?
include('../common.php');
$cookie_name = $_SESSION["VIEW_LIST"];
$idx_value="";
?>
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
