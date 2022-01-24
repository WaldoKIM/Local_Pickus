<?php
include_once("./_common.php");

$sql = " select * from {$g5['estimate_propose_detail']} where estimate_idx='$idx' and rc_email='$rc_email' ";

$result = sql_fetch($sql);

$sql = " select * from {$g5['estimate_propose']} where estimate_idx='$idx' and rc_email='$rc_email' ";

$result_detail = sql_fetch($sql);
?>

<input type="hidden" name="idx" value="<?php echo $idx; ?>">
<div class="form-group">
	<ul class="row">
		<li class="col-xs-5 title gray_bg">
			총 견적 (공금가+세액)
		</li>
		<li class="col-xs-7">
			<div id="divTotalAmt"><?php echo number_format($result['total_amt'],0)?> 원</div> 
			<input type="hidden" id="totalAmt" name="total_amt" value="<?php echo $result['total_amt'] ?>">
		</li>
	</ul>
</div>

<div class="form-group">
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
	 			<td><input type="text" id="item<?php echo $vId ?>" name="item<?php echo $vId ?>" value="<?php echo $result['item'.$vId]?>"></td>
	 			<td><input type="text" id="desc<?php echo $vId ?>" name="desc<?php echo $vId ?>" value="<?php echo $result['desc'.$vId]?>"></td>
	 			<td><input type="number" class="pati_detail_input_02" id="amt<?php echo $vId ?>" name="amt<?php echo $vId ?>" value="<?php echo $result_amt?>"></td>
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
			<p>작성내역</p>
			<textarea id="content" name="content"><?php echo $result['content']?></textarea>
		</li>
		<li class="col-xs-12">
			<div class="box-file-input">
				<label>
					<input type="file" id="attach_file2" name="attfile" class="file-input" accept="image/*">
				</label>
				<span id="attfilename2" class="filename"><?php
				echo '<a href="/data/estimate/' . $result_detail['attach_file'] . ' ">파일확인</a>';
				 ?></span>
			</div>
		</li>
		
	</ul>
</div>
<style type="text/css">
	#itemList tr:nth-of-type(n+6){display: none;}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$("#attach_file2").bind('change', function() {
			$("#attfilename2").html(this.files[0].name);
		});
		for(var i=0; i<=11; i++)
		{
			var vId = i;
			if(i<10) vId = "0"+i;

			var vAmtId = "#amt"+vId;
			var vVatId = "#vat"+vId;
			
			$(vAmtId).inputFilter(function(value) {
				  return /^\d*$/.test(value);
			});
			
			$(vAmtId).focus(function() {
				  $(this).val(cfnNumberRemoveComma($(this).val()));
			});
			
			$(vAmtId).blur(function() {
				var amtId = $(this).attr("id");
				var vatId = "#"+amtId.replace("amt","vat");
				var vAmt = $(this).val();
				if(vAmt)
				{
					var vVat = Math.round(vAmt * 0.1);
					$(this).val(vAmt);
					$(vatId).val(vVat);
				}else{
					$(vatId).val("");
				}	
				
				fnCalcAmt();
			});

			$(vVatId).inputFilter(function(value) {
				  return /^\d*$/.test(value);
			});
			
			$(vVatId).focus(function() {
				  $(this).val(cfnNumberRemoveComma($(this).val()));
			});
			
			$(vVatId).blur(function() {
				  $(this).val(cfnNumberComma($(this).val()));
				  fnCalcAmt();
			});
			
		}		
	});
</script>