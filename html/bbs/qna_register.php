<?php
include_once('./_common.php');

$g5['title'] = "Q&A";

include_once('./_head.php');

$register_action_url = G5_BBS_URL.'/qna_register_update.php';

?>

<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="sub_title notice_bg">
	<h1>1:1문의</h1>
	<h5>무엇이 궁금하세요?</h5>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">

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
		<form name="fqna" action="<?php echo $register_action_url ?>" onsubmit="return fqna_submit(this);" method="post">
		<div id="board">
			<div class="write">
				<table>
					<colgroup>
						<col style="width: 20%" />
						<col style="width: 80%" />
					</colgroup>
					<tr>
						<th>문의유형</th>
						<td>
							<select id="res_type" name="res_type">
								<option value="" selected>선택</option>
								<option value="파트너스 관련 문의">파트너스 관련 문의</option>
								<option value="견적선택중 문의">견적선택중 문의</option>
								<option value="수거/철거 진행중 문의">수거/철거 진행중 문의</option>
								<option value="수거/철거 완료 후 문의">수거/철거 완료 후 문의</option>
								<option value="기타문의">기타문의</option>
							</select>
						</td>
					</tr>
					<?php if($is_guest) : ?>
					<tr>
						<th>이름</th>
						<td>
							<input type="text" id="nickname" name="nickname" >
						</td>
					</tr>
					<tr>
						<th>전화번호</th>
						<td>
							<input type="number" id="phone" name="phone" >
						</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>
							<input type="email" id="email" name="email" >
						</td>
					</tr>
					<tr>
						<th>비밀번호</th>
						<td>
							<input type="password" id="password" name="password" >
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<th>제목</th>
						<td>
							<input type="text" id="title" name="title" >
						</td>
					</tr>
					<tr>
						<th>문의내역</th>
						<td>
							<textarea id="res_content" name="res_content" placeholder="내용을 작성해주세요" style="height:200px;"></textarea>
						</td>
					</tr>
				</table>

				<div class="btn_wrap">
					<ul class="row">
						<li class="col-md-3 col-xs-6 col-md-offset-3"><a class="line_bg" href="./qna.php">취소</a></li>
						<li class="col-md-3 col-xs-6"><input class="main_bg" type="submit" value="1:1문의하기" onClick="doSaveQna();"></li>
					</ul>
				</div>
			</div><!-- write -->
		</div><!-- board -->
		</form>
	</div><!-- container -->
</div><!-- member -->
<script>
// submit 최종 폼체크
function fqna_submit(f)
{
	if(!f.res_type.value){
		alert("문의 유형을 선택하십시오.");
		return false;
	}
	if(!f.title.value){
		alert("제목을 입력하십시오.");
		return false;
	}
	if(!f.res_content.value){
		alert("내용을 입력하십시오.");
		return false;
	}

	return true;
}

</script>
<?php
include_once('./_tail.php');
?>
<style>
    @media(max-width:703px){
    .btn_wrap .row li input[type="submit"] {
        margin-top: 10px;
    }
    }
</style>