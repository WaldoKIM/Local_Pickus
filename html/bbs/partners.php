<?php
include_once('./_common.php');

include_once('./_head.php');

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.partner{width: 23.5%; margin: 0; margin-right: 2%; margin-bottom: 2%; float: left; cursor: pointer;}
	.partner img{height: 250px;}
	.partner h3{margin-top: 10px; font-size: 20px; text-align: center;}
	.partner:nth-of-type(4){margin-right: 0;}
</style>
<?php 

$sql = "select * from g5_member WHERE mb_intro_center IS NOT NULL";
$query = sql_query($sql);


 ?>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">업체소개</span></h1>
			<!-- <p class="tit_desc">내 정보를 확인 및 수정 할 수 있습니다.</p> -->
		</div>
		<div>
			<div class="partners">
			<?php 
				for ($i=0; $row=sql_fetch_array($query); $i++) {
					echo "<div class='partner' onclick='show_partner_detail(\"".$row['mb_email']."\")' >";
						echo '<img src = "/data/estimate/' . $row['mb_photo_site'] . ' " >';
						echo '<h3 class="name "> '.$row['mb_name'].'</h3>';
					echo '</div>';
				}
			?>
			</div>
		</div>
	</div>
</div><!-- member -->
<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">업체 소개</h4>
			</div>
			<div class="modal-body" id="modal_info_content">
				<div id="board">
					<div class="form-group">
						<p class="text-right" id="reviewTitle">

						</p>
					</div>
					<div id="board">
						<div class="photo_list">
							<table id="reviewList"></table>
						</div>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->

				</div><!-- board -->
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 업체정보 -->
<script type="text/javascript">
	function show_partner_detail(rcEmail)
	{
	    $.ajax({
	        type: "POST",
	        url: "<?php echo G5_URL ?>/estimate/ajax.partner_info.modal.php",
	        data: {
	        	rc_email:rcEmail
	        },
	        cache: false,
	        success: function(data) {
				$("#modal_info").html(data);
				$("#modal_info").modal();

	        }
	    });
	}
</script>
<?php
include_once('./_tail.php');
?>
