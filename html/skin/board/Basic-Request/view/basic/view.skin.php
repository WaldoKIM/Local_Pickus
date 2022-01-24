<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css" media="screen">', 0);

// 공지글 체크
$chk_notice = explode(",", trim($board['bo_notice']));
$notice_cnt = count($chk_notice);
$is_view_notice = false;
if($notice_cnt > 0) {
	if(in_array($wr_id, $chk_notice)) {
		$is_view_notice = true;
	}
}

$end_time = $view['update'] - G5_SERVER_TIME;
$is_end = ($end_time > 0) ? false : true;

// 마감처리
if($is_view_notice) {
	;
} else {
	if($is_admin || $view['mb_id'] && $view['mb_id'] == $member['mb_id']) {
		;
	} else if($is_end) {
		alert("이미 마감된 의뢰글입니다.", G5_BBS_URL.'/board.php?bo_table='.$bo_table.$qstr);
	}
}

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';

if($is_view_notice) { // 공지글 

	$attach_list = '';
	if (implode('', $view['link'])) {
		// 링크
		for ($i=1; $i<=count($view['link']); $i++) {
			if ($view['link'][$i]) {
				$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
				$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).' &nbsp;<span class="blue">+ '.$view['link_hit'][$i].'</span></a>'.PHP_EOL;
			}
		}
	}

	// 가변 파일
	$j = 0;
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
			}
			$file_tooltip = '';
			if($view['file'][$i]['content']) {
				$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
			}
			$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
			$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;<span class="orangered">+ '.$view['file'][$i]['download'].'</span></a>'.PHP_EOL;
			$j++;
		}
	}
?>
	
	<h1>
		<?php if($view['photo']) { ?><span class="talker-photo hidden-xs"><?php echo $view['photo'];?></span><?php } ?><?php echo cut_str(get_text($view['wr_subject']), 70); ?>
	</h1>

	<div class="panel panel-default view-head<?php echo ($attach_list) ? '' : ' no-attach';?>">
		<div class="panel-heading">
			<div class="text-muted<?php echo $view_font;?>">
				<i class="fa fa-user"></i>
				<?php echo $view['name']; //등록자 ?><?php echo ($is_ip_view) ? '<span class="hidden-xs">&nbsp;('.$ip.')</span>' : ''; ?>
				<?php if($view['ca_name']) { ?>
					<span class="hidden-xs">
						<span class="sp"></span>
						<i class="fa fa-tag"></i>
						<?php echo $view['ca_name']; //분류 ?>
					</span>
				<?php } ?>

				<span class="sp"></span>
				<i class="fa fa-comment"></i>
				<?php echo ($view['wr_comment']) ? '<b class="red">'.number_format($view['wr_comment']).'</b>' : 0; //댓글수 ?>

				<span class="sp"></span>
				<i class="fa fa-eye"></i>
				<?php echo number_format($view['wr_hit']); //조회수 ?>

				<span class="hidden-xs pull-right">
					<i class="fa fa-clock-o"></i>
					<?php echo apms_datetime($view['date'], 'Y.m.d H:i'); //시간 ?>
				</span>
			</div>
		</div>
	   <?php
			if($attach_list) {
				echo '<div class="list-group'.$view_font.'">'.$attach_list.'</div>'.PHP_EOL;
			}
		?>
	</div>

