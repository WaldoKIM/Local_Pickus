
	<div class="left_gnb">
		<h3>고객센터</h3>
		<ul class="menu">
		<?
		$bbs_result = $db->select("cs_bbs", "where 1 order by idx desc");
		while( $bbs_row = @mysqli_fetch_object( $bbs_result )) {
		?>	
		<?if($code==$bbs_row->code){?>
		<li><a class="sensbutton-checked" onclick="javascript:location='bbs_list.php?code=<?=$bbs_row->code;?>'"><?=$bbs_row->name;?></a></li>
		<?}else{?>
		<li><a onclick="javascript:location='bbs_list.php?code=<?=$bbs_row->code;?>'"><?=$bbs_row->name;?></a></li>
		<?}?>
		<?}?>
		</ul>
		<ul class="info">
			<li class="tel">
				<a href="tel:<?=$admin_stat->shop_tel1;?>"><?=$admin_stat->shop_tel1;?></a>
			</li>
			<li class="time"><?=$tools->strHtmlBr($admin_stat->week);?></li>
			<?
			$bankResult = $db->select( "cs_banklist", "where main_marking=1 order by idx asc");
			while( $bankRow = @mysqli_fetch_object($bankResult) ) {?>
			<?}?>
		</ul>
	</div>

	<div class="noneboard" id='bbs_alignbox'>
		<!--페이지 제목출력-->
			<!--셀렉트메뉴-->
			<div class='btncenter_container4M' name='모바일일때 중앙정렬'>
				<div id='cssmenu'>
					<ul>
					   <li class='active has-sub'>
						  <ul>
								<?if($TARGETFILENAME=="customer.php"){?>
								<li class='has-sub'><a>고객센터</a>
								<?}else{?>
								<li class='has-sub'><a><?=$bbs_admin_stat->name?></a>
								<?}?>


								<ul>
									<?if($TARGETFILENAME!="customer.php"){?>
									<li><a href="customer.php">고객센터</a></li>
									<?}?>
									<?
									$bbs_result = $db->select("cs_bbs", "where 1 and code!='$code' order by idx desc");
									while( $bbs_row = @mysqli_fetch_object( $bbs_result )) {
									?>	
									<li><a href="bbs_list.php?code=<?=$bbs_row->code;?>"><?=$bbs_row->name;?></a></li>
									<?}?>
								</ul>
							 </li>
						  </ul>
					   </li>
					</ul>
				</div>
			</div>
			<!--셀렉트메뉴-->
	</div>

<script language="javascript">
	<!--
	function link_change(value) {
		location.href=value;
	}
	//-->
</script>
