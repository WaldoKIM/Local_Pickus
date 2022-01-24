<?php
include_once('./_common.php');
include_once(G5_PATH . '/head.php');

if ($member['mb_level'] != '2') {
	alert('일반회원은 이용하실 수 없습니다.');
}
?>
<link rel="stylesheet" href="./css/mypage_btn.css">
<section>
    <div class="mypage_btn_header">
        <div class="back_btn"><img src="./images/back.png" alt=""></div>
        <div class="title">마이페이지</div>
    </div>
    <div class="mypage_btn_list">
        <a href="https://repickus.com/market/seller/product/product_add.php"><img src="./images/mypage_add_btn.png" alt=""><p>상품 등록</p></a>
        <!-- <a href="https://repickus.com/market/seller/other/review.php"><img src="./images/mypage_review_btn.png" alt=""><p>구매 후기 관리</p></a> -->
        <a href="https://repickus.com/market/seller/other/qna.php"><img src="./images/mypage_qna_btn.png" alt=""><p>문의 관리</p></a>
        <a href="https://repickus.com/market/seller/order/trade.php"><img src="./images/mypage_order_btn.png" alt=""><p>주문 관리</p></a>
        <a href="https://repickus.com/market/seller/product/product_list.php"><img src="./images/mypage_product_btn.png" alt=""><p>상품 관리</p></a>
        <a href="https://repickus.com/market/seller/wallet/wallet.php"><img src="./images/mypage_wallet_btn.png" alt=""><p>수익금 관리</p></a>
        <a href="https://repickus.com/market/seller/wallet/wallet_settle.php"><img src="./images/mypage_settle_btn.png" alt=""><p>출금 신청 내역</p></a>
        <a href="https://repickus.com/bbs/mypage_partner.php"><img src="./images/mypage_info_btn.png" alt=""><p>회원 정보 수정</p></a>
    </div>
</section>

<?php
include_once(G5_PATH . '/tail.php');
?>

<script>
    $('.back_btn').click(function(){
		window.history.back();
	});
</script>
