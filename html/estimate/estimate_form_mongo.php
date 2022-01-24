<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$g5['title'] = '견적신청';
include_once('./_head.php');

$sql = " select a.*, concat(substr(nickname,1,1),'**') as nickname1, concat('<p>',replace(a.content,'\n','</p><p>'),'</p>') as content1  from {$g5['estimate_list']} a where idx =  '$idx'	 ";

$master = sql_fetch($sql);

$sql = "update g5_notify set read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx = '$idx' ";

sql_query($sql);

if($master['sub_key'] !='0'){
	$sql = " select count(*) as cnt from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	$detail_cnt = sql_fetch($sql);
	$detailCnt = $detail_cnt['cnt'];
	$sql = " select * from {$g5['estimate_list_multi']} where sub_key = '{$master['sub_key']}'  ";
	if($detail_cnt['cnt'] == 1 && $master['e_type'] == "2"){
		$detail = sql_fetch($sql);
	}else{
		$detail = sql_query($sql);
	}
}

$e_type = $master['e_type'];

$request_yn = "N";
$sql = " select * from {$g5['estimate_request']} a where estimate_idx =  '$idx' and rc_email = '{$member['mb_email']}' ";

$er = sql_fetch($sql);
if($er){
	$request_yn = "Y";
}

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
<link rel="stylesheet" type="text/css" href="/share/css/jquery.bxslider.css"/>

<style type="text/css">


	.pager_wrap .bx-wrapper{max-width: 150px !important;}
	ul#bx-pager li{max-height: 150px; max-width: 150px;}
	.swiper-slide{text-align: center;}
	.swiper-slide a{width: 100%;}
	#modal_price #desc{font-size:15px; white-space: nowrap;}
	@media(min-width: 768px){
		.bx-wrapper{max-height: 350px;}
	.bx-wrapper img{width: 350px; height: 350px;}
	#mob_view_slider li a img{height: 350px;}
	#bx-pager img{max-height: 64px;}
	}

	.pager_wrap .bx-wrapper {max-width: 340px !important;}

	@media(max-width: 768px){
		#modal_price #desc{font-size:13px;}

	}
