<?php
$sub_menu = "400500";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '업체문의넣기';
include_once('./admin.head.php');
?>

<style>
    .push_form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;

    }

    .push_title {
        font-size: 18px;
        font-weight: 800;
        color: #1379cd;
        margin-bottom: 20px;
    }

    .estimate {
        margin-bottom: 20px;
        border: 1px solid #1379cd;
        padding: 30px;
        border-radius: 10px;
        width: 450px;
        margin-right: 50px;
    }

    .estimate_match {
        margin-bottom: 20px;
        border: 1px solid #1379cd;
        padding: 30px;
        border-radius: 10px;
        width: 450px;
    }

    .push_input {
        margin-top: 10px;
        border: 2px solid #1379cd;
        padding: 10px;
        border-radius: 10px;
    }

    .push_li {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
        width: 60%;
        font-size: 16px;
    }

    .push_btn {
        border: 2px solid #1379cd;
        border-radius: 10px;
        width: 100px;
        height: 30px;
        font-size: 16px;
        line-height: 28px;
        text-align: center;
        font-weight: 700;
        margin: auto;
        margin-top: 10px;
    }

    .push_ul {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hr {
        width: 100%;
        border: 1px solid #1379cd;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<div class="push_form">
    <div class="estimate">
        <p class="push_title">견적 업체문의</p>
        <hr class="hr">
        <form name="frmrequest" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_request_update_adm.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <ul class="push_ul">
                <li class="push_li">견적번호<input class="push_input" type="number" name="idx" id="idx" placeholder="견적번호를 입력해주세요."></li>
                <li class="push_li">업체이메일<input class="push_input" type="text" name="email" id="email" placeholder="이메일을 입력해주세요."></li>
                <li class="push_li"><?php echo "<a class='push_btn' href='javascript:etdoRequest(\"" . $idx . "\",\"" . $email . "\" )'>문의하기</a>"; ?></li>
            </ul>
        </form>
    </div>

    <div class="estimate_match">
        <p class="push_title">구매매칭 업체문의</p>
        <hr class="hr">
        <form name="mtfrmrequest" action="<?php echo G5_URL; ?>/estimate/my_estimate_form_request_match_update_adm.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <ul class="push_ul">
                <li class="push_li">견적번호<input class="push_input" type="number" name="no_estimate" id="no_estimate" placeholder="견적번호를 입력해주세요."></li>
                <li class="push_li">업체이메일<input class="push_input" type="text" name="email" id="mtemail" placeholder="이메일을 입력해주세요."></li>
                <li class="push_li"><?php echo "<a class='push_btn' href='javascript:mtdoRequest(\"" . $no_estimate . "\",\"" . $email . "\" )'>문의하기</a>"; ?></li>
            </ul>
        </form>
    </div>
</div>

<hr class="hr">
<p style="margin-top:2%; text-align:center; font-size:24px;">견적진행현황</p>
<?php


auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['estimate_list']} a ";
$sql_common .= " left join ( select 
                                estimate_idx, 
                                ifnull(max(case when selected = '1' then date_format(requesttime, '%Y-%m-%d') else '' end ),'') as request_date,
                                ifnull(max(case when selected = '1' then date_format(completetime, '%Y-%m-%d') else '' end ),'') as complete_date,
                                count(*) as estimate_cnt,
                                max(price) as estimate_amt1,
                                min(price) as estimate_amt2,
                                min(price_minus) as price_minus
                            from 
                                {$g5['estimate_propose']} 
                            group by estimate_idx ) b on a.idx = b.estimate_idx ";
$sql_common .= " left join {$g5['estimate_propose']}  c on a.idx = c.estimate_idx and c.selected = '1' ";
$sql_common .= " where 1=1 ";
$qstr = '';
$qstr .= 'set=' . urlencode($set);
$qstr .= '&amp;sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sa1=' . urlencode($sa1);
$qstr .= '&amp;sa2=' . urlencode($sa2);
$qstr .= '&amp;stl=' . urlencode($stl);
$qstr .= '&amp;swf=' . urlencode($swf);
$qstr .= '&amp;swt=' . urlencode($swt);
$qstr .= '&amp;spf=' . urlencode($spf);
$qstr .= '&amp;spt=' . urlencode($spt);
$qstr .= '&amp;scf=' . urlencode($scf);
$qstr .= '&amp;sct=' . urlencode($sct);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);

