<?php
include_once('./_common.php');

/*if (!$is_member || $member['mb_level'] != "0")
	alert("회원만 가능합니다.", G5_URL);*/

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.mob_back{display: none !important;}
	#fregisterform{max-width: 585px; margin: 0 auto; background-color: #fff; padding: 30px;}  
	.at-body{background-color:#f4f5f9; }
	input[type=text], input[type=password], input[type=search], input[type=email], input[type=number], input[type=tel]:focus{border:0 !important;}
	.col-md-2{width: 30%;}
	.col-md-10{width: 70%;}
	@media(max-width: 768px){
		.col-md-2{width: 100%;}
	}
</style>
<!-- <div class="sub_title login">
	<h5>마이페이지</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div> --><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">마이페이지</h1>
			<p class="tit_desc">내 정보를 확인 및 수정 할 수 있습니다.</p>
		</div>
		<div class="join_wrap">
			<div class="form_wrap">
				
				<form id="fregisterform" name="fregisterform" action="/bbs/mypage_update.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="u">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" name="mb_level" value="<?php echo $member['mb_level']; ?>">
					<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
					<input type="hidden" name="mb_password">
					<input type="hidden" name="mb_password_type" value="md5">	

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">이름</li>
							<li class="title col-md-10">
								<span id="span_nickname"><?php echo $member['mb_name']; ?></span>
								<input type="hidden" name="mb_name" value="<?php echo $member['mb_name']; ?>">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">아이디</li>
							<li class="title col-md-10">
								<span id="span_email"><?php echo $member['mb_email']; ?></span>
								<input type="hidden" id="mb_email" name="mb_email" value="<?php echo $member['mb_email']; ?>">
							</li>
						</ul>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">비밀번호</li>
							<li class="col-md-10"><input type="password" id="password_new" name="password_new" aria-describedby="비밀번호" placeholder="비밀번호 변경 (영문, 숫자 조합 8-16)"></li>
						</ul>
						<p class="input_error error" id="lbl_passwordConfirm">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">비밀번호 확인</li>
							<li class="col-md-10"><input type="password" id="password_new_c" name="password_new_c" aria-describedby="비밀번호" placeholder="비밀번호 확인 (영문, 숫자 조합 8-16)"></li>
						</ul>
						<p class="input_error error" id="lbl_passwordConfirm">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<ul class="row">
							<li class="title col-md-2">전화번호</li>
							<li class="col-md-10"><input type="text" id="mb_hp" name="mb_hp" aria-describedby="전화번호" placeholder="전화번호를 입력하십시오" value="<?php echo $member['mb_hp']; ?>"></li>
						</ul>
						<p class="input_error error" id="lbl_passwordConfirm">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>
					<div class="form-group" style="border-bottom: 0;">
						<ul class="row">
							<li class="title col-md-2">은행명</li>
							<li class="title col-md-10"><input type="hidden" name="mb_bank" id="mb_bank" value="NH농협">
						<select id="mb_bank_select">
							<option <?php if($member['mb_bank'] == 'NH농협'): ?> selected='selected'<?php endif ?>value="NH농협">NH농협</option>
							<option <?php if($member['mb_bank'] == '우리은행'): ?> selected='selected'<?php endif ?>value="우리은행">우리은행</option>
							<option <?php if($member['mb_bank'] == '국민은행'): ?> selected='selected'<?php endif ?>value="국민은행">국민은행</option>
							<option <?php if($member['mb_bank'] == '기업은행'): ?> selected='selected'<?php endif ?>value="기업은행">기업은행</option>
							<option <?php if($member['mb_bank'] == '신한은행'): ?> selected='selected'<?php endif ?>value="신한은행">신한은행</option>
							<option <?php if($member['mb_bank'] == '하나은행'): ?> selected='selected'<?php endif ?>value="하나은행">하나은행</option>
							<option <?php if($member['mb_bank'] == 'SC은행'): ?> selected='selected'<?php endif ?>value="SC은행">SC은행</option>
							<option <?php if($member['mb_bank'] == '카카오뱅크'): ?> selected='selected'<?php endif ?>value="카카오뱅크">카카오뱅크</option>
							<option <?php if($member['mb_bank'] == '산업은행'): ?> selected='selected'<?php endif ?>value="산업은행">산업은행</option>
							<option <?php if($member['mb_bank'] == '대구은행'): ?> selected='selected'<?php endif ?>value="대구은행">대구은행</option>
							<option <?php if($member['mb_bank'] == '광주은행'): ?> selected='selected'<?php endif ?>value="광주은행">광주은행</option>
							<option <?php if($member['mb_bank'] == '전북은행'): ?> selected='selected'<?php endif ?>value="전북은행">전북은행</option>
							<option <?php if($member['mb_bank'] == '한국씨티은행'): ?> selected='selected'<?php endif ?>value="한국씨티은행">한국씨티은행</option>
							<option <?php if($member['mb_bank'] == '부산은행'): ?> selected='selected'<?php endif ?>value="부산은행">부산은행</option>
							<option <?php if($member['mb_bank'] == '수협은행'): ?> selected='selected'<?php endif ?>value="수협은행">수협은행</option>
							<option <?php if($member['mb_bank'] == '경남은행'): ?> selected='selected'<?php endif ?>value="경남은행">경남은행</option>
							<option <?php if($member['mb_bank'] != 'NH농협' &&
								$member['mb_bank'] != '우리은행' &&
								$member['mb_bank'] != '국민은행' &&
								$member['mb_bank'] != '기업은행' &&
								$member['mb_bank'] != '신한은행' &&
								$member['mb_bank'] != '하나은행' &&
								$member['mb_bank'] != 'SC은행' &&
								$member['mb_bank'] != '카카오뱅크' &&
								$member['mb_bank'] != '산업은행' &&
								$member['mb_bank'] != '대구은행' &&
								$member['mb_bank'] != '광주은행' &&
								$member['mb_bank'] != '전북은행' &&
								$member['mb_bank'] != '한국씨티은행' &&
								$member['mb_bank'] != '부산은행' &&
								$member['mb_bank'] != '수협은행' &&
								$member['mb_bank'] != '경남은행'): ?> selected='selected'<?php endif ?>value="기타은행입력">기타은행입력
							</option>
						</select></li>
						</ul>
					</div>
					<div class="form-group" style="display: none"  id="mb_bank_txt_area">
						<ul>
							<li class="title col-md-2"></li>
							<li class="title col-md-10"><input id="mb_bank_txt" type="text" value="<?php echo $member['mb_bank']; ?>" name="mb_bank_txt" placeholder="은행명"></li>
						</ul>
					</div>
					<div class="form-group">
						<ul>
							<li class="title col-md-2">계좌번호</li>
							<li class="title col-md-10">
							<input type="number" id="mb_bank_num" name="mb_bank_num" aria-describedby="계좌번호" placeholder="정산계좌번호" value="<?php echo $member['mb_bank_num'];?>"></li>
						</ul>
					</div>
					<div class="form-group">
						<ul>
							<li class="title col-md-2">예금주</li>
							<li class="title col-md-10">
							<input type="text" id="mb_bank_name" name="mb_bank_name" aria-describedby="예금주" placeholder="예금주" value="<?php echo $member['mb_bank_name'];?>"></li>
						</ul>
					</div>
					<div class="btn_wrap" style="text-align: center;">
						<ul class="row" style="text-align: center;">
							<p style="text-align: center;">
							<li class="col-md-6 col-xs-6"><a class="line_bg" href="#none" onClick="doWithdrawal();">회원탈퇴</a></li>
							<li class="col-md-6 col-xs-6"><input class="main_bg" type="submit" value="정보수정하기"></li>
							</p>
						</ul>
					</div>
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
jQuery(document).ready(function(){
	if($('#mb_bank_select').val() == '기타은행입력'){
		$('#mb_bank_txt_area').css('display', 'block');
	}
	$('#mb_bank_select').change(function(){
		if($(this).val() == '기타은행입력'){
			$('#mb_bank_txt_area').css('display', 'block');
			$("#mb_bank_txt").val('');
			$("#mb_bank").val('');
		}else{
			$('#mb_bank_txt_area').css('display', 'none');
			$("#mb_bank").val($(this).val());
		}
	});
	$("#mb_hp").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
});	

function fregisterform_submit(f){
	if(f.password_new.value){
		f.mb_password.value = hex_md5(f.password_new.value);

	}

	return true;
}

function doWithdrawal()
{
	if(!confirm("회원을 탈퇴하시겠습니까?"))  return;
	
	location.href = "./member_leave.php";
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
</style>