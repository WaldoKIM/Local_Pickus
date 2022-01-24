<?php
$sub_menu = "400210";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$qstr = '';
$qstr .= 'set=' . urlencode($set);
$qstr .= '&amp;sme=' . urlencode($sme);
$qstr .= '&amp;snn=' . urlencode($snn);
$qstr .= '&amp;shp=' . urlencode($shp);
$qstr .= '&amp;sa1=' . urlencode($sa1);
$qstr .= '&amp;sa2=' . urlencode($sa2);
$qstr .= '&amp;stl=' . urlencode($stl);
$qstr .= '&amp;swf=' . urlencode($swf);
$qstr .= '&amp;swt=' . urlencode($swt);
$qstr .= '&amp;spf=' . urlencode($spf);
$qstr .= '&amp;spt=' . urlencode($spt);
$qstr .= '&amp;scf=' . urlencode($scf);
$qstr .= '&amp;sct=' . urlencode($sct);
$qstr .= '&amp;sta=' . urlencode($sta);
$qstr .= '&amp;smp=' . urlencode($smp);

$w = "";
$readonly = "";
if($e_type == "0"){
    $sub_key= "0";
}else{
    $sub_key= time();
}
if($idx){
    $w = "u";
    $sql = "select * from {$g5['estimate_list']} a where idx = '$idx' ";
    $estimate = sql_fetch($sql);
    $e_type = $estimate['e_type'];
    $sub_key= $estimate['sub_key'];
    $readonly = "readonly";

    $sql = "select * from {$g5['estimate_list_photo']} a where estimate_idx = '$idx'";
    $photo_list = sql_query($sql);
}
//print_r2($estimate);exit;

$g5['title'] = '견적관리';
include_once('./admin.head.php');