$sql_search = "";
if ($set == "0" || $set) {
    $sql_search .= " and a.e_type = '$set' ";
}
if ($sme) {
    $sql_search .= " and a.email like '%$sme%' ";
}
if ($snn) {
    $sql_search .= " and a.nickname like '%$snn%' ";
}
if ($shp) {
    $sql_search .= " and a.phone like '%$shp%' ";
}
if ($sa1) {
    $sql_search .= " and a.area1 = '$sa1' ";
}
if ($sa2) {
    $sql_search .= " and a.area2 = '$sa2' ";
}
if ($stl) {
    $sql_search .= " and a.title like '%$stl%' ";
}

if ($sta) {
    $sql_search .= " and a.state = '$sta' ";
}

if ($smp) {
    $sql_search .= " and a.simple_yn = '$smp' ";
}

$fr_write_date = $swf;
$to_write_date = $swt;
$fr_pickup_date = $spf;
$to_pickup_date = $spt;
$fr_complete_date = $scf;
$to_complete_date = $sct;
if (!$fr_write_date) $fr_write_date = '0000-00-00';
if (!$to_write_date) $to_write_date = '9999-99-99';
if (!$fr_pickup_date) $fr_pickup_date = '0000-00-00';
if (!$to_pickup_date) $to_pickup_date = '9999-99-99';
if (!$fr_complete_date) $fr_complete_date = '0000-00-00';
if (!$to_complete_date) $to_complete_date = '9999-99-99';

if ($swf || $swt) $sql_search .= " and date_format(a.writetime, '%Y-%m-%d') between '$fr_write_date' and '$to_write_date' ";
if ($spf || $spt) $sql_search .= " and a.pickup_date between '$fr_pickup_date' and '$to_pickup_date' ";
if ($scf || $sct) $sql_search .= " and b.request_date between '$fr_complete_date' and '$to_complete_date' ";

$sql_order = " order by a.idx desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select count(*) as cnt {$sql_common}  ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common} and a.e_type = '0' ";
$row = sql_fetch($sql);
$total_count1 = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common} and a.e_type = '1'  ";
$row = sql_fetch($sql);
$total_count2 = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common} and a.e_type = '2'  ";
$row = sql_fetch($sql);
$total_count3 = $row['cnt'];

$sql = " select count(*) as cnt {$sql_common} and a.e_type = '3'  ";
$row = sql_fetch($sql);
$total_count4 = $row['cnt'];


$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">전체목록</a>';

$g5['title'] = '견적진행현황';
include_once('./admin.head.php');

$sql = " select 
            a.*,
            b.*,
            date_format(a.writetime, '%Y-%m-%d') as write_time, 
            case when a.state = '5' then ifnull(b.complete_date, '') else ifnull(b.request_date, '') end as estimate_date, 
            ifnull(b.estimate_cnt, 0) as estimate_cnt,
            case when c.idx is null then case when a.e_type = '2' then ifnull(b.estimate_amt2, 0) else ifnull(b.estimate_amt1, 0) end else c.price end as estimate_amt
        {$sql_common} 
        {$sql_search} 
        {$sql_order} 
        limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 12;
?>
<script>
    $(function() {
        $(" #swf, #swt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $("#spf, #spt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $("#scf, #sct").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $('#sa1').change(function() {
            doSelectArea2();
        });
    });

    function doSelectArea2() {
        $.ajax({
            type: "POST",
            url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
            data: {
                "area1": $('#sa1').val()
            },
            cache: false,
            success: function(data) {
                var fvHtml = "";
                fvHtml += "<option value=\" \" selected>선택</option>";
                fvHtml += data;
                $("#sa2").html(fvHtml);

            }
        });
    }