<?php } else { // 리퀘스트글 ?>

	<h1 class="text-center">
		<?php echo get_text($view['wr_subject']); ?>
	</h1>

	<div class="panel panel-default" style="margin-top:15px;">
		<div class="panel-heading">
			<h3 class="panel-title">
				<span class="pull-right font-14" style="font-weight:normal;">
					<i class="fa fa-comment"></i>
					<?php echo ($view['wr_comment']) ? '<b class="red">'.number_format($view['wr_comment']).'</b>' : 0; //댓글수 ?>
					&nbsp; &nbsp;
					<i class="fa fa-eye"></i>
					<?php echo number_format($view['wr_hit']); //조회수 ?>
				</span>
			</h3>
		</div>
		<div class="panel-body">
			<table class="tb_info">
				<tr>
					<th>등록일자</th>
					<td><?php echo date("Y년 m월 d일 H시", strtotime($view['wr_datetime'])); ?></td>
					<th>마감일자</th>
					<td><?php echo date("Y년 m월 d일 H시", strtotime($view['as_update'])); ?></td>
					<th>배송요청일자</th>
					<td><?php echo $view['wr_5']?></td>
				</tr>
				<tr>
					<th>이름</th>
					<td><?php echo $view['wr_1']?></td>
					<th>이메일</th>
					<td><?php echo $view['wr_2']?></td>
					<th>연락처</th>
					<td><?php echo $view['wr_3']?></td>
				</tr>
				<tr>
					<th>장소</th>
					<td><?php echo $view['wr_6']?></td>
					<th>의뢰비용</th>
					<td><?php echo ($view['as_view']) ? number_format($view['as_view']).'만원' : '협의';?></td>
				</tr>
				
			</table>

			<div class="view-line"></div>

			<div>
				<span class="pull-right">
					<b><?php echo $view['name']; //등록자 ?></b>
				</span>
				<?php if($is_end) { ?>
					의뢰가 이미 마감되었습니다.
				<?php } else { ?>
					마감까지 <b><span class="red"><span id="end_timer"></span></span></b> 남았습니다.
				<?php } ?>
			</div>
		</div>
	</div>

	<?php
		$cnt = 0;
		if ($view['file']['count']) {
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
					$cnt++;
			}
		}
	?>

	<?php if($cnt) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-download"></i> Attachment
				</h3>
			</div>
			<div class="list-group">
			   <?php
				// 가변 파일
				for ($i=0; $i<count($view['file']); $i++) {
					if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
						$file_tooltip = '';
						if($view['file'][$i]['content']) {
							$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
						}
				 ?>
					<a class="list-group-item view_file_download at-tip" href="<?php echo $view['file'][$i]['href'];  ?>"<?php echo $file_tooltip;?>>
						<i class="fa fa-gift"></i> <?php echo $view['file'][$i]['source'] ?>
						(<?php echo $view['file'][$i]['size'] ?>)
					</a>
				<?php
					}
				}
				 ?>
			</div>
		</div>
	<?php } ?>

	<?php if (implode('', $view['link'])) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-home"></i> Links
				</h3>
			</div>
			<div class="list-group">
				<?php
					// 링크
					$cnt = 0;
					for ($i=1; $i<=count($view['link']); $i++) {
						if ($view['link'][$i]) {
							$cnt++;
							$link = cut_str($view['link'][$i], 70);
				?>
					<a class="list-group-item at-tip" href="<?php echo $view['link_href'][$i] ?>" target="_blank" data-original-title="<?php echo number_format($view['link_hit'][$i]); ?> 명 방문" data-toggle="tooltip">
						<i class="fa fa-link"></i> <?php echo $link ?>
					</a>
				<?php
					}
				}
				 ?>
			</div>
		</div>
	<?php } ?>

<?php } //공지글과 구분 끝 ?>

<?php if ($is_torrent) { // 토렌트 파일정보 ?>
	<?php for($i=0; $i < count($torrent); $i++) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-share-alt"></i> <?php echo $torrent[$i]['name'];?></h3>
			</div>
			<div class="panel-body">
				<span class="pull-right hidden-xs text-muted en font-11"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d H:i", $torrent[$i]['date']);?></span>
				<?php if ($torrent[$i]['is_size']) { ?>
						<b class="en font-16"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['info']['name'];?> (<?php echo $torrent[$i]['info']['size'];?>)</b>
				<?php } else { ?>
					<p><b class="en font-16"><i class="fa fa-cube"></i> Total <?php echo $torrent[$i]['info']['total_size'];?></b></p>
					<div class="text-muted<?php echo $view_font;?>">
						<?php for ($j=0;$j < count($torrent[$i]['info']['file']);$j++) { 
							echo ($j + 1).'. '.implode(', ', $torrent[$i]['info']['file'][$j]['name']).' ('.$torrent[$i]['info']['file'][$j]['size'].')<br>'."\n";
						} ?>
					</div>
				<?php } ?>
			</div>
			<ul class="list-group">
				<li class="list-group-item en font-14 break-wrod"><i class="fa fa-magnet"></i> <?php echo $torrent[$i]['magnet'];?></li>
				<li class="list-group-item break-word">
					<div class="text-muted<?php echo $view_font;?>">
						<?php for ($j=0;$j < count($torrent[$i]['tracker']);$j++) { ?>
							<i class="fa fa-tags"></i> <?php echo $torrent[$i]['tracker'][$j];?><br>
						<?php } ?>
					</div>
				</li>
				<?php if($torrent[$i]['comment']) { ?>
					<li class="list-group-item en font-14 break-word"><i class="fa fa-bell"></i> <?php echo $torrent[$i]['comment'];?></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>
<?php } ?>

<?php
	// 이미지 상단 출력
	$v_img_count = count($view['file']);
	if($v_img_count && $is_img_head) {
		echo '<div class="view-img">'.PHP_EOL;
		for ($i=0; $i<=count($view['file']); $i++) {
			if ($view['file'][$i]['view']) {
				echo get_view_thumbnail($view['file'][$i]['view']);
			}
		}
		echo '</div>'.PHP_EOL;
	}
 ?>

<div class="view-content">
	<?php echo get_view_thumbnail($view['content']); ?>
</div>

<?php
	// 이미지 하단 출력
	if($v_img_count && $is_img_tail) {
		echo '<div class="view-img">'.PHP_EOL;
		for ($i=0; $i<=count($view['file']); $i++) {
			if ($view['file'][$i]['view']) {
				echo get_view_thumbnail($view['file'][$i]['view']);
			}
		}
		echo '</div>'.PHP_EOL;
	}
?>

<?php if ($good_href || $nogood_href) { ?>
	<div class="print-hide view-good-box">
		<?php if ($good_href) { ?>
			<span class="view-good">
				<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'good', 'wr_good'); return false;">
					<b id="wr_good"><?php echo $view['wr_good']; ?></b>
					<br>
					<i class="fa fa-thumbs-up"></i>
				</a>
			</span>
		<?php } ?>
		<?php if ($nogood_href) { ?>
			<span class="view-nogood">
				<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'nogood', 'wr_nogood'); return false;">
					<b id="wr_nogood"><?php echo $view['wr_nogood']; ?></b>
					<br>
					<i class="fa fa-thumbs-down"></i>
				</a>
			</span>
		<?php } ?>
	</div>
	<p></p>
