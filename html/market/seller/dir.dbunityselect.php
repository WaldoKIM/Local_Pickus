<?
include('../common.php');

$_GET=&$HTTP_GET_VARS;

if($_GET[table] ) {$table = $_GET[table];}		//table name
if($_GET[field] ) {$field = $_GET[field];}		//field name
if($_GET[idx] ) {$idx = $_GET[idx];}			//idx name
if($_GET[value] ) {$value = $_GET[value];}		//value name

If( $db->update($table, $field."='".$value."' where idx='".$idx."'")) {
}
else {
	echo "alert('수정시 문제 발생. 다시 시도해 주세요.');";
}

?>
