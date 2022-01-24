<?php
$sub_menu = "400220";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['estimate_list']} a ";
$sql_common .= " join {$g5['estimate_propose']}  b on a.idx = b.estimate_idx and b.meet = '1' ";
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

$fr_write_date = $swf;
$to_write_date = $swt;
$fr_pickup_date = $spf;
$to_pickup_date = $spt;
if(!$fr_write_date) $fr_write_date = '0000-00-00';
if(!$to_write_date) $to_write_date = '9999-99-99';
if(!$fr_pickup_date) $fr_pickup_date = '0000-00-00';
if(!$to_pickup_date) $to_pickup_date = '9999-99-99';

if($swf || $swt) $sql_search .= " and date_format(a.writetime, '%Y-%m-%d') between '$fr_write_date' and '$to_write_date' ";
if($spf || $spt) $sql_search .= " and a.pickup_date between '$fr_pickup_date' and '$to_pickup_date' ";

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

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '견적진행현황';
include_once('./admin.head.php');

$sql = " select 
            a.*,
            date_format(a.writetime, '%Y-%m-%d') as write_time, 
            b.idx as sub_idx,
            b.rc_email,
            b.rc_nickname,
            b.meet,
            b.meet_confirm
        {$sql_common} 
        {$sql_search} 
        {$sql_order} 
        limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 11;
?>
<script>
$(function(){
    $("#swf, #swt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#spf, #spt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });

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
    <span class="btn_ov01"><span class="ov_txt">총 방문 </span><span class="ov_num"> <?php echo number_format($total_count) ?>건 </span></span>
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
        <col style="width: 14%" />
        <col style="width: 8%" />
        <col style="width: 7%" />
        <col style="width: 7%" />
        <col style="width: 10%" />
        <col style="width: 11%" />
        <col style="width: 8%" />
    </colgroup>    
    <thead>
    <tr>
        <th scope="col">견적종류</th>
        <th scope="col">Email</th>
        <th scope="col">지역</th>
        <th scope="col">이름</th>
        <th scope="col">제목</th>
        <th scope="col">견적가</th>
        <th scope="col">견적신청일</th>
        <th scope="col">수거요청일</th>
        <th scope="col">업체명</th>
        <th scope="col">업체 Email</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $s_mod = "";
        if($row['meet_confirm'])
        {
            $s_mod .= '승인완료';    
        }else{
            $s_mod .= '<a href="./pickus_estimate_meet_list_confirm.php?'.$qstr.'&w=u&sub_idx='.$row['sub_idx'].'" class="btn btn_03">승인</a>';
        }
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
        <td class="td_mng">
            <?php echo $row['write_time']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['pickup_date']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['rc_nickname']; ?>          
        </td>
        <td class="td_mng">
            <?php echo $row['rc_email']; ?>          
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


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