</script>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총 견적수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>건 </span></span>
    <a href="?set=0" class="btn_ov01"> <span class="ov_txt">가전/가구 매입 </span><span class="ov_num"><?php echo number_format($total_count1) ?>건</span></a>
    <a href="?set=1" class="btn_ov01"> <span class="ov_txt">다량 매입 </span><span class="ov_num"><?php echo number_format($total_count2) ?>건</span></a>
    <a href="?set=2" class="btn_ov01"> <span class="ov_txt">철거/원상복구 </span><span class="ov_num"><?php echo number_format($total_count3) ?>건</span></a>
    <a href="?set=3" class="btn_ov01"> <span class="ov_txt">원스톱 중고매입/철거 </span><span class="ov_num"><?php echo number_format($total_count4) ?>건</span></a>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
    <div class="sch_last">
        <strong>견적구분</strong>
        <select id="set" name="set" class="frm_input">
            <option value="">선택</option>
            <option value="0" <?php if ($set == "0") echo 'selected'; ?>>가전/가구 매입</option>
            <option value="1" <?php if ($set == "1") echo 'selected'; ?>>다량 매입</option>
            <option value="2" <?php if ($set == "2") echo 'selected'; ?>>철거/원상복구</option>
            <option value="3" <?php if ($set == "3") echo 'selected'; ?>>원스톱 중고매입/철거</option>
        </select>

        <strong>email</strong>
        <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">

        <strong>이름</strong>
        <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">

        <strong>전화번호</strong>
        <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">

        <strong>시/도</strong>
        <select id="sa1" name="sa1" class="frm_input">
            <option value="">선택</option>
            <?php
            $sql1 = " select area1 from {$g5['estimate_area1']} order by idx ";

            $result1 = sql_query($sql1);

            for ($i = 0; $row1 = sql_fetch_array($result1); $i++) {
                if ($row1['area1'] == $sa1) {
                    echo '<option value="' . $row1['area1'] . '" selected>' . $row1['area1'] . '</option>';
                } else {
                    echo '<option value="' . $row1['area1'] . '">' . $row1['area1'] . '</option>';
                }
            }
            ?>
        </select>

        <strong>시/구/군</strong>
        <select id="sa2" name="sa2" class="frm_input">
            <option value="">선택</option>
            <?php
            if ($sa1) {
                $sql2 = " select area2 from {$g5['estimate_area2']} where area1='$sa1' order by idx ";
                $result2 = sql_query($sql2);

                for ($i = 0; $row2 = sql_fetch_array($result2); $i++) {
                    if ($row2['area2'] == $sa2) {
                        echo '<option value="' . $row2['area2'] . '" selected>' . $row2['area2'] . '</option>';
                    } else {
                        echo '<option value="' . $row2['area2'] . '">' . $row2['area2'] . '</option>';
                    }
                }
            }
            ?>
        </select>

        <br /><br />

        <strong>제목</strong>
        <input type="text" name="stl" value="<?php echo $stl ?>" id="stl" class="frm_input" size="20">

        <strong>견적신청일</strong>
        <input type="text" name="swf" value="<?php echo $swf ?>" id="swf" class="frm_input" size="11" maxlength="10">
        <label for="swf" class="sound_only">시작일</label>
        ~
        <input type="text" name="swt" value="<?php echo $swt ?>" id="swt" class="frm_input" size="11" maxlength="10">
        <label for="swt" class="sound_only">종료일</label>

        <strong>수거요청일</strong>
        <input type="text" name="spf" value="<?php echo $spf ?>" id="spf" class="frm_input" size="11" maxlength="10">
        <label for="spf" class="sound_only">시작일</label>
        ~
        <input type="text" name="spt" value="<?php echo $spt ?>" id="spt" class="frm_input" size="11" maxlength="10">
        <label for="spt" class="sound_only">종료일</label>

        <strong>수거예정일</strong>
        <input type="text" name="scf" value="<?php echo $scf ?>" id="scf" class="frm_input" size="11" maxlength="10">
        <label for="scf" class="sound_only">시작일</label>
        ~
        <input type="text" name="sct" value="<?php echo $sct ?>" id="sct" class="frm_input" size="11" maxlength="10">
        <label for="sct" class="sound_only">종료일</label>

        <strong>상태</strong>
        <select id="sta" name="sta" class="frm_input">
            <option value="">선택</option>
            <option value="0" <?php if ($sta == "0") echo 'selected'; ?>>견적 대기중</option>
            <option value="1" <?php if ($sta == "1") echo 'selected'; ?>>견적중</option>
            <option value="2" <?php if ($sta == "2") echo 'selected'; ?>>견적선택중</option>
            <option value="3" <?php if ($sta == "3") echo 'selected'; ?>>견적선택됨</option>
            <option value="4" <?php if ($sta == "4") echo 'selected'; ?>>수거중</option>
            <option value="5" <?php if ($sta == "5") echo 'selected'; ?>>수거완료</option>
            <option value="6" <?php if ($sta == "6") echo 'selected'; ?>>견적취소</option>
            <option value="7" <?php if ($sta == "7") echo 'selected'; ?>>견적마감</option>
        </select>

        <strong>간편견적</strong>
        <select id="smp" name="smp" class="frm_input">
            <option value="">선택</option>
            <option value="1" <?php if ($smp == "1") echo 'selected'; ?>>간편견적신청</option>
        </select>

        <input type="submit" value="검색" class="btn_submit">
    </div>
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="set" value="<?php echo $set ?>">
    <input type="hidden" name="sme" value="<?php echo $sme ?>">
    <input type="hidden" name="snn" value="<?php echo $snn ?>">
    <input type="hidden" name="shp" value="<?php echo $shp ?>">
    <input type="hidden" name="sa1" value="<?php echo $sa1 ?>">
    <input type="hidden" name="sa2" value="<?php echo $sa2 ?>">
    <input type="hidden" name="stl" value="<?php echo $stl ?>">
    <input type="hidden" name="swf" value="<?php echo $swf ?>">
    <input type="hidden" name="swt" value="<?php echo $swt ?>">
    <input type="hidden" name="spf" value="<?php echo $spf ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="scf" value="<?php echo $scf ?>">
    <input type="hidden" name="sct" value="<?php echo $sct ?>">
    <input type="hidden" name="sta" value="<?php echo $sta ?>">
    <input type="hidden" name="smp" value="<?php echo $smp ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col style="width: 8%" />
                <col style="width: 12%" />
                <col style="width: 9%" />
                <col style="width: 6%" />
                <col style="width: 13%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 10%" />
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">견적번호</th>
                    <th scope="col">견적종류</th>
                    <th scope="col">Email</th>
                    <th scope="col">지역</th>
                    <th scope="col">이름</th>
                    <th scope="col">제목</th>
                    <th scope="col">매입가</th>
                    <th scope="col">폐기가</th>
                    <th scope="col">견적신청일</th>
                    <th scope="col">수거요청일</th>
                    <th scope="col">견적현황</th>
                    <th scope="col">수거예정일</th>
                    <th scope="col">업체견적수</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <script type="text/javascript">
                    $(function() {
                        $(".delete").click(function() {
                            if (confirm('삭제하시겠습니까?')) {
                                var url = $(this).next('a').attr('href');
                                location.href = url;
                            }
                        })
                    });
                </script>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                    $s_mod = "";
                    $s_mod .= '<a href="' . G5_URL . '/estimate/my_estimate_form.php?idx=' . $row['idx'] . '" target="_blank" class="btn btn_03">보기</a>';
                    $s_mod .= '<a href="#none" id="" class="btn btn_01 delete">삭제</a>';
                    $s_mod .= '<a id="delete_url" style="display:none;" href="./pickus_estimate_list_delete.php?' . $qstr . '&page=' . $page . '&idx=' . $row['idx'] . '" class="btn btn_01">삭제</a>';
                    $s_mod .= '<a href="./pickus_estimate_form.php?' . $qstr . '&page=' . $page . '&idx=' . $row['idx'] . '" class="btn btn_03">수정</a>';
                ?>

                    <tr class="<?php echo $bg; ?>">
                        <td class="td_mng">
                            <?php echo $row['idx']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo get_etype($row['e_type']); ?>
                        </td>
                        <td class="td_name">
                            <?php echo $row['email']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['area1']; ?> <?php echo $row['area2']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['nickname']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['title']; ?>
                        </td>
                        <td class="td_mng td_num">
                            <?php echo number_format($row['estimate_amt']); ?>
                        </td>
                        <td class="td_mng td_num">
                            <?php echo number_format($row['price_minus']); ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['write_time']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['pickup_date']; ?>
                        </td>
                        <td class="td_mng">
                            <?php
                            echo get_estimate_state($row['state']);
                            if ($row['simple_yn']) {
                                echo "(간편견적)";
                            }
                            ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['estimate_date']; ?>
                        </td>
                        <td class="td_mng td_num">
                            <?php echo number_format($row['estimate_cnt']); ?>
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
        <a href="./pickus_estimate_form.php?<?php echo $qstr; ?>&page=<?php echo $page; ?>&e_type=0" id="member_add" class="btn btn_02">가전/가구 매입 추가</a>
        <a href="./pickus_estimate_form.php?<?php echo $qstr; ?>&page=<?php echo $page; ?>&e_type=1" id="member_add" class="btn btn_02">다량 일괄 매입 추가</a>
        <a href="./pickus_estimate_form.php?<?php echo $qstr; ?>&page=<?php echo $page; ?>&e_type=2" id="member_add" class="btn btn_02">철거/원상복구 추가</a>
        <a href="./pickus_estimate_form.php?<?php echo $qstr; ?>&page=<?php echo $page; ?>&e_type=3" id="member_add" class="btn btn_02">원스톱 중고매입/철거 추가</a>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>

