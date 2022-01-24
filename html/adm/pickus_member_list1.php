<?php
$sub_menu = "200110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} a ";
$sql_common .= " left join ( select email, count(*) as estimate_cnt from {$g5['estimate_list']} where state != '6' group by email ) b on a.mb_email = b.email ";
$sql_common .= " where a.mb_level in ('0','3','8') ";

$qstr = '';
$qstr .= 'sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sfd=' . urlencode($sfd);
$qstr .= '&amp;std=' . urlencode($std);
$qstr .= '&amp;sml=' . urlencode($sml);

$sql_search = "";
if ($sme) {
    $sql_search .= " and a.mb_email like '%$sme%' ";
}
if ($snn) {
    $sql_search .= " and a.mb_name like '%$snn%' ";
}
if ($shp) {
    $sql_search .= " and a.mb_hp like '%$shp%' ";
}

if ($sml == "0" || $sml == "3" || $sml == "8") {
    $sql_search .= " and a.mb_level = '$sml' ";
}
$fr_date = $sfd;
$to_date = $std;
if (!$fr_date) $fr_date = '0000-00-00';
if (!$to_date) $to_date = '9999-99-99';

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
$sql = " select count(*) as cnt {$sql_common} and a.mb_level = '0' ";
$row = sql_fetch($sql);
$total_count1 = $row['cnt'];

// 탈퇴 회원수
$sql = " select count(*) as cnt {$sql_common} and mb_level = '3'  ";
$row = sql_fetch($sql);
$total_count2 = $row['cnt'];

// 비 회원수
$sql = " select count(*) as cnt {$sql_common} and mb_level = '8'  ";
$row = sql_fetch($sql);
$total_count3 = $row['cnt'];


$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">전체목록</a>';

$g5['title'] = '소비자 회원관리';
include_once('./admin.head.php');

$sql = " select a.*, ifnull(b.estimate_cnt, 0) as estimate_cnt {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);



$colspan = 9;
?>
<script>
    $(function() {
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
    });
</script>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sml=0" class="btn_ov01"> <span class="ov_txt">일반회원 </span><span class="ov_num"><?php echo number_format($total_count1) ?>명</span></a>
    <a href="?sml=3" class="btn_ov01"> <span class="ov_txt">탈퇴회원 </span><span class="ov_num"><?php echo number_format($total_count2) ?>명</span></a>
    <a href="?sml=8" class="btn_ov01"> <span class="ov_txt">비회원 </span><span class="ov_num"><?php echo number_format($total_count3) ?>명</span></a>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
    <div class="sch_last">
        <strong>email</strong>
        <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">
        <strong>이름</strong>
        <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">
        <strong>전화번호</strong>
        <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">
        <strong>기간</strong>
        <input type="text" name="sfd" value="<?php echo $sfd ?>" id="sfd" class="frm_input" size="11" maxlength="10">
        <label for="sfd" class="sound_only">시작일</label>
        ~
        <input type="text" name="std" value="<?php echo $std ?>" id="std" class="frm_input" size="11" maxlength="10">
        <label for="std" class="sound_only">종료일</label>
        <strong>회원구분</strong>
        <select id="sml" name="sml" class="frm_input">
            <option value="">선택</option>
            <option value="0" <?php if ($sml == "0") echo 'selected'; ?>>일반회원</option>
            <option value="3" <?php if ($sml == "3") echo 'selected'; ?>>탈퇴회원</option>
            <option value="8" <?php if ($sml == "8") echo 'selected'; ?>>비회원</option>
        </select>
        <input type="submit" value="검색" class="btn_submit">
    </div>
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sme" value="<?php echo $sme ?>">
    <input type="hidden" name="snn" value="<?php echo $snn ?>">
    <input type="hidden" name="shp" value="<?php echo $shp ?>">
    <input type="hidden" name="sfd" value="<?php echo $sfd ?>">
    <input type="hidden" name="std" value="<?php echo $std ?>">
    <input type="hidden" name="sml" value="<?php echo $sml ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col style="width: 7%" />
                <col style="width: 20%" />
                <col style="width: 7%" />
                <col style="width: 8%" />
                <col style="width: 15%" />
                <col style="width: 10%" />
                <col style="width: 10%" />
                <col style="width: 8%" />
                <col style="width: 15%" />
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">구분</th>
                    <th scope="col">이메일</th>
                    <th scope="col">이름</th>
                    <th scope="col">가입일</th>
                    <th scope="col">전화번호</th>
                    <th scope="col">중고구매 / 매입</th>
                    <th scope="col">이메일 수신여부</th>
                    <th scope="col">탈퇴일</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                    $s_mod = "";
                    $s_mod .= '<a href="./pickus_member_list_login2.php?mb_id=' . $row['mb_id'] . '" class="btn btn_02">로그인</a>';
                    $s_mod .= '<a href="./pickus_member_list_delete.php?' . $qstr . '&gubun=1&w=u&mb_id=' . $row['mb_id'] . '" class="btn btn_01">삭제</a>';
                    $s_mod .= '<a href="./pickus_member_form.php?' . $qstr . '&w=u&mb_type=1&mb_id=' . $row['mb_id'] . '" class="btn btn_03">수정</a>';
                ?>

                    <tr class="<?php echo $bg; ?>">
                        <td class="td_mng">
                            <?php
                            if ($row['mb_level'] == "8") {
                                echo '비회원';
                            } else {
                                echo '회원';
                            }
                            ?>
                        </td>
                        <td class="td_name">
                            <?php echo $row['mb_email']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['mb_name']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['mb_datetime']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['mb_hp']; ?>
                        </td>
                        <td class="td_mng">
                            <?php
                            // 중고구매 견적수 
                            $email = $row['mb_email'];
                            $sql = "select count(*) as match_cnt from {$g5['estimate_match']} where state != '6' AND email = '$email'";
                            $fetch = sql_fetch($sql);
                            echo number_format($fetch['match_cnt']) . '건 / ';
                            echo number_format($row['estimate_cnt']) . '건';

                            ?>
                        </td>
                        <td class="td_mng">
                            <?php
                            if ($row['mb_mailling']) {
                                echo 'Y';
                            } else {
                                echo 'N';
                            }
                            ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['mb_leave_date']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $s_mod; ?>
                        </td>
                    </tr>

                <?php
                }
                if ($i == 0)
                    echo "<tr><td colspan=\"" . $colspan . "\" class=\"empty_table\">자료가 없습니다.</td></tr>";
                ?>
            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <a href="./pickus_member_form.php?mb_level=0&mb_type=1" id="member_add" class="btn btn_01">회원추가</a>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>

<?php
include_once('./admin.tail.php');
?>