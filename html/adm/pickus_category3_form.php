<?php
$sub_menu = "300140";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if($w == "u"){
    $sql = "select a.* from {$g5['estimate_category3']} a where idx = '$idx' ";
    $row = sql_fetch($sql);
}

$sql = " select * from {$g5['estimate_category1']} a order by idx ";
$result = sql_query($sql);

$g5['title'] = '제조사 관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form name="fmember" id="fmember" action="./pickus_category3_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="idx" value="<?php echo $idx ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">

<section id="cate1">
    <h2 class="h2_frm">세부 카테고리 관리</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 85%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>품목</th>
                    <td>
                        <select name="category1" id="category1" class="frm_input">
                            <option value="">선택</option>
                        <?php
                        for ($i=0; $row1=sql_fetch_array($result); $i++) {
                            $selected = "";
                            if($row['category1'] == $row1['category1'])
                            {
                                $selected = "selected";
                            }

                            echo '<option value="'.$row1['category1'].'" '.$selected.'>'.$row1['category1'].'</option>';
                        }
                        ?>                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>세부카테고리</th>
                    <td>
                        <select name="category2" id="category2" class="frm_input">
                            <option value="">선택</option>
                            <?php
                            if($row['category1'])
                            {
                                $sql = " select * from {$g5['estimate_category2']} a where category1 = '{$row['category1']}' order by idx ";
                                $result2 = sql_query($sql);
                                for ($i=0; $row2=sql_fetch_array($result2); $i++) {
                                    $selected = "";
                                    if($row['category2'] == $row2['category2'])
                                    {
                                        $selected = "selected";
                                    }

                                    echo '<option value="'.$row2['category2'].'" '.$selected.'>'.$row2['category2'].'</option>';
                                }

                            }
                            ?>                         
                        </select>
                    </td>
                </tr> 
                <tr>
                    <th>제조사</th>
                    <td>
                        <input type="text" name="category3" value="<?php echo $row['category3'] ?>" id="category3" class="frm_input" style="width:100%">
                    </td>
                </tr> 
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_category_list.php" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn">
</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function(){  
    $('#category1').change(function() { 
        doSelectCategory2();

    }); 
});
function doSelectCategory2()
{

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
        data: {
            category1:$('#category1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="<option value=\"\" selected>선택</option>";
            fvHtml += data;
            $("#category2").html(fvHtml);
        }
    });
}   
</script>
<?php
include_once ('./admin.tail.php');
?>
