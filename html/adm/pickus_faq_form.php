<?php
$sub_menu = "300110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

if($w == "u"){
    $sql = "select a.* from {$g5['faq_table']} a where fa_id = '$fa_id' ";
    $row = sql_fetch($sql);
}


$g5['title'] = 'FAQ 관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form name="fmember" id="fmember" action="./pickus_faq_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="fa_id" value="<?php echo $fa_id ?>">

<input type="hidden" name="w" value="<?php echo $w ?>">

<section id="cate1">
    <h2 class="h2_frm">FAQ 정보</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 85%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>제목</th>
                    <td>
                        <input type="text" name="fa_subject" value="<?php echo $row['fa_subject'] ?>" id="fa_subject" <?php echo $readonly ?> class="frm_input" style="width:100%">
                    </td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>
                        <textarea id="fa_content" name="fa_content" class="frm_input" style="width:100%"><?php echo $row['fa_content']?></textarea>
                    </td>
                </tr> 
                
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_faq_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn">
</div>
</form>
<?php
include_once ('./admin.tail.php');
?>
