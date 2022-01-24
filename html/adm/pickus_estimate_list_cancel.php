<?php
    $sub_menu = "400235";
    include_once('./_common.php');

    auth_check($auth[$sub_menu], 'r');
    $g5['title'] = '수거 취소';
    $sql = " select count(*) as cnt from g5_cancel as a join g5_estimate_list as b on a.estimate_idx = b.idx order by b.idx desc";
    $row = sql_fetch($sql);
    
    $total_count = $row['cnt'];
    $rows = $config['cf_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함
    $sql = "select * from g5_cancel as a join g5_estimate_list as b on a.estimate_idx = b.idx order by b.idx desc limit {$from_record}, {$rows} ";
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
            <th scope="col">제목</th>
            <th scope="col">취소사유</th>
            <th scope="col">업체명</th>
            <th scope="col">업체이메일</th>
            <th scope="col">고객명</th>
            <th scope="col">고객이메일</th>
            <th scope="col">취소일시</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bg = 'bg'.($i%2);
        ?>

        <tr class="<?php echo $bg; ?>">
            <td class="td_name">
                <?php echo $row['title']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['reason']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['rc_name']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['rc_email']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['nickname']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['email']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['date']; ?>                
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
