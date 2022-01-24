<style type="text/css">
.panel-default>.panel-heading{background-color: transparent;}
.hidden-xs{display: block !important; }
	.view-head{overflow: hidden; margin-bottom: 20px; box-shadow: none !important;}
	.view-wrap{padding-top: 60px;}
	.view-wrap h1{text-align: center; font-size: 36px; font-weight: 400;}
	.sv_member{font-size: 16px;}
	.panel-default{border:0;}
	.panel-default>.panel-heading{border:0; border-bottom: 1px solid #ccc; background-color: #fff; text-align: center;}
	.view-img,.view-content{text-align: center; font-size: 16px; line-height: 25px;}
	form[name="fviewcomment"]{padding-top: 40px; border-top: 2px solid rgb(19, 121, 205);}
	textarea#wr_content{box-shadow: none !important;}
	.form-group{border-bottom: 0;}
	div#bo_vc_opt{display: none;}
	@media(max-width: 768px){
		.modal_info{width: 100%;}
	}
</style>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$attach_list = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
			$attach_list .= '<span class="label label-warning pull-right view-cnt">'.number_format($view['link_hit'][$i]).'</span>';
			$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).'</a>'.PHP_EOL;
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
		$attach_list .= '<span class="label label-primary pull-right view-cnt">'.number_format($view['file'][$i]['download']).'</span>';
		$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;';
		$attach_list .= '<span class="en font-11 text-muted"><i class="fa fa-clock-o"></i> '.apms_datetime(strtotime($view['file'][$i]['datetime']), "Y.m.d").'</span></a>'.PHP_EOL;
		$j++;
	}
}
$mb_id = $view['mb_id'];
$sql_row = "select * from g5_member where mb_id = '$mb_id'";
$result_row = sql_fetch($sql_row);
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

?>
<?php if($boset['video']) { ?>
	<style>.view-wrap .apms-autowrap { max-width:<?php echo (G5_IS_MOBILE) ? '100%' : $boset['video'];?> !important;}</style>
<?php } ?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<div class="member com_pd">
	<div class="sub_title">
	<?php if($_GET['bo_table'] == 'gallery'){ ?>
	<h1 class="main_co">피커스 픽</h1>
	<?php } ?>
	<?php if($_GET['bo_table'] == 'intro'){ ?>
	<h1 class="main_co">업체소개</h1>
	<?php } ?>
	<?php if($_GET['bo_table'] == 'event'){ ?>
	<h1 class="main_co">이벤트</h1>
	<?php } ?>