?>
<form name="fmember" id="fmember" action="./pickus_estimate_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="set" value="<?php echo $set ?>">
<input type="hidden" name="sme" value="<?php echo $sme ?>">
<input type="hidden" name="snn" value="<?php echo $snn ?>">
<input type="hidden" name="shp" value="<?php echo $shp ?>">
<input type="hidden" name="sa1" value="<?php echo $sa1 ?>">
<input type="hidden" name="sa2" value="<?php echo $sa2 ?>">
<input type="hidden" name="stl" value="<?php echo $stl ?>">
<input type="hidden" name="swf" value="<?php echo $swf ?>">
<input type="hidden" name="swt" value="<?php echo $swt ?>">
<input type="hidden" name="spf" value="<?php echo $spf ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="scf" value="<?php echo $scf ?>">
<input type="hidden" name="sct" value="<?php echo $sct ?>">
<input type="hidden" name="sta" value="<?php echo $sta ?>">
<input type="hidden" name="smp" value="<?php echo $smp ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<input type="hidden" name="idx" value="<?php echo $idx ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="e_type" value="<?php echo $e_type ?>">
<input type="hidden" name="sub_key" value="<?php echo $sub_key ?>">
<section id="cate1">
    <h2 class="h2_frm">고객정보</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 35%" />
                <col style="width: 15%" />
                <col style="width: 35%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>이름</th>
                    <td>
                        <input type="text" name="nickname" value="<?php echo $estimate['nickname'] ?>" id="nickname" <?php echo $readonly ?> class="frm_input" style="width:100%">
                    </td>
                    <th>연락처</th>
                    <td>
                        <input type="text" name="phone" value="<?php echo $estimate['phone'] ?>" id="phone" <?php echo $readonly ?> class="frm_input" style="width:100%">
                    </td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td>
                        <input type="text" name="email" value="<?php echo $estimate['email'] ?>" id="email" <?php echo $readonly ?> class="frm_input" style="width:100%">
                    </td>
                    <th>견적마감일</th>
                    <td>
                        <input type="text" name="deadline" value="<?php echo $estimate['deadline'] ?>" id="deadline" class="frm_input" style="width:100%">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<section id="cate2">
    <h2 class="h2_frm">지역선택</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 10%" />
                <col style="width: 15%" />
                <col style="width: 10%" />
                <col style="width: 15%" />
                <col style="width: 35%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>주소</th>
                    <td colspan="3">
                        <select name="area1" id="area1" class="frm_input" style="width:45%;">
                            <option value="">시/도</option>
                        <?php
                            $sql1 = " select area1 from {$g5['estimate_area1']} order by idx ";

                            $result1 = sql_query($sql1);

                            for ($i=0; $row1=sql_fetch_array($result1); $i++){
                                $selected = "";
                                if($row1['area1'] == $estimate['area1']) $selected = "selected";

                                echo '<option value="'.$row1['area1'].'" '.$selected.'>'.$row1['area1'].'</option>';
                            }                        
                        ?>
                        </select>
                        <select name="area2" id="area2" class="frm_input" style="width:45%;">
                            <option value="">시/구/군</option>
                        <?php
                            if($estimate['area1']){
                                $sql1 = " select area2 from {$g5['estimate_area2']} where area1='{$estimate['area1']}' order by idx ";

                                $result1 = sql_query($sql1);

                                for ($i=0; $row1=sql_fetch_array($result1); $i++){
                                    $selected = "";
                                    if($row1['area2'] == $estimate['area2']) $selected = "selected";

                                    echo '<option value="'.$row1['area2'].'" '.$selected.'>'.$row1['area2'].'</option>';
                                }                        

                            }
                        ?>                            
                        </select>
                    </td>
                    <th>상세주소</th>
                    <td>
                        <input type="text" name="area3" value="<?php echo $estimate['area3'] ?>" id="area3" class="frm_input" style="width:100%">
                    </td>
                </tr>
                <tr>
                    <th>층수</th>
                    <td>
                        <input type="text" name="floor" value="<?php echo $estimate['floor'] ?>" id="floor" class="frm_input" style="width:100%">
                    </td>
                    <th>엘리베이터</th>
                    <td>
                        <select name="elevator_yn" id="elevator_yn" class="frm_input" style="width:100%;">
                            <option value="엘리베이터 있음" <?php if($estimate['area2'] == "엘리베이터 있음") echo "selected"; ?>>유</option>
                            <option value="엘리베이터 없음" <?php if($estimate['area2'] == "엘리베이터 없음") echo "selected"; ?>>무</option>
                        </select>
                    </td>
                    <th>수거요청일</th>
                    <td>
                        <input type="text" name="pickup_date" value="<?php echo $estimate['pickup_date'] ?>" id="pickup_date" class="frm_input" style="width:100%">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php if($e_type == 0){ ?>
<section id="cate3">
    <h2 class="h2_frm">물품정보</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 35%" />
                <col style="width: 15%" />
                <col style="width: 35%" />
            </colgroup>
            <tbody>
                <tr>
                    <th>품목</th>
                    <td colspan="3">
                        <select name="item_cat" id="item_cat" class="frm_input" style="width:30%;">
                            <option value="가전" <?php if($estimate['item_cat'] == "가전") echo "selected"; ?>>가전</option>
                            <option value="주방집기" <?php if($estimate['item_cat'] == "주방집기") echo "selected"; ?>>주방집기</option>
                            <option value="헬스용품" <?php if($estimate['item_cat'] == "헬스용품") echo "selected"; ?>>헬스용품</option>
                            <option value="가구" <?php if($estimate['item_cat'] == "가구") echo "selected"; ?>>가구</option>
                        </select>                        
                    </td>
                </tr>
                <tr>
                    <th>세부카테고리</th>
                    <td>
                        <select name="item_cat_dtl_s" id="item_cat_dtl_s" class="frm_input" style="width:45%;">
                            <option value="">선택</option>
                        <?php
                            $item_cat = $estimate['item_cat'];
                            if(!$item_cat)  $item_cat = '가전';
                            $item_cat_dtl = $estimate['item_cat_dtl'];
                            $item_cat_dtl_s = "";
                            $item_cat_dtl_etc = "";
                            if($item_cat_dtl)
                            {
                                $sql1 = " select * from {$g5['estimate_category2']} where category1='$item_cat' order by idx ";
                                $result = sql_query($sql1);
                                for ($i=0; $row1=sql_fetch_array($result); $i++){
                                    if($item_cat_dtl == $row1['category2']){
                                        $item_cat_dtl_s = $item_cat_dtl;
                                        $item_cat_dtl_etc = "";
                                    }
                                }

                                if(!$item_cat_dtl_s){
                                    $item_cat_dtl_s = "직접입력";
                                    $item_cat_dtl_etc = $item_cat_dtl;
                                }
                            }
                            $sql1 = " select * from {$g5['estimate_category2']} where category1='$item_cat' order by idx ";
                            $result = sql_query($sql1);
                            for ($i=0; $row1=sql_fetch_array($result); $i++){
                                $selected = "";
                                if($row1['category2'] == $item_cat_dtl_s) $selected = "selected";
                                echo '<option value="'.$row1['category2'].'" '.$selected.'>'.$row1['category2'].'</option>';
                            }
                        ?>    
                        </select>                        
                        <?php if($item_cat_dtl_etc){ ?>
                            <input type="text" name="item_cat_dtl_etc" value="<?php echo $item_cat_dtl_etc ?>" id="item_cat_dtl_etc" class="frm_input" style="width:50%">
                        <?php }else{?>
                            <input type="text" name="item_cat_dtl_etc" id="item_cat_dtl_etc" class="frm_input" style="width:50%;display:none;">
                        <?php }?>
                        <input type="hidden" name="item_cat_dtl" id="item_cat_dtl" value="<?php echo $estimate['item_cat_dtl'] ?>">
                    </td>
                    <th>제조사</th>
                    <td>
                        <select name="manufacturer_s" id="manufacturer_s" class="frm_input" style="width:45%;">
                            <option value="">선택</option>
                        <?php
                            if($item_cat_dtl_s)
                            {
                                $manufacturer = $estimate['manufacturer'];
                                $manufacturer_s = "";
                                $manufacturer_etc = "";                                
                                $sql1 = " select * from {$g5['estimate_category3']} where category1='$item_cat' and category2='$item_cat_dtl_s' order by idx ";
                                $result = sql_query($sql1);
                                for ($i=0; $row1=sql_fetch_array($result); $i++){
                                    if($manufacturer == $row1['category3']){
                                        $manufacturer_s = $manufacturer;
                                        $manufacturer_etc = "";
                                    }
                                }

                                if(!$manufacturer_s){
                                    $manufacturer_s = "직접입력";
                                    $manufacturer_etc = $manufacturer;
                                }
                                $sql1 = " select * from {$g5['estimate_category3']} where category1='$item_cat' and category2='$item_cat_dtl_s' order by idx ";
                                $result = sql_query($sql1);
                                for ($i=0; $row1=sql_fetch_array($result); $i++){
                                    $selected = "";
                                    if($row1['category3'] == $manufacturer_s) $selected = "selected";
                                    echo '<option value="'.$row1['category3'].'" '.$selected.'>'.$row1['category3'].'</option>';
                                }
                            }
                        ?>    
                        </select>    
                        <?php if($item_cat_dtl_etc){ ?>
                            <input type="text" name="manufacturer_etc" value="<?php echo $manufacturer_etc ?>" id="manufacturer_etc" class="frm_input" style="width:50%">
                        <?php }else{?>
                            <input type="text" name="manufacturer_etc" id="manufacturer_etc" class="frm_input" style="width:50%;display:none;">
                        <?php }?>                                            
                        <input type="hidden" name="manufacturer" id="manufacturer" value="<?php echo $estimate['manufacturer'] ?>">
                    </td>
                </tr>
                <tr>
                    <th>모델명</th>
                    <td>
                        <input type="text" name="medel_name" value="<?php echo $estimate['medel_name'] ?>" id="medel_name" class="frm_input" style="width:100%">
                    </td>
                    <th>연식</th>
                    <td>
                        <input type="hidden" id="year" name="year" value="<?php echo $estimate['year'] ?>"/>
                        <select name="use_year" id="use_year" class="frm_input" style="width:45%;">
                        <?php
                            for($i=1; $i<=20; $i++){
                                $selected = "";
                                if($estimate['use_year'] == $i) $selected = "selected";
                                echo '<option value="'.$i.'" '.$selected.'>'.(G5_TIME_YEAR-$i+1).'년</option>';
                            }
                        ?>
                        </select>                        
                    </td>
                </tr>
                <tr>
                    <th>참고사항</th>
                    <td colspan="3">
                        <textarea id="content" name="content" class="frm_input" style="width:100%;height:400px;"><?php echo $estimate['content'] ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php } ?>
