<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;

$menu['menu500'] = array (
    array('500000', '현황', G5_ADMIN_URL.'/pickus_state_list.php', 'pickus_stats'),
    array('500110', '현황', G5_ADMIN_URL.'/pickus_state_list.php', 'pickus_state_list')
);
?>