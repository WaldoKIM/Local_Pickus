<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['content_table']} where co_id = 'privacy' ";
$row = sql_fetch($sql);
$privacy = $row['co_content'];

$sql = " select * from {$g5['content_table']} where co_id = 'provision' ";
$row = sql_fetch($sql);
$provision = $row['co_content'];

?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" href="/skin/member/basic/style.css">
<style type="text/css">
	.at-body{background-color: #f4f5f9;}
	@media(min-width: 600px){
		.tit_desc br{display: none;}
	}
</style>
<!-- 회원정보 입력/수정 시작 { -->

<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
            <h1 class="main_co">일반 회원가입</h1>
            <p class="tit_desc">홈페이지의 다양한 정보와 맞춤 서비스를<br/> 이용하시려면 회원가입이 필요합니다.</p>
        </div><!-- sub_title -->
		<div class="register_wrap">
			<div class="form_wrap ">
				<!-- <?php echo $register_action_url ?> -->
				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="<?php echo $w ?>">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" name="mb_level" value="0">
					<input type="hidden" name="mb_id">
					<input type="hidden" name="mb_password">
					<input type="hidden" name="mb_password_type" value="md5">
					<div class="form-group">
						<ul class="tab">
							<li class="col-xs-6 main_bg on">
								<a href="#none">
									<span>무료 견적 보러 오셨나요 ?</span>
									<h4>사용자 회원가입</h4>
								</a>
							</li>
							<li class="col-xs-6">
								<a href="./register_partner_form.php">
									<span>사장님도 편리하게 !</span>
									<h4>센터 회원가입</h4>
								</a>
							</li>
						</ul>
					</div>

					<div class="form-group">
						<input type="text" class="input_default" id="mb_name" name="mb_name" aria-describedby="이름" placeholder="이름">
						<p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group text-right">
						<input type="text" class="input_default" id="mb_email" name="mb_email" aria-describedby="이메일" placeholder="이메일">
						<p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
						
					</div>

					<div class="form-group">
						<input type="password" class="input_default" id="password_new" name="password_new" aria-describedby="비밀번호" placeholder="비밀번호(영문,숫자 8~15)">
						<p class="input_error error" id="lbl_password">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="password" class="input_default" id="password_new_c" name="password_new_c" aria-describedby="비밀번호 확인" placeholder="비밀번호 확인(영문,숫자 8~15)">
						<p class="input_error error" id="lbl_passwordConfirm">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>

					<div class="form-group">
						<input type="text" class="input_default" id="mb_hp" name="mb_hp" aria-describedby="휴대폰 번호" placeholder="휴대폰 번호">
						<p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
					</div>
					<div class="form-group">
						<label name="sendAgree_lbl" >
							<input type="checkbox" id="mb_mailling" name="mb_mailling" value="1"/><i></i>&nbsp;&nbsp;피커스의 다양한 정보메일 수신 하겠습니다.
						</label>
					</div>
					<div class="form-group">
						<label for="pbAgree" name="pbAgree_lbl">
							<input type="checkbox" required="" id="pbAgree"/><i></i>&nbsp;&nbsp;본인은
							<a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및 
							<a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
						</label>
					</div>

					<div class="btn_wrap">
						<ul class="col-md-4 col-md-offset-4">
							<li><input class="main_bg" type="button" value="회원가입 하기" onClick="fregisterform_submit()"></li>
						</ul>
					</div>
				</form>
				
				<?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">이용약관</h4>
			</div>
			<div class="modal-body">
				<div class="scroll">
					<?php echo $provision ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- 이용약관 -->

<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">개인정보보호방침</h4>
			</div>
			<div class="modal-body">
				<div class="scroll">
					<?php echo $privacy ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- 이용약관 -->
<script>
jQuery(document).ready(function(){
	$("#mb_hp").inputFilter(function(value) {
		  return /^\d*$/.test(value);
	});
});

function fregisterform_submit(){
	var f = document.fregisterform;

	if(!checkFields(f))	 return false;
	f.mb_id.value = f.mb_email.value;

	f.mb_password.value = hex_md5(f.password_new.value);

	f.submit();
}
function checkFields(f) {  
	
	removeClass();

	if(!$("#mb_name").val()){
		alert("이름을 입력해주세요.");
		return false;
	}
	
	if(!$("#mb_email").val()){
		alert("이메일을 입력해주세요.");
		return false;        		
	}
	
	if(!this.validateEmail($("#mb_email").val())){
		alert("올바른 이메일 형식을 입력해주세요.");
		return false;
	}
	
	if(!$("#password_new").val()){
		alert("비밀번호를 입력해주세요.");
		return false;
	}
	
	if($("#password_new").val()!=$("#password_new_c").val()){
		alert("비밀번호와 비밀번호확인이 일치하지 않습니다.");
		return false;
	}

	if($("#password_new").val().length  < 8 || $("#password_new").val().length  > 15){
		alert("비밀번호는 8자 이상 15자 이하입니다.");
		return false;
	}


	if(!$("#mb_hp").val()){
		alert("전화번호를 입력해주세요.");
		return false;
	}

   /* var msg = reg_mb_email_check($("#mb_email").val());
    if (msg) {
        alert(msg);
        return false;
    }	*/

	if(!$("#pbAgree").prop("checked")){
		alert("이용약관에 동의해주세요!");
		return false;
	}


	return true;
}
        
function removeClass()
{
	$("#lbl_nickname").hide();
	$("#lbl_email").hide();
	$("#lbl_password").hide();
	$("#lbl_passwordConfirm").hide();
	$("#lbl_phone").hide();
	
	$("#nickname").removeClass("input_error");
	$("#email").removeClass("input_error");
	$("#password").removeClass("input_error");
	$("#passwordConfirm").removeClass("input_error");
	$("#phone").removeClass("input_error");
}
function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
<!-- } 회원정보 입력/수정 끝 -->