<?php if($e_type == 1){ ?>
<section id="cate3">
    <h2 class="h2_frm">물품정보</h2>
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
                    <td><input type="text" name="title" id="title" value="<?php echo $estimate['title'] ?>" class="frm_input" style="width:100%;"></td>
                </tr>
                <tr>
                    <th rowspan = "2">품목 리스트</th>
                    <td>
                        <label>품목</label>
                        <select name="item_cat" id="item_cat" class="frm_input" style="width:12%;">
                            <option value="가전">가전</option>
                            <option value="주방집기">주방집기</option>
                            <option value="헬스용품">헬스용품</option>
                            <option value="가구">가구</option>
                        </select> 
                        <label>세부카테고리</label>
                        <select name="item_cat_dtl_s" id="item_cat_dtl_s" class="frm_input" style="width:12%;">
                            <option value="">선택</option>
                        <?php
                            $sql1 = " select * from {$g5['estimate_category2']} where category1='가전' order by idx ";
                            $result = sql_query($sql1);
                            for ($i=0; $row1=sql_fetch_array($result); $i++){
                                $selected = "";
                                if($row1['category2'] == $item_cat_dtl_s) $selected = "selected";
                                echo '<option value="'.$row1['category2'].'" '.$selected.'>'.$row1['category2'].'</option>';
                            }
                        ?>    
                        </select>    
                        <input type="text" name="item_cat_dtl_etc" id="item_cat_dtl_etc" class="frm_input" style="width:12%;display:none;">
                        <label>제조사</label>
                        <select name="manufacturer_s" id="manufacturer_s" class="frm_input" style="width:12%;">
                            <option value="">선택</option>
                        </select>       
                        <input type="text" name="manufacturer_etc" id="manufacturer_etc" class="frm_input" style="width:12%;display:none;">
                        <label>모델명</label>
                        <input type="text" name="medel_name" id="medel_name" class="frm_input" style="width:12%"> 
                        <label>연식</label>
                        <select name="use_year" id="use_year" class="frm_input" style="width:12%;">
                        <?php
                            for($i=1; $i<=20; $i++){
                                echo '<option value="'.$i.'">'.(G5_TIME_YEAR-$i+1).'년</option>';
                            }
                        ?>
                        </select>   
                        <label>수량</label>   
                        <input type="text" name="item_qty" id="item_qty" class="frm_input" style="width:12%">   
                        <a href="javascript:" class="btn btn_03 btn_add_item">추가</a>       
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="tbl_head01 tbl_wrap">
                            <table>
                                <colgroup>
                                    <col style="width: 15%" />
                                    <col style="width: 15%" />
                                    <col style="width: 15%" />
                                    <col style="width: 25%" />
                                    <col style="width: 15%" />
                                    <col style="width: 5%" />
                                    <col style="width: 10%" />
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>품목</th>
                                        <th>세부 카테고리</th>
                                        <th>제조사</th>
                                        <th>모델명</th>
                                        <th>년식</th>
                                        <th>수량</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="multiList">
                                <?php
                                    if($sub_key){
                                        $sql1 = " select * from {$g5['estimate_list_multi']} where sub_key='$sub_key' order by idx ";
                                        $result = sql_query($sql1);
                                        for ($i=0; $row1=sql_fetch_array($result); $i++){
                                ?>
                                    <tr>
                                        <input type="hidden" name="item_cat[]" value="<?php echo $row1['item_cat'] ?>">
                                        <input type="hidden" name="item_cat_dtl[]" value="<?php echo $row1['item_cat_dtl'] ?>">
                                        <input type="hidden" name="manufacturer[]" value="<?php echo $row1['manufacturer'] ?>">
                                        <input type="hidden" name="medel_name[]" value="<?php echo $row1['medel_name'] ?>">
                                        <input type="hidden" name="year[]" value="<?php echo $row1['year'] ?>">
                                        <input type="hidden" name="use_year[]" value="<?php echo $row1['use_year'] ?>">
                                        <input type="hidden" name="item_qty[]" value="<?php echo $row1['item_qty'] ?>">
                                        <td><?php echo $row1['item_cat'] ?></td>
                                        <td><?php echo $row1['item_cat_dtl'] ?></td>
                                        <td><?php echo $row1['manufacturer'] ?></td>
                                        <td><?php echo $row1['medel_name'] ?></td>
                                        <td><?php echo $row1['year'] ?></td>
                                        <td><?php echo $row1['item_qty'] ?></td>
                                        <td>
                                            <a href="javascript:" class="btn btn_02 btn_del_item">삭제</a>
                                        </td>
                                    </tr>
                                <?php
                                        }
                                    }
                                ?>
                                </tbody>                              
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>첨부파일</th>
                    <td colspan="3">
                    <?php
                        if($estimate['attach_file']){
                            echo '<a href="'.G5_DATA_URL.'/estimate/'.$estimate['attach_file'].'" class="btn btn_01">삭제</a>';
                        }
                    ?>
                        <input type="file" id="attfile" name="attfile"  class="frm_input" style="width:500px;">
                    </td>
                </tr>                
                <tr>
                    <th>참고사항</th>
                    <td colspan="3">
                        <textarea id="content" name="content" class="frm_input" style="width:100%;height:400px;"><?php echo $estimate['content'] ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php } ?>
