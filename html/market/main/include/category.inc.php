<!--서브페이지 샵 페이지 상단 PC용 카테고리 시작-->
<script language="javascript">
	<!--
	function onoffbutton(){
		if(document.getElementById('category_list').style.display=="none"){
			document.getElementById('category_list').style.display='';
			document.getElementById('category_onoff').innerHTML="<div class='category_onoff_bg_off' title='닫기'></div>";
			SaveCookie("CATEGORY_LIST_COOKIE", "1", 365);
		}else{
			document.getElementById('category_list').style.display='none';
			document.getElementById('category_onoff').innerHTML="<div class='category_onoff_bg_on' title='카테고리 열기'></div>";
			SaveCookie("CATEGORY_LIST_COOKIE", "2", 365);
		}
	}
	function SaveCookie(name, value, expire) {
		var eDate = new Date();
		eDate.setDate(eDate.getDate() + expire);
		document.cookie = name + '=' + value + '; expires=' + eDate.toGMTString()+ '; path=/';
	}
	window.onload = onoffbutton();
	//-->
</script>
<TABLE class='category_list_box_title'>
	<tr>
		<td id="category_onoff" onclick="onoffbutton()">
			<?if($HTTP_COOKIE_VARS['CATEGORY_LIST_COOKIE']!="1"){?><div class="category_onoff_bg_on" title='카테고리 열기'></div><?}else{?><div class="category_onoff_bg_off" title='닫기'></div><?}?>
		</td>
	</tr>
</table>
<div style="display:none;">
	<span>대분류명</span><span><?=$cate1_name?></span>
	<span>중분류명</span><span><?=$cate2_name?></span>
	<span>소분류명</span><span><?=$cate3_name?></span>
