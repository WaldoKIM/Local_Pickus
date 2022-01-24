<?php
include_once('./_common.php');

//dbconfig파일에 $g5['faq_table'] , $g5['faq_master_table'] 배열변수가 있는지 체크
if( !isset($g5['faq_table']) || !isset($g5['faq_master_table']) ){
    die('<meta charset="utf-8">관리자 모드에서 게시판관리->FAQ관리를 먼저 확인해 주세요.');
}

$g5['title'] = "FAQ";

include_once('./_head.php');

$skin_file = $faq_skin_path.'/list.skin.php';

$sql = " select *
            from {$g5['faq_table']}
            order by fa_order , fa_id ";

$result = sql_query($sql);

if(is_file($skin_file)) {
    include_once($skin_file);
} else {
    echo '<p>'.str_replace(G5_PATH.'/', '', $skin_file).'이 존재하지 않습니다.</p>';
}

include_once('./_tail.php');
?>