<?php if($e_type == 2){ ?>
<section id="cate3">
    <h2 class="h2_frm">물품정보</h2>
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
                    <td><input type="text" name="title" id="title" value="<?php echo $estimate['title'] ?>" class="frm_input" style="width:100%;"></td>
                </tr>
                <tr>
                    <th>철거종류</th>
                    <td>
                    <?php
                        $pull_kinds = array(
                                                "붙박이장"=>"붙박이장",
                                                "인테리어"=>"인테리어",
                                                "내부철거"=>"내부철거",
                                                "간판철거"=>"간판철거",
                                                "가벽철거"=>"가벽철거",
                                                "타일철거"=>"타일철거",
                                                "건물철거"=>"건물철거",
                                                "폐기물처리"=>"폐기물처리",
                                                "원상복구"=>"원상복구",
                                                "모두철거"=>"모두철거",
                                                "기타"=>"기타"
                                            );
                        $seq = 1;
                        while(list($key,$val) = each($pull_kinds)) {
                            $checked = "";
                            $pos = strpos(','.$estimate['pull_kind'],$key);
                            if($pos){
                                $checked = "checked";
                            }
                           echo '<input type="checkbox" name="pull_kind[]" id="pull_kind'.$seq.'" value="'.$key.'" '.$checked.'>';
                           echo '<label for="pull_kind'.$seq.'">'.$val.'</label>&nbsp;&nbsp;&nbsp;';
                           $seq++;
                        }            

                    ?>
                        <input type="text" name="pull_kind_etc" id="pull_kind_etc" value="<?php echo $estimate['pull_kind_etc'] ?>" class="frm_input" style="width:10%;">
                    </td>
                </tr>
                <tr>
                    <th>천장/바닥 철거</th>
                    <td>
                        <input type="radio" name="pull_floor_bottom" value="유" <?php echo $estimate['pull_floor_bottom']=="유"?"checked":""; ?> id="pull_floor_bottom1">
                        <label for="pull_floor_bottom1">유</label>
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="pull_floor_bottom" value="무" <?php echo $estimate['pull_floor_bottom']=="무"?"checked":""; ?> id="pull_floor_bottom2">
                        <label for="pull_floor_bottom2">무</label>                             
                    </td>
                </tr>
                <tr>
                    <th>첨부파일</th>
                    <td colspan="3">
                    <?php
                        if($estimate['attach_file']){
                            echo '<a href="'.G5_DATA_URL.'/estimate/'.$estimate['attach_file'].'" class="btn btn_01">삭제</a>';
                        }
                    ?>
                        <input type="file" id="attfile" name="attfile"  class="frm_input" style="width:500px;">
                    </td>
                </tr>                
                <tr>
                    <th>참고사항</th>
                    <td colspan="3">
                        <textarea id="content" name="content" class="frm_input" style="width:100%;height:400px;"><?php echo $estimate['content'] ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php } ?>
