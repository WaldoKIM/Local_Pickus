<?php
include_once('./_common.php');


/*if($member['mb_level'] != "0" && $member['mb_level'] != "8"){
	alert("메인 창으로 이동합니다.",G5_URL);
}*/


$g5['title'] = '견적현황';
include_once('./_head.php');

$sql_common = " from
			{$g5['estimate_list']} a
			left join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.selected = '1'
			left join (
				select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
			) c on a.idx = c.estimate_idx 
			where a.email = '{$member['mb_email']}' ";

$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			a.idx,
			b.idx as sub_idx,
			a.title,
			a.area1,
			a.area2,
			a.area3,
			a.state,
			a.photo1,
			a.e_type,
			a.deadline,
			date_format(a.writetime, '%Y.%m.%d') as writetime,
			case when a.selecttime is null then '-' else date_format(a.selecttime, '%Y-%m-%d') end as selecttime,
			case when b.completetime is null then '-' else date_format(b.completetime, '%Y-%m-%d') end as completetime,
			case when trim(ifnull(b.review,'')) = '' then '0' else '1' end as review_yn,
			a.simple_yn
           $sql_common
           order by a.idx desc	
           limit $from_record, $rows ";
$result = sql_query($sql);
$result_fetch = sql_fetch($sql);
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
    #fixed_kakao{display: block !important;}
	.no_photo .info_area{margin-left: 0 !important;}
	.esti_list .req_list{ max-height: 100%;}
	#esti_guide li{margin-bottom: 30px;}
	#esti_guide h4{margin-bottom: 10px;}
	#esti_guide strong{margin: 5px 0;display: block;}
</style>

<div class="member com_pd esti_list">
	<div class="container">

		<div class="sub_title">
			<h1 class="main_co">내 신청현황</h1>
			<h5>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h5>
		</div><!-- sub_title -->
		<div class="form-group">
			<ul class="tab">
				<li class="col-xs-6 main_bg on">
					<a href="#none">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-xs-6">
					<a href="./my_estimate_list_match.php">
						<h4>구매</h4>
					</a>
				</li>
			</ul>
		</div>
		<div class="form-group">
			<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 견적신청 가이드</a>
		</div>
		<div id="board">
			<div class="member">
				
					<?php
    				for ($i=0; $row=sql_fetch_array($result); $i++)
    				{
    					$state = $row['state'];
    					$e_type = $row['e_type'];
    					$simple_yn = $row['simple_yn'];
    					$idx = $row['idx'];
						$sql = "select count(*) as pro_cnt FROM g5_estimate_propose WHERE estimate_idx = $idx AND NOT selected = 2";
						$pro_row = sql_fetch($sql);
						$pro_cnt = $pro_row['pro_cnt'];
    				?>
    				<div class="req_list">
						<div class="status_req"><?php 
						if($e_type==2 && $state == 4){
						echo '철거중';
					}else if($e_type==2 && $state == 5){
						echo '철거완료';
					}else{
						if($e_type == 3 || $e_type == 4 || $simple_yn == "1"){ ?>
								<div class="status_req">상담준비중</div>
						<?php
						}else{
							echo get_estimate_state($state);
						}
					} ?></div>
						<h4 class="title_req"><?php
    						if($simple_yn == "1"){
    							echo '<a class="subject" href="#none">고객 견적상담 드릴 예정 입니다.</a>';
	    					}else if($e_type == 3 || $e_type == 4){
	    						echo '<a class="subject" href="#none">원스톱 중고매입+철거</a>';
	    					}else{
    						?>
    							<a class='subject' href='javascript:doSelectEstimate("<?php echo $row['idx']; ?>","<?php echo $e_type; ?>","<?php echo $state; ?>")'><?php echo $row['title']; ?></a>
    						<?php
	    					}
    						?>
    					</h4>
							<?php if($e_type == 3 || $e_type == 4 || $simple_yn == "1"){ ?>
								<div class="info_req no_photo">
							<?php }else{ ?>
								<div class="info_req">
							<div class="thumb_area">

								<?php  
								
								$sql = " select * from {$g5['estimate_list_photo']} where estimate_idx = '$idx' ";
								$photo_result = sql_fetch($sql);
								
								echo '<img src="/data/estimate/' . $photo_result['photo'] .'">';
    					
								?>
							</div>
							<?php } ?>
							<div class="info_area">
								<?php if($e_type == 3 || $e_type == 4 || $simple_yn == "1"){ ?>
									<div class="ea_req" style="font-size: 13px; margin-bottom: 10px;">빠른 시일내에 연락드리겠습니다.</div>
								<?php }else{ 
									if($state == 3 || $state == 4 || $state == 5){
									?>
										<?php if($row['completetime'] !== '-'){ ?>
											<div class="end_req">수거완료일 : <?php 
												echo $row['completetime'];
												?>
											</div>
										<?php }else{ ?>
											<div class="end_req">견적선택일 : <?php 
												echo $row['selecttime'];
												?>
											</div>
										<?php } 
									}else{ 
										if($state == 6){
											echo '<div class="end_req">견적취소';
										}else{
										?>
										<div class="end_req">견적마감일 : <?php if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) == 0){ echo '오늘';
											}else if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) < 0){
												echo '선택중';	
											}else{
												echo 'D-' . floor(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) / 86400);
											}	
										} ?></div>
								<?php } ?>
									<div class="ea_req">지역 : <?php echo $row['area1'] . ' '.$row['area2']  ; ?></div>
									<div class="ea_req">입찰업체 : <?php echo $pro_cnt; ?></div>

								<?php } ?>
								

								<div class="ea_req">견적요청 : <?php echo get_etype($e_type);?></div>
							</div>
							<?php if($e_type == 3 || $e_type == 4 || $simple_yn == "1"){ ?>
								<div class="btn_req"><a class='main_bg' href='#none'>상담진행 예정</a></div>
							<?php }else{ ?>
								<div class="btn_req"><a class='main_bg' href='javascript:doSelectEstimate("<?php echo $row['idx']; ?>","<?php echo $e_type; ?>","<?php echo $state; ?>")'>견적확인</a>
									<?php
				    					if($row['review_yn'] == "1"){
				    						echo "<a class='end'>후기작성완료</a>";

				    					}else if($state == 5 && $simple_yn == 0){
				    						echo "<a href='#none' class='main_bg' onClick='doReviewEstimate(\"".$row["sub_idx"]."\")' class='ing'>후기작성</a>";
				    					}
				    					
			    					?>
								</div>
							<?php } ?>
							
						</div>
					</div>
    						<!-- <?php echo $row['writetime'];?> -->
    				<?php
    				}
    				if($i == 0){
    					echo '<p style="text-align:center;">견적 내역이 없습니다<a href="/estimate/estimate_register.php" class="main_co"> 견적신청 바로가기</a></p>';
    				}
    				?>
			</div><!-- list -->

			<div id="page">
				<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?page="); ?>
			</div><!-- page -->

		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade" id="modal_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">후기작성</h4>
			</div>
			<div class="modal-body">
				<div id="board">
					<form name="frmreview" action="<?php echo G5_URL; ?>/estimate/my_estimate_list_review_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" id="page" name="page" vaule="<?php echo $page; ?>">
					<input type="hidden" id="sub_idx" name="sub_idx">
					<div class="write">
						<table>
							<colgroup>
								<col style="width: 20%" />
								<col style="width: 80%" />
							</colgroup>
							<tr>
								<th>평점</th>
								<td>
									<select class="input_default" id="score"  name="score">
										<option value="5">5.0/5.0</option>
										<option value="4">4.0/5.0</option>
										<option value="3">3.0/5.0</option>
										<option value="2">2.0/5.0</option>
										<option value="1">1.0/5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>문의내역</th>
								<td>
									<textarea id="review" name="review" required placeholder="내용을 작성해주세요" style="height:200px;"></textarea>
								</td>
							</tr>
						</table>
					</div>

					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="javascript:doCloseReview()" data-dismiss="modal">닫기</a></li>
							<li class="col-xs-3"><a class="main_bg" href="javascript:doSaveReview()" onClick="">확인</a></li>
						</ul>
					</div><!-- btn_wrap -->
					</form>
				</div><!-- board -->						
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 이용후기 -->	

