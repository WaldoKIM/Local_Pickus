<?php
include_once("./_common.php");

$sql = " select * from {$g5['match_propose']} where idx = '$idx' ";

$propose = sql_fetch($sql);
?>
<div class="form-group">
	<ul class="row">
		<li class="col-xs-3 title">
			견적가격
		</li>
		<li class="col-xs-9" id="price"><?php echo display_estimate_price($propose['price']) ?></li>
	</ul>
</div>								
<div class='form-group'>
	<div class='row' id='imageList'>
		<?php
			for($i=1; $i <= 6; $i++)
			{
				echo "<div class='col-md-4 text-center'>";
				if($propose['photo'.$i]){
					echo "<div class='estimate_image_bg'>";
					echo "<img src='/data/estimate/".$propose['photo'.$i]."' style='width:100%;'/>";
					echo "</div>";
				}
				echo "</div>";
			}
		?>	
	</div><!-- imageList -->
</div>
	
<div class="form-group">
	<ul class="row">
		<li class="col-xs-6">
			<p>상태 및 참고사항</p>
			<p id="content"><?php echo $propose['content'] ?></p>
		</li>
		<li class="col-xs-6">
			<p>배송/환불/A/S</p>
			<p id="delievery"><?php echo $propose['delievery'] ?></p>
		</li>
	</ul>
</div>

<div class="btn_wrap">
	<ul class="row">
		<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
	</ul>
</div>
