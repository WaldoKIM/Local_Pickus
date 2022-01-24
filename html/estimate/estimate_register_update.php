<?php
include_once('./_common.php');
if($title == "" || $content == "" || $member['mb_hp'] == "" || $area1 == "" || $area2 == ""){
    alert("잘못된 접근방식입니다.",G5_URL);
}else{
    if (!$is_member)
            alert("로그인 후 사용이 가능합니다.");

    $sql = " insert into {$g5['estimate_list']} set
                            sub_key = '$sub_key',
                            email = '{$member['mb_email']}',
                            nickname = '{$member['mb_name']}',
                            title = '$title',
                            content = '$content',
                            phone = '{$member['mb_hp']}',
                            item_cat = '$item_cat',
                            item_cat_dtl = '$item_cat_dtl',
                            manufacturer = '$manufacturer',
                            floor = '$floor',
                            elevator_yn = '$elevator_yn',
                            pickup_date = '$pickup_date',
                            medel_name = '$medel_name',
                            year = '$year',
                            use_year = '$use_year',
                            goods_state = '$goods_state',
                            item_qty = '$item_qty',
                            area_total = '$area_total',
                            area1 = '$area1',
                            area2 = '$area2',
                            area3 = '$area3',
                            photo1 = '$photo1', 
                            photo2 = '$photo2',
                            photo3 = '$photo3',
                            photo4 = '$photo4',
                            photo5 = '$photo5',
                            photo6 = '$photo6',
                            photo7 = '$photo7',
                            photo8 = '$photo8',
                            photo9 = '$photo9',
                            photo1_rotate = '$photo1_rotate', 
                            photo2_rotate = '$photo2_rotate',
                            photo3_rotate = '$photo3_rotate',
                            photo4_rotate = '$photo4_rotate',
                            photo5_rotate = '$photo5_rotate',
                            photo6_rotate = '$photo6_rotate',
                            photo7_rotate = '$photo7_rotate',
                            photo8_rotate = '$photo8_rotate',
                            photo9_rotate = '$photo9_rotate',			
                            state = '1',
                            e_type = '$e_type',
                            simple_yn = '$simple_yn',
                            writetime = now(),
                            deadline = date_add(now(), interval 3 day) ";

    sql_query($sql);

    alert("견적이 신청되었습니다.","./my_estimate_list.php");
}
?> 
