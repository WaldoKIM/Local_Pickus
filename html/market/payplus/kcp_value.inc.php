<?
$req_tx           = $_POST[ "req_tx"         ];      // 요청 구분(승인/취소)
$use_pay_method   = $_POST[ "use_pay_method" ];      // 사용 결제 수단
$bSucc            = $_POST[ "bSucc"          ];      // 업체 DB 정상처리 완료 여부
/* = -------------------------------------------------------------------------- = */
$res_cd           = $_POST[ "res_cd"         ];      // 결과 코드
$res_msg          = $_POST[ "res_msg"        ];      // 결과 메시지
/* = -------------------------------------------------------------------------- = */
$ordr_idxx        = $_POST[ "ordr_idxx"      ];      // 주문번호
$tno              = $_POST[ "tno"            ];      // KCP 거래번호
$good_mny         = $_POST[ "good_mny"       ];      // 결제 금액
$good_name        = $_POST[ "good_name"      ];      // 상품명
$buyr_name        = $_POST[ "buyr_name"      ];      // 구매자명
$buyr_tel1        = $_POST[ "buyr_tel1"      ];      // 구매자 전화번호
$buyr_tel2        = $_POST[ "buyr_tel2"      ];      // 구매자 휴대폰번호
$buyr_mail        = $_POST[ "buyr_mail"      ];      // 구매자 E-Mail
/* = -------------------------------------------------------------------------- = */
// 신용카드
$card_cd          = $_POST[ "card_cd"        ];      // 카드 코드
$card_name        = $_POST[ "card_name"      ];      // 카드명
$app_time         = $_POST[ "app_time"       ];      // 승인시간 (공통)
$app_no           = $_POST[ "app_no"         ];      // 승인번호
$quota            = $_POST[ "quota"          ];      // 할부개월
/* = -------------------------------------------------------------------------- = */
// 계좌이체
$bank_name        = $_POST[ "bank_name"      ];      // 은행명
/* = -------------------------------------------------------------------------- = */
// 가상계좌
$bankname         = $_POST[ "bankname"       ];      // 입금 은행
$depositor        = $_POST[ "depositor"      ];      // 입금계좌 예금주
$account          = $_POST[ "account"        ];      // 입금계좌 번호
/* = -------------------------------------------------------------------------- = */
// 포인트
$epnt_issu        = $_POST[ "epnt_issu"      ];      // 포인트 서비스사
$add_pnt          = $_POST[ "add_pnt"        ];      // 발생 포인트
$use_pnt          = $_POST[ "use_pnt"        ];      // 사용가능 포인트
$rsv_pnt          = $_POST[ "rsv_pnt"        ];      // 적립 포인트
$pnt_app_time     = $_POST[ "pnt_app_time"   ];      // 승인시간
$pnt_app_no       = $_POST[ "pnt_app_no"     ];      // 승인번호
$pnt_amount       = $_POST[ "pnt_amount"     ];      // 적립금액 or 사용금액
/* = -------------------------------------------------------------------------- = */
// 현금영수증
$cash_yn          = $_POST[ "cash_yn"        ];      //현금영수증 등록 여부
$cash_authno      = $_POST[ "cash_authno"    ];      //현금 영수증 승인 번호
$cash_tr_code     = $_POST[ "cash_tr_code"   ];      //현금 영수증 발행 구분
$cash_id_info     = $_POST[ "cash_id_info"   ];      //현금 영수증 등록 번호


$req_tx_name = "";

if( $req_tx == "pay" )
{
	$req_tx_name = "지불";
}
else if( $req_tx == "mod" )
{
	$req_tx_name = "취소/매입";
}
?>
