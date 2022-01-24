<?php
    $sub_menu = "200110";
    include_once('./_common.php');

    auth_check($auth[$sub_menu], 'r');
    $g5['title'] = '파트너 문의';
    $sql = "select * from g5_partner_estimate";
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
            <th scope="col">업체명</th>
            <th scope="col">이름</th>
            <th scope="col">전화번호</th>
            <th scope="col" colspan="2">지역</th>
            <th scope="col">신청일시</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bg = 'bg'.($i%2);
        ?>

        <tr class="<?php echo $bg; ?>">
            <td class="td_name">
                <?php echo $row['company']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['name']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['phone']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['area1']; ?>                
            </td>
            <td class="td_mng">
                <?php echo $row['area2']; ?>                
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
