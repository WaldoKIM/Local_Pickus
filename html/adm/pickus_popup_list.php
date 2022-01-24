<?php
$sub_menu = "300150";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '팝업 관리';
include_once('./admin.head.php');

$sql = "select * from {$g5['popup_table']} a ";
$result = sql_query($sql);

$colspan = 4;
?>
<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col style="width: 60%" />
        <col style="width: 15%" />
        <col style="width: 10%" />
        <col style="width: 15%" />
    </colgroup>    
    <thead>
    <tr>
        <th scope="col">이미지</th>
        <th scope="col">등록일자</th>
        <th scope="col">게시여부</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $s_mod = "";
        $s_mod .= '<a href="./pickus_popup_list_delete.php?page='.$page.'&idx='.$row['idx'].'" class="btn btn_01">삭제</a>';
        if($row['state']){
            $s_mod .= '<a href="./pickus_popup_list_update.php?page='.$page.'&state=0&idx='.$row['idx'].'" class="btn btn_03">대기</a>';
        }else{
            $s_mod .= '<a href="./pickus_popup_list_update.php?page='.$page.'&state=1&idx='.$row['idx'].'" class="btn btn_03">개시</a>';
        }
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_name">
            <?php 
                if($row['photo']){
                    echo admin_estimate_img_thumbnail($row['photo'], 200, 200);
                }
            ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['updatetime']; ?>                
        </td>
        <td class="td_mng">
            <?php 
                if($row['state']){ 
                    echo '게시'; 
                }else{ 
                    echo'대기'; 
                } 
            ?>                
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
    <a href="./pickus_popup_form.php" id="member_add" class="btn btn_01">팝업추가</a>
</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