<?php } else { //여백주기 ?>
	<div class="h40"></div>
<?php } ?>

<?php if ($is_tag) { // 태그 ?>
	<p class="view-tag view-padding<?php echo $view_font;?>"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
<?php } ?>

<div class="print-hide view-icon view-padding">
	<?php 
		// SNS 보내기
		if ($board['bo_use_sns']) {
			echo apms_sns_share_icon('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $view['subject'], $seometa['img']['src']);
		}
	?>
	<span class="pull-right">
		<img src="<?php echo G5_IMG_URL;?>/sns/print.png" alt="프린트" class="cursor at-tip" onclick="apms_print();" data-original-title="프린트" data-toggle="tooltip">
		<?php if ($scrap_href) { ?>
			<img src="<?php echo G5_IMG_URL;?>/sns/scrap.png" alt="스크랩" class="cursor at-tip" onclick="win_scrap('<?php echo $scrap_href;  ?>');" data-original-title="스크랩" data-toggle="tooltip">
		<?php } ?>
		<?php if ($is_shingo) { ?>
			<img src="<?php echo G5_IMG_URL;?>/sns/shingo.png" alt="신고" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>');" data-original-title="신고" data-toggle="tooltip">
		<?php } ?>
		<?php if ($is_admin) { ?>
			<?php if ($view['is_lock']) { // 글이 잠긴상태이면 ?>
				<img src="<?php echo G5_IMG_URL;?>/sns/unlock.png" alt="해제" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'unlock');" data-original-title="해제" data-toggle="tooltip">
			<?php } else { ?>
				<img src="<?php echo G5_IMG_URL;?>/sns/lock.png" alt="잠금" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'lock');" data-original-title="잠금" data-toggle="tooltip">
			<?php } ?>
		<?php } ?>
	</span>
	<div class="clearfix"></div>
</div>

<?php if($is_signature) { // 서명 ?>
	<div class="print-hide">
		<?php echo apms_addon('sign-basic'); // 회원서명 ?>
	</div>
<?php } else { ?>
	<div class="view-author-none"></div>
<?php } ?>

<?php include_once('./view_comment.php'); ?>

<?php if (!$is_end && !$is_view_notice) { ?>
<script>

	var end_time = <?php echo $end_time; ?>;

	function run_timer() {
		var timer = document.getElementById("end_timer");

		dd = Math.floor(end_time/(60*60*24));
		hh = Math.floor((end_time%(60*60*24))/(60*60));
		mm = Math.floor(((end_time%(60*60*24))%(60*60))/60);
		ii = Math.floor((((end_time%(60*60*24))%(60*60))%60));

		var str = "";

		if (dd > 0) str += dd + "일 ";
		if (hh > 0) str += hh + "시간 ";
		if (mm > 0) str += mm + "분 ";
		str += ii + "초 ";

		timer.style.color = "red";
		timer.style.fontWeight = "bold";
		timer.innerHTML = str;

		end_time--;

		if (end_time < 0) clearInterval(tid);
	}

	run_timer();

	tid = setInterval('run_timer()', 1000); 

</script>
<?php } ?>
<?php echo apms_addon('cmt-img-upload');?>