<hr class="hr">
<p style="margin-top:2%; text-align:center; font-size:24px;">중고구매 견적진행 현황</p>
<?php

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_estimate_match a";
$sql_common .= " where 1=1 ";

/*$sql_join = "SELECT *
FROM g5_estimate_match_info AS a 
JOIN g5_estimate_match AS b
ON a.no_estimate = b.no_estimate WHERE 1=1";
$row_join = sql_fetch($sql_join);*/
/*
$qstr = '';
$qstr .= 'set=' . urlencode($set);
$qstr .= '&amp;sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sa1=' . urlencode($sa1);
$qstr .= '&amp;sa2=' . urlencode($sa2);
$qstr .= '&amp;stl=' . urlencode($stl);
$qstr .= '&amp;swf=' . urlencode($swf);
$qstr .= '&amp;swt=' . urlencode($swt);
$qstr .= '&amp;spf=' . urlencode($spf);
$qstr .= '&amp;spt=' . urlencode($spt);
$qstr .= '&amp;scf=' . urlencode($scf);
$qstr .= '&amp;sct=' . urlencode($sct);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);*/

$sql_search = "";

if ($sme) {
    $sql_search .= " and a.email like '%$sme%' ";
}
if ($snn) {
    $sql_search .= " and a.nickname like '%$snn%' ";
}
if ($shp) {
    $sql_search .= " and a.phone like '%$shp%' ";
}
/*if($sa1){
    $sql_search .= " and a.area1 = '$sa1' ";
}
if($sa2){
    $sql_search .= " and a.area2 = '$sa2' ";
}*/
if ($stl) {
    $sql_search .= " and a.title like '%$stl%' ";
}

