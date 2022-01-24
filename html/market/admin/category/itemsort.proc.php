<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;

// 디비 입력
if( $db->update("cs_design", "item_all_sort='$_GET[item_all_sort]'") ) { $tools->alertJavaGo('순위  변경 되었습니다.', 'category_list.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>
