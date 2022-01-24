<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$save_mb_id = get_cookie("save_mb_id");
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<form id="frm" name="frm" method="post" >
  <input type="hidden" id="enc" name="enc">
</form>
<style type="text/css">
.at-body{background-color: #f4f5f9;}
    #fixed_kakao{display: block !important;}
    @media(min-width: 600px){
        .tit_desc br{display: none;}
    }
</style>
<div class="member com_pd">
    <div class="container">
        <div class="sub_title">
            <h1 class="main_co">로그인</h1>
            <p class="tit_desc">홈페이지의 다양한 정보와 맞춤 서비스를 이용하시려면 <br/>로그인이 필요합니다.</p>
        </div><!-- sub_title -->
        <div class="login_wrap row">
            <div class="form_wrap col-md-6 col-md-offset-3">

                <form name="flogin" action="<?php echo $login_action_url ?>" onkeydown="if(event.keyCode==13) return false;" onsubmit="return flogin_submit(this);" method="post">
                    <input type="hidden" id="url" name="url" value="<?php echo $url ?>">
                    <input type="hidden" id="mb_login_gubun" name="mb_login_gubun" value="1">
                    <input type="hidden" id="mb_password_md5" name="mb_password_md5">
					<input type="hidden" id="login_go" name="login_go" value="<?php echo $_GET['login_go']?>">
                    <div class="form-group">
                        <ul class="way">
                            <li class="current col-xs-6" data-tab="tab1">
                                <a href="#none">회원 로그인</a>
                            </li>
                            <li class="col-xs-6" data-tab="tab2">
                                <a href="#none">비회원 로그인</a>
                            </li>
                        </ul>
                    </div>

                    <div id="tab2" class="form-group tabcontent">
                        <input type="text" id="mb_name" name="mb_name" aria-describedby="사용자 이름" placeholder="사용자 이름">
                    </div>

                    <div class="form-group">
                        <input type="text" id="mb_id" name="mb_id" aria-describedby="사용자 이메일" placeholder="사용자 이메일" value="<?php echo $save_mb_id ?>">
                    </div>

                    <div id="tab1" class="tabcontent current">
                        <div class="form-group">
                            <input type="password" id="mb_password" name="mb_password" aria-describedby="사용자 패스워드" placeholder="사용자 패스워드">
                        </div>

						<div class="form-group text-left" style="float:left;">
							<label for="login_auto_login"><input type="checkbox" name="auto_login" id="login_auto_login" value="1" class="selec_chk">
							<i></i>&nbsp;&nbsp;자동로그인</label>
						</div>

                        <div class="form-group text-right" style="float:right;">
                            <label name="SAVEID_lbl"><input type="checkbox" id="saveid" name="saveid" <?php if($save_mb_id) echo 'checked'; ?>><i></i>&nbsp;&nbsp;이메일 기억하기</label>
                        </div>
                    </div><!-- tab1 -->

                    <div class="form-group">
                        <input class="main_bg" type="submit" value="로그인">
                    </div>
                </form>

                <div class="tab">
                    <ul class="row">
                        <li class="col-xs-6">
                            <a class="line_bg" href="./find_id.php">아이디 찾기</a>
                        </li>
                        <li class="col-xs-6">
                            <a class="line_bg" href="./find_password.php">비밀번호 찾기</a>
                        </li>
                    </ul>
                </div>
                <?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
            </div><!-- form_wrap -->
            <div class="bottom_register">
                <div class="col-md-6 col-md-offset-3">
                    <div class="find_box">
                        <strong>어떤 전문 서비스를 원하시나요?</strong>
                        <p>회원이 되시면 중고매입,판매,철거 등 <br/>온라인 서비스를 편히 이용하실 수 있습니다</p>


                        <a href="./register_customer_form.php" class="btn-text_link">
                            <em>일반 회원가입</em>
                        </a>
                    </div>
                    <div class="find_box">
                        <strong>사장님도 편리하게 !</strong>
                        <p>회원이 되시면 홈페이지에서 제공하는<br>온라인 서비스를 이용하실 수 있습니다.</p>
                        <a href="/bbs/register_partner_form.php">
                            <em>파트너 회원가입</em>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- login_wrap -->

    </div><!-- container -->
</div><!-- member -->


<script>
$(function() {
    $('.way li').click(function() {
        var activeTab = $(this).attr('data-tab');
        if(activeTab == "tab1"){
            $("#mb_name").val("");
            $("#mb_id").val("");
            $("#mb_password").val("");
            $("#mb_login_gubun").val("1");
        }else{
            $("#mb_name").val("");
            $("#mb_id").val("");
            $("#mb_password").val("");
            $("#mb_login_gubun").val("2");
        }
        $('ul li').removeClass('current');
        $('.tabcontent').removeClass('current');
        $(this).addClass('current');
        $('#' + activeTab).addClass('current');
    })

    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });

    $("#mb_id").keydown(function(){
        if(event.keyCode == 13) $("#mb_password").focus();
    });

    $("#mb_password").keydown(function(){
        if(event.keyCode == 13){
            var f = document.flogin;
            if(flogin_submit(f))
                document.flogin.submit();
        }
    });

});

function flogin_submit(f)
{

    if(f.mb_login_gubun.value == "1"){
        if(!f.mb_id.value){
            alert("이메일을 입력해주세요.");
            return false;
        }
        if(!f.mb_password.value){
            alert("비밀번호를 입력해주세요.");
            return false;
        }
        f.mb_password_md5.value = hex_md5(f.mb_password.value);
    }else{
        if(!f.mb_name.value){
            alert("이름을 입력해주세요.");
            return false;
        }
        if(!f.mb_id.value){
            alert("이메일을 입력해주세요.");
            return false;
        }
    }

    return true;
}
function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
<!-- } 로그인 끝 -->