/*if($sta){
    $sql_search .= " and a.state = '$sta' ";
}

if($smp){
    $sql_search .= " and a.simple_yn = '$smp' ";
}*/

$fr_write_date = $swf;
$to_write_date = $swt;
$fr_pickup_date = $spf;
$to_pickup_date = $spt;
$fr_complete_date = $scf;
$to_complete_date = $sct;
if (!$fr_write_date) $fr_write_date = '0000-00-00';
if (!$to_write_date) $to_write_date = '9999-99-99';
if (!$fr_pickup_date) $fr_pickup_date = '0000-00-00';
if (!$to_pickup_date) $to_pickup_date = '9999-99-99';
if (!$fr_complete_date) $fr_complete_date = '0000-00-00';
if (!$to_complete_date) $to_complete_date = '9999-99-99';

if ($swf || $swt) $sql_search .= " and date_format(a.apply_date, '%Y-%m-%d') between '$fr_write_date' and '$to_write_date' ";
if ($spf || $spt) $sql_search .= " and a.pickup_date between '$fr_pickup_date' and '$to_pickup_date' ";
if ($scf || $sct) $sql_search .= " and b.request_date between '$fr_complete_date' and '$to_complete_date' ";

$sql_order = " order by a.no desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];



$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select count(*) as cnt {$sql_common}  ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];




$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">전체목록</a>';

$g5['title'] = '중고구매 견적진행현황';
include_once('./admin.head.php');

$sql = " select 
            a.*
        {$sql_common} 
        {$sql_search} 
        {$sql_order} 
        limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 12;
?>
<script>
    $(function() {
        $(" #swf, #swt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $("#spf, #spt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $("#scf, #sct").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99",
            maxDate: "+0d"
        });
        $('#sa1').change(function() {
            doSelectArea2();
        });
    });

    function doSelectArea2() {
        $.ajax({
            type: "POST",
            url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
            data: {
                "area1": $('#sa1').val()
            },
            cache: false,
            success: function(data) {
                var fvHtml = "";
                fvHtml += "<option value=\" \" selected>선택</option>";
                fvHtml += data;
                $("#sa2").html(fvHtml);

            }
        });
    }
