<?php
include_once('./_common.php');

if($title == "" || $content == "" || $phone == "" || $area1 == "" || $area2 == ""){
    echo "<script>alert('잘못된 접근방식입니다.');location.replace('/')</script>";
}else{
    $sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
    $mm = sql_fetch($sql);

    if($mm){
            if($mm['mb_level'] != "0" && $mm['mb_level'] != "8")
            {
                    alert("소비자 회원은 견적신청하실 수 없습니다.",G5_URL);
            }
    }

    $datetime = G5_TIME_YMD;
    $cur_year = date("Y", strtotime($datetime));
    $cur_month = date("m", strtotime($datetime));
    $cur_day = date("d", strtotime($datetime));

    $img_dir_year = G5_DATA_PATH.'/estimate/'.$cur_year;
    @mkdir($img_dir_year, G5_DIR_PERMISSION);
    @chmod($img_dir_year, G5_DIR_PERMISSION);

    $img_dir_month = $img_dir_year.'/'.$cur_month;
    @mkdir($img_dir_month, G5_DIR_PERMISSION);
    @chmod($img_dir_month, G5_DIR_PERMISSION);

    $img_dir = $img_dir_month.'/'.$cur_day;
    @mkdir($img_dir, G5_DIR_PERMISSION);
    @chmod($img_dir, G5_DIR_PERMISSION);

    $attach_file = "";
    if ($_FILES['attfile']['name']) {
            $attach_file = estimate_file_upload($_FILES['attfile']['tmp_name'], $_FILES['attfile']['name'], $img_dir);
    }

    $sql = " insert into {$g5['estimate_list']} set
                            sub_key = '$sub_key',
                            email = '$email',
                            nickname = '$nickname',
                            title = '$title',
                            content = '$content',
                            phone = '$phone',
                            floor = '$floor',
                            elevator_yn = '$elevator_yn',
                            pickup_date = '$pickup_date',
                            area_total = '$area_total',
                            area1 = '$area1',
                            area2 = '$area2',
                            area3 = '$area3',
                            attach_file = '$attach_file',		
                            state = '1',
                            e_type = '$e_type',
                            simple_yn = '$simple_yn',
                            test_type = '$test_type',
                            type = '$type',
                            writetime = now(),
                            deadline = date_add(now(), interval 3 day),
                            el_ip = '".$_SERVER['REMOTE_ADDR']."'";

    sql_query($sql);

    $option_count = (isset($_POST['item_cat']) && is_array($_POST['item_cat'])) ? count($_POST['item_cat']) : array();
    if($option_count) {
            for($i=0; $i<$option_count; $i++) {
                    $item_cat     = $_POST['item_cat'][$i];
                    $item_cat_dtl = $_POST['item_cat_dtl'][$i];
                    $manufacturer = $_POST['manufacturer'][$i];
                    $medel_name   = $_POST['medel_name'][$i];
                    $year         = $_POST['year'][$i];
                    $use_year     = $_POST['use_year'][$i];
                    $item_qty     = $_POST['item_qty'][$i];
                    $sql = " insert into {$g5['estimate_list_multi']} set
                                            sub_key = '$sub_key',
                                            item_cat = '$item_cat',
                                            item_cat_dtl = '$item_cat_dtl',
                                            manufacturer = '$manufacturer',
                                            medel_name = '$medel_name',
                                            year = '$year',
                                            use_year = '$use_year',
                                            item_qty = '$item_qty' ";

                    sql_query($sql);
            }

    }

    $sql = " select max(idx) as idx from {$g5['estimate_list']} where email = '$email' ";
    $estimate = sql_fetch($sql);
    $idx = $estimate['idx'];

    $photo_count = count($_FILES['photo']['name']);
    for ($i=0; $i<$photo_count; $i++) {
            if ($_FILES['photo']['name'][$i]) {
                    $photo = estimate_img_upload($_FILES['photo']['tmp_name'][$i], $_FILES['photo']['name'][$i], $img_dir);
                $sql = " insert into {$g5['estimate_list_photo']} set 
                                            estimate_idx = '$idx',
                                photo = '$photo',
                                photo_rotate = '',
                                writetime = now() ";	
                sql_query($sql);

            }
    }

    $url = "./my_estimate_form.php?idx=".$estimate['idx'];
    if (!$is_member) {
            $sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
            $mm = sql_fetch($sql);
            if(!$mm){
                $sql = " insert into {$g5['member_table']} set 
                                            mb_id = '$email',
                                mb_password_type = 'md5',
                                mb_name = '$nickname',
                                mb_email = '$email',
                                mb_level = '8',
                                mb_hp = '$phone',
                                mb_datetime = now(),
                                mb_email_certify = now(),
                                mb_open = '1' ";	
                sql_query($sql);	

            set_session('ss_mb_id', $email);

            set_session('ss_mb_reg', $email);

            }else{
                    if($mm['mb_level'] == "8"){
                    set_session('ss_mb_id', $email);

                    set_session('ss_mb_reg', $email);
                    }else{
                            $url = G5_URL;
                    }
            }
    }

    kakaotalk_send($phone, 'SJT_041562',  get_etype($e_type));

    alert("견적이 신청되었습니다.",$url);
}
?> 
