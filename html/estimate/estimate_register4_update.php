<?php
include_once('./_common.php');

if ($nickname == "" || $email == "" || $phone == "" || $content == "") {
        alert("잘못된 접근방식입니다.", G5_URL);
} else {

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
                            pull_kind = '$pull_kind',
                            pull_floor_bottom = '$pull_floor_bottom',
                            state = '1',
                            e_type = '$e_type',
                            simple_yn = '$simple_yn',
                            test_type = '$test_type',
                            writetime = now(),
                            deadline = date_add(now(), interval 3 day),
                            el_ip = '" . $_SERVER['REMOTE_ADDR'] . "'";

        sql_query($sql);

        $option_count = (isset($_POST['pull_kind']) && is_array($_POST['pull_kind'])) ? count($_POST['pull_kind']) : array();
        if ($option_count) {
                for ($i = 0; $i < $option_count; $i++) {
                        $pull_kind         = $_POST['pull_kind'][$i];
                        $pull_floor_bottom = $_POST['pull_floor_bottom'][$i];
                        $pull_space        = $_POST['pull_space'][$i];
                        $pull_size         = $_POST['pull_size'][$i];
                        $sql = " insert into {$g5['estimate_list_multi']} set
                                            sub_key = '$sub_key',
                                            pull_kind = '$pull_kind',
                                            pull_floor_bottom = '$pull_floor_bottom',
                                            pull_space = '$pull_space',
                                            pull_size = '$pull_size' ";

                        sql_query($sql);
                }
        }
        $sql = " select max(idx) as idx from {$g5['estimate_list']} where email = '$email' ";
        $estimate = sql_fetch($sql);

        if (!$is_member) {
                $sql = " select * from {$g5['member_table']} where mb_email = '$email' ";
                $mm = sql_fetch($sql);
                if (!$mm) {
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
                }
        }
        insert_notify($email, '11', $title . ' 견적신청이 되었습니다.', '', $idx, '', 'cp1');

        kakaotalk_send($phone, 'SJT_058638',  $nickname . '|' . $email . '|' . get_etype($e_type));


        /*kakaotalk_send($phone, 'SJT_041562',  get_etype($e_type));*/
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
        alert("견적이 신청되었습니다.", "./my_estimate_list.php");
}