</div>
<TABLE width='100%' id="category_list" class='category_list_box_out' style="display:<?if($HTTP_COOKIE_VARS['CATEGORY_LIST_COOKIE']!="1"){?>none<?}else{?><?}?>">
<tr>
	<td>
		<TABLE width='100%' class='category_list_box_in'>
			<?
			$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
			while( $part1_row = @mysqli_fetch_object($part1_result) ) {
				$sub_cnt2 .= $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
			}
			$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
			// 주메뉴
			if($sub_cnt2==0){
			echo "<tr>";
			$new_cnt = 0;
			$new_tr = 0;
			$td_width = 6;
			while( $part1_row = @mysqli_fetch_object($part1_result) ) {
				$itemcnt = $db->cnt("cs_goods", "where part_idx=$part1_row->idx and display=1");
			$new_cnt++;
			?>
				<td class="category_list_1th_in" width="<? $width_td = 100/$td_width; echo($width_td."%");?>"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?></a></td>
			<? if (($new_cnt % $td_width) == 0) { $new_tr++;?>
			</tr>
			<tr>
			<?}}?>
			<? $new_td = $td_width - ($new_cnt%$td_width);	for($i=0; $i<$new_td; $i++) { if( $new_cnt != $td_width * $new_tr) {?>
				<!-- 반복 생성 -->
				<td width="<? $width_td = 100/$td_width; echo($width_td."%");?>" class="category_list_1th_in">
					&nbsp;
				</td>
			<?}}
			}else{
			while( $part1_row = @mysqli_fetch_object($part1_result) ) {
			//1차/2차 메뉴
			$part2_result = $db->select( "cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
			$sub_cnt2 = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
			$depth3_cnt2 = $db->cnt("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code'");
			$new1_cnt = 0;
			$new1_tr = 0;
			$td1_width = 5;
			if(!$depth3_cnt2){
			$itemcnt = $db->cnt("cs_goods", "where part_idx=$part1_row->idx and display=1");
			?>
			<tr>
				<td class='category_list_1th' width="15%"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?> <?if($itemcnt){?>(<font color='EC7777'><?=$itemcnt?></font>)<?}?></a><?if($sub_cnt2){?><?}?></td>
				<td class='category_list_1th_in' colspan="2">
					<?if($sub_cnt2){?>
					<table width="100%">
						<tr>
							<?
							while( $part2_row = @mysqli_fetch_object($part2_result) ) {
							$new1_cnt++;
							$itemcnt = $db->cnt("cs_goods", "where part_idx=$part2_row->idx and display=1");
							?>
							<td height="20" class='category_list_2th_in1' width="<?echo(100/$td1_width."%");?>"><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?> <?if($itemcnt){?>(<font color='EC7777'><?=$itemcnt?></font>)<?}?></a></td>
							<? if (($new1_cnt % $td1_width) == 0) { $new1_tr++;?>
						</tr>
						<tr>
							<?}}?>
							<? $new1_td = $td1_width - ($new1_cnt%$td1_width);	for($i=0; $i<$new1_td; $i++) { if( $new1_cnt != $td1_width * $new1_tr) {?>
							<!-- 반복 생성 -->
							<td width="<? $width1_td = 100/$td1_width; echo($width1_td."%");?>" class='category_list_3th_in' align="center">
								&nbsp;
							</td>
							<?}}?>
						</tr>
					</table>
					<?}else{?>
					<table width="100%">
						<tr>
							<?for($i=0; $i<$td1_width; $i++) { ?>
							<!-- 반복 생성 -->
							<td class='category_list_3th_in_space' width="<?echo(100/$td1_width."%");?>" align="center">
								&nbsp;
							</td>
							<?}?>
						</tr>
					</table>
					<?}?>
				</td>
			</tr>
			<?
			}
			else{
			while( $part2_row = @mysqli_fetch_object($part2_result) ) {
				$rowcnt++;
			?>
			<tr>
				<?if($rowcnt==1){?>
				<td class='category_list_1th' width="<?echo(100/$td_width."%");?>" rowspan="<?=$sub_cnt2?>"><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>"><?=$part1_row->part_name;?></a></td>
				<?}?>
				<td class='category_list_1th_in' width="<?echo(((100/$td1_width)-3)."%");?>"><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><?=$part2_row->part_name;?></a></td>
				<td class='category_list_1th_in'>
					<!--3차메뉴시작-->
					<?
					$part3_cnt = $db->cnt( "cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code'");
					if($part3_cnt){?>
					<table width="100%">
						<tr>
							<?
							//3차 서브메뉴
							$part3_result = $db->select( "cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code' order by part_ranking asc");
							$new2_cnt = 0;
							$new2_tr = 0;
							$td2_width = 4;
							while( $part3_row = @mysqli_fetch_object($part3_result) ) {
							$new2_cnt++;
							$itemcnt = $db->cnt("cs_goods", "where part_idx=$part3_row->idx and display=1");
							?>
							<td class='category_list_3th_in' width="<?echo(100/$td2_width."%");?>"><a href="<?if($part3_row->url){?><?=$part3_row->url?><?}else{?>product_list.php?part_idx=<?=$part3_row->idx;?><?}?>"><?=$part3_row->part_name;?> <?if($itemcnt){?>(<font color='EC7777'><?=$itemcnt?></font>)<?}?></a></td>
							<? if (($new2_cnt % $td2_width) == 0) { $new2_tr++;?>
						</tr>
						<tr>
							<?}}?>
							<? $new2_td = $td2_width - ($new2_cnt%$td2_width);	for($i=0; $i<$new2_td; $i++) { if( $new2_cnt != $td2_width * $new2_tr) {?>
							<!-- 반복 생성 -->
							<td class='category_list_3th_in_space2' width="<? $width2_td = 100/$td2_width; echo($width2_td."%");?>" align="center">
								&nbsp;
							</td>
							<?}}?>
						</tr>
					</table>
					<?}else{?>
					<table width="100%">
						<tr>
							<?for($i=0; $i<$td2_width; $i++) { ?>
							<!-- 반복 생성 -->
							<td class='category_list_3th_in_space' width="<?echo(100/$td2_width."%");?>" align="center">
								&nbsp;
							</td>
							<?}?>
						</tr>
					</table>
					<?}?>
				</td>
			</tr>
			<?} $rowcnt=0; ?>
			<?}?>
			<!--2차메뉴끝-->
			<?}?>
			<?}?>
		</table>
		</td>
	</tr>
</table>
<!--PC용 카테고리 End-->
<style>
/*모바일-메뉴ON OFF버튼처리  css/mtree.css */
.accordion_box {
	padding:0
}
.onoffswitch {
    position: relative;
	width: 100%;
    -webkit-user-select:none;
	-moz-user-select:none;
	-ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block;
	overflow: hidden;
	cursor: pointer;
    border: 0;
	border-radius: 2px 2px 0px 0px;
}
.onoffswitch-inner {
    display: block;
	width: 200%;
	margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s;
	-webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s;
	transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block;
	float: left;
	width: 50%;
	height: 40px;
	padding: 0;
	line-height: 40px;
	color: #fff;
    -moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "카테고리 닫기";
    padding-left: 10px;
    background-color: #6A9BEA;
	color: #FFFFFF;
	text-align: left;
	font-family:'RixSGo B', "NanumBarunGothicBold", "Dotum", "Tahoma", "Helvetica", sans-serif;
	font-size:11pt;
	float:left;
	letter-spacing: -1px;
}
.onoffswitch-inner:after {
    content: "카테고리 열기";
    padding-left: 10px;
    background-color: #6A9BEA;
	color: #FFFFFF;
	text-align: left;
	font-family:'RixSGo B', "NanumBarunGothicBold", "Dotum", "Tahoma", "Helvetica", sans-serif;
	font-size:11pt;
	float:left;
	letter-spacing: -1px;
}
.onoffswitch-switch {
	display: block;
	position:absolute;
	right:0;top:0;
	width:40px;
	height:40px;
	background: #8DB8FC;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner2 {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}
.onoffswitch_font {
	font-size:10pt;
	letter-spacing: -0.1em;
}
/*모바일-메뉴ON OFF버튼처리 End*/
</style>
<!--Mobile용 카테고리 시작 css/mtree.css -->
<div class='category_list_box_mobile'>
	<div class=" accordion_example2"><!-- 모바일에서메뉴열기닫기시작 -->
		<div class="accordion_box acc_head stopmenuM">
			<div></div>
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
				<label class="onoffswitch-label" for="myonoffswitch">
					<span class="onoffswitch-inner"></span>
					<p><span class="onoffswitch-switch"></span></p>
				</label>
			</div>
		</div>
		<div class="acc_content" style="display:none">
		  <ul class="mtree transit">
				<?
				$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
				// 주메뉴
				while( $part1_row = @mysqli_fetch_object($part1_result) ) {
				$depth2_cnt = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
				// 카테고리 이미지 출력
				if( $part1_row->list_display_check == 1 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; }
				// 카테고리 목록이미지 출력(마우스 롤오버)
				if( $part1_row->list_display_check == 2 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; $P2_images = "../data/designImages/".$part1_row->list_display_images2; }
				if(!$depth2_cnt){
				?>
				<li>
					<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>">
					- <?=$part1_row->part_name;?>
					</a>
				</li>
				<?}else{?>
				<li>
					<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>">
					- <?=$part1_row->part_name;?>
					</a>
					<ul>
						<?
						//중분류 정보
						$part2_result = $db->select("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
						while($part2_row = mysqli_fetch_object($part2_result)){
							$depth3_cnt = $db->cnt("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code'");
							if(!$depth3_cnt){
							?>
							<li><a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>" class="menu-link2"><i class='fa-caret-right fa-chevron-right_tepfont'></i><?=$part2_row->part_name;?></a></li>
							<?}else{?>
							<li>
							<a href="<?if($part2_row->url){?><?=$part2_row->url?><?}else{?>product_list.php?part_idx=<?=$part2_row->idx;?><?}?>"><i class='fa-caret-right fa-chevron-right_tepfont'></i><?=$part2_row->part_name;?></a>
							<ul>
								<?
								//세세분류 정보
								$part3_result = $db->select("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code' order by part_ranking asc");
								while($part3_row = mysqli_fetch_object($part3_result)){
								?>
								<li><a href="<?if($part3_row->url){?><?=$part3_row->url?><?}else{?>product_list.php?part_idx=<?=$part3_row->idx;?><?}?>">- <?=$part3_row->part_name;?></a></li>
								<?}?>
							</ul>
							</li>
							<?}?>
						<?}?>
					</ul>
				</li>
				<?}}?>
		</ul>
		</div>
	</div><!-- //모바일에서메뉴열기닫기end  css/mtree.css -->
</div>
<script src='js/jquery.velocity.min.js'></script>
<script src="js/mtree.js"></script>
<!--Mobile용 카테고리 End  css/mtree.css-->