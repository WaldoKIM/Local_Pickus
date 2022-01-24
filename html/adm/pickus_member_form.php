<?php
$sub_menu = "200110";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

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
if ($mb_id) {
    $w = "u";
    $sql = "select * from {$g5['member_table']} a where mb_id = '$mb_id' ";
    $mb = sql_fetch($sql);
    $mb_level = $mb['mb_level'];
    $readonly = "readonly";
}


$g5['title'] = '회원 관리';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<script type="text/javascript" src="/js/md5.js"></script>
<form name="fmember" id="fmember" action="./pickus_member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
    <input type="hidden" name="mb_type" value="<?php echo $mb_type ?>">

    <input type="hidden" name="token" value="">

    <input type="hidden" name="w" value="<?php echo $w ?>">

    <input type="hidden" name="mb_id" value="<?php echo $mb['mb_id'] ?>">
    <input type="hidden" name="mb_password_type" value="<?php echo $mb['md5'] ?>">
    <input type="hidden" name="mb_password">
    <input type="hidden" name="mb_level" value="<?php echo $mb_level ?>">
    <?php if ($mb_level == "0" || $mb_level == "3" || $mb_level == "8" || $mb_level == "10") { ?>
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
                            <th>이메일</th>
                            <td>
                                <input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" <?php echo $readonly ?> class="frm_input" style="width:100%">

                            </td>
                            <th>비밀번호</th>
                            <td>
                                <input type="password" name="mb_password_new" class="frm_input" style="width:100%">
                            </td>
                        </tr>
                        <tr>
                            <th>이름</th>
                            <td>
                                <input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" class="frm_input" style="width:50%">
                            </td>
                            <th>연락처</th>
                            <td>
                                <input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" style="width:100%">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    <?php } ?>
    <?php if ($mb_level == "1" || $mb_level == "2" || $mb_level == "4") { ?>
        <section id="cate1">
            <h2 class="h2_frm">센터정보</h2>
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
                            <th>센터종류</th>
                            <td>
                                <select name="mb_biz_type" id="mb_biz_type" class="frm_input" style="width:30%">
                                    <option value="1">재활용센터</option>
                                    <option value="2">철거업체</option>
                                    <option value="3">센터, 업체 둘다</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>매입/철거 업체추천</th>
                            <td>
                                <select name="mb_show_type" id="mb_show_type" class="frm_input" style="width:30%">
                                    <option value="1">표시함</option>
                                    <option value="2">표시안함</option>
                                </select>
                            </td>
                            <th>매칭 업체추천</th>
                            <td>
                                <select name="mb_show_type_match" id="mb_show_type_match" class="frm_input" style="width:30%">
                                    <option value="1">표시함</option>
                                    <option value="2">표시안함</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td>
                                <input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" <?php echo $readonly ?> class="frm_input" style="width:100%">

                            </td>
                            <th>비밀번호</th>
                            <td>
                                <input type="password" name="mb_password_new" class="frm_input" style="width:100%">
                            </td>
                        </tr>
                        <tr>
                            <th>센터이름</th>
                            <td>
                                <input type="text" name="mb_biz_name" value="<?php echo $mb['mb_biz_name'] ?>" id="mb_biz_name" class="frm_input" style="width:50%">
                                <input type="hidden" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name">
                            </td>
                            <th>센터전화번호</th>
                            <td>
                                <input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" style="width:100%">
                            </td>
                        </tr>
                        <tr>
                            <th>주소</th>
                            <td>
                                <input type="text" name="mb_biz_post" value="<?php echo $mb['mb_biz_post'] ?>" id="mb_biz_post" class="frm_input" readonly style="width:15%;">
                                <button type="button" class="btn_frmline" onclick="doSearchPost1();">주소 검색</button>
                                <input type="text" name="mb_biz_addr1" value="<?php echo $mb['mb_biz_addr1'] ?>" id="mb_biz_addr1" class="frm_input" readonly style="width:70%;">
                                <div id="wrap" style="display:none;border:1px solid;width:90%;height:300px;margin:5px 0;position:relative">
                                    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="width:40px;cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" onclick="foldDaumPostcode()" alt="접기 버튼">
                                </div>
                                <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                                <script>
                                    // 우편번호 찾기 찾기 화면을 넣을 element
                                    var element_wrap = document.getElementById('wrap');

                                    function foldDaumPostcode() {
                                        // iframe을 넣은 element를 안보이게 한다.
                                        element_wrap.style.display = 'none';
                                    }

                                    function doSearchPost1() {
                                        // 현재 scroll 위치를 저장해놓는다.
                                        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
                                        new daum.Postcode({
                                            oncomplete: function(data) {
                                                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                                                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                                var addr = ''; // 주소 변수
                                                var extraAddr = ''; // 참고항목 변수

                                                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                                                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                                    addr = data.roadAddress;
                                                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                                    addr = data.jibunAddress;
                                                }

                                                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                                                if (data.userSelectedType === 'R') {
                                                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                                        extraAddr += data.bname;
                                                    }
                                                    // 건물명이 있고, 공동주택일 경우 추가한다.
                                                    if (data.buildingName !== '' && data.apartment === 'Y') {
                                                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                                                    }
                                                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                                    if (extraAddr !== '') {
                                                        extraAddr = ' (' + extraAddr + ')';
                                                    }

                                                }

                                                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                                $('#mb_biz_post').val(data.zonecode); //5자리 새우편번호 사용
                                                $('#mb_biz_addr1').val(addr);
                                                // iframe을 넣은 element를 안보이게 한다.
                                                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                                                element_wrap.style.display = 'none';

                                                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                                                document.body.scrollTop = currentScroll;
                                            },
                                            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
                                            onresize: function(size) {
                                                element_wrap.style.height = size.height + 'px';
                                            },
                                            width: '100%',
                                            height: '100%'
                                        }).embed(element_wrap);

                                        // iframe을 넣은 element를 보이게 한다.
                                        element_wrap.style.display = 'block';
                                    }
                                </script>
                            </td>
                            <th>상세주소</th>
                            <td>
                                <input type="text" name="mb_biz_addr2" value="<?php echo $mb['mb_biz_addr2'] ?>" id="mb_biz_addr2" class="frm_input" style="width:100%;">
                            </td>
                        </tr>
                        <tr>
                            <th>사업자등록번호</th>
                            <td colspan="3">
                                <input type="text" name="mb_biz_num" value="<?php echo $mb['mb_biz_num'] ?>" id="mb_biz_num" class="frm_input" style="width:100%;">
                            </td>
                        </tr>
                        <tr>
                            <th>사업장 정면 또는 내부 사진</th>
                            <td colspan="3">
                                <input type="file" name="mb_photo_site" class="frm_input" style="width:500px;">
                                <?php
                                if ($mb['mb_photo_site']) {
                                    $img_thumb_tag = admin_estimate_img_thumbnail($mb['mb_photo_site'], 100, 100);
                                    $img_tag = admin_estimate_img_thumbnail($mb['mb_photo_site'], 800, 800);
                                ?>
                                    <span class="sit_wimg_limg_photo_site">
                                        <?php echo $img_thumb_tag; ?>
                                    </span>

                                    <div id="limgphotosite" class="banner_or_img" style="display:none;">
                                        <?php echo $img_tag; ?>
                                    </div>
                                    <script>
                                        $('<button type="button" id="it_limgphotosite_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg_photo_site');
                                    </script>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>담당자 사진</th>
                            <td colspan="3">
                                <input type="file" name="mb_photo_bizcard" class="frm_input" style="width:500px;">
                                <?php
                                if ($mb['mb_photo_bizcard']) {
                                    $img_thumb_tag = admin_estimate_img_thumbnail($mb['mb_photo_bizcard'], 100, 100);
                                    $img_tag = admin_estimate_img_thumbnail($mb['mb_photo_bizcard'], 800, 800);
                                ?>
                                    <span class="sit_wimg_limg_photo_bizcard">
                                        <?php echo $img_thumb_tag; ?>
                                    </span>

                                    <div id="limgphotobizcard" class="banner_or_img" style="display:none;">
                                        <?php echo $img_tag; ?>
                                    </div>
                                    <script>
                                        $('<button type="button" id="it_limgphotobizcard_view" class="btn_frmline sit_wimg_view">이미지  확인</button>').appendTo('.sit_wimg_limg_photo_bizcard');
                                    </script>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>담당자 이름</th>
                            <td>
                                <input type="text" name="mb_biz_worker_name" value="<?php echo $mb['mb_biz_worker_name'] ?>" id="mb_biz_worker_name" class="frm_input" size="15" maxlength="20">
                            </td>
                            <th>담당자 휴대전화번호</th>
                            <td>
                                <input type="text" name="mb_biz_worker_phone" value="<?php echo $mb['mb_biz_worker_phone'] ?>" id="mb_biz_worker_phone" class="frm_input" size="30" maxlength="20">
                            </td>
                        </tr>
                        <tr>
                            <th>업체 소개글</th>
                            <td colspan="3">
                                <textarea id="mb_biz_intro" name="mb_biz_intro" class="frm_input" style="width:100%;height:300px;"><?php echo $mb['mb_biz_intro'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <script src="/plugin/editor/smarteditor2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
                            <script type="text/javascript">
                                var g5_editor = "smarteditor2";
                            </script>
                            <th>관리자 소개글</th>
                            <td colspan="3">
                                <!-- 에디터 추가 시작 (gnuwiz) -->
                                <?php echo editor_html('mb_intro_center', get_text($mb['mb_intro_center'], 0)); ?>
                                <!-- 에디터 추가 끝 (gnuwiz) -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section id="cate2">
            <h2 class="h2_frm">맞춤정보</h2>
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
                            <th rowspan="2">수거 / 철거 주 지역</th>
                            <td colspan="3">
                                <select name="area1" id="area1" class="frm_input">
                                    <option value="">시/도</option>
                                    <?php
                                    $sql1 = " select area1 from {$g5['estimate_area1']} order by idx ";

                                    $result1 = sql_query($sql1);

                                    for ($i = 0; $row1 = sql_fetch_array($result1); $i++) {
                                        echo '<option value="' . $row1['area1'] . '">' . $row1['area1'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <select name="area2" id="area2" class="frm_input">
                                    <option value="">시/구/군</option>
                                </select>
                                <button type="button" class="btn_frmline" onclick="doAddArea();">지역추가</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="tbl_head01 tbl_wrap" style="width:40%;">
                                    <table>
                                        <colgroup>
                                            <col style="width: 40%" />
                                            <col style="width: 40%" />
                                            <col style="width: 20%" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>시/도</th>
                                                <th>시/구/군</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="areaList">
                                            <?php
                                            $sql1 = " select * from {$g5['member_area_table']} where mb_id = '{$mb['mb_id']}' order by idx ";
                                            $result1 = sql_query($sql1);

                                            for ($i = 0; $row1 = sql_fetch_array($result1); $i++) {
                                                echo '<tr>';
                                                echo '<input type="hidden" name="mb_area1[]" value="' . $row1['mb_area1'] . '">';
                                                echo '<input type="hidden" name="mb_area2[]" value="' . $row1['mb_area2'] . '">';
                                                echo '<td>' . $row1['mb_area1'] . '</td>';
                                                echo '<td>';
                                                if ($row1['mb_area2']) {
                                                    echo $row1['mb_area2'];
                                                } else {
                                                    echo '전체';
                                                }
                                                echo '</td>';
                                                echo '<td>';
                                                echo '<button type="button" class="btn_frmline remove_area" >삭제</button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <th>매입품목/년식 설정</th>
                            <td colspan="3">
                                <?php
                                echo '<input type="hidden" id="mb_biz_goods_item" name="mb_biz_goods_item" value="' . $mb['mb_biz_goods_item'] . '">';
                                echo '<input type="hidden" id="mb_biz_goods_year" name="mb_biz_goods_year" value="' . $mb['mb_biz_goods_year'] . '">';
                                $goods_items = array(
                                    "가전" => "가전",
                                    "가구" => "가구",
                                    "주방집기" => "주방집기",
                                    "헬스용품" => "헬스용품",
                                    "모두수거" => "모두수거"
                                );

                                if ($mb['mb_biz_goods_item']) {
                                    $goods_items_array = explode(',', $mb['mb_biz_goods_item']);
                                } else {
                                    $goods_items_array = array();
                                }
                                if ($mb['mb_biz_goods_year']) {
                                    $goods_years_array = explode(',', $mb['mb_biz_goods_year']);
                                } else {
                                    $goods_years_array = array();
                                }

                                $seq = 1;
                                while (list($key1, $val1) = each($goods_items)) {
                                    $checked = "";
                                    $years = "";
                                    if (in_array($key1, $goods_items_array)) {
                                        $pos = array_search($key1, $goods_items_array);
                                        $checked = "checked";
                                        $years = $goods_years_array[$pos];
                                    }
                                    echo '<input type="checkbox" name="mb_biz_goods_item_s[]" id="mb_biz_goods_item_s_' . $seq . '" value="' . $key1 . '" ' . $checked . '>';
                                    echo '<label for="mb_biz_goods_item_s_' . $seq . '">' . $val1 . '</label>&nbsp;&nbsp;&nbsp;';
                                    echo '<select id="mb_biz_goods_year_s_' . $seq . '">';
                                    $goods_years = array(
                                        "1" => "1년 미만",
                                        "2" => "2년 미만",
                                        "3" => "3년 미만",
                                        "4" => "4년 미만",
                                        "5" => "5년 미만",
                                        "6" => "6년 미만",
                                        "7" => "7년 미만",
                                        "8" => "8년 미만",
                                        "9" => "9년 미만",
                                        "10" => "10년 미만",
                                        "99" => "상관없음"
                                    );
                                    $seq++;
                                    while (list($key2, $val2) = each($goods_years)) {
                                        $selected = "";
                                        if ($years == $key2) {
                                            $selected = "selected";
                                        }
                                        echo '<option value="' . $key2 . '" ' . $selected . '>' . $val2 . '</option>';
                                    }
                                    echo '</select>&nbsp;&nbsp;&nbsp;';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>철거품목</th>
                            <td colspan="3">
                                <?php
                                echo '<input type="hidden" id="mb_biz_remove_item" name="mb_biz_remove_item" value="' . $mb['mb_biz_remove_item'] . '">';

                                $pull_kinds = array(
                                    "붙박이장" => "붙박이장",
                                    "인테리어" => "인테리어",
                                    "내부철거" => "내부철거",
                                    "간판철거" => "간판철거",
                                    "가벽철거" => "가벽철거",
                                    "타일철거" => "타일철거",
                                    "건물철거" => "건물철거",
                                    "폐기물처리" => "폐기물처리",
                                    "원상복구" => "원상복구",
                                    "모두철거" => "모두철거",
                                    "기타" => "기타"
                                );
                                $seq = 1;
                                while (list($key, $val) = each($pull_kinds)) {
                                    $checked = "";
                                    $pos = strpos(',' . $mb['mb_biz_remove_item'], $key);
                                    if ($pos) {
                                        $checked = "checked";
                                    }
                                    echo '<input type="checkbox" name="mb_biz_remove_item_s[]" id="mb_biz_remove_item_s_' . $seq . '" value="' . $key . '" ' . $checked . '>';
                                    echo '<label for="mb_biz_remove_item_s_' . $seq . '">' . $val . '</label>&nbsp;&nbsp;&nbsp;';
                                    $seq++;
                                }

                                ?>
                                <input type="text" name="mb_biz_remove_etc" id="mb_biz_remove_etc" value="<?php echo $mb['mb_biz_remove_etc'] ?>" class="frm_input" style="width:10%;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    <?php } ?>
    <div class="btn_fixed_top">
        <a href="./pickus_member_list<?php echo $mb_type ?>.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
        <input type="button" value="확인" class="btn_submit btn" onclick="doSave();">
    </div>
</form>
<script type="text/javascript">
    $(function() {
        $(".sit_wimg_view").bind("click", function() {
            var sit_wimg_id = $(this).attr("id").split("_");
            var $img_display = $("#" + sit_wimg_id[1]);

            $img_display.toggle();

            if ($img_display.is(":visible")) {
                $(this).text($(this).text().replace("확인", "닫기"));
            } else {
                $(this).text($(this).text().replace("닫기", "확인"));
            }

            var $img = $("#" + sit_wimg_id[1]).children("img");
            var width = $img.width();
            var height = $img.height();
            if (width > 700) {
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

        $('.remove_area').click(function() {
            var $el = $(this).closest("tr");
            $el.remove();
        });

        $('#area1').change(function() {
            doSelectArea2();
        });

        $('input[name="mb_biz_goods_item_s[]"]').click(function() {
            var vValue = $(this).val();
            var vSValue = $('#mb_biz_goods_year_s_4').val();
            if ($(this).is(':checked')) {
                if (vValue == "모두수거") {
                    $('input[name="mb_biz_goods_item_s[]"]').each(function() {
                        this.checked = true;
                    });
                    for (var i = 1; i < 5; i++) {
                        $("#mb_biz_goods_year_s_" + i).val(vSValue);
                    }
                }
            }
        });

        $('#mb_biz_goods_year_s_5').change(function() {
            var vValue = $(this).val();
            for (var i = 1; i < 5; i++) {
                $("#mb_biz_goods_year_s_" + i).val(vValue);
            }
        });

    });

    function doSelectArea2() {
        $.ajax({
            type: "POST",
            url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
            data: {
                "area1": $('#area1').val()
            },
            cache: false,
            success: function(data) {
                var fvHtml = "";
                if ($("#area1").val()) {
                    fvHtml += "<option value=\"\" selected>" + $("#area1").val() + " 전체</option>";
                } else {
                    fvHtml += "<option value=\"\" selected>시/도</option>";
                }
                fvHtml += data;
                $("#area2").html(fvHtml);

            }
        });
    }

    function doAddArea() {
        if (!$("#area1").val()) {
            alert("시/도를 선택하십시오.");
            return;
        }

        var area1 = $("#area1").val();
        var area2 = $("#area2").val();

        var vHtml = "";
        vHtml += "<tr>";
        vHtml += "<input type='hidden' name='mb_area1[]' value='" + area1 + "'>";
        vHtml += "<input type='hidden' name='mb_area2[]' value='" + area2 + "'>";
        vHtml += "<td>" + area1 + "</td>";
        if (area2) {
            vHtml += "<td>" + area2 + "</td>";
        } else {
            vHtml += "<td>전체</td>";
        }
        vHtml += "<td><button type='button' class='btn_frmline remove_area' >삭제</button></td>";
        vHtml += "</tr>";
        $("#areaList").append(vHtml);
        $('.remove_area').click(function() {
            var $el = $(this).closest("tr");
            $el.remove();
        });
    }

    function doSave() {
        var f = document.fmember;
        if (!f.mb_name.value) {
            f.mb_name.value = f.mb_biz_name.value;
        }
        if (f.mb_password_new.value) {
            f.mb_password.value = hex_md5(f.mb_password_new.value);
            f.mb_password_type.value = "md5";
        }

        // 에디터 추가 시작 (gnuwiz)
        <?php if ($mb_level == "1" || $mb_level == "2" || $mb_level == "4") {
            echo get_editor_js('mb_intro_center');
        }
        ?>
        // 에디터 추가 끝 (gnuwiz)

        var goodsItem = "";
        var goodsYear = "";
        $('input[name="mb_biz_goods_item_s[]"]:checked').each(function(index, item) {
            if (index != 0) {
                goodsItem += ",";
                goodsYear += ",";
            }
            goodsItem += $(this).val();

            var vId = $(this).attr('id');
            var vIdx = vId.replace("mb_biz_goods_item_s_", "");

            if ($("#mb_biz_goods_year_s_" + vIdx).val()) {
                goodsYear += $("#mb_biz_goods_year_s_" + vIdx).val();
            } else {
                goodsYear += "0";
            }
        });

        var removeItem = "";
        $('input[name="mb_biz_remove_item_s[]"]:checked').each(function(index, item) {
            if (index != 0) {
                removeItem += ",";
            }
            removeItem += $(this).val();
        });

        $("#mb_biz_goods_item").val(goodsItem);
        $("#mb_biz_goods_year").val(goodsYear);
        $("#mb_biz_remove_item").val(removeItem);

        f.submit();
    }
</script>
<?php
include_once('./admin.tail.php');
?>