<? include('../common.php');
?>
<?
/* ============================================================================== */
/* =   02. 지불 요청 정보 설정                                                  = */
/* = -------------------------------------------------------------------------- = */
$site_cd        = $_POST["site_cd"]; // 사이트 코드
$site_key       = $_POST["site_key"]; // 사이트 키
$req_tx         = $_POST["req_tx"]; // 요청 종류
$cust_ip        = getenv("REMOTE_ADDR"); // 요청 IP
$ordr_idxx      = $_POST["ordr_idxx"]; // 쇼핑몰 주문번호
$good_name      = $_POST["good_name"]; // 상품명
/* = -------------------------------------------------------------------------- = */
$good_mny       = $_POST["good_mny"]; // 결제 총금액
$tran_cd        = $_POST["tran_cd"]; // 처리 종류
/* = -------------------------------------------------------------------------- = */
$res_cd         = "";                         // 응답코드
$res_msg        = "";                         // 응답메시지
$tno            = $_POST["tno"]; // KCP 거래 고유 번호
/* = -------------------------------------------------------------------------- = */
$buyr_name      = $_POST["buyr_name"]; // 주문자명
$buyr_tel1      = $_POST["buyr_tel1"]; // 주문자 전화번호
$buyr_tel2      = $_POST["buyr_tel2"]; // 주문자 핸드폰 번호
$buyr_mail      = $_POST["buyr_mail"]; // 주문자 E-mail 주소
/* = -------------------------------------------------------------------------- = */
$bank_name      = "";                         // 은행명
$bank_code      = "";                         // 은행코드
$bank_issu      = $_POST["bank_issu"]; // 계좌이체 서비스사
/* = -------------------------------------------------------------------------- = */
$mod_type       = $_POST["mod_type"]; // 변경TYPE VALUE 승인취소시 필요
$mod_desc       = $_POST["mod_desc"]; // 변경사유
/* = -------------------------------------------------------------------------- = */
$use_pay_method = $_POST["use_pay_method"]; // 결제 방법
$epnt_issu      = $_POST["epnt_issu"]; //포인트(OK캐쉬백,복지포인트)
$bSucc          = "";                         // 업체 DB 처리 성공 여부
/* = -------------------------------------------------------------------------- = */
$card_cd        = "";                         // 신용카드 코드
$card_name      = "";                         // 신용카드 명
$app_time       = "";                         // 승인시간 (모든 결제 수단 공통)
$app_no         = "";                         // 신용카드 승인번호
$noinf          = "";                         // 신용카드 무이자 여부
$quota          = "";                         // 신용카드 할부개월
$bankname       = "";                         // 은행명
$depositor      = "";                         // 입금 계좌 예금주 성명
$account        = "";                         // 입금 계좌 번호
/* = -------------------------------------------------------------------------- = */
$amount         = "";                         // KCP 실제 거래 금액
/* = -------------------------------------------------------------------------- = */
$add_pnt        = "";                         // 발생 포인트
$use_pnt        = "";                         // 사용가능 포인트
$rsv_pnt        = "";                         // 적립 포인트
$pnt_app_time   = "";                         // 승인시간
$pnt_app_no     = "";                         // 승인번호
$pnt_amount     = "";                         // 적립금액 or 사용금액
/* = -------------------------------------------------------------------------- = */
$cash_yn        = $_POST["cash_yn"]; // 현금영수증 등록 여부
$cash_authno    = "";                         // 현금 영수증 승인 번호
$cash_tr_code   = $_POST["cash_tr_code"]; // 현금 영수증 발행 구분
$cash_id_info   = $_POST["cash_id_info"]; // 현금 영수증 등록 번호

/* = -------------------------------------------------------------------------- = */
/* =   05-10. 승인 결과를 업체 자체적으로 DB 처리 작업하시는 부분입니다.         = */
/* = -------------------------------------------------------------------------- = */
/* =         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해      = */
/* =         DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로       = */
/* =         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.                = */
/* =         DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"     = */
/* =         로 세팅해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의 = */
/* =         값을 세팅하시면 됩니다.)                                           = */
/* =         amount(KCP실제 거래금액)과 업체가 DB 처리하실 금액이 다를 경우의   = */
/* =         비교 루틴을 추가 하셔서 다를 경우 마찬가지로 "false"로 셋팅하여    = */
/* =         주시길 바랍니다.                                                   = */
/* = -------------------------------------------------------------------------- = */
$bSucc = ""; // DB 작업 실패 또는 금액 불일치의 경우 "false" 로 세팅
/* = -------------------------------------------------------------------------- = */
/* =   05-11. DB 작업 실패일 경우 자동 승인 취소                                 = */
/* = -------------------------------------------------------------------------- = */

