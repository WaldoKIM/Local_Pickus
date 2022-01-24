<?php
include_once('./_common.php');

$g5['title'] = "Q&A";

include_once('./_head.php');

if($is_guest || $member['mb_level'] == '10'){
	$sql_common = " from {$g5['qna_table']}";

	$sql_order = " order by idx desc ";

	$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
}else{

	$sql_common = " from {$g5['qna_table']} where email = '{$member['mb_email']}' ";

	$sql_order = " order by idx desc ";

	$sql = " select count(*) as cnt {$sql_common} {$sql_order} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

}

$sql = " select
			idx,
			nickname,
			email,
			phone,
			res_type,
			title,
			password,
			res_content,
			ret_content,
			case when ifnull(ret_content,'') = '' then 'N' else 'Y' end as ret_yn,
			date_format(updatetime, '%Y.%m.%d') as updatetime,
			date_format(updatetime, '%Y.%m.%d') as completetime
		{$sql_common} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

?>
<style type="text/css">
    #fixed_kakao{display: block !important;}
	
</style>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">1:1문의</h1>
			<p class="tit_desc">무엇이 궁금하세요?</p>
		</div>
		<div>
			<ul class="tab">
				<li class="col-xs-4" style="display: none;">
					<a href="./notice.php">공지사항</a>
				</li>
				<li class="col-xs-6 on">
					<a href="#none">1:1문의</a>
				</li>
				<li class="col-xs-6">
					<a href="./faq.php">FAQ</a>
				</li>
			</ul>
		</div>
		
		<div id="board">

			<div class="list">
				<table>
					<colgroup class="web_col">
						<col style="width: 10%" />
						<col style="width: 60%" />
						<col style="width: 15%" />
						<col style="width: 15%" />
					</colgroup>
					<colgroup class="mob_col">
						<col style="width: 65%" />
						<col style="width: 15%" />
						<col style="width: 20%" />
					</colgroup>
					<thead>
						<tr>
							<th class="web_td">번호</th>
							<th>제목</th>
							<th>작성자</th>
							<th>처리현황</th>
						</tr>
					</thead>
					<tbody>
    				<?php
    				for ($i=0; $row=sql_fetch_array($result); $i++) {
    					echo '<tr>';
    					echo '<td class="web_td">'.$row['idx'].'</td>';
    					if($is_member){
    						if($member['mb_email'] == $row['email']){
    							echo '<td><a class="subject" href="./qna_detail.php?page='.$page.'&&idx='.$row['idx'].'">'.$row['title'].'</a></td>';
    						}else{
    							echo '<td><a class="subject" href="#none" onClick="doNotUser()">'.$row['title'].'</a></td>';
    						}

    					}else{
	    					//echo '<td><a class="subject" href="#none" onClick="doAlertLogin()">'.$row['title'].'</a></td>';
	    					/*echo '<td><a class="subject" href="./qna_detail.php?page='.$page.'&&idx='.$row['idx'].'">'.$row['title'].'</a></td>';*/
	    					echo '<input type="hidden" id="password_row" value = "' . $row['password'] . '">';
	    					echo '<input type="hidden" id="url" value="./qna_detail.php?page='.$page.'&&idx='.$row['idx'].'">';
	    					echo '<td><a class="subject" onclick="chk_password()">'.$row['title'].'</a></td>';
    					}
    					echo '<td>'.mb_substr($row['nickname'], 0,1).'**</td>';
    					if($row['ret_yn'] == "Y"){
	    					echo '<td><span class="end">답변완료</span></td>';
    					}else{
    						echo '<td><span class="ing">답변대기</span></td>';
    					}
    					echo '</tr>';
    				}
    				?>					
					</tbody>
				</table>
			</div><!-- list -->
			<div class="btn_wrap">
				<ul class="row">
					<li class="col-xs-4 col-md-2">
					
						<a class="main_bg" href="./qna_register.php">1:1문의하기</a>
					
					</li>
				</ul>
			</div>
			<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
		</div><!-- board -->
	</div><!-- container -->
</div><!-- member -->
<script>
	function chk_password(){
		var inputString = prompt('비밀번호를 입력하세요', ''); 

		if(inputString == $('#password_row').val()){
			location.href = $('#url').val();
		}else{
			alert('비밀번호가 일치하지 않습니다');
		}
	}

	function doAlertLoginWrite()
	{
		alert("로그인 후 작성 가능합니다.");
	}

	function doAlertLogin()
	{
		alert("로그인 후 내용을 보실수 있습니다.");
	}

	function doNotUser()
	{
		alert("작성한 회원만 볼수 있습니다.");
	}
</script>
<?php
include_once('./_tail.php');
?>
