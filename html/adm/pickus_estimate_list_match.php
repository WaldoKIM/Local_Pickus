<?php
$sub_menu = "400230";
include_once('./_common.php');

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

if($sme){
    $sql_search .= " and a.email like '%$sme%' ";
}
if($snn){
    $sql_search .= " and a.nickname like '%$snn%' ";
}
if($shp){
    $sql_search .= " and a.phone like '%$shp%' ";
}
/*if($sa1){
    $sql_search .= " and a.area1 = '$sa1' ";
}
if($sa2){
    $sql_search .= " and a.area2 = '$sa2' ";
}*/
if($stl){
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
if(!$fr_write_date) $fr_write_date = '0000-00-00';
if(!$to_write_date) $to_write_date = '9999-99-99';
if(!$fr_pickup_date) $fr_pickup_date = '0000-00-00';
if(!$to_pickup_date) $to_pickup_date = '9999-99-99';
if(!$fr_complete_date) $fr_complete_date = '0000-00-00';
if(!$to_complete_date) $to_complete_date = '9999-99-99';

if($swf || $swt) $sql_search .= " and date_format(a.apply_date, '%Y-%m-%d') between '$fr_write_date' and '$to_write_date' ";
if($spf || $spt) $sql_search .= " and a.pickup_date between '$fr_pickup_date' and '$to_pickup_date' ";
if($scf || $sct) $sql_search .= " and b.request_date between '$fr_complete_date' and '$to_complete_date' ";

$sql_order = " order by a.no desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];



$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // ?????? ????????? ??????
if ($page < 1) $page = 1; // ???????????? ????????? ??? ????????? (1 ?????????)
$from_record = ($page - 1) * $rows; // ?????? ?????? ??????

$sql = " select count(*) as cnt {$sql_common}  ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];




$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">????????????</a>';

$g5['title'] = '???????????? ??????????????????';
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
$(function(){
    $("#swf, #swt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#spf, #spt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    $("#scf, #sct").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });

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
            fvHtml += "<option value=\"\" selected>??????</option>";
            fvHtml += data;
            $("#sa2").html(fvHtml);

        }
    });
}
</script>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">??? ????????? </span><span class="ov_num"> <?php echo number_format($total_count) ?>??? </span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch03 local_sch" method="get">
<div class="sch_last">
    
    <strong>email</strong>
    <input type="text" name="sme" value="<?php echo $sme ?>" id="sme" class="frm_input" size="30">
    
    <strong>??????</strong>
    <input type="text" name="snn" value="<?php echo $snn ?>" id="snn" class="frm_input" size="11">
    
    <strong>????????????</strong>
    <input type="text" name="shp" value="<?php echo $shp ?>" id="shp" class="frm_input" size="20">
    
    <strong>???/???</strong>
    <select id="sa1" name="sa1"  class="frm_input">
        <option value="">??????</option>
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
    
    <strong>???/???/???</strong>
    <select id="sa2" name="sa2"  class="frm_input">
        <option value="">??????</option>
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

    <strong>??????</strong>
    <input type="text" name="stl" value="<?php echo $stl ?>" id="stl" class="frm_input" size="20">

    <strong>???????????????</strong>
    <input type="text" name="swf" value="<?php echo $swf ?>" id="swf" class="frm_input" size="11" maxlength="10">
    <label for="swf" class="sound_only">?????????</label>
    ~
    <input type="text" name="swt" value="<?php echo $swt ?>" id="swt" class="frm_input" size="11" maxlength="10">
    <label for="swt" class="sound_only">?????????</label>

    <strong>???????????????</strong>
    <input type="text" name="spf" value="<?php echo $spf ?>" id="spf" class="frm_input" size="11" maxlength="10">
    <label for="spf" class="sound_only">?????????</label>
    ~
    <input type="text" name="spt" value="<?php echo $spt ?>" id="spt" class="frm_input" size="11" maxlength="10">
    <label for="spt" class="sound_only">?????????</label>

    <strong>???????????????</strong>
    <input type="text" name="scf" value="<?php echo $scf ?>" id="scf" class="frm_input" size="11" maxlength="10">
    <label for="scf" class="sound_only">?????????</label>
    ~
    <input type="text" name="sct" value="<?php echo $sct ?>" id="sct" class="frm_input" size="11" maxlength="10">
    <label for="sct" class="sound_only">?????????</label>
    
    <strong>??????</strong>
    <select id="sta" name="sta"  class="frm_input">
        <option value="">??????</option>
        <option value="1" <?php if($sta == "1") echo 'selected'; ?>>?????????</option>
        <option value="2" <?php if($sta == "2") echo 'selected'; ?>>???????????????</option>
        <option value="3" <?php if($sta == "3") echo 'selected'; ?>>???????????????</option>
        <option value="4" <?php if($sta == "4") echo 'selected'; ?>>?????????</option>
        <option value="5" <?php if($sta == "5") echo 'selected'; ?>>????????????</option>
        <option value="6" <?php if($sta == "6") echo 'selected'; ?>>????????????</option>
        <option value="7" <?php if($sta == "7") echo 'selected'; ?>>????????????</option>
    </select>
   
    <input type="submit" value="??????" class="btn_submit">
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
    <caption><?php echo $g5['title']; ?> ??????</caption>
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
        <!-- <th scope="col">????????????</th> -->
        <th scope="col">Email</th>
        <th scope="col">??????</th>
        <th scope="col">??????</th>
        <th scope="col">??????</th>
        <th scope="col">???????????????</th>
        <th scope="col">???????????????</th>
        <th scope="col">???????????????</th>
        <th scope="col">????????????</th>
        <th scope="col">???????????????</th>
        <th scope="col">???????????????</th>
        <th scope="col">??????</th>
    </tr>
    </thead>
    <tbody>
    <script type="text/javascript">
    $(function(){
        $(".delete").click(function(){
            if(confirm('?????????????????????????')){
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
        $s_mod .= '<a href="'.G5_URL.'/estimate/my_estimate_form_match_sa.php?no_estimate='.$row['no_estimate'].'" target="_blank" class="btn btn_03">??????</a>';
        $s_mod .= '<a href="#none" class="btn btn_01 delete">??????</a>';
        $s_mod .= '<a style="display:none;" href="./pickus_estimate_match_list_delete.php?'.$qstr.'&page='.$page.'&no_estimate='.$row['no_estimate'].'" class="btn btn_01">??????</a>';
        $s_mod .= '<a href="./pickus_estimate_match_form.php?'.$qstr.'&page='.$page.'&no_estimate='.$row['no_estimate'].'" class="btn btn_03">??????</a>';

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
        <td class="td_name">
            <?php echo $row['email']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['area1']; ?>  <?php echo $row['area2']; ?>  
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
            <?php if($results['completetime']){
                echo $results['completetime'];
            } ?>          
        </td>
        <td class="td_mng td_num">
            <?php  echo number_format($pro_cnt); ?>                
        </td>
        <td class="td_mng action">
            <?php echo $s_mod; ?>
        </td>
    </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">????????? ????????????.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./pickus_estimate_add_match.php" id="member_add" class="btn btn_02">?????????????????? ??????</a>
</div>


</form>

<!-- <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?> -->

<?php
include_once ('./admin.tail.php');
?>
