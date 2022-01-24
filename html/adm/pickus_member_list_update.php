<?php
$sub_menu = "200110";
include_once('./_common.php');

$qstr = '';
$qstr .= 'sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sfd=' . urlencode($sfd);
$qstr .= '&amp;std=' . urlencode($std);
$qstr .= '&amp;sml=' . urlencode($sml);
$qstr .= '&amp;sms=' . urlencode($sms);
$qstr .= '&amp;page=' . urlencode($page);

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택 수수료율 변경") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb_id = $_POST['mb_id'][$k];
        $mb_biz_charge_rate = $_POST['mb_biz_charge_rate'][$k];
        $mb_biz_match_rate = $_POST['mb_biz_match_rate'][$k];
        $sql = " update {$g5['member_table']}
                    set mb_biz_charge_rate = '$mb_biz_charge_rate',
                    mb_biz_match_rate = '$mb_biz_match_rate'
                    where mb_id = '$mb_id' ";
        sql_query($sql);

        //echo $sql.'<br>';
    }

}

//echo $sql;
alert("변경하였습니다.","./pickus_member_list2.php?".$qstr);
?>