<section id="cate3">
    <h2 class="h2_frm">이미지</h2>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col style="width: 15%" />
                <col style="width: 85%" />
            </colgroup>
            <tbody>
        <?php 
            if($photo_list){ 
                for ($i=0; $row1=sql_fetch_array($photo_list); $i++){

                    $img_thumb_tag = admin_estimate_img_thumbnail($row1['photo'], 100, 100);
                    $img_tag = admin_estimate_img_thumbnail($row1['photo'], 800, 800);
        ?>
                    <tr>
                        <input type="hidden" name="photo_old[]" value="<?php echo $row1['photo']; ?>">
                        <th>이미지</th>
                        <td>
                            <span class="sit_wimg_limg<?php echo $i; ?>"><?php echo $img_thumb_tag; ?></span>
                            <div id="limg<?php echo $i; ?>" class="banner_or_img" style="display:none;">
                                <?php echo $img_tag; ?>
                                <!--<button type="button" class="sit_wimg_close">닫기</button>-->
                            </div>
                            <script>
                            $('<button type="button" id="it_limg<?php echo $i; ?>_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg<?php echo $i; ?>');
                            </script>
                            <a href="./pickus_estimate_form_image_download.php?idx=<?php echo $row1['idx']; ?>" class="btn btn_03">이미지 다운로드</a>
                        </td>
                    </tr>
        <?php 
                }
            } 
        ?>
                <tr>
                    <th>이미지 등록</th>
                    <td>
                        <div id="photoList" style="padding-bottom:5px;">
                            <input type="file" name="photo[]" class="frm_input" style="width:500px;">
                        </div>
                        <a href="javascript:" class="btn btn_03 btn_add_photo">이미지 추가</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<div class="btn_fixed_top">
    <a href="./pickus_estimate_list.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
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

    $(".btn_add_item").bind("click", function() {
        var item_cat = $("#item_cat_dtl_s").val();
        var item_cat_dtl = $("#item_cat_dtl_s").val();
        if(item_cat_dtl == "직접입력")
        {
            item_cat_dtl = $("#item_cat_dtl_etc").val();
        }
        
        var manufacturer = $("#manufacturer_s").val();
        if(manufacturer == "직접입력")
        {
            manufacturer = $("#manufacturer_etc").val();
        }
        var medel_name =  $("#medel_name").val();
        var use_year = $("#use_year").val();
        var year = $("#use_year option:selected").text();
        var item_qty = $("#item_qty").val();

        var vHtml = "<tr>";

        vHtml += '<input type="hidden" name="item_cat_m[]" value="'+item_cat+'">';
        vHtml += '<input type="hidden" name="item_cat_dtl_m[]" value="'+item_cat_dtl+'">';
        vHtml += '<input type="hidden" name="manufacturer_m[]" value="'+manufacturer+'">';
        vHtml += '<input type="hidden" name="medel_name_m[]" value="'+medel_name+'">';
        vHtml += '<input type="hidden" name="year_m[]" value="'+year+'">';
        vHtml += '<input type="hidden" name="use_year_m[]" value="'+use_year+'">';
        vHtml += '<input type="hidden" name="item_qty_m[]" value="'+item_qty+'">';
        vHtml += '<td>'+item_cat+'</td>';
        vHtml += '<td>'+item_cat_dtl+'</td>';
        vHtml += '<td>'+manufacturer+'</td>';
        vHtml += '<td>'+medel_name+'</td>';
        vHtml += '<td>'+year+'</td>';
        vHtml += '<td>'+item_qty+'</td>';
        vHtml += '<td><a href="javascript:" class="btn btn_02 btn_del_item">삭제</a></td>';
        vHtml += "</tr>";
        $("#multiList").append(vHtml);

        $(".btn_del_item").bind("click", function() {
            $(this).closest("tr").remove();
            return false;
        });
        $('#use_year_m').change(function(){ 
            var vYear = $("#use_year_m").val();
            $('#year_m').val($("#use_year_m option:selected").text());
        }); 

        return false;
    });

    $(".btn_del_item").bind("click", function() {
        $(this).closest("tr").remove();
        return false;
    });

    $(".btn_add_photo").bind("click", function() {
        $("#photoList").append('<br><input type="file" name="photo[]" class="frm_input" style="width:500px;">');
        return false;
    });
    $('#area1').change(function(){ 
        doSelectArea2(); 
    }); 

    $('#item_cat').change(function() { 
        doSelectCategory2();

    }); 

    $('#item_cat_dtl_s').change(function() { 
        $('#item_cat_dtl_etc').val("");
        if($(this).val() == "직접입력")
        {
            $('#item_cat_dtl_etc').show();
        }else{
            $('#item_cat_dtl_etc').hide();
        }
        doSelectCategory3();

    }); 

    $('#manufacturer_s').change(function(){
        $('#manufacturer_etc').val("");
        $('#manufacturer').val($(this).val());
        if($(this).val() == "직접입력")
        {
            $('#manufacturer').val("");
            $('#manufacturer_etc').show();
        }else{
            $('#manufacturer_etc').hide();
        }
    });

    $('#manufacturer_etc').change(function(){
        $('#manufacturer').val($(this).val());
    });

    $('#use_year').change(function(){ 
        var vYear = $("#use_year").val();
        $('#year').val($("#use_year option:selected").text());
    });         
    $('input[name="pull_kind[]"]').click(function() {
        var vValue = $(this).val();
        if ($(this).is(':checked')) {
            if(vValue == "모두철거"){
                $('input[name="pull_kind[]"]').each(function(){
                    this.checked = true;
                });
            }
        }
    });
});