</div>
<div class="view-wrap<?php echo (G5_IS_MOBILE) ? ' view-mobile font-14' : '';?>">
	<h1><?php if($view['photo']) { ?><img src="<?php echo $view['photo'];?>" class="photo" alt=""><?php } ?><?php echo cut_str(get_text($view['wr_subject']), 70); ?></h1>
	<div class="panel panel-default view-head<?php echo ($attach_list) ? '' : ' no-attach';?>">
		<div class="panel-heading">
			<div class="font-12 text-muted">
				<!-- <i class="fa fa-user"></i> -->
				Write by. <a href='#' id='show_modal'>
				<?php echo $result_row['mb_name']; //등록자 ?></a>
				<?php if($view['ca_name']) { ?>
					<span class="hidden-xs">
						<span class="sp"></span>
						<i class="fa fa-tag"></i>
						<?php echo $view['ca_name']; //분류 ?>
					</span>
				<?php } ?>

				<span class="sp"></span>
				<!-- <i class="fa fa-comment"></i>
				<?php echo ($view['wr_comment']) ? '<b class="red">'.number_format($view['wr_comment']).'</b>' : 0; //댓글수 ?>

				<span class="sp"></span>
				<i class="fa fa-eye"></i>
				<?php echo number_format($view['wr_hit']); //조회수 ?> -->

				<span class="pull-right">
					<i class="fa fa-clock-o"></i>
					<span style="color: #333;"><?php echo apms_date($view['date'], ''); //시간 ?></span>
				</span>
			</div>
		</div>
	   <?php
			if($attach_list) {
				echo '<div class="list-group font-12">'.$attach_list.'</div>'.PHP_EOL;
			}
		?>
	</div>

	<?php if ($is_torrent) echo apms_addon('torrent-basic'); // 토렌트 파일정보 ?>

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
		<?php echo get_view_thumbnail2($view['content']); ?>
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
						<b id="wr_good"><?php echo number_format($view['wr_good']) ?></b>
						<br>
						<i class="fa fa-thumbs-up"></i>
					</a>
				</span>
			<?php } ?>
			<?php if ($nogood_href) { ?>
				<span class="view-nogood">
					<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'nogood', 'wr_nogood'); return false;">
						<b id="wr_nogood"><?php echo number_format($view['wr_nogood']) ?></b>
						<br>
						<i class="fa fa-thumbs-down"></i>
					</a>
				</span>
			<?php } ?>
		</div>
		<p></p>
	<?php } ?>

	<?php if ($is_tag) { // 태그 ?>
		<p class="view-tag font-12"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
	<?php } ?>

	<?php if($is_signature) echo apms_addon('sign-basic'); // 회원서명 ?>

	<!-- <h3 class="view-comment">Comments</h3> -->
	<?php include_once('./view_comment.php'); ?>

	<div class="clearfix"></div>

	<div class="print-hide view-btn text-right">
		<div class="btn-group">
			<?php if ($prev_href) { ?>
				<a href="<?php echo $prev_href ?>" class="btn btn-black btn-sm" title="이전글">
					<i class="fa fa-chevron-circle-left"></i><span class="hidden-xs"> 이전</span>
				</a>
			<?php } ?>
			<?php if ($next_href) { ?>
				<a href="<?php echo $next_href ?>" class="btn btn-black btn-sm" title="다음글">
					<i class="fa fa-chevron-circle-right"></i><span class="hidden-xs"> 다음</span>
				</a>
			<?php } ?>
			<?php if ($copy_href) { ?>
				<a href="<?php echo $copy_href ?>" class="btn btn-black btn-sm" onclick="board_move(this.href); return false;" title="복사">
					<i class="fa fa-clipboard"></i><span class="hidden-xs"> 복사</span>
				</a>
			<?php } ?>
			<?php if ($move_href) { ?>
				<a href="<?php echo $move_href ?>" class="btn btn-black btn-sm" onclick="board_move(this.href); return false;" title="이동">
					<i class="fa fa-share"></i><span class="hidden-xs"> 이동</span>
				</a>
			<?php } ?>
			<?php if ($delete_href) { ?>
				<a href="<?php echo $delete_href ?>" class="btn btn-black btn-sm" title="삭제" onclick="del(this.href); return false;">
					<i class="fa fa-times"></i><span class="hidden-xs"> 삭제</span>
				</a>
			<?php } ?>
			<?php if ($update_href) { ?>
				<a href="<?php echo $update_href ?>" class="btn btn-black btn-sm" title="수정">
					<i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span>
				</a>
			<?php } ?>
			<?php if ($search_href) { ?>
				<a href="<?php echo $search_href ?>" class="btn btn-black btn-sm">
					<i class="fa fa-search"></i><span class="hidden-xs"> 검색</span>
				</a>
			<?php } ?>
			<a href="<?php echo $list_href ?>" class="btn btn-black btn-sm">
				<i class="fa fa-bars"></i><span class="hidden-xs"> 목록</span>
			</a>
			<?php if ($reply_href) { ?>
				<a href="<?php echo $reply_href ?>" class="btn btn-black btn-sm">
					<i class="fa fa-comments"></i><span class="hidden-xs"> 답변</span>
				</a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a href="<?php echo $write_href ?>" class="btn btn-color btn-sm">
					<i class="fa fa-pencil"></i><span class="hidden-xs"> 글쓰기</span>
				</a>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class='modal_background' id='modal_background' style='display:none;'>
		<div class='modal_info'>
		<a href='#'><img id='close_modal' src='/img/btn_x.png'></a>
		<div class='modal_top'>
	<div class='img'><img src ='/data/estimate/<?php echo $result_row['mb_photo_site'] ?>'></div></div>
	<h4><?php echo $result_row['mb_name']; ?></h4>
	
	<p style='    background-color: aliceblue;
    margin-bottom: 20px;
    padding: 10px 20px;'> <span style='color:gold;'>★</span>4.8 <span id='stick'>|</span> <span id='where'><img id='location_icon' src='/img/ico_location.png' style="margin-right: 5px;"><?php echo $result_row['mb_biz_addr1']; ?></span></p>
	<p><?php echo $result_row['mb_biz_intro']; ?></p>
	</div>
</div>
<script>
function board_move(href){
	window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
$(function() {
	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
	<?php if ($board['bo_download_point'] < 0) { ?>
	$("a.view_file_download").click(function() {
		if(!g5_is_member) {
			alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
			return false;
		}

		var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

		if(confirm(msg)) {
			var href = $(this).attr("href")+"&js=on";
			$(this).attr("href", href);

			return true;
		} else {
			return false;
		}
	});
	<?php } ?>
	$("#show_modal").click(function(){
		$( ".modal_background" ).css( "display", "block" );
	});
	var btn_x = document.getElementById("close_modal");
	var modal = document.getElementById("modal_background");
	var show_modal = document.getElementById("show_modal");
	btn_x.onclick = function() {
	  modal.style.display = "none";
	}
	window.onclick = function(event) {
		
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
});
</script>