</script>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총 견적수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>건 </span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
    <div class="sch_last">

        <strong>email</strong>
        <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">

        <strong>이름</strong>
        <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">

        <strong>전화번호</strong>
        <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">

        <strong>시/도</strong>
        <select id="sa1" name="sa1" class="frm_input">
            <option value="">선택</option>
            <?php
            $sql1 = " select area1 from {$g5['estimate_area1']} order by idx ";

            $result1 = sql_query($sql1);

            for ($i = 0; $row1 = sql_fetch_array($result1); $i++) {
                if ($row1['area1'] == $sa1) {
                    echo '<option value="' . $row1['area1'] . '" selected>' . $row1['area1'] . '</option>';
                } else {
                    echo '<option value="' . $row1['area1'] . '">' . $row1['area1'] . '</option>';
                }
            }
            ?>
        </select>

        <strong>시/구/군</strong>
        <select id="sa2" name="sa2" class="frm_input">
            <option value="">선택</option>
            <?php
            if ($sa1) {
                $sql2 = " select area2 from {$g5['estimate_area2']} where area1='$sa1' order by idx ";
                $result2 = sql_query($sql2);

                for ($i = 0; $row2 = sql_fetch_array($result2); $i++) {
                    if ($row2['area2'] == $sa2) {
                        echo '<option value="' . $row2['area2'] . '" selected>' . $row2['area2'] . '</option>';
                    } else {
                        echo '<option value="' . $row2['area2'] . '">' . $row2['area2'] . '</option>';
                    }
                }
            }
            ?>
        </select>

        <br /><br />

        <strong>제목</strong>
        <input type="text" name="stl" value="<?php echo $stl ?>" id="stl" class="frm_input" size="20">

        <strong>견적신청일</strong>
        <input type="text" name="swf" value="<?php echo $swf ?>" id="swf" class="frm_input" size="11" maxlength="10">
        <label for="swf" class="sound_only">시작일</label>
        ~
        <input type="text" name="swt" value="<?php echo $swt ?>" id="swt" class="frm_input" size="11" maxlength="10">
        <label for="swt" class="sound_only">종료일</label>

        <strong>배송요청일</strong>
        <input type="text" name="spf" value="<?php echo $spf ?>" id="spf" class="frm_input" size="11" maxlength="10">
        <label for="spf" class="sound_only">시작일</label>
        ~
        <input type="text" name="spt" value="<?php echo $spt ?>" id="spt" class="frm_input" size="11" maxlength="10">
        <label for="spt" class="sound_only">종료일</label>

        <strong>배송예정일</strong>
        <input type="text" name="scf" value="<?php echo $scf ?>" id="scf" class="frm_input" size="11" maxlength="10">
        <label for="scf" class="sound_only">시작일</label>
        ~
        <input type="text" name="sct" value="<?php echo $sct ?>" id="sct" class="frm_input" size="11" maxlength="10">
        <label for="sct" class="sound_only">종료일</label>

        <strong>상태</strong>
        <select id="sta" name="sta" class="frm_input">
            <option value="">선택</option>
            <option value="1" <?php if ($sta == "1") echo 'selected'; ?>>견적중</option>
            <option value="2" <?php if ($sta == "2") echo 'selected'; ?>>견적선택중</option>
            <option value="3" <?php if ($sta == "3") echo 'selected'; ?>>견적선택됨</option>
            <option value="4" <?php if ($sta == "4") echo 'selected'; ?>>배송중</option>
            <option value="5" <?php if ($sta == "5") echo 'selected'; ?>>배송완료</option>
            <option value="6" <?php if ($sta == "6") echo 'selected'; ?>>견적취소</option>
            <option value="7" <?php if ($sta == "7") echo 'selected'; ?>>견적마감</option>
        </select>

        <input type="submit" value="검색" class="btn_submit">
    </div>
