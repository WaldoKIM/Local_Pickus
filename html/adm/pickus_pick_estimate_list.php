<?php
    $sub_menu = "400231";
    include_once('./_common.php');

    auth_check($auth[$sub_menu], 'r');
    $g5['title'] = '선택견적';
   

    $sql = " select count(*) as cnt from g5_estimate_list as a JOIN g5_estimate_propose as b ON a.idx = b.estimate_idx where a.state in (3,4,5,8) and b.selected = '1' order by a.idx desc";
    $row = sql_fetch($sql);
    
    $total_count = $row['cnt'];
    $rows = $config['cf_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함
     $sql = "select a.*,b.price,b.price_minus, b.completetime from g5_estimate_list as a JOIN g5_estimate_propose as b ON a.idx = b.estimate_idx where a.state in (3,4,5,8) and b.selected = '1' order by a.idx desc limit {$from_record}, {$rows} ";
    $result = sql_query($sql);
    include_once('./admin.head.php');
?>
<style type="text/css">
    td{text-align: center !important;}
</style>
<div class="tbl_head01 tbl_wrap">
    <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <colgroup>
            <col style="width: 7%" />
            <col style="width: 7%" />
            <col style="width: 15%" />
            <col style="width: 7%" />
            <col style="width: 7%" />
            <col style="width: 10%" />
            <col style="width: 10%" />
            <col style="width: 8%" />
            <col style="width: 15%" />
        </colgroup>    
        <thead>
        <tr>
            <th scope="col">견적종류</th>
            <th scope="col">이메일</th>
            <th scope="col">지역</th>
            <th scope="col">이름</th>
            <th scope="col">제목</th>
            <th scope="col">매입가</th>
            <th scope="col">폐기가</th>
            <th scope="col">견적신청일</th>
            <th scope="col">수거요청일</th>
            <th scope="col">견적선택일</th>
            <th scope="col">수거완료일</th>
            <th scope="col">업체견적수</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bg = 'bg'.($i%2);
            $idx = $row['idx'];
            $sql = "select count(*) as cnt from g5_estimate_propose where estimate_idx = '$idx'";
            $cnt = sql_fetch($sql);
        ?>

        <tr class="<?php echo $bg; ?>">
            <td class="td_name">
                <?php echo get_etype($row['e_type']); ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['email']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['area1'] . $row['area2'] . $row['area3']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['nickname']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['title']; ?>                
            </td>
            <td class="td_mng">
                <?php echo number_format($row['price']) . '원'; ?>
            </td>
            <td class="td_mng">
                <?php echo $row['price_minus']; ?>
            </td>
            <td class="td_mng">
                <?php echo $row['writetime']; ?>
            </td>
            <td class="td_mng">
                <?php echo $row['pickup_date']; ?>
            </td>
            <td class="td_mng">
                <?php 
                if($row['selecttime'] != ''){
                    echo date('Y-m-d', strtotime($row['selecttime']) ); 
                }else{
                    echo '-'; 
                }
                ?>
            </td>
            <td class="td_mng">
                <?php

                if($row['selecttime'] != '' && date('Y-m-d', strtotime($row['completetime']) ) != '1970-01-01'){
                 echo date('Y-m-d' ,strtotime($row['completetime']));
                 }else{
                    echo '-';
                 } ?>
            </td>
            <td class="td_mng">
                <?php echo $cnt['cnt'] . '개'; ?>
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
