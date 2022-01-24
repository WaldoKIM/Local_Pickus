<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
$code = $_GET[code];
if($_GET['arr_del_list']) {
	$arr_idx = explode('@',$_GET['arr_del_list']);
	if(sizeof($arr_idx)) {
		foreach($arr_idx as $key=>$val) {
			if($val && $val!="on") {
				$row = $db->object("cs_bbs_data", "where idx=".$val);
				if( $row->bbs_file != "none" ) { @unlink("../../data/bbsData/".$row->bbs_file); }
				if( $row->add_file1 != "none" ) { @unlink("../../data/bbsData/".$row->add_file1); }
				if( $row->add_file2 != "none" ) { @unlink("../../data/bbsData/".$row->add_file2); }
				if( $row->add_file3 != "none" ) { @unlink("../../data/bbsData/".$row->add_file3); }
				if( $row->add_file4 != "none" ) { @unlink("../../data/bbsData/".$row->add_file4); }
				if( $row->add_file5 != "none" ) { @unlink("../../data/bbsData/".$row->add_file5); }
				if(!$db->delete("cs_bbs_data", "where idx =".$val)) $tools->errMsg('삭제 실패.\n\n다시 시도해주세요');
			}
		}
	}
	$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?code=$code");
} else {
	if($db->delete("cs_bbs_data", "where idx =".$_GET['del_list'])) $tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?code=$code");
	else $tools->errMsg('삭제 실패.\n\n다시 시도해주세요');
}
?>