</form>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="set" value="<?php echo $set ?>">
    <input type="hidden" name="sme" value="<?php echo $sme ?>">
    <input type="hidden" name="snn" value="<?php echo $snn ?>">
    <input type="hidden" name="shp" value="<?php echo $shp ?>">
    <input type="hidden" name="sa1" value="<?php echo $sa1 ?>">
    <input type="hidden" name="sa2" value="<?php echo $sa2 ?>">
    <input type="hidden" name="stl" value="<?php echo $stl ?>">
    <input type="hidden" name="swf" value="<?php echo $swf ?>">
    <input type="hidden" name="swt" value="<?php echo $swt ?>">
    <input type="hidden" name="spf" value="<?php echo $spf ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="scf" value="<?php echo $scf ?>">
    <input type="hidden" name="sct" value="<?php echo $sct ?>">
    <input type="hidden" name="sta" value="<?php echo $sta ?>">
    <input type="hidden" name="smp" value="<?php echo $smp ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col style="width: 8%" />
                <col style="width: 12%" />
                <col style="width: 9%" />
                <col style="width: 6%" />
                <col style="width: 13%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 7%" />
                <col style="width: 10%" />
            </colgroup>
            <thead>
                <tr>
                    <!-- <th scope="col">견적종류</th> -->
                    <th scope="col">견적번호</th>
                    <th scope="col">Email</th>
                    <th scope="col">지역</th>
                    <th scope="col">이름</th>
                    <th scope="col">제목</th>
                    <th scope="col">견적신청일</th>
                    <th scope="col">견적마감일</th>
                    <th scope="col">배송요청일</th>
                    <th scope="col">견적현황</th>
                    <th scope="col">배송예정일</th>
                    <th scope="col">업체견적수</th>
                    <th scope="col">관리</th>
                </tr>
            </thead>
            <tbody>
                <script type="text/javascript">
                    $(function() {
                        $(".delete").click(function() {
                            if (confirm('삭제하시겠습니까?')) {
                                var url = $(this).next('a').attr('href');
                                location.href = url;
                            }
                        })
                    });
                </script>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                    $s_mod = "";
                    $s_mod .= '<a href="' . G5_URL . '/estimate/my_estimate_form_match_sa.php?no_estimate=' . $row['no_estimate'] . '" target="_blank" class="btn btn_03">보기</a>';
                    $s_mod .= '<a href="#none" class="btn btn_01 delete">삭제</a>';
                    $s_mod .= '<a style="display:none;" href="./pickus_estimate_match_list_delete.php?' . $qstr . '&page=' . $page . '&no_estimate=' . $row['no_estimate'] . '" class="btn btn_01">삭제</a>';
                    $s_mod .= '<a href="./pickus_estimate_match_form.php?' . $qstr . '&page=' . $page . '&no_estimate=' . $row['no_estimate'] . '" class="btn btn_03">수정</a>';

                    $no_estimate = $row['no_estimate'];
                    $sql = "select count(*) as cnt from g5_estimate_match_propose where no_estimate = $no_estimate";
                    $pro_row = sql_fetch($sql);
                    $pro_cnt = $pro_row['cnt'];

                    $sql = "select * from g5_estimate_match_propose where no_estimate = $no_estimate";
                    $results = sql_fetch($sql);
                ?>

                    <tr class="<?php echo $bg; ?>">
                        <!-- <td class="td_mng">
            <?php echo $row['cate']; ?>
        </td> -->
                        <td class="td_mng">
                            <?php echo $row['no_estimate']; ?>
                        </td>
                        <td class="td_name">
                            <?php echo $row['email']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['area1']; ?> <?php echo $row['area2']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['title']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['apply_date']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['date_close']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['date_req']; ?>
                        </td>
                        <td class="td_mng">
                            <?php
                            echo get_estimate_state_match($row['state']);
                            ?>
                        </td>
                        <td class="td_mng">
                            <?php if ($results['completetime']) {
                                echo $results['completetime'];
                            } ?>
                        </td>
                        <td class="td_mng td_num">
                            <?php echo number_format($pro_cnt); ?>
                        </td>
                        <td class="td_mng action">
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
        <a href="./pickus_estimate_add_match.php" id="member_add" class="btn btn_02">중고구매매칭 추가</a>
    </div>


</form>
<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>




<hr class="hr">
<p style="margin-top:2%; text-align:center; font-size:24px;">센터 회원관리</p>
<?php

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
$sql_common .= " where a.mb_level in ('2','4') ";

$qstr = '';
$qstr .= 'sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sfd=' . urlencode($sfd);
$qstr .= '&amp;std=' . urlencode($std);
$qstr .= '&amp;sml=' . urlencode($sml);
$qstr .= '&amp;sms=' . urlencode($sms);

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

if ($sml) {
    $sql_search .= " and a.mb_level = '$sml' ";
}

