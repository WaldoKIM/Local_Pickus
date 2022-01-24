<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;

$menu['menu400'] = array(
    array('400000', '견적관리', G5_ADMIN_URL . '/pickus_estimate_list.php', 'estimate_config'),

    array('400210', '견적진행현황', G5_ADMIN_URL . '/pickus_estimate_list.php', 'scf_estimate_list'),
    array('400220', '견적 방문진행 현황', G5_ADMIN_URL . '/pickus_estimate_meet_list.php', 'scf_estimate_meet_list'),
    array('400230', '중고구매 견적진행 현황', G5_ADMIN_URL . '/pickus_estimate_list_match.php', 'scf_estimate_list_match'),
    array('400231', '선택 견적/수거(철거)완료', G5_ADMIN_URL . '/pickus_pick_estimate_list.php', 'scf_pick_estimate_list'),
    array('400233', '중고 선택견적/배송완료', G5_ADMIN_URL . '/pickus_mpick_estimate_list.php', 'scf_mpick_estimate_list'),
    array('400235', '수거 취소', G5_ADMIN_URL . '/pickus_estimate_list_cancel.php', 'scf_estimate_list_cancel'),
    array('400240', '배송 취소', G5_ADMIN_URL . '/pickus_estimate_list_match_cancel.php', 'scf_estimate_list_match_cancel'),
    array('400250', '쇼핑몰관리', G5_ADMIN_URL . '/shop_admin/', 'shop_config'),
    array('400260', '쇼핑몰설정', G5_ADMIN_URL . '/shop_admin/configform.php', 'scf_config'),
    array('400270', '개인결제관리', G5_ADMIN_URL . '/shop_admin/personalpaylist.php', 'scf_personalpay', 1),
    array('400280', '분류관리', G5_ADMIN_URL . '/shop_admin/categorylist.php', 'scf_cate'),
    array('400290', '상품관리', G5_ADMIN_URL . '/shop_admin/itemlist.php', 'scf_item'),
    array('400400', '주문내역', G5_ADMIN_URL . '/shop_admin/orderlist.php', 'scf_order', 1),
    array('400500', '업체문의넣기', G5_ADMIN_URL . '/pickus_estimate_push.php', 'scf_estimate_push'),
    /*
    array('400000', '쇼핑몰관리', G5_ADMIN_URL.'/shop_admin/', 'shop_config'),
    array('400100', '쇼핑몰설정', G5_ADMIN_URL.'/shop_admin/configform.php', 'scf_config'),
    
   
    array('400660', '상품문의', G5_ADMIN_URL.'/shop_admin/itemqalist.php', 'scf_item_qna'),
    array('400650', '사용후기', G5_ADMIN_URL.'/shop_admin/itemuselist.php', 'scf_ps'),
    array('400620', '상품재고관리', G5_ADMIN_URL.'/shop_admin/itemstocklist.php', 'scf_item_stock'),
    array('400610', '상품유형관리', G5_ADMIN_URL.'/shop_admin/itemtypelist.php', 'scf_item_type'),
    array('400500', '상품옵션재고관리', G5_ADMIN_URL.'/shop_admin/optionstocklist.php', 'scf_item_option'),
    array('400800', '쿠폰관리', G5_ADMIN_URL.'/shop_admin/couponlist.php', 'scf_coupon'),
    array('400810', '쿠폰존관리', G5_ADMIN_URL.'/shop_admin/couponzonelist.php', 'scf_coupon_zone'),
    array('400750', '추가배송비관리', G5_ADMIN_URL.'/shop_admin/sendcostlist.php', 'scf_sendcost', 1),
    array('400410', '미완료주문', G5_ADMIN_URL.'/shop_admin/inorderlist.php', 'scf_inorder', 1),
    */
);
