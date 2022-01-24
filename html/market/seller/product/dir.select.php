<?
//$_GET=&$HTTP_GET_VARS;
include('../../common.php');
?>

<script type='text/javascript'>
<?
$part_idx = $_GET[part_idx];
if($part_idx) {$part_stat = $db->object("cs_part", "where idx=$part_idx");} else { $tools->errMsg('비정상적으로 접속 하였습니다');}

for($i=1;$i<=$part_stat->part_index;$i++){
	$part_query .= " and part".$i."_code='".$part_stat->{"part".$i."_code"}."'";
}

//상위 카테고리에 속해있는 하위 카테고리 정보 가져오기
$partQuery = $db->select("cs_part", "where idx > 0 $part_query");
$N=0;
while( $partRow = mysqli_fetch_object($partQuery)) {
	$N++;
	if($N==1){
		$subList .= $partRow->idx;
	}else{
		$subList .= ", ".$partRow->idx;
	}
}

if($_GET[searchtxt]) $query = " and (name like '%$_GET[searchtxt]%' or tag like '%$_GET[searchtxt]%' or description like '%$_GET[searchtxt]%' or content like '%$_GET[searchtxt]%')";
if($_GET[part_idx]) $partquery = " and part_idx IN($subList)";
$result		= $db->select("cs_goods", "where display=1 $query $partquery order by idx desc" );
$i=0;
while( $row = mysqli_fetch_object($result) ) {
	echo "var oOption = document.createElement('OPTION');";
	echo "oOption.value = '".$row->idx."';";
	echo "oOption.text = '".$row->name."';";
	echo "parent.document.all.subitems.options.add(oOption);";
}
?>
</script>
