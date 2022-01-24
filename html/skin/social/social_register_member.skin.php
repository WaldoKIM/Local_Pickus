<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if( ! $config['cf_social_login_use']) {     //소셜 로그인을 사용하지 않으면
    return;
}

$sql = " select * from {$g5['content_table']} where co_id = 'privacy' ";
$row = sql_fetch($sql);
$privacy = $row['co_content'];

$sql = " select * from {$g5['content_table']} where co_id = 'provision' ";
$row = sql_fetch($sql);
$provision = $row['co_content'];

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="sub_title login">
    <h5>SNS 회원가입</h5>
    <h1>피커스 회원가입을 환영합니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
    <div class="container">
        
        <div class="join_wrap">
            <div class="form_wrap">
                
                <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" id="mb_id" name="mb_id" value="<?php echo $user_id ?>">
                    <input type="hidden" id="mb_level" name="mb_level" value="0">
					<input type="hidden" name="provider" value="<?php echo $provider_name;?>" >
					<input type="hidden" name="action" value="register">
					<input type="hidden" name="url" value="<?php echo $urlencode; ?>">
					<input type="hidden" name="mb_nick_default" value="<?php echo isset($user_nick)?get_text($user_nick):''; ?>">
					<input type="hidden" name="mb_nick" value="<?php echo isset($user_nick)?get_text($user_nick):''; ?>" id="reg_mb_nick">

                    <div class="form-group">
                        <h4>피커스 SNS 회원가입</h4>
                        <p>SNS 연동이 완료 되었습니다.<br/>
                        기본 정보는 SNS의 정보로 자동 설정되며 간편한 로그인 및 이용을 위해 이메일ID 및 비밀번호를 설정해 주세요. <br/>
                        추후 SNS 로그인 및 메일아이디/PW 로그인 두가지 방식 모두 로그인이 가능합니다.</p>
                        <br/>
                    </div>

                    <div class="form-group">
                        <ul class="row">
                            <li class="col-xs-10">
                                <input type="text" id="mb_name" name="mb_name" value="<?php echo $user_name ? $user_name : $user_nick ?>" aria-describedby="이름" placeholder="이름">
                                <p class="input_error error" id="lbl_nickname">8-16자 영문과 숫자를 조합해 주세요</p>
                            </li>
                            <!--
                            <li class="col-xs-2"><a href="javascript:doMappingUser()" class="main_bg form_btn">기존회원 매핑</a></li>
                        -->
                        </ul>
                        
                    </div>

                    <div class="form-group text-right">
                        <input type="text" id="mb_email" name="mb_email" aria-describedby="이메일" value="<?php echo isset($user_email)?$user_email:''; ?>" placeholder="이메일">
                        <p class="input_error error" id="lbl_email">8-16자 영문과 숫자를 조합해 주세요</p>
                        <label name="sendAgree_lbl" >
                            <input type="checkbox" id="mb_mailling" name="mb_mailling" value="1"/><i></i>&nbsp;&nbsp;피커스의 다양한 정보메일 수신 하겠습니다.
                        </label>
                    </div>

                    <div class="form-group">
                        <input type="text" id="mb_hp" name="mb_hp" aria-describedby="휴대폰 번호" value="<?php echo isset($user_phone)?$user_phone:''; ?>"  placeholder="휴대폰 번호">
                        <p class="input_error error" id="lbl_phone">8-16자 영문과 숫자를 조합해 주세요</p>
                    </div>

                    <div class="form-group">
                        <label for="pbAgree" name="pbAgree_lbl">
                            <input type="checkbox" id="pbAgree"/><i></i>&nbsp;&nbsp;본인은
                            <a class="main_co" href="#" data-toggle="modal" data-target="#terms">이용약관</a> 및 
                            <a class="main_co" href="#" data-toggle="modal" data-target="#privacy">개인정보보호방침</a>에 대한 내용을 모두 이해하였으며 이에 동의합니다.
                        </label>
                    </div>

                    <div class="btn_wrap">
                        <ul class="col-md-4 col-md-offset-4">
                            <li><input class="main_bg" type="button" value="회원가입 하기" onClick="doSnsSignup();"></li>
                        </ul>
                    </div>
                </form>

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
<div class="modal fade" id="mapping" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">기존회원 매핑</h4>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <input type="text" id="user_email" name="user_email" aria-describedby="사용자 이메일" placeholder="사용자 이메일">
                    </div>

                    <div class="form-group">
                        <input type="password" id="user_password" name="user_password" aria-describedby="사용자 패스워드" placeholder="사용자 패스워드">
                    </div>

                    <div class="btn_wrap">
                        <ul class="row">
                            <li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
                            <li class="col-xs-3"><input class="main_bg" type="button" value="로그인 하기" onClick="doMappingSave();"></li>
                        </ul>
                    </div><!-- btn_wrap -->
                    
                </form>
            </div><!-- modal-body -->
        </div>
    </div>
</div><!-- 이용약관 -->
<script type="text/javascript">
function doMappingUser()
{
    $("#user_email").val("");
    $("#user_password").val("");
    $("#mapping").modal();
}

function doSnsSignup(){
    if(!$("#pbAgree").prop("checked")){
        alert("이용약관에 동의해주세요!");
        return false;
    }

    var f = document.fregisterform;

    f.submit();
}
</script>