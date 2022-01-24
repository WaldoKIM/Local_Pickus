<?php
$sub_menu = "400210";
include_once('./_common.php');

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
$qstr .= '&amp;scd=' . urlencode($scd);
$qstr .= '&amp;scs=' . urlencode($scs);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);

$sql_search = "";
if($set == "0" || $set){
    $sql_search .= " and a.e_type = '$set' ";
}
if($sme){
    $sql_search .= " and a.email like '%$sme%' ";
}
if($snn){
    $sql_search .= " and a.nickname like '%$snn%' ";
}
if($shp){
    $sql_search .= " and a.phone like '%$shp%' ";
}
if($sa1){
    $sql_search .= " and a.area1 = '$sa1' ";
}
if($sa2){
    $sql_search .= " and a.area2 = '$sa2' ";
}
if($stl){
    $sql_search .= " and a.title like '%$stl%' ";
}

if($sta){
    $sql_search .= " and a.state = '$sta' ";
}

if($smp){
    $sql_search .= " and a.simple_yn = '$smp' ";
}

$fr_write_date = $swf;
$to_write_date = $swt;
$fr_pickup_date = $spf;
$to_pickup_date = $spt;
$fr_complete_date = $scf;
$to_complete_date = $sct;
$deadline = $scd;
$selecttime = $scs;
if(!$fr_write_date) $fr_write_date = '0000-00-00';
if(!$to_write_date) $to_write_date = '9999-99-99';
if(!$fr_pickup_date) $fr_pickup_date = '0000-00-00';
if(!$to_pickup_date) $to_pickup_date = '9999-99-99';
if(!$fr_complete_date) $fr_complete_date = '0000-00-00';
if(!$to_complete_date) $to_complete_date = '9999-99-99';
if(!$deadline) $deadline = '0000-00-00';
if(!$selecttime) $selecttime = '0000-00-00';

