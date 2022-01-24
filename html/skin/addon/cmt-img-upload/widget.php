<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $board, $bo_table, $member, $is_guest, $it_id;

// 설정값
include_once($widget_path.'/_api.php');

// 등록권한
$is_comment_write = '';
if($bo_table) {
	if($is_guest && !$is_guest_upload) {
		$is_comment_write = '로그인한 회원만 등록가능합니다.';
	} else if ($member['mb_level'] >= $board['bo_comment_level']) {
		;
	} else {
		$is_comment_write = ($is_guest) ? '로그인한 회원만 등록가능합니다.' : '등록할 수 있는 권한이 없습니다.';
	}
} else if($it_id && $is_guest) {
	$is_comment_write = '로그인한 회원만 등록가능합니다.';
}

?>

<div id="cmtImageUpload" class="modal fade">
	<form class="form" id="ajaxImgUploadForm" action="<?php echo $widget_url;?>/upload.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table;?>">
	<input type="hidden" name="it_id" value="<?php echo $it_id;?>">
	<input type="hidden" name="wname" value="<?php echo $wname;?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo ($is_img_upload) ? 'Image' : 'File';?> Upload</h4>
			</div>
			<div class="modal-body">
				<p class="help-block">
					<i class="fa fa-commenting fa-lg"></i> 
					<?php 
						if($is_comment_write) {
							echo $is_comment_write;
						} else {
							echo $is_max_upload.'MB이내';
							echo ($is_img_upload) ? ' 이미지(JPG/GIF/PNG)파일만 등록할 수 있습니다.' : ' 파일만 등록할 수 있습니다.';
						}
					?>
				</p>
				<input type="file" name="img_upload" style="width:100%">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-black"><i class="fa fa-upload"></i> Upload</button>
			</div>
		</div>
	</div>
	</form>
</div>

<script>
	var ajaxImgAuth = "<?php echo $is_comment_write;?>";
	var ajaxImgFile = "<?php echo ($is_img_upload) ? 1 : '';?>";
	var ajaxImgur = "<?php echo ($is_imgur_upload) ? 1 : '';?>";
</script>
<script src="<?php echo $widget_url;?>/jquery.form.min.js"></script>
<script src="<?php echo $widget_url;?>/jquery.upload.img.js"></script>
<?php if($is_imgur_upload) { ?>
<div style="display:none;"><span id="ajaxImgTag"></span></div>
<?php } ?>