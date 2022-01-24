<?php
$sub_menu = "300135";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'page=' . urlencode($page);

if($w == "u"){
    $sql = "select a.* from {$g5['forum_table']} a where idx = '$idx' ";
    $row = sql_fetch($sql);
}


$g5['title'] = '포럼 관리';
include_once('./admin.head.php');
include_once(G5_EDITOR_LIB);

$is_dhtml_editor = true;
$editor_html = editor_html('content', $row['content'], $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('content', $is_dhtml_editor);

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form name="fmember" id="fmember" action="./pickus_forum_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="idx" value="<?php echo $idx ?>">

<input type="hidden" name="w" value="<?php echo $w ?>">

<section id="cate1">
    <h2 class="h2_frm">포럼 정보</h2>
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
                        <input type="text" name="title" value="<?php echo $row['title'] ?>" id="title" <?php echo $readonly ?> class="frm_input" style="width:100%">
                    </td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>
                        <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                        <!--<textarea id="content" name="content" class="frm_input" style="width:100%"><?php echo $row['content']?></textarea>-->
                    </td>
                </tr> 
                <!--
                <tr>
                    <th>이미지1</th>
                    <td>
                        <input type="file" name="photo1" class="frm_input" style="width:500px;">
                    <?php 
                        if($row['photo1']){ 
                            $img_thumb_tag = admin_estimate_img_thumbnail($row['photo1'], 100, 100);
                            $img_tag = admin_estimate_img_thumbnail($row['photo1'], 800, 800);
                    ?>                        
                            <span class="sit_wimg_limg_photo1">
                                <?php echo $img_thumb_tag; ?>
                            </span>
                            
                            <div id="limgphoto1" class="banner_or_img" style="display:none;">
                                <?php echo $img_tag; ?>
                            </div>
                            <script>
                            $('<button type="button" id="it_limgphoto1_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg_photo1');
                            </script>
                    <?php 
                        } 
                    ?>   
                    </td>
                </tr>                               
                <tr>
                    <th>이미지2</th>
                    <td>
                        <input type="file" name="photo2" class="frm_input" style="width:500px;">
                    <?php 
                        if($row['photo2']){ 
                            $img_thumb_tag = admin_estimate_img_thumbnail($row['photo2'], 100, 100);
                            $img_tag = admin_estimate_img_thumbnail($row['photo2'], 800, 800);
                    ?>                        
                            <span class="sit_wimg_limg_photo2">
                                <?php echo $img_thumb_tag; ?>
                            </span>
                            
                            <div id="limgphoto2" class="banner_or_img" style="display:none;">
                                <?php echo $img_tag; ?>
                            </div>
                            <script>
                            $('<button type="button" id="it_limgphoto2_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg_photo2');
                            </script>
                    <?php 
                        } 
                    ?>   
                    </td>
                </tr>                               
                <tr>
                    <th>이미지3</th>
                    <td>
                        <input type="file" name="photo3" class="frm_input" style="width:500px;">
                    <?php 
                        if($row['photo3']){ 
                            $img_thumb_tag = admin_estimate_img_thumbnail($row['photo3'], 100, 100);
                            $img_tag = admin_estimate_img_thumbnail($row['photo3'], 800, 800);
                    ?>                        
                            <span class="sit_wimg_limg_photo3">
                                <?php echo $img_thumb_tag; ?>
                            </span>
                            
                            <div id="limgphoto3" class="banner_or_img" style="display:none;">
                                <?php echo $img_tag; ?>
                            </div>
                            <script>
                            $('<button type="button" id="it_limgphoto3_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg_photo3');
                            </script>
                    <?php 
                        } 
                    ?>   
                    </td>
                </tr>    
                -->                           
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_forum_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn">
</div>
</form>
<script type="text/javascript">
$(function() {
    $(".sit_wimg_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sit_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
       // var $button = $("#it_"+id+"_view");
        //$button.text($button.text().replace("닫기", "확인"));
    });
});

function fmember_submit(f)
{
    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
    return true;
}
</script>
<?php
include_once ('./admin.tail.php');
?>