if ($ordr_idxx) {
    $_POST[TRADE_CODE] = $ordr_idxx;
    if (!$_POST[TRADE_CODE]) {
        $tools->alertJavaGo('결제 오류 입니다.\n\n처음부터 다시 주문하세요\\n오류코드 : ' . $res_cd, 'cart.php');
    }
    // 구매 상품 입력
    $cnt1 = $db->cnt("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
    if ($cnt1) {
        $trade1_result = $db->select("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
        while ($trade1_row = @mysqli_fetch_object($trade1_result)) {
            $trade1_data    = $tools->decode($trade1_row->data);
            $trade1_data[goods_name] = $db->addSlash(urldecode($trade1_data[goods_name]));
            //$db->insert("cs_trade_goods", "trade_code='$trade1_data[trade_code]', part_idx='$trade1_data[part_idx]', goods_idx='$trade1_data[goods_idx]', goods_code='$trade1_data[goods_code]', goods_name='$trade1_data[goods_name]', goods_price='$trade1_data[goods_price]', goods_cnt='$trade1_data[goods_cnt]', goods_point='$trade1_data[goods_point]', opt_data='$trade1_data[opt_data]', trade_day=now()");
            $db->insert("cs_trade_goods", "trade_code='$trade1_data[trade_code]', part_idx='$trade1_data[part_idx]', goods_idx='$trade1_data[goods_idx]', goods_code='$trade1_data[goods_code]', goods_name='$trade1_data[goods_name]', goods_price='$trade1_data[goods_price]', trade_price='$trade1_data[trade_price]',  goods_cnt='$trade1_data[goods_cnt]', goods_point='$trade1_data[goods_point]', opt_data='$trade1_data[opt_data]', seller='$trade1_data[seller]', order_userid='$trade1_data[order_userid]', order_name='$trade1_data[order_name]', trade_deliv_price='$trade1_data[deliv_fee]', trade_day=now()");

            // 주문한 상품에서 수량을 삭제
            $goods_stat = $db->object("cs_goods", "where idx='$trade1_data[goods_idx]'");
            if ($goods_stat->unlimit != 1) {
                $number = $goods_stat->number - $trade1_data[goods_cnt];
                $db->update("cs_goods", "number=$number where idx='$trade1_data[goods_idx]'");
            }
            //상품의 재구매처리가안되게 결과물 아이템변경
            $db->update("cs_trade_tmp", "item=5 where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
        }
    }
    $cnt2 = $db->cnt("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
    if ($cnt2) {
        $trade2_data_stat = $db->object("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
        $trade2_data    = $tools->decode($trade2_data_stat->data);
        $db->insert("cs_trade", "trade_code='$trade2_data[trade_code]', order_userid='$trade2_data[order_userid]', order_name='$trade2_data[order_name]', order_email='$trade2_data[order_email]', order_tel1='$trade2_data[order_tel1]', order_tel2='$trade2_data[order_tel2]', order_tel3='$trade2_data[order_tel3]', deliv_name='$trade2_data[deliv_name]', deliv_email='$trade2_data[deliv_email]', deliv_tel1='$trade2_data[deliv_tel1]', deliv_tel2='$trade2_data[deliv_tel2]', deliv_tel3='$trade2_data[deliv_tel3]', deliv_phone1='$trade2_data[deliv_phone1]', deliv_phone2='$trade2_data[deliv_phone2]', deliv_phone3='$trade2_data[deliv_phone3]',  deliv_zip='$trade2_data[deliv_zip]', deliv_add1='$trade2_data[deliv_add1]', deliv_add2='$trade2_data[deliv_add2]', deliv_content='$trade2_data[deliv_content]', deliv_pree_day='$trade2_data[deliv_pree_day]',tno = '$tno'");
        //상품의 재구매처리가안되게 결과물 아이템변경
        $db->update("cs_trade_tmp", "item=6 where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
    }
    // 결제 정보 입력
    $cnt3 = $db->cnt("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
    if ($cnt3) {
        $trade3_data_stat = $db->object("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
        $trade3_data    = $tools->decode($trade3_data_stat->data);
        if ($trade3_data[trade_method] == 4) {
            $trade_method_info = $depositor . ":" . $bankname . " [" . $account . "]";
        } else {
            $trade_method_info = $trade3_data[trade_method_info];
        }
        $db->update("cs_trade", "trade_code='$trade3_data[trade_code]', trade_total_price='$trade3_data[trade_total_price]', trade_price='$trade3_data[trade_price]', trade_use_point='$trade3_data[trade_use_point]', trade_save_point='$trade3_data[trade_save_point]', trade_member_dc='$trade3_data[trade_member_dc]', trade_deliv_price='$trade3_data[trade_deliv_price]', trade_method='$trade3_data[trade_method]', trade_method_info='$trade_method_info', trade_day=now(), trade_stat=1 where trade_code='$trade2_data[trade_code]'");
        // 사용한 포인트를 삭제 사용포인트가 있을때만 이용
        if ($trade3_data[trade_use_point] != 0 && $trade2_data[order_userid]) {
            $title = "상품구입사용 거래번호 : " . $_POST[TRADE_CODE];
            $db->insert("cs_point", "userid='$trade2_data[order_userid]', title='$title', point='-$trade3_data[trade_use_point]', register=now()");
        }
        //상품의 재구매처리가안되게 결과물 아이템변경
        $db->update("cs_trade_tmp", "item=7 where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
    }
}

// End of [res_cd = "0000"]
?>
<html>

<head>
    <script>
        function goResult() {
            var openwin = window.open('proc_win.html', 'proc_win', '');
            document.pay_info.submit();
            openwin.close();
        }
    </script>
</head>

<body onload="goResult()">
    <form name="pay_info" method="post" action="./order_trade_end_ok.php">
        <input type="hidden" name="req_tx" value="<?= $req_tx ?>"> <!-- 요청 구분 -->
        <input type="hidden" name="use_pay_method" value="<?= $use_pay_method ?>"> <!-- 사용한 결제 수단 -->
        <input type="hidden" name="bSucc" value="<?= $bSucc ?>"> <!-- 쇼핑몰 DB 처리 성공 여부 -->
        <input type="hidden" name="res_cd" value="<?= $res_cd ?>"> <!-- 결과 코드 -->
        <input type="hidden" name="res_msg" value="<?= $res_msg ?>"> <!-- 결과 메세지 -->
        <input type="hidden" name="ordr_idxx" value="<?= $ordr_idxx ?>"> <!-- 주문번호 -->
        <input type="hidden" name="tno" value="<?= $tno ?>"> <!-- KCP 거래번호 -->
        <input type="hidden" name="good_mny" value="<?= $good_mny ?>"> <!-- 결제금액 -->
        <input type="hidden" name="good_name" value="<?= $good_name ?>"> <!-- 상품명 -->
        <input type="hidden" name="buyr_name" value="<?= $buyr_name ?>"> <!-- 주문자명 -->
        <input type="hidden" name="buyr_tel1" value="<?= $buyr_tel1 ?>"> <!-- 주문자 전화번호 -->
        <input type="hidden" name="buyr_tel2" value="<?= $buyr_tel2 ?>"> <!-- 주문자 휴대폰번호 -->
        <input type="hidden" name="buyr_mail" value="<?= $buyr_mail ?>"> <!-- 주문자 E-mail -->
        <input type="hidden" name="card_cd" value="<?= $card_cd ?>"> <!-- 카드코드 -->
        <input type="hidden" name="card_name" value="<?= $card_name ?>"> <!-- 카드명 -->
        <input type="hidden" name="app_time" value="<?= $app_time ?>"> <!-- 승인시간 -->
        <input type="hidden" name="app_no" value="<?= $app_no ?>"> <!-- 승인번호 -->
        <input type="hidden" name="quota" value="<?= $quota ?>"> <!-- 할부개월 -->
        <input type="hidden" name="bank_name" value="<?= $bank_name ?>"> <!-- 은행명 -->
        <input type="hidden" name="bank_code" value="<?= $bank_code ?>"> <!-- 은행코드 -->
        <input type="hidden" name="bankname" value="<?= $bankname ?>"> <!-- 입금 은행 -->
        <input type="hidden" name="depositor" value="<?= $depositor ?>"> <!-- 입금계좌 예금주 -->
        <input type="hidden" name="account" value="<?= $account ?>"> <!-- 입금계좌 번호 -->
        <input type="hidden" name="epnt_issu" value="<?= $epnt_issu ?>"> <!-- 포인트 서비스사 -->
        <input type="hidden" name="pnt_app_time" value="<?= $pnt_app_time ?>"> <!-- 승인시간 -->
        <input type="hidden" name="pnt_app_no" value="<?= $pnt_app_no ?>"> <!-- 승인번호 -->
        <input type="hidden" name="pnt_amount" value="<?= $pnt_amount ?>"> <!-- 적립금액 or 사용금액 -->
        <input type="hidden" name="add_pnt" value="<?= $add_pnt ?>"> <!-- 발생 포인트 -->
        <input type="hidden" name="use_pnt" value="<?= $use_pnt ?>"> <!-- 사용가능 포인트 -->
        <input type="hidden" name="rsv_pnt" value="<?= $rsv_pnt ?>"> <!-- 적립 포인트 -->
        <input type="hidden" name="cash_yn" value="<?= $cash_yn ?>"> <!-- 현금영수증 등록 여부 -->
        <input type="hidden" name="cash_authno" value="<?= $cash_authno ?>"> <!-- 현금 영수증 승인 번호 -->
        <input type="hidden" name="cash_tr_code" value="<?= $cash_tr_code ?>"> <!-- 현금 영수증 발행 구분 -->
        <input type="hidden" name="cash_id_info" value="<?= $cash_id_info ?>"> <!-- 현금 영수증 등록 번호 -->
    </form>
</body>

</html>