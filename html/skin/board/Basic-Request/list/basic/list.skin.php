<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 더보기
apms_script('infinite');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 헤드스킨
if(isset($boset['hskin']) && $boset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$boset['hskin'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($boset['hcolor']) && $boset['hcolor']) ? 'border-'.$boset['hcolor'] : 'border-black';
}

?>

<div class="list-board">
	<div class="div-head <?php echo $head_class;?>">
		<span class="num hidden-xs">번호</span>
		<span class="status">상태</span>
		<span class="subj">의뢰명</span>
		<span class="num hidden-xs">댓글</span>
		<span class="point hidden-xs">비용</span>
		<span class="date hidden-xs">등록</span>
		<span class="date hidden-xs">마감</span>
		<span class="name hidden-xs">이름</span>
		<?php if ($is_checkbox) { ?>
		<span class="chk">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
			<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</span>
		<?php } ?>
	</div>
	<ul id="list-container" class="list-body">
	<?php
		$is_ajax = false;
		include_once($list_skin_path.'/list.rows.php');
	?>
	</ul>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="list-none text-center text-muted">게시물이 없습니다.</div>
	<?php } ?>
</div>
<div id="list-nav">
	<a href="<?php echo $list_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
</div>
<div id="list-more" class="font-14 cursor en">
	<i class="fa fa-plus-circle"></i>&nbsp; 더보기
</div>
<script type="text/javascript">
	$(function(){
		var $container = $('#list-container');

		$container.infinitescroll({
			navSelector  : '#list-nav',    // selector for the paged navigation
			nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
			itemSelector : '.list-item',     // selector for all items you'll retrieve
			loading: {
				msgText: '로딩 중...',
				finishedMsg: '더이상 글이 없습니다.',
				img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
			}
		}, function( newElements ) { // trigger Masonry as a callback
			var $newElems = $( newElements ).css({ opacity: 0 });
			$container.append($newElems);
			$newElems.animate({ opacity: 1 });
		});
		$(window).unbind('.infscr');
		$('#list-more').click(function(){
		   $container.infinitescroll('retrieve');
		   $('#list-nav').show();
			return false;
		});
		$(document).ajaxError(function(e,xhr,opt){
			if(xhr.status==404) $('#list-nav').remove();
		});
	});
</script>