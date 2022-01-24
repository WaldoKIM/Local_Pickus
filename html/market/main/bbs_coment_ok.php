<?
include('../common.php');
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;
$MV_DATA	= $_GET["board_data"];
$bbs_data	= $tools->decode( $_GET["board_data"] );
$idx = $bbs_data["idx"];

$MV_SEARCH_ITEM	= $_GET["search_items"];
$SEARCH_ITEM	= $tools->decode( $_GET["search_items"] );

$code = $SEARCH_ITEM["code"];

if(!$_SERVER['HTTP_REFERER']){
	$tools->errMsg('잘못된 방식으로 접근하셨습니다.');
	exit;
}else{
	if( $_POST["coment_reg"] ) {	
		if($COMENTSIGN==1){
			if($_SESSION["text"] != $_POST["imagecode"])$tools->errMsg('보안코드값이 정확하지 않습니다. 다시 입력하여 주세요.');
		}

		$_POST["name"]	= $db->addSlash( $_POST["name"] );		
		$_POST["coment"]	= $db->addSlash( $_POST["coment"] );		
		$db->insert("cs_bbs_coment", "link = $idx, coment = '$_POST[coment]', name = '$_POST[name]', pwd = '$_POST[pwd]', reg_date = now()");
		$tools->alertJavaGo("등록 하였습니다.", "bbs_list.php?boardT=v&board_data=$MV_DATA&search_items=$MV_SEARCH_ITEM");
	} else if( $_POST["coment_del"] ) {
		$co_row	= $db->object("cs_bbs_coment", "where idx=$_POST[coment_idx]", "pwd");
		if( $co_row->pwd == $_POST[pwd] ) {
			$db->delete("cs_bbs_coment", "where idx = $_POST[coment_idx]");
			$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?boardT=v&board_data=$MV_DATA&search_items=$MV_SEARCH_ITEM");
		} else {
			$tools->errMsg("패스워드가 올바르지 않습니다.");			
		}
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
}
?>