</style>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">견적현황</h1>
		</div><!-- sub_title -->
		<div id="board">
			<div class="view">

				<div class="mob">
					<div class="mob_slider swiper-container">
						<ul id="mob_view_slider" class="swiper-wrapper">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);

								for ($i=0; $row1=sql_fetch_array($photo); $i++) {

									// 썸네일
									$srcfile = G5_DATA_PATH."/estimate/".$row1['photo'];
									$filename = basename($srcfile);
									$filepath = dirname($srcfile);
									$thumb = thumbnail($filename, $filepath, $filepath, '342', '350', false);
									$dir_path = explode("/", $row1['photo']);
									$thumb_img = "<img src='/data/estimate/".$dir_path[0]."/".$dir_path[1]."/".$dir_path[2]."/".$thumb."'>";

									echo '<li class="swiper-slide"><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.$thumb_img.'</a></li>';
								}
							?>
						</ul>
						<div class="text" id="mobileEtype"><?php echo get_etype($master['e_type']);?></div>
				    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
					</div>

					<div class="text-center mob_ing" id="mobileStatus">
						<?php echo get_estimate_mobile_state_tag($master['state']);?>
					</div>


					<div class="mob_info">
						<ul class="row"  id="mobileInfo1">

						<li class='col-xs-6'><p class='text-center main_co'><i class='xi-calendar-check'></i> 견적마감일</p>
						<p class='text-center'>
						<?php
						if(intval(strtotime($master['deadline'])-strtotime(date("Y-m-d"))) == 0){
							echo $master['deadline'];
						}else{
							echo 'D-' . floor(intval(strtotime($master['deadline'])-strtotime(date("Y-m-d"))) / 86400);
						} ?>
						</p>
						</li>
						<?php

						echo "<li class='col-xs-6'>";
						echo "<p class='text-center main_co'><i class='xi-money'></i> 내견적가</p>";
						echo "<p class='text-center'>견적에 참여하세요</p>";
						echo "</li>";
					?>
						</ul>
					</div>

					<div class="customer"  id="mobileInfo2">
						<?php
						echo "<dt class='col-xs-4 main_co'>";
						if($master['e_type'] == "2"){
							echo "철거요청일";
						}else{
							echo "수거요청일";
						}
						echo "</dt><dd class='col-xs-8'>".$master['pickup_date']."</dd>";
						?>
						<?php
							echo "<dt class='col-xs-4 main_co'>지역</dt>";
							echo "<dd class='col-xs-8'>".$master['area1']." ".$master['area2']."</dd>";
							echo "<dt class='col-xs-4 main_co'>층수</dt>";
							echo "<dd class='col-xs-8'>".$master['elevator_yn']."/".$master['floor']."</dd>";
						?>
						<?php
							if($master['attach_file']){
								echo "<dt class='col-xs-4 main_co'>파일</dt><dd class='col-xs-8'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
							}
						?>
					</div>

					<div class="customer" id="mobileButton">
						<?php
							if($master['e_type'] == "2"){
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
								echo "</li>";
								echo "</ul>";
							}else{
								echo "<ul class='row'>";
								echo "<li class='col-xs-6'>";
								if($master['e_type'] == "1"){
									echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
								}
								echo "</li>";
								echo "<li class='col-xs-6'>";
								echo "<a class='main_bg' href='javascript:doPrice()'>견적 참여하기</a>";
								echo "</li>";
								echo "</ul>";
							}
						?>
					</div>
				</div>

				<table class="web">
					<tr>
						<th class="photo">
							<ul id="view_slider">
							<?php
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo = sql_query($sql);
                                                                $p_cnt = mysqli_num_rows($photo);
                                                                
                                                                if($p_cnt == "0"){
                                                                    $imgsql = " select attach_file from {$g5['estimate_list']} where idx = '$idx' ";
                                                                    $imgphoto = sql_query($imgsql);
                                                                    $row1 = sql_fetch_array($imgphoto);
                                                                    
                                                                    $file_ext = strtolower(preg_replace('/^.+\.([^\.]{1,})$/','\\1',$row1['attach_file'])); //file 확장자 추출
                                                                    if(!$file_ext == "jpg" || !$file_ext == "jpeg" || !$file_ext == "peg" || !$file_ext == "png" || !$file_ext == "gif" || !$file_ext == "bmp"){
                                                                        echo "<script>console.log('등록된 이미지 파일이 없습니다.')</script>";
//                                                                        exit();
                                                                    }
                                                                    $srcimg = "<img src='/data/estimate/".$row1['attach_file']."' width=342 height=350>";
                                                                    
                                                                    echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$row1['attach_file'].'" target="_blank">'.$srcimg.'</a></li>';
                                                                }else{
                                                                    
                                                                    for ($i=0; $row1=sql_fetch_array($photo); $i++) {
                                                                            // 썸네일
                                                                            $srcfile = G5_DATA_PATH."/estimate/".$row1['photo'];
                                                                            $filename = basename($srcfile);
                                                                            $filepath = dirname($srcfile);
                                                                            $thumb = thumbnail($filename, $filepath, $filepath, '342', '350', false);
                                                                            $dir_path = explode("/", $row1['photo']);
                                                                            $thumb_img = "<img src='/data/estimate/".$dir_path[0]."/".$dir_path[1]."/".$dir_path[2]."/".$thumb."'>";

                                                                            echo '<li><a href="'.G5_DATA_URL.'/estimate/'.$row1['photo'].'" target="_blank">'.$thumb_img.'</a></li>';
                                                                    }
                                                                }
							?>
							</ul>
							<div class="pager_wrap">
								<ul id="bx-pager">
								<?php
									$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
									$photo = sql_query($sql);
                                                                        $p_cnt = mysqli_num_rows($photo);
                                                                
                                                                        if($p_cnt == "0"){
                                                                            $imgsql = " select attach_file from {$g5['estimate_list']} where idx = '$idx' ";
                                                                             $imgphoto = sql_query($imgsql);
                                                                             $row1 = sql_fetch_array($imgphoto);

                                                                             $file_ext = strtolower(preg_replace('/^.+\.([^\.]{1,})$/','\\1',$row1['attach_file'])); //file 확장자 추출
                                                                             if(!$file_ext == "jpg" || !$file_ext == "jpeg" || !$file_ext == "peg" || !$file_ext == "png" || !$file_ext == "gif" || !$file_ext == "bmp"){
                                                                                 echo "<script>console.log('등록된 이미지 파일이 없습니다.')</script>";
//                                                                                 exit();
                                                                             }
                                                                            $srcimg = "<img src='/data/estimate/".$row1['attach_file']."'>";
                                                                            
                                                                            echo '<li><a data-slide-index="0" href="">'.$srcimg.'</a></li>';
                                                                        }else{
                                                                            for ($i=0; $row1=sql_fetch_array($photo); $i++) {
                                                                                    // 썸네일
                                                                                    $srcfile = G5_DATA_PATH."/estimate/".$row1['photo'];
                                                                                    $filename = basename($srcfile);
                                                                                    $filepath = dirname($srcfile);
                                                                                    $thumb = thumbnail($filename, $filepath, $filepath, '64', '64', false);
                                                                                    $dir_path = explode("/", $row1['photo']);
                                                                                    $thumb_img = "<img src='/data/estimate/".$dir_path[0]."/".$dir_path[1]."/".$dir_path[2]."/".$thumb."'>";

                                                                                    echo '<li><a data-slide-index="'.$i.'" href="">'.$thumb_img.'</a></li>';
                                                                            }
                                                                        }
								?>
								</ul>
							</div>
						</th>
						<td class="info" id="mainTitle">
							<h1><?php echo get_etype($master['e_type']); ?></h1>
							<dl>
								<dt class="col-xs-3">제목</dt><dd class="col-xs-9"><?php echo $master['title']; ?></dd>
								<dt class="col-xs-3">고객</dt><dd class="col-xs-9"><?php echo $master['nickname1']; ?></dd>
								<dt class="col-xs-3">지역</dt><dd class="col-xs-9"><?php echo $master['area1']; ?> <?php echo $master['area2']; ?></dd>
								<dt class="col-xs-3">층수</dt><dd class="col-xs-9"><?php echo $master['elevator_yn']; ?>/<?php echo $master['floor']; ?></dd>
								<dt class="col-xs-3">견적마감일</dt><dd class="col-xs-9"><?php
									if(intval(strtotime($master['deadline'])-strtotime(date("Y-m-d"))) == 0){
										echo $master['deadline'];
									}else{
										echo 'D-' . floor(intval(strtotime($master['deadline'])-strtotime(date("Y-m-d"))) / 86400);
									} ?></dd>
							<?php
								if($e_type == "2"){
									echo "<dt class='col-xs-3'>철거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}else{
									echo "<dt class='col-xs-3'>수거요청일</dt><dd class='col-xs-9'>".$master['pickup_date']."</dd>";
								}
							?>
							</dl>
							<?php
								if($master['attach_file']){
									echo "<dt class='col-xs-3'>첨부파일</dt><dd class='col-xs-9'><a href='".G5_DATA_URL.'/estimate/'.$master['attach_file']."' style='height:23px;line-height:25px;'>다운로드</a></dd>";
								}
							?>
							<?php
								if($master['e_type'] == "2"){
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doPriceDetail()'>견적 참여하기</a>";
									echo "</li>";
									echo "</ul>";
								}else{
									echo "<ul class='row'>";
									echo "<li class='col-xs-6'>";
									if($master['e_type'] == "1"){
										echo "<a class='main_bg' href='javascript:doMeet()'>방문견적</a>";
									}
									echo "</li>";
									echo "<li class='col-xs-6'>";
									echo "<a class='main_bg' href='javascript:doPrice()'>견적 참여하기</a>";
									echo "</li>";
									echo "</ul>";
								}
							?>
						</td>
					</tr>
				</table>

				<h1 class="tt">상세정보</h1>

				<table class="requst_list" id="subDetail">
				<?php
					if($e_type == "0" || ($e_type == "2" && $detailCnt == 1 & $master['test_type'] != "B" )){
						echo "<colgroup>";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "<col style='width: 20%' />";
						echo "<col style='width: 30%' />";
						echo "</colgroup>";
						if($e_type == "0"){
							echo "<tr>";
							echo "<th>품목</th><td>".$master['item_cat']." ".$master['item_cat_dtl']."</td>";
							echo "<th>제조사</th><td>".$master['manufacturer']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>모델명</th><td>".$master['medel_name']."</td>";
							echo "<th>연식</th><td>".$master['year']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
							echo "</tr>";
						}else{
							echo "<tr>";
							echo "<th>철거종류</th><td>".$detail['pull_kind']."</td>";
							echo "<th>천장/바닥 철거</th><td>".$detail['pull_floor_bottom']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>철거평수</th><td>".$detail['pull_space']."</td>";
							echo "<th>철거사이즈</th><td>".$detail['pull_size']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
							echo "</tr>";
						}
					}

					if($master['test_type'] == "B"){
						if($e_type == "2"){
							$pull_kind_etc = "";
							if($master['pull_kind_etc']){
								$pull_kind_etc = ','.$master['pull_kind_etc'];
							}
							echo "<tr>";
							echo "<th>철거종류</th><td>".$master['pull_kind'].$pull_kind_etc."</td>";
							echo "<th>천장/바닥 철거</th><td>".$master['pull_floor_bottom']."</td>";
							echo "</tr>";
						}
						if($e_type == "1" || $e_type == "2"){
							echo "<tr>";
							echo "<th>참고사항</th><td colspan='3'>".$master['content1']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>

				<table class="requst_list02" id="subList">
				<?php
					if(($e_type == "1" || ($e_type == "2" && $detailCnt > 1)) && $master['test_type'] != "B"){
						if($e_type == "1"){
							echo "<colgroup class='web_col'>";
							echo "<col style='width: 10%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 15%' />";
							echo "<col style='width: 15%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th class='web_td'>품목</th>";
							echo "<th>세부카테고리</th>";
							echo "<th>제조사</th>";
							echo "<th>모델명</th>";
							echo "<th>년식</th>";
							echo "<th>수량</th>";
							echo "</tr>";
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td class='web_td'>".$row['item_cat']."</td>";
								echo "<td>".$row['item_cat_dtl']."</td>";
								echo "<td>".$row['manufacturer']."</td>";
								echo "<td>".$row['medel_name']."</td>";
								echo "<td>".$row['year']."</td>";
								echo "<td>".$row['item_qty']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td class='web_td' colspan='5'>".$master['content1']."</td>";
							echo "<td class='mob_td' colspan='4'>".$master['content1']."</td>";
							echo "</tr>";
						}else{
							echo "<colgroup>";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 30%' />";
							echo "<col style='width: 20%' />";
							echo "<col style='width: 20%' />";
							echo "</colgroup>";
							echo "<tr>";
							echo "<th>철거종류</th>";
							echo "<th>천장/바닥 철거 유뮤</th>";
							echo "<th>철거평수</th>";
							echo "<th>철거사이즈</th>";
							echo "</tr>";
							for ($i=0; $row=sql_fetch_array($detail); $i++) {
								echo "<tr>";
								echo "<td>".$row['pull_kind']."</td>";
								echo "<td>".$row['pull_floor_bottom']."</td>";
								echo "<td>".$row['pull_space']."</td>";
								echo "<td>".$row['pull_size']."</td>";
								echo "</tr>";
							}
							echo "<tr>";
							echo "<th>참고사항</th>";
							echo "<td colspan='3'>".$master['content1']."</td>";
							echo "</tr>";
						}
					}
				?>
				</table>
				<?php
					$sql = " select count(*) as cnt from {$g5['estimate_propose']} where estimate_idx = '$idx' and ISNULL(content) != '' ";
					$request_cnt = sql_fetch($sql);
					if($request_cnt['cnt'] > 0){
						$sql = " select * from {$g5['estimate_propose']} where estimate_idx = '$idx' and ISNULL(content) != '' ";
						$request_list = sql_query($sql);
						echo '<div class="text_note">';
						echo '<h1>업체 견적 참고사항</h1>';
						for ($i=0; $row=sql_fetch_array($request_list); $i++) {
							echo '<p>'.$row['rc_nickname'].' - '.$row['content'].'</p>';
						}
						echo '</div>';
					}
				?>
			</div><!-- view -->

			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-3 col-xs-offset-9 col-md-1 col-md-offset-11">
						<a class="main_bg" href="./estimate_list2.php">리스트</a>
					</li>
				</ul>
			</div>

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->


<div class="modal fade" id="modal_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="frmprice" action="<?php echo G5_URL; ?>/estimate/estimate_form_price_update_test.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="idx" value="<?php echo $idx; ?>">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="tit_modal">
					<p class="main_co">희망 견적가격을 입력하세요</p>
				</div>
				<?php if($e_type == "0"){ ?>
				<style type="text/css">
					.sell_price{display: none;}
				</style>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" checked="" id="buy" name="sell" value="0" ><i><p>매입</p></i></label>
						</li>
						<li class="col-xs-6">
							<label style="width: 100%;" class="box">
								<input type="radio" id="sell" name="sell" value="1" ><i><p>폐기</p></i></label>
						</li>
					</ul>
					<p id="desc" style="margin-top: 5px; text-align: right;">매입 및 무료수거 불가 할 시에만 폐기 견적을 넣어주세요.</p>

				</div>
				<?php } ?>
				<div class="form-group buy_price">
					<ul class="row">
						<li class="col-xs-3 title">
							매입가
						</li>
						<li class="col-xs-9">
							<input type="hidden" id="chk_free" name="chk_free" value="0">
							<input type="hidden" id="year" name="year" value="<?php echo $master['year']?>">
							<input type="hidden" id="brand" name="brand" value="<?php echo $master['manufacturer']?>">
							<input type="hidden" id="model_code" name="model_code" value="<?php echo $master['medel_name']?>">
							<input type="hidden" id="model_name" name="model_name" value="<?php echo $master['medel_name']?>">
							<input type="hidden" id="category2" name="category2" value="<?php echo $master['item_cat']?>">
							<input type="hidden" id="category3" name="category3" value="<?php echo $master['item_cat_dtl']?>">
							<input type="number" class="input_default" id="price" name="price">
						</li>
					</ul>
				</div>

				<div class="form-group sell_price">
					<ul class="row">
						<li class="col-xs-3 title">
							폐기가
						</li>

						<li class="col-xs-9">
							<input type="number" class="input_default" id="price_pe" name="price_pe">

						</li>
					</ul>
					<?php if($e_type=="1") {?>
							<p id="desc" style="margin-top: 5px; text-align: right;">매입만, 폐기만 각각 따로 또는 함께 견적이 가능합니다.</p>
						<?php } ?>
				</div>
				<div class="form-group">
					<ul class="row">
						<li class="col-xs-3 title">
							참고사항
						</li>
						<li class="col-xs-9">
							<textarea placeholder="견적내역에 대해 고객이 참고할 사항이 있으면 함께 작성해 주세요." id="content" name="content"></textarea>
						</li>
					</ul>
				</div>
				<div class="btn_wrap">
					<ul class="row">
					<?php
						if($request_yn == "Y"){
					?>
						<li class="col-xs-3"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-3"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-3"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">수거불가</a></li>
						<li class="col-xs-3"><a href="javascript:doSavePrice();" class="main_bg">확인</a></li>
						
					<?php
						}else{
							if($e_type == "1"){
                    ?>
					  	<!-- <li class="col-xs-12">
							<div class="box-file-input">
								<label>
									<input type="file" id="attach_file1" name="attfile" class="file-input" accept="image/*">
								</label>
								<span id="attfilename1" class="filename">파일을 선택해주세요.</span>
							</div>
						</li> -->
					<?php
						}
					?>

						<!-- <a class="main_bg1" href="#." data-dismiss="modal">파일 업로드</a></li> -->
						<li class="col-xs-4"><a class="line_bg" href="#." data-dismiss="modal">닫기</a></li>
						<li class="col-xs-4"><a href="javascript:doPriceZero()" class="sub_bg">무료수거</a></li>
						<li class="col-xs-4"><a href="javascript:doSavePrice();" class="main_bg">확인</a></li>
					<?php
						}
					?>
					</ul>
				</div>
				</form>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 선택 -->
<div class="modal fade modal_table" id="modal_price_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">상세견적서</h4>
			</div>
			<div class="modal-body">
				<form name="frmpricedetail" action="<?php echo G5_URL; ?>/estimate/estimate_form_price_detail_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="idx" value="<?php echo $idx; ?>">
					<div class="form-group">
						<ul class="row">
							<li class="col-xs-5 title gray_bg">
								총 견적 (공금가+세액)
							</li>
							<li class="col-xs-7">
								<div id="divTotalAmt" style="margin-top: 11px; margin-left: 10px;">0 원</div>
								<input type="hidden" id="totalAmt" name="total_amt">
							</li>
						</ul>
					</div>

					<div class="form-group" style="border-bottom: 0;">
						<table>
							<tr>
								<th>품목</th>
								<th>내역</th>
								<th>공급가액</th>
								<th>세액</th>
							</tr>
							<tbody id="itemList"></tbody>

						</table>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="col-xs-12">
								<p style="margin-bottom: 10px;">고객참고사항</p>
								<textarea id="content" name="content" style="padding: 5px; color:gray;" placeholder="고객이 견적에 참고할 내역을 작성해 주세요."></textarea>
							</li>
						</ul>
					</div>

					<div class="btn_wrap">
						<ul class="row">
						<?php
							if($request_yn == "Y"){
						?>
							<li class="col-xs-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-4"><a href="javascript:doNotRequest()" style="background:#da1a1a; color:#fff;">철거불가</a></li>
							<li class="col-xs-4"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						<?php
							}else{
						?>
							<li class="col-xs-12">
								<div class="box-file-input">
									<label>
										<input type="file" id="attach_file2" name="attfile" class="file-input" accept="image/*">
									</label>
									<span id="attfilename2" class="filename">파일을 선택해주세요.</span>
								</div>
							</li>
							<li class="col-xs-6"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-6"><a href="#." class="main_bg" onClick="doSavePriceDetail();">확인</a></li>
						<?php
							}
						?>

						</ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</div><!-- 견적 -->
<form name="frmmeet" action="<?php echo G5_URL; ?>/estimate/estimate_form_meet_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="idx" value="<?php echo $idx; ?>">
</form>
<script type="text/javascript" src="/share/js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#attach_file1").bind('change', function() {
		$("#attfilename1").html(this.files[0].name);
	});

	$('input[type=radio][name=sell]').change(function() {
	    if (this.value == '0') {
	        $('.buy_price').css('display','block');
	        $('.sell_price').css('display','none');
	        $('#desc_pe').css('display','none');
	        $("#price").val('');
	        $("#price_pe").val('');
	    }
	    else if (this.value == '1') {
	        $('.buy_price').css('display','none');
	        $('.sell_price').css('display','block');
	        $('#desc_pe').css('display','block');
	        $("#price").val('');
	        $("#price_pe").val('');
	    }
	});

	$("#attach_file2").bind('change', function() {
		$("#attfilename2").html(this.files[0].name);
	});
	$('#view_slider').bxSlider({
		auto: false,					// 자동 슬라이드 사용여부
		controls: false,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : true,
		pagerCustom:'#bx-pager',
		loop:false
	});

	$('#bx-pager').bxSlider({
		minSlides : 1,
		maxSlides : 5,
		slideWidth : 64,
		slideMargin : 5,
		controls: true,
		pager : false
	});

/*	$('#mob_view_slider').bxSlider({
		auto: true,					// 자동 슬라이드 사용여부
		controls: true,				// 양옆컨트롤(prev/next) 사용여부
		speed: 1000,
		preloadImages: 'all',
		pager : false,
	});
    */

	$("#price").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});

	var vHtml = "";
	for(var i=1; i<=5; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vItemId = "item"+vId;
		var vDescId = "desc"+vId;
		var vAmtId = "amt"+vId;
		var vVatId = "vat"+vId;
		vHtml += "<tr>";
		vHtml += '<td><input type="text" id="'+vItemId+'" name="'+vItemId+'"></td>';
		vHtml += '<td><input type="text" id="'+vDescId+'" name="'+vDescId+'"></td>';
		vHtml += '<td><input type="number" id="'+vAmtId+'" name="'+vAmtId+'"></td>';
		vHtml += '<td><input type="text" id="'+vVatId+'" name="'+vVatId+'"></td>';
		vHtml += "</tr>";
	}
	$("#itemList").html(vHtml);
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vAmtId = "#amt"+vId;
		var vVatId = "#vat"+vId;

		$(vAmtId).inputFilter(function(value) {
			  return /^\d*$/.test(value);
		});

		$(vAmtId).focus(function() {
			 // $(this).val(cfnNumberRemoveComma($(this).val()));
			 $(this).val($(this).val());
		});

		$(vAmtId).blur(function() {
			var amtId = $(this).attr("id");
			var vatId = "#"+amtId.replace("amt","vat");
			var vAmt = $(this).val();
			if(vAmt)
			{
				var vVat = Math.round(vAmt * 0.1);
				/*$(this).val(cfnNumberComma(vAmt));
				$(vatId).val(cfnNumberComma(vVat));*/
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
	$(".swiper-slide a").lightbox();
	$("#view_slider a").lightbox();
});

function doPrice()
{
	var vPoint = "<?php echo $member['mb_point']; ?>";
	/*
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}
	*/
	
	$('#modal_price').modal();
}


function  doCancelPrice()
{
	$('#modal_price').modal("hide");
}

function doPriceZero()
{
	var f = document.frmprice;
	f.price.value = "0"	;
	f.chk_free.value = "1"	;
	f.submit();
}

function doSavePrice()
{
	var f = document.frmprice;

	if( $(".sell_price").is(':visible') && $(".buy_price").is(':visible') == false ){
		if(!cfnNullCheckInput($("#price_pe").val(), "폐기가")) return;
	}
	if( $(".sell_price").is(':visible') == false && $(".buy_price").is(':visible') ){
		if(!cfnNullCheckInput($("#price").val(), "매입가")) return;
	}

	f.submit();
}


	
function mongoestimate(){
	$.ajax({
		type: "GET",
		url: "<?php echo G5_URL?>/ajax.mongo_estimate.php",
		data: {
			brand: $('#brand').val(),
			model_code: $('#model_code').val(),
			model_name: $('#model_name').val(),
			year: $('#year').val(),
			category2: $('#category2').val(),
			category3: $('#category3').val(),
			price: $('#price').val(),
		}
	});
}

$(function() {
	 	var brand = $('#brand').val();
		var model_code = $('#model_code').val();
		var model_name = $('#model_name').val();
		var year = $('#year').val();
		var category2 = $('#category2').val();
		var category3 = $('#category3').val();
		var price = $('#price').val();
    $('#modal_price_btn').click(function() {
            
       
            
        // ajax 호출을 위한 정보 기입
        var request = $.ajax({
            url: "<?php echo G5_URL?>/ajax.mongo_estimate.php", // 호출 url
            method: "POST", // 전송방식
            data: {brand, model_code, model_name, year, category2, category3, price}, // 파라미터
            dataType: "text" // 전송 받을 타입 ex) xml, html, text, json
        });
             
        // 호출 정상일 시 실행되는 메서드
        request.done(function( data ) {
            console.log(data);
        });
 
        // 호출 에러일 시 실행되는 메서드
        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
 
        // 호출 정상 또는 에러 상관없이 실행
        request.always(function() {
            console.log('완료');
        });
    });
});

function fnCalcAmt()
{
	var totalAmt = 0;
	for(var i=1; i<=11; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		var vAmtId = "#amt"+vId;
		var vVatId = "#vat"+vId;

		var vAmt = 0;
		var vVat = 0;
		if($(vAmtId).val())
		{
			vAmt = parseInt(cfnNumberRemoveComma($(vAmtId).val()));
		}

		if($(vVatId).val())
		{
			vVat = parseInt(cfnNumberRemoveComma($(vVatId).val()));
		}

		totalAmt = totalAmt + vAmt + vVat;
	}
	$("#divTotalAmt").html(cfnNumberComma(totalAmt)+" 원");
	$("#totalAmt").val(totalAmt);
}


function doPriceDetail()
{
	var vPoint = parseInt($("#userPoint").val());
	if(vPoint < 100){
		alert("충전금이 부족하여 견적에 참여하실 수 없습니다.");
		return;
	}


	for(var i=1; i<=5; i++)
	{
		var vId = i;
		if(i<10) vId = "0"+i;

		$("#item"+vId).val("");
		$("#desc"+vId).val("");
		$("#amt"+vId).val("");
		$("#vat"+vId).val("");
	}
	$("#divTotalAmt").html("0 원");
	$("#totalAmt").val("");
	$("#content").val("");
	//$("#discoutContent").val("");

	$('#modal_price_detail').modal();
}

function  doCancelPriceDetail()
{
	$('#modal_price_detail').modal("hide");
}

function doSavePriceDetail()
{
	if($("#totalAmt").val() < 1)
	{
		alert("상세 견적을 입력하십시오.");
		return;
	}

	var f = document.frmpricedetail;
	f.submit();
}

function doMeet()
{
	if(confirm("방문견적을 신청하시겠습니까?"))
	{
		var f = document.frmmeet;
		f.submit();
	}
}

function doNotRequest()
{
	if(confirm("수거불가하시겠습니까?"))
	{
		var f = document.frmmeet;
		f.action = "./estimate_form_not_request_update.php"
		f.submit();
	}
}

function goMove()
{
	location.href="<?php echo G5_URL; ?>/estimate/estimate_list2.php";
}

</script>
<!-- 파일 다운로드 테스트버전 _20200401 -->
<script>
$(document).on("change", ".file-input", function(){
     $filename = $(this).val();
     if($filename == "")
         $filename = "파일을 선택해주세요.";
     $(".filename").text($filename);
 })
</script>
<script type="text/javascript" src="/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
     navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
<?php

include_once('./_tail.php');
?>
<style>
    /*woojin*/
    .customer a {
        display: inherit;
        height: inherit !important;
        line-height: inherit !important;
        text-align: left;
    }
    .customer .row a {
    display: block;
    height: 40px !important;
    line-height: 40px !important;
    text-align: center;
    border-radius: 5px;
    margin-top: 20px;
    }
</style>