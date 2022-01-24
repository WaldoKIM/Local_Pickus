<?php
include_once("./_common.php");

$sql = " select * from {$g5['estimate_propose_detail']} where estimate_idx='$idx' and rc_email='$rc_email' ";
$result = sql_fetch($sql);

$sql = " select * from {$g5['estimate_propose']} where estimate_idx='$idx' and rc_email='$rc_email' ";
$row = sql_fetch($sql);
?>
<div class="form-group">
	<ul class="row">
		<li class="col-xs-5 title gray_bg">
			총 견적 (공금가+세액)
		</li>
		<li class="col-xs-7"><?php echo number_format($result['total_amt'],0)?> 원</li>
	</ul>
</div>
<div class="form-group" style="border-bottom: 0;">
	<table>
		<thead>
			<tr>
				<th class="web_td">품목</th>
				<th>내역</th>
				<th>공급가액</th>
				<th>세액</th>
			</tr>
		</thead>
		<tbody>
		<?php
		for ($i=1; $i<=5; $i++){
			if($i < 10){
				$vId = '0'.$i;
			}else{
				$vId = ''.$i;
			}
			$result_amt = "";
			$result_vat = "";
			if($result['amt'.$vId]){
				$result_amt = $result['amt'.$vId];
			}

			if($result['vat'.$vId]){
				$result_vat = $result['vat'.$vId];
			}
		?>
			<tr>
	 			<td><input type="text" id="item<?php echo $vId ?>" name="item<?php echo $vId ?>" value="<?php echo $result['item'.$vId]?>" readonly></td>
	 			<td><input type="text" id="desc<?php echo $vId ?>" name="desc<?php echo $vId ?>" value="<?php echo $result['desc'.$vId]?>" readonly></td>
	 			<td><input type="number" class="pati_detail_input_02" id="amt<?php echo $vId ?>" name="amt<?php echo $vId ?>" value="<?php echo $result_amt?>" readonly></td>
	 			<td><input type="text" class="pati_detail_input_02" id="vat<?php echo $vId ?>" name="vat<?php echo $vId ?>" value="<?php echo $result_vat?>" readonly></td>
	 		</tr>			
		<?php
		}
		?>			
		</tbody>
	</table>
</div>
	
<div class="form-group">
	<ul class="row">
		<li class="col-xs-12">
			<p>업체 견적 참고사항</p>
			<textarea id="content" name="content"  readonly><?php echo $result['content']?></textarea>
		</li>
<?php
	if($row['attach_file']){

		echo "<li class='col-xs-12'><a href='".G5_DATA_URL.'/estimate/'.$row['attach_file']."' style='margin-top:20px; padding:15px;' class='main_bg'>다운로드</a></li>";
	}
?>
	</ul>
</div>


<div class="btn_wrap">
	<ul class="row">
		<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
	</ul>
</div>
