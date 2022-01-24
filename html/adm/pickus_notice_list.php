<?php
$sub_menu = "300110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['notice_table']} a ";


$sql_order = " order by idx desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$g5['title'] = '공지사항 관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 4;
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

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col style="width: 55%" />
        <col style="width: 15%" />
        <col style="width: 15%" />
        <col style="width: 15%" />
    </colgroup>    
    <thead>
    <tr>
        <th scope="col">제목</th>
        <th scope="col">작성일자</th>
        <th scope="col">조회수</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
        $s_mod = "";
        $s_mod .= '<a href="./pickus_notice_list_delete.php?page='.$page.'&idx='.$row['idx'].'" class="btn btn_01">삭제</a>';
        $s_mod .= '<a href="./pickus_notice_form.php?page='.$page.'&w=u&idx='.$row['idx'].'" class="btn btn_03">수정</a>';
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_name">
            <?php echo $row['title']; ?>    
        </td>
        <td class="td_mng">
            <?php echo $row['updatetime']; ?>                
        </td>
        <td class="td_mng">
            <?php echo $row['hit']; ?>                
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
    <a href="./pickus_notice_form.php?w=" id="member_add" class="btn btn_01">추가</a>
</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
