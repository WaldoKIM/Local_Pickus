<?
include('../../common.php');
$area1 = $_GET['area1'];

$area2_result = $db->select("g5_estimate_area2","where area1='$area1' order by idx asc");
while( $area2_row = @mysqli_fetch_object($area2_result) ) {
?>
	<option value="<?=$area2_row->area2;?>"><?=$area2_row->area2;?></option>
<?}?>