if($swf || $swt) $sql_search .= " and date_format(a.writetime, '%Y-%m-%d') between '$fr_write_date' and '$to_write_date' ";
if($spf || $spt) $sql_search .= " and a.pickup_date between '$fr_pickup_date' and '$to_pickup_date' ";
if($scf || $sct) $sql_search .= " and b.request_date between '$fr_complete_date' and '$to_complete_date' ";
if($scd) $sql_search .= " and a.deadline ='$deadline'";
if($scs) $sql_search .= " and a.selecttime ='$selecttime'";
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


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

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
$(function(){
    $("#swf, #swt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#spf, #spt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#scf, #sct").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#scd").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#scs").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $('#sa1').change(function(){ 
        doSelectArea2(); 
    }); 
});
function doSelectArea2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
        data: {
            "area1": $('#sa1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
            fvHtml += "<option value=\"\" selected>선택</option>";
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
    <a href="?set=1" class="btn_ov01"> <span class="ov_txt">다량 매입  </span><span class="ov_num"><?php echo number_format($total_count2) ?>건</span></a>
    <a href="?set=2" class="btn_ov01"> <span class="ov_txt">철거/원상복구  </span><span class="ov_num"><?php echo number_format($total_count3) ?>건</span></a>
    <a href="?set=3" class="btn_ov01"> <span class="ov_txt">원스톱 중고매입/철거  </span><span class="ov_num"><?php echo number_format($total_count4) ?>건</span></a>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    <strong>견적구분</strong>
    <select id="set" name="set"  class="frm_input">
        <option value="">선택</option>
        <option value="0" <?php if($set == "0") echo 'selected'; ?>>가전/가구 매입</option>
        <option value="1" <?php if($set == "1") echo 'selected'; ?>>다량 매입</option>
        <option value="2" <?php if($set == "2") echo 'selected'; ?>>철거/원상복구</option>
        <option value="3" <?php if($set == "3") echo 'selected'; ?>>원스톱 중고매입/철거</option>
    </select>
    
    <strong>email</strong>
    <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">
    
    <strong>이름</strong>
    <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">
    
    <strong>전화번호</strong>
    <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">
    
    <strong>시/도</strong>
    <select id="sa1" name="sa1"  class="frm_input">
        <option value="">선택</option>
        <?php
            $sql1 = " select area1 from {$g5['estimate_area1']} order by idx ";

            $result1 = sql_query($sql1);

            for ($i=0; $row1=sql_fetch_array($result1); $i++){
                if($row1['area1'] == $sa1){
                    echo '<option value="'.$row1['area1'].'" selected>'.$row1['area1'].'</option>';
                }else{
                    echo '<option value="'.$row1['area1'].'">'.$row1['area1'].'</option>';
                }
            }        
        ?>
    </select>
    
    <strong>시/구/군</strong>
    <select id="sa2" name="sa2"  class="frm_input">
        <option value="">선택</option>
        <?php
            if($sa1){
                $sql2 = " select area2 from {$g5['estimate_area2']} where area1='$sa1' order by idx ";
                $result2 = sql_query($sql2);

                for ($i=0; $row2=sql_fetch_array($result2); $i++){
                    if($row2['area2'] == $sa2){
                        echo '<option value="'.$row2['area2'].'" selected>'.$row2['area2'].'</option>';
                    }else{
                        echo '<option value="'.$row2['area2'].'">'.$row2['area2'].'</option>';
                    }                    
                }
            }
        ?>        
    </select>
    
    <br/><br/>

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
    
    <strong>견적마감일</strong>
    <input type="text" name="scd" value="<?php echo $scd ?>" id="scd" class="frm_input" size="11" maxlength="10">
    <label for="scd" class="sound_only">견적마감일</label>
    
    <strong>견적선택일</strong>
    <input type="text" name="scs" value="<?php echo $scs ?>" id="scs" class="frm_input" size="11" maxlength="10">
    <label for="scs" class="sound_only">견적마감일</label>

    <strong>상태</strong>
    <select id="sta" name="sta"  class="frm_input">
        <option value="">선택</option>
        <option value="0" <?php if($sta == "0") echo 'selected'; ?>>견적 대기중</option>
        <option value="1" <?php if($sta == "1") echo 'selected'; ?>>견적중</option>
        <option value="2" <?php if($sta == "2") echo 'selected'; ?>>견적선택중</option>
        <option value="3" <?php if($sta == "3") echo 'selected'; ?>>견적선택됨</option>
        <option value="4" <?php if($sta == "4") echo 'selected'; ?>>수거중</option>
        <option value="5" <?php if($sta == "5") echo 'selected'; ?>>수거완료</option>
        <option value="6" <?php if($sta == "6") echo 'selected'; ?>>견적취소</option>
        <option value="7" <?php if($sta == "7") echo 'selected'; ?>>견적마감</option>
    </select>
   
    <strong>간편견적</strong>
    <select id="smp" name="smp"  class="frm_input">
        <option value="">선택</option>
        <option value="1" <?php if($smp == "1") echo 'selected'; ?>>간편견적신청</option>
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
<input type="hidden" name="scd" value="<?php echo $scd ?>">
<input type="hidden" name="scs" value="<?php echo $scs ?>">
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
        <th scope="col">견적종류</th>
        <th scope="col">Email</th>
        <th scope="col">지역</th>
        <th scope="col">이름</th>
        <th scope="col">제목</th>
        <th scope="col">매입가</th>
        <th scope="col">폐기가</th>
        <th scope="col">견적신청일</th>
        <th scope="col">수거요청일</th>
        <th scope="col">견적마감일</th>
        <th scope="col">견적선택일</th>
        <th scope="col">견적현황</th>
        <th scope="col">수거예정일</th>
        <th scope="col">업체견적수</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <script type="text/javascript">
    $(function(){
        $(".delete").click(function(){
            if(confirm('삭제하시겠습니까?')){
                var url = $(this).next('a').attr('href');
                location.href = url;
            }
        })
    });
    </script>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $s_mod = "";
        $s_mod .= '<a href="'.G5_URL.'/estimate/my_estimate_form.php?idx='.$row['idx'].'" target="_blank" class="btn btn_03">보기</a>';
        $s_mod .= '<a href="#none" id="" class="btn btn_01 delete">삭제</a>';
        $s_mod .= '<a id="delete_url" style="display:none;" href="./pickus_estimate_list_delete.php?'.$qstr.'&page='.$page.'&idx='.$row['idx'].'" class="btn btn_01">삭제</a>';
        $s_mod .= '<a href="./pickus_estimate_form.php?'.$qstr.'&page='.$page.'&idx='.$row['idx'].'" class="btn btn_03">수정</a>';
    ?>
    
    <tr class="<?php echo $bg; ?>">
        <td class="td_mng">
            <?php echo get_etype($row['e_type']); ?>
        </td>
        <td class="td_name">
            <?php echo $row['email']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['area1']; ?>  <?php echo $row['area2']; ?>  
        </td>
        <td class="td_mng">
            <?php echo $row['nickname']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['title']; ?>                
        </td>
        <td class="td_mng td_num">
            <?php  echo number_format($row['estimate_amt']); ?>                
        </td>
        <td class="td_mng td_num">
            <?php  echo number_format($row['price_minus']); ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['write_time']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['pickup_date']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['deadline']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['selecttime']; ?>          
        </td>
        <td class="td_mng">
            <?php 
                echo get_estimate_state($row['state']); 
                if($row['simple_yn']){
                    echo "(간편견적)";
                }
            ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['estimate_date']; ?>          
        </td>
        <td class="td_mng td_num">
            <?php  echo number_format($row['estimate_cnt']); ?>                
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
    <a href="./pickus_estimate_form.php?<?php echo $qstr;?>&page=<?php echo $page;?>&e_type=0" id="member_add" class="btn btn_02">가전/가구 매입 추가</a>
    <a href="./pickus_estimate_form.php?<?php echo $qstr;?>&page=<?php echo $page;?>&e_type=1" id="member_add" class="btn btn_02">다량 일괄 매입 추가</a>
    <a href="./pickus_estimate_form.php?<?php echo $qstr;?>&page=<?php echo $page;?>&e_type=2" id="member_add" class="btn btn_02">철거/원상복구 추가</a>
    <a href="./pickus_estimate_form.php?<?php echo $qstr;?>&page=<?php echo $page;?>&e_type=3" id="member_add" class="btn btn_02">원스톱 중고매입/철거 추가</a>
</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