if ($sms) {
    $sql_search .= " and a.mb_biz_score = '$sms' ";
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
$sql = " select count(*) as cnt {$sql_common} and a.mb_level = '2' ";
$row = sql_fetch($sql);
$total_count1 = $row['cnt'];

// 탈퇴 회원수
$sql = " select count(*) as cnt {$sql_common} and mb_level = '4'  ";
$row = sql_fetch($sql);
$total_count2 = $row['cnt'];



$listall = '<a href="' . $_SERVER['SCRIPT_NAME'] . '" class="ov_listall">전체목록</a>';

$g5['title'] = '센터 회원관리';
include_once('./admin.head.php');

$sql = " select a.*, ifnull(b.estimate_cnt, 0) as estimate_cnt, ifnull(b.estimate_amt, 0) as estimate_amt {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
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
    <a href="?sml=2" class="btn_ov01"> <span class="ov_txt">승인센터 </span><span class="ov_num"><?php echo number_format($total_count1) ?>명</span></a>
    <a href="?sml=4" class="btn_ov01"> <span class="ov_txt">탈퇴센터 </span><span class="ov_num"><?php echo number_format($total_count2) ?>명</span></a>
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
        <strong>회원구분</strong>
        <select id="sml" name="sml" class="frm_input">
            <option value="">선택</option>
            <option value="2" <?php if ($sml == "2") echo 'selected'; ?>>승인센터</option>
            <option value="4" <?php if ($sml == "4") echo 'selected'; ?>>탈퇴센터</option>
        </select>
        <input type="submit" value="검색" class="btn_submit">
    </div>
</form>

<form name="fmemberlist" id="fmemberlist" action="./pickus_member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sme" value="<?php echo $sme ?>">
    <input type="hidden" name="snn" value="<?php echo $snn ?>">
    <input type="hidden" name="shp" value="<?php echo $shp ?>">
    <input type="hidden" name="shp" value="<?php echo $shp ?>">
    <input type="hidden" name="sms" value="<?php echo $sms ?>">
    <input type="hidden" name="std" value="<?php echo $std ?>">
    <input type="hidden" name="sml" value="<?php echo $sml ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col style="width: 5%" />
                <col style="width: 20%" />
                <col style="width: 15%" />
                <col style="width: 10%" />
                <col style="width: 10%" />
                <col style="width: 15%" />
                <col style="width: 15%" />
                <col style="width: 10%" />
            </colgroup>
            <thead>
                <tr>
                    <th scope="col" id="mb_list_chk" rowspan="2">
                        <label for="chkall" class="sound_only">회원 전체</label>
                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                    </th>
                    <th scope="col">센터종류</th>
                    <th scope="col">이메일</th>
                    <th scope="col">센터이름</th>
                    <th scope="col">담당자명</th>
                    <th scope="col">담당자연락처</th>
                    <th scope="col">센터연락처</th>
                    <th scope="col" rowspan="2">관리</th>
                </tr>
                <tr>
                    <th scope="col">지역</th>
                    <th scope="col">평점</th>
                    <th scope="col">충전내역</th>
                    <th scope="col">완료건/비용</th>
                    <th scope="col">견적신청 / 중고매칭 수수료율</th>
                    <th scope="col">이메일 수신여부</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $row = sql_fetch_array($result); $i++) {
                    $bg = 'bg' . ($i % 2);
                    $s_mod = "";
                    $s_mod .= '<a href="./pickus_member_list_login.php?mb_id=' . $row['mb_id'] . '" class="btn btn_02">로그인</a>';
                    $s_mod .= '<a href="./pickus_point_list.php?sfl=mb_id&stx=' . $row['mb_id'] . '" class="btn btn_02">충전내역</a>';
                    $s_mod .= '<a href="./pickus_member_list_delete.php?' . $qstr . '&gubun=2&w=u&mb_id=' . $row['mb_id'] . '" class="btn btn_01">삭제</a>';
                    $s_mod .= '<a href="./pickus_member_form.php?' . $qstr . '&mb_type=2&w=u&mb_id=' . $row['mb_id'] . '" class="btn btn_03">수정</a>';
                ?>

                    <tr class="<?php echo $bg; ?>">
                        <td headers="mb_list_chk" class="td_chk" rowspan="2">
                            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
                            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
                            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
                        </td>
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
                        <td class="td_mng" rowspan="2">
                            <?php echo $s_mod; ?>
                        </td>
                    </tr>
                    <tr class="<?php echo $bg; ?>">
                        <td class="td_name">
                            <?php echo $row['mb_biz_addr1']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo $row['mb_biz_score']; ?>
                        </td>
                        <td class="td_mng">
                            <?php echo number_format($row['mb_point']); ?>
                        </td>
                        <td class="td_mng">
                            <?php echo number_format($row['estimate_cnt']); ?>건 / <?php echo number_format($row['estimate_amt']); ?>원
                        </td>
                        <td class="td_mng">
                            견적신청 : <input type="text" id="mb_biz_charge_rate_<?php echo $i; ?>" name="mb_biz_charge_rate[]" value="<?php echo $row['mb_biz_charge_rate']; ?>" style="text-align:right;"><br /> 중고매칭 : <input type="text" id="mb_biz_match_rate_<?php echo $i; ?>" name="mb_biz_match_rate[]" value="<?php echo $row['mb_biz_match_rate']; ?>" style="text-align:right;">

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
        <input type="submit" name="act_button" value="선택 수수료율 변경" onclick="document.pressed=this.value" class="btn btn_02">
        <a href="./pickus_member_form.php?mb_level=2&mb_type=2" id="member_add" class="btn btn_01">회원추가</a>
    </div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?' . $qstr . '&amp;page='); ?>
<script>
    function fmemberlist_submit(f) {
        if (!is_checked("chk[]")) {
            alert(document.pressed + " 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        return true;
    }
</script>


<?php
include_once('./admin.tail.php');
?>


<script>
    function etdoRequest(idx, email) {
        if (confirm("문의 하시겠습니까?")) {
            var f = document.frmrequest;
            f.idx.value = document.getElementById("idx").value;
            f.email.value = document.getElementById("email").value;
            f.submit();
        }
    }


    function mtdoRequest(no_estimate, mtemail) {
        if (confirm("문의 하시겠습니까?")) {
            var f = document.mtfrmrequest;
            f.no_estimate.value = document.getElementById("no_estimate").value;
            f.email.value = document.getElementById("mtemail").value;
            f.submit();
        }
    }
</script>