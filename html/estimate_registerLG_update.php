<?php
include_once('./_common.php');
//include_once('../bbs/do_fcm.php');

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
    /*
    if (!@mkdir($img_dir)) {
           $error = error_get_last();
           echo $error['message'];
    }*/

    $sql = " insert into {$g5['estimate_list']} set
                            sub_key = '$sub_key',
                            email = '$email',
                            nickname = '$nickname',
                            title = '$title',
                            content = '$content',
                            phone = '$phone',
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
                            attach_file = '$attach_file',		
                            state = '1',
                            e_type = '$e_type',
                            simple_yn = '$simple_yn',
                            test_type = '$test_type',
                            type = '$type',
                            writetime = now(),
                            deadline = '$pickup_date_magam',
                            el_ip = '".$_SERVER['REMOTE_ADDR']."'";

    sql_query($sql);


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
    $rc_email_count = (isset($_POST['rc_email_chk']) && is_array($_POST['rc_email_chk'])) ? count($_POST['rc_email_chk']) : array();
    if($rc_email_count) {
            for($i=0; $i<$rc_email_count; $i++) {
                    $rc_email_chk     = $_POST['rc_email_chk'][$i];
                    $rc_email         = $_POST['rc_email'][$i];
                    if($rc_email_chk == "Y"){
                            $sql = " insert {$g5['estimate_request']} set
                                                    estimate_idx = '$idx', 
                                                    rc_email = '$rc_email' ";


                            sql_query($sql);
                            insert_notify($rc_email, '22', $title.' 문의가 들어왔습니다.','',$idx, '','p2');
                    }
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

    insert_notify($email, '11', $title.' 견적신청이 되었습니다.','',$idx, '','cp1');

    /*kakaotalk_send($phone, 'SJT_041562',  get_etype($e_type));*/

	


    kakaotalk_send($phone, 'SJT_058638',  $nickname .'|'. $email .'|'. get_etype($e_type));

    echo "
            <!-- NAVER SCRIPT -->
            <script type='text/javascript' src='//wcs.naver.net/wcslog.js'></script> 
            <script type='text/javascript'> 
            if (!wcs_add) var wcs_add={};
            wcs_add['wa'] = 's_4e5aa7de4638';
            if (!_nasa) var _nasa={};
            _nasa['cnv'] = wcs.cnv('4','1'); //전환유형, 전환가치
            wcs_do(_nasa);
            </script>
            <!-- NAVER SCRIPT END -->
            ";
/*
	$msg = $title.' 견적신청이 되었습니다.';

	$sql = " select * from {$g5['member_token_table']} where mb_email = '{$member['mb_id']}' order by idx desc";
	$row = sql_fetch($sql);
	//토큰
	$token = $row['token'];
	app_push($token,$msg);
*/
    alert("견적이 신청되었습니다.",$url);

}
?> 

