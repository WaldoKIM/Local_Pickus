<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title login">
    <h5>아이디 찾기</h5>
    <h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
    <div class="container">
        
        <div class="login_wrap row">
            <div class="form_wrap col-md-6 col-md-offset-3">
                
                <form>
                    <div class="sub_tt">
                        <h5>아이디 찾기</h5>
                        <p>* 회원가입 시 입력하셨던 <span>휴대폰 번호</span>를 기입해주세요</p>
                    </div>

                    <div class="form-group">
                        <input type="text" class="input_default" id="srchHpNo" aria-describedby="휴대폰번호 입력" placeholder="휴대폰번호 입력">
                    </div>
                    <div class="sub_tt">
                        <p id="srchUserIdInfo"></p>
                    </div>

                    <div class="login_btn text-center">
                        <ul class="row">
                            <li class="col-xs-4"><a class="line_bg" href="./login.php">취소</a></li>
                            <li class="col-xs-4"><a class="line_bg" href="./find_password.php">비밀번호 찾기</a></li>
                            <li class="col-xs-4"><input class="main_bg" type="button" value="확인" style="margin-top: 0; height: 42px;" onClick="doSearchUserIdCompete();"></li>
                        </ul>
                    </div>
                </form>

            </div><!-- form_wrap -->
        </div><!-- login_wrap -->

    </div><!-- container -->
</div><!-- member -->
<script>
jQuery(document).ready(function(){
    $("#srchHpNo").inputFilter(function(value) {
          return /^\d*$/.test(value);
    });
});

function doSearchUserIdCompete()
{
    if(!$('#srchHpNo').val()){
        alert("휴대폰번호를 입력하십시오.");
        return;
    }
    $.ajax({
        type: "POST",
        url: "./ajax.mb_id_find.php",
        data: {
            "mb_hp": $('#srchHpNo').val()
        },
        cache: false,
        success: function(data) {
            $("#srchUserIdInfo").html(data);
        }
    });
}

function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
