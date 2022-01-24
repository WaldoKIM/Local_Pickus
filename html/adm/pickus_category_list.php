<?php
$sub_menu = "300140";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '리스트 관리';
include_once('./admin.head.php');

$sql = " select * from {$g5['estimate_category1']} a order by idx ";
$result1 = sql_query($sql);
$sql = " select * from {$g5['estimate_category2']} a order by a.category1, a.idx";
$result2 = sql_query($sql);
$sql = " select * from {$g5['estimate_category3']} a order by a.category1, a.category2, a.idx";
$result3 = sql_query($sql);

?>
<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sme" value="<?php echo $sme ?>">
<input type="hidden" name="snn" value="<?php echo $snn ?>">
<input type="hidden" name="shp" value="<?php echo $shp ?>">
<input type="hidden" name="sfd" value="<?php echo $sfd ?>">
<input type="hidden" name="std" value="<?php echo $std ?>">
<input type="hidden" name="sml" value="<?php echo $sml ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<table>
<colgroup>
    <col style="width: 50%" />
    <col style="width: 50%" />
</colgroup>    
<tr>
    <td style="vertical-align: top;">
        <div class="tbl_head01 tbl_wrap" style="margin-right:20px;">
            <h2 class="h2_frm">세부 카테고리</h2>
            <table>
            <colgroup>
                <col style="width: 30%" />
                <col style="width: 40%" />
                <col style="width: 30%" />
            </colgroup>    
            <thead>
            <tr>
                <th scope="col">품목</th>
                <th scope="col">세부카테고리</th>
                <th scope="col">관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result2); $i++) {
                $bg = 'bg'.($i%2);
                $s_mod = "";
                $s_mod .= '<a href="./pickus_category_list_delete2.php?idx='.$row['idx'].'" class="btn btn_01">삭제</a>';
                $s_mod .= '<a href="./pickus_category2_form.php?w=u&idx='.$row['idx'].'" class="btn btn_03">수정</a>';
            ?>

            <tr class="<?php echo $bg; ?>">
                <td class="td_name">
                    <?php echo $row['category1']; ?>    
                </td>
                <td class="td_name">
                    <?php echo $row['category2']; ?>    
                </td>
                <td class="td_mng">
                    <?php echo $s_mod; ?>    
                </td>
            </tr>

            <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"3\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
            </table>     
        </div>          
    </td>
    <td style="vertical-align: top;">
        <div class="tbl_head01 tbl_wrap" style="margin-right:20px;">
            <h2 class="h2_frm">제조사</h2>
            <table>
            <colgroup>
                <col style="width: 25%" />
                <col style="width: 25%" />
                <col style="width: 25%" />
                <col style="width: 25%" />
            </colgroup>    
            <thead>
            <tr>
                <th scope="col">품목</th>
                <th scope="col">카테고리</th>
                <th scope="col">제조사</th>
                <th scope="col">관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result3); $i++) {
                $bg = 'bg'.($i%2);
                $s_mod = "";
                $s_mod .= '<a href="./pickus_category_list_delete3.php?'.$qstr.'&w=u&idx='.$row['idx'].'" class="btn btn_01">삭제</a>';
                $s_mod .= '<a href="./pickus_category3_form.php?w=u&idx='.$row['idx'].'" class="btn btn_03">수정</a>';
            ?>

            <tr class="<?php echo $bg; ?>">
                <td class="td_name">
                    <?php echo $row['category1']; ?>    
                </td>
                <td class="td_name">
                    <?php echo $row['category2']; ?>                
                </td>
                <td class="td_name">
                    <?php echo $row['category3']; ?>                
                </td>
                <td class="td_mng">
                    <?php echo $s_mod; ?>
                </td>
            </tr>

            <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"4\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
            </table>               
        </div>
    </td>
</tr>
</table>


<div class="btn_fixed_top">
    <a href="./pickus_category2_form.php?w=" id="member_add" class="btn btn_01">세부 카테고리 추가</a>
    <a href="./pickus_category3_form.php?w=" id="member_add" class="btn btn_01">제조사 추가</a>
</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