<form name="frmcancel" action="<?php echo G5_URL; ?>/estimate/my_estimate_list_update.php">
	<input type="hidden" id="page" name="page" vaule="<?php echo $page; ?>">
	<input type="hidden" id="idx" name="idx" vaule="idx">
	<input type="hidden" id="state" name="state" vaule="6">
</form>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">견적신청 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<img class="web" src="/img/c_web.png">
						<img class="mobile" src="/img/c_mobile.png">
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 견적 가이드 -->
<script type="text/javascript">
	$(".mob_back").hide();
function doSelectEstimate(idx, eType, state)
{
	if(eType == "3" || eType == "4") return;
	/*
	document.frm.idx.value = idx;
	document.frm.action = "myEstimateDetail.do";
	document.frm.submit();
	*/			
	if(state == "7")
	{
		alert("견적 선택기간이 마감되어 취소 되었습니다.");
		return;
	}
	
	if(state == "6")
	{
		alert("취소된 견적입니다.");
		return;
	}
	
	location.href="./my_estimate_form.php?idx="+idx+"&&page=<?php echo $page; ?>";
}	

function doCancelEstimate(idx)
{
	if(!confirm("견적을 취소하시겠습니까?")) return;

	var f = document.frmcancel;
	f.idx.value = idx;
	f.state.value = "6";
	f.submit();
}

function doReviewEstimate(idx)
{
	$("#sub_idx").val(idx);
	$("#review").val("");
	$("#score").val("5");
	$('#modal_review').modal();
}
function doSaveReview()
{
	
	var f = document.frmreview;
	if(!f.review.value){
		alert("내용을 작성해주세요");
		return;
	}
	f.submit();
}

function doCloseReview()
{
	$('#modal_review').modal("hide");
}
</script>
<?php
include_once('./_tail.php');
?>