function doSelectArea2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
        data: {
            "area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
            fvHtml += "<option value=\"\" selected>시/군/구</option>";
            fvHtml += data;
            $("#area2").html(fvHtml);

        }
    });
}   

function doSelectCategory2()
{
    var itemCat = $('#item_cat').val();
    
    $("#manufacturer_s").val("");
    $("#medel_name").val("");
    $("#year").val("");
    $("#use_year").val("");

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
        data: {
            category1:$('#item_cat').val()
        },
        cache: false,
        success: function(data) {
            $('#item_cat_dtl_etc').hide();
            $('#manufacturer_etc').hide();
            $("#item_cat_dtl_s").html("");
            var fvHtml="<option value=\"\" selected>선택</option>";
            $("#manufacturer_s").html(fvHtml);
            fvHtml += data;
             $("#item_cat_dtl_s").html(fvHtml);
        }
    });
}

function doSelectCategory3()
{

    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category3.php",
        data: {
            category1:$('#item_cat').val(),
            category2:$('#item_cat_dtl_s').val()
        },
        cache: false,
        success: function(data) {
            $('#manufacturer_etc').hide();
            var fvHtml="<option value=\"\" selected>선택</option>";
            if($('#item_cat_dtl_s').val())
            {
                fvHtml += data;
            }
            $("#manufacturer_s").html(fvHtml);
        }
    });
}

</script>
<?php
include_once ('./admin.tail.php');
?>
