<?php
$sub_menu = "300150";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

$g5['title'] = '팝업 관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form name="fmember" id="fmember" action="./pickus_popup_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="idx" value="<?php echo $idx ?>">

<input type="hidden" name="w" value="<?php echo $w ?>">

<section id="cate1">
    <h2 class="h2_frm">팝업 정보</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 85%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>이미지</th>
                    <td>
                        <input type="file" name="photo" class="frm_input" style="width:500px;">
                    </td>
                </tr>                               
                <tr>
                    <th>게시여부</th>
                    <td>
                        <select name="state" class="frm_input" style="width:200px;">
                            <option value="0">대기</option>
                            <option value="1">게시</option>
                        </select>
                    </td>
                </tr>                               
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_popup_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn">
</div>
</form>
<?php
include_once ('./admin.tail.php');
?>
