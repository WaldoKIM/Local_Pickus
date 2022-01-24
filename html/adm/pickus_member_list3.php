<?php
$sub_menu = "200130";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} a ";
$sql_common .= " left join (  ";
$sql_common .= "    select b.rc_email, count(*) as estimate_cnt, sum(b.price) as estimate_amt ";
$sql_common .= "    from ";
$sql_common .= "        {$g5['estimate_list']} a ";
$sql_common .= "        join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.selected = '1' and a.state = '5' ";
$sql_common .= "    group by b.rc_email  ";
$sql_common .= "  ";
$sql_common .= " ) b on a.mb_email = b.rc_email ";
$sql_common .= " where a.mb_level = '1' ";

$qstr = '';
$qstr .= 'sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sfd=' . urlencode($sfd);
$qstr .= '&amp;std=' . urlencode($std);
$qstr .= '&amp;sms=' . urlencode($sms);

$sql_search = "";
if($sme){
    $sql_search .= " and a.mb_email like '%$sme%' ";
}
if($snn){
    $sql_search .= " and a.mb_name like '%$snn%' ";
}
if($shp){
    $sql_search .= " and a.mb_hp like '%$shp%' ";
}



if($sms){
    $sql_search .= " and a.mb_biz_score = '$sms' ";   
}
$fr_date = $sfd;
$to_date = $std;
if(!$fr_date) $fr_date = '0000-00-00';
if(!$to_date) $to_date = '9999-99-99';

$sql_search .= " and date_format(a.mb_datetime,'%Y-%m-%d') between '$fr_date' and '$to_date' ";

$sql_order = " order by a.mb_datetime desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 총 회원수
$sql = " select count(*) as cnt {$sql_common}  ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// 일반 회원수
$sql = " select count(*) as cnt {$sql_common} and a.mb_level = '2' ";
$row = sql_fetch($sql);
$total_count1 = $row['cnt'];

// 탈퇴 회원수
$sql = " select count(*) as cnt {$sql_common} and mb_level = '4'  ";
$row = sql_fetch($sql);
$total_count2 = $row['cnt'];



$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '센터 회원 승인요청';
include_once('./admin.head.php');

$sql = " select a.*, ifnull(b.estimate_cnt, 0) as estimate_cnt, ifnull(b.estimate_amt, 0) as estimate_amt {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 9;
?>
<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});
</script>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sml=2" class="btn_ov01"> <span class="ov_txt">승인센터 </span><span class="ov_num"><?php echo number_format($total_count1) ?>명</span></a>
    <a href="?sml=4" class="btn_ov01"> <span class="ov_txt">탈퇴센터  </span><span class="ov_num"><?php echo number_format($total_count2) ?>명</span></a>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    <strong>email</strong>
    <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">
    <strong>이름</strong>
    <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">
    <strong>전화번호</strong>
    <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">
    <strong>평점</strong>
    <input type="text" name="sms" value="<?php echo $sms ?>" id="sms" class="frm_input" size="8">
    <strong>기간</strong>
    <input type="text" name="sfd" value="<?php echo $sfd ?>" id="sfd" class="frm_input" size="11" maxlength="10">
    <label for="sfd" class="sound_only">시작일</label>
    ~
    <input type="text" name="std" value="<?php echo $std ?>" id="std" class="frm_input" size="11" maxlength="10">
    <label for="std" class="sound_only">종료일</label>
    <input type="submit" value="검색" class="btn_submit">
</div>
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sme" value="<?php echo $sme ?>">
<input type="hidden" name="snn" value="<?php echo $snn ?>">
<input type="hidden" name="shp" value="<?php echo $shp ?>">
<input type="hidden" name="shp" value="<?php echo $shp ?>">
<input type="hidden" name="sms" value="<?php echo $sms ?>">
<input type="hidden" name="std" value="<?php echo $std ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col style="width: 10%" />
        <col style="width: 15%" />
        <col style="width: 10%" />
        <col style="width: 10%" />
        <col style="width: 10%" />
        <col style="width: 10%" />
        <col style="width: 14%" />
        <col style="width: 8%" />
        <col style="width: 12%" />
    </colgroup>    
    <thead>
        <tr>
            <th scope="col">센터종류</th>
            <th scope="col">이메일</th>
            <th scope="col">센터이름</th>
            <th scope="col">담당자명</th>
            <th scope="col">담당자연락처</th>
            <th scope="col">센터연락처</th>
            <th scope="col">지역</th>
            <th scope="col">이메일 수신여부</th>
            <th scope="col">관리</th>
        </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $s_mod = "";
        $s_mod .= '<a href="./pickus_member_list_confirm.php?'.$qstr.'&w=u&mb_id='.$row['mb_id'].'" class="btn btn_03">승인</a>';
        $s_mod .= '<a href="./pickus_member_list_delete.php?'.$qstr.'&gubun=3&w=u&mb_id='.$row['mb_id'].'" class="btn btn_01">삭제</a>';
        $s_mod .= '<a href="./pickus_member_form.php?'.$qstr.'&gubun=3&w=u&mb_id='.$row['mb_id'].'" class="btn btn_03">보기</a>';
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_mng">
            <?php 
               echo get_biz_type($row['mb_biz_type']);
            ?>
        </td>
        <td class="td_name">
            <?php echo $row['mb_email']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['mb_biz_name']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['mb_biz_worker_name']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['mb_biz_worker_phone']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['mb_hp']; ?>                
        </td>
        <td class="td_name">
           <?php echo $row['mb_biz_addr1']; ?>  
        </td>
        <td class="td_mng">
            <?php 
                if($row['mb_mailling'])
                {
                    echo 'Y';
                }else{
                    echo 'N';
                }
            ?>                
        </td>        
        <td class="td_mng">
            <?php echo $s_mod; ?>
        </td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./pickus_member_form.php?mb_level=2" id="member_add" class="btn btn_01">회원추가</a>
</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}
</script>
<?php
include_once ('./admin.tail.php');
?>
