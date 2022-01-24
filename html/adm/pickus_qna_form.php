<?php
$sub_menu = "300120";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

$sql = "select a.*, concat('<p>',replace(a.res_content,'\n','</p><p>'),'</p>') as res_content1 from {$g5['qna_table']} a where idx = '$idx' ";
$row = sql_fetch($sql);


$g5['title'] = 'Q&A 관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form name="fmember" id="fmember" action="./pickus_qna_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="idx" value="<?php echo $idx ?>">

<input type="hidden" name="w" value="<?php echo $w ?>">

<section id="cate1">
    <h2 class="h2_frm">Q&A 정보</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 85%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>이메일</th>
                    <td><?php echo $row['email']?></td>
                </tr>
                <tr>
                    <th>이름</th>
                    <td><?php echo $row['nickname']?></td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td><?php echo $row['phone']?></td>
                </tr>                
                <tr>
                    <th>문의유형</th>
                    <td><?php echo $row['res_type']?></td>
                </tr>                
                <tr>
                    <th>제목</th>
                    <td><?php echo $row['title']?></td>
                </tr>                
                <tr>
                    <th>내용</th>
                    <td><?php echo $row['res_content1']?></td>
                </tr>                
                <tr>
                    <th>답변</th>
                    <td>
                        <textarea id="ret_content" name="ret_content" class="frm_input" style="width:100%"><?php echo $row['ret_content']?></textarea>
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_qna_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn">
</div>
</form>
<?php
include_once ('./admin.tail.php');
?>
