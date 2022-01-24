<?php
$sub_menu = "500110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = substr(G5_TIME_YMD,0,4).'-01-01';
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$g5['title'] = '현황'; 
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$sql = " select
            ifnull(sum(case when mb_level = '0' then 1 else 0 end),0) as member_cnt,
            ifnull(sum(case when mb_level = '2' then 1 else 0 end),0) as center_cnt,
            ifnull(sum(case when mb_level = '1' then 1 else 0 end),0) as center_accept_cnt,
            ifnull(sum(case when mb_level = '3' then 1 else 0 end),0) as member_withdraw_cnt,
            ifnull(sum(case when mb_level = '4' then 1 else 0 end),0) as center_withdraw_cnt
        from
            {$g5['member_table']}
        where
            date_format(mb_datetime,'%Y-%m-%d') between '$fr_date' and '$to_date' ";
$memberInfo = sql_fetch($sql);

$sql = " select
            ifnull(sum(case when state != '6' then 1 else 0 end),0) as estimate_cnt,
            ifnull(sum(case when state = '0' or state = '1' or state = '2' then 1 else 0 end),0) as estimate_ing_cnt,
            ifnull(sum(case when state = '3' or state = '4' then 1 else 0 end),0) as estimate_select_cnt,
            ifnull(sum(case when state = '5' and ( e_type = '0' or e_type = '1' ) then 1 else 0 end),0) as estimate_complete_cnt1,
            ifnull(sum(case when state = '5' and e_type = '2' then 1 else 0 end),0) as estimate_complete_cnt2
        from
            {$g5['estimate_list']}
        where
            date_format(writetime,'%Y-%m-%d') between '$fr_date' and '$to_date' ";
$estimateInfo = sql_fetch($sql);

$sql = " select
            ifnull(sum(case when state != '6' then 1 else 0 end),0) as estimate_cnt,
            ifnull(sum(case when state = '0' or state = '1' or state = '2' then 1 else 0 end),0) as estimate_ing_cnt,
            ifnull(sum(case when state = '3' or state = '4' then 1 else 0 end),0) as estimate_select_cnt,
            ifnull(sum(case when state = '5' then 1 else 0 end),0) as estimate_complete_cnt1
        from
            {$g5['estimate_match']}
        where
            date_format(apply_date,'%Y-%m-%d') between '$fr_date' and '$to_date' ";
$estimateInfo_match = sql_fetch($sql);

$sql = " select
            ifnull(sum(b.price),0) as estimate_amt,
            ifnull(( 
                select abs(sum(po_point)) as pointAmt 
                from {$g5['point_table']}
                where po_point > 0 and date_format(po_datetime,'%Y-%m-%d') between '$fr_date' and '$to_date' 
            ),0) AS point_amt,
            ifnull(sum(case when a.e_type = '0' then b.price else 0 end),0) as estimate_amt0,
            ifnull(sum(case when a.e_type = '1' then b.price else 0 end),0) as estimate_amt1,
            ifnull(sum(case when a.e_type = '2' then b.price else 0 end),0) as estimate_amt2
        from
            {$g5['estimate_list']} a
            join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.selected = '1'
        where
            a.state = '5'
            and date_format(a.writetime,'%Y-%m-%d') between '$fr_date' and '$to_date' ";
$amtInfo = sql_fetch($sql);


/*$sql = "select
            ifnull(sum(b.price),0) as estimate_amt,
        from
            {$g5['estimate_match']} a
            join g5_estimate_match_propose b on a.no_estimate = b.no_estimate and b.selected = '1'
        where
            a.state = '5'
            and date_format(a.writetime,'%Y-%m-%d') between '$fr_date' and '$to_date' ";
$amtInfo_match = sql_fetch($sql);*/
?>

<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});
</script>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    <strong>기간별검색</strong>
    <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
    <label for="fr_date" class="sound_only">시작일</label>
    ~
    <input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input" size="11" maxlength="10">
    <label for="to_date" class="sound_only">종료일</label>
    <input type="submit" value="검색" class="btn_submit">
</div>
</form>

<form name="fpopularrank" id="fpopularrank" method="post">
    <table>
        <tr>
            <td style="width:34%;">
                <div class="tbl_head01 tbl_wrap" style="margin-right:20px;">
                    <h2 class="h2_frm">회원현황</h2>
                    <table>
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">총건수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_mng">회원가입 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($memberInfo['member_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">센터회원 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($memberInfo['center_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">센터승인 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($memberInfo['center_accept_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">탈퇴회원 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($memberInfo['member_withdraw_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">탈퇴센터 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($memberInfo['center_withdraw_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td style="width:34%;">
                <div class="tbl_head01 tbl_wrap" style="margin-right:20px;">
                    <h2 class="h2_frm">건적현황</h2>
                    <table>
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">총건수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_mng">총 견적 신청 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo['estimate_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">견적중(신청 수)</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo['estimate_ing_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">견적 선택</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo['estimate_select_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">수거 완료</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo['estimate_complete_cnt1']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">철거 완료</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo['estimate_complete_cnt2']); ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td style="width:32%">
                <div class="tbl_head01 tbl_wrap">
                    <h2 class="h2_frm">거래현황</h2>
                    <table>
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">총금액</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_mng">총 거래 현황</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">충전 현황</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['point_amt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">가전/가구 매입</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt0']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">다량 매입</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt1']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">철거/원상복구</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt2']); ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:32%; ">
                <div class="tbl_head01 tbl_wrap" style="margin-right: 20px;">
                    <h2 class="h2_frm">중고견적현황</h2>
                    <table>
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">총건수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_mng">총 견적 신청 수</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo_match['estimate_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">견적중(신청 수)</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo_match['estimate_ing_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">견적 선택</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo_match['estimate_select_cnt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">배송 완료</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($estimateInfo_match['estimate_complete_cnt1']); ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td style="width:32%">  
                <div class="tbl_head01 tbl_wrap" style="margin-right: 20px;">
                    <h2 class="h2_frm">중고거래현황</h2>
                    <table>
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">구분</th>
                                <th scope="col">총금액</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_mng">총 거래 현황</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">충전 현황</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['point_amt']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">가전/가구 매입</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt0']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">다량 매입</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt1']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_mng">철거/원상복구</td>
                                <td class="td_mng td_num">
                                    <a href="">
                                        <?php echo number_format($amtInfo['estimate_amt2']); ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</form>
<?php
include_once('./admin.tail.php');
?>
