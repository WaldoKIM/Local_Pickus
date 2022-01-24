<?
include('../../common.php'); 
//$_POST=&$HTTP_POST_VARS;
$_FILES=&$HTTP_POST_FILES;


$_POST[title_bar] = $db->addSlash ( $_POST[title_bar] );
$_POST[status_bar] = $db->addSlash ( $_POST[status_bar] );
$_POST[meta_title] = $db->addSlash ( $_POST[meta_title] );
// 디비 입력
if( $db->update("cs_design", "title_bar='$_POST[title_bar]', status_bar='$_POST[status_bar]', meta_title='$_POST[meta_title]'") ) { $tools->alertJavaGo('웹브라우저 타이틀  변경 되었습니다.', 'display.php'); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}
?>
