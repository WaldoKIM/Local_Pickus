<?
include('../common.php');
//@header("Content-Type: application/x-javascript");
echo "<script type='text/javascript'>";
//$_GET=&$HTTP_GET_VARS;
$result = $db->object("cs_part", "where idx = '".$_GET[value]."'");
$fieldArr = explode("@", $result->fieldlist);
echo "parent.document.getElementById('addfield').style.display = ''";
for($i=0;$i<$DEFAULTADDFIELD;$i++){
	echo "parent.document.getElementById('addfield').innerHTML = \"<input type='text' name='fieldlist[]' value='".$fieldArr[$i]."' size='15'>\";";
	echo "parent.document.getElementById('addfield').innerHTML = \"<textarea style='width:100%;height:35px;' name='fielddata[]'></textarea>\";";
	if(($i+1)%5==0 && $i!=0){
		echo "<br>";
	}
}
?>
</script>
