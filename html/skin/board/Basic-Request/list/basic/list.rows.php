<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { // 모달 - PC만 작동
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	if(!$boset['list_skin']) $boset['list_skin'] = 'basic'; // 목록스킨

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];
}

for ($i=0; $i < $list_cnt; $i++) { 

	if($list[$i]['is_notice']) continue; //공지출력 제외

	//아이콘 체크
	$wr_icon = '';
	$is_lock = false;
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_icon = '<span class="wr-icon wr-secret"></span>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		$wr_icon = '<span class="wr-icon wr-hot"></span>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = '<span class="wr-icon wr-new"></span>';
	}

	// 공지, 현재글 스타일 체크
	$li_css = '';
	if ($wr_id == $list[$i]['wr_id']) {
		$li_css = ' bg-light';
		$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
		$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
	} else if ($list[$i]['is_notice']) { // 공지사항
		$li_css = ' bg-light';
		$list[$i]['num'] = '<span class="wr-icon wr-notice"></span>';
		$list[$i]['ca_name'] = '공지';
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
	}

	// 링크이동
	if($is_link_target) {
		if($list[$i]['is_notice']) {
			$list[$i]['target'] = '';
		} else {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}
	}

	// 진행
	$is_closed = false;
	if($list[$i]['update'] > G5_SERVER_TIME) {
		$wr_status = '<span class="red">진행</span>'; 
	} else {
		$is_closed = true;
		$wr_status = '<span class="gray">마감</span>'; 
	}

	// 수동으로 편집해야 됩니다.
	$wr_cate = '';
	if($list[$i]['ca_name'] == '해드립니다') {
		$wr_cate = ($is_closed) ? '<span class="rank-icon bg-gray">마감</span>' : '<span class="rank-icon bg-green">재능</span>'; 
	} else if($list[$i]['ca_name'] == '해주세요') {
		$wr_cate = ($is_closed) ? '<span class="rank-icon bg-gray">마감</span>' : '<span class="rank-icon bg-orangered">의뢰</span>'; 
	} else if($list[$i]['ca_name'] == '공지') {
		$wr_cate = '<span class="rank-icon bg-violet">공지</span>'; 
	} else {
		$wr_cate = '<span class="rank-icon bg-orange">기타</span>'; 
	}

?>
	<li class="list-item<?php echo $li_css;?>">
		<div class="num hidden-xs"><?php echo $list[$i]['num']; ?></div>
		<div class="status"><?php echo $wr_status;?></div>
		<div class="subj">
			<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?> class="ellipsis">
				<?php echo $list[$i]['icon_reply']; ?>
				<?php echo $wr_cate;?>
				<?php echo $list[$i]['subject']; ?>
			</a>
			<div class="subj-item text-muted visible-xs">
				<span class="xs-name"><?php echo $list[$i]['name'];?></span>
				<span><i class="fa fa-comment"></i> <?php echo $list[$i]['wr_comment']; ?></span>
				<span><i class="fa fa-ticket"></i> <?php echo ($list[$i]['as_view']) ? number_format($list[$i]['as_view']).'만원' : '협의'; ?></span>
				<span><i class="fa fa-calendar"></i> <?php echo date("Y.m.d", $list[$i]['update']); ?>까지</span>
			</div>
		</div>
		<div class="num hidden-xs">
			<?php echo $list[$i]['wr_comment']; ?>
		</div>
		<div class="point hidden-xs">
			<?php echo ($list[$i]['as_view']) ? number_format($list[$i]['as_view']).'만원' : '협의'; ?>
		</div>
		<div class="date hidden-xs">
			<?php echo date("m.d", $list[$i]['date']); ?>
		</div>
		<div class="date hidden-xs">
			<?php echo date("m.d", $list[$i]['update']); ?>
		</div>
		<div class="name ellipsis hidden-xs">
			<?php echo $list[$i]['name'];?>
		</div>
		<?php if ($is_checkbox) { ?>
			<div class="chk">
				<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</div>
		<?php } ?>
	</li>
<?php } ?>
