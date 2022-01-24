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
                
                <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
                    <div class="sub_tt">
                        <h5>비밀번호 찾기</h5>
                        <p>* 회원가입 시 입력하셨던 <span>이메일</span>로 비밀번호가 재발급 됩니다.</p>
                    </div>

                    <div class="form-group">
                        <input type="text" class="input_default" id="srchEmail" name="srchEmail" aria-describedby="이메일 입력" placeholder="이메일 입력">
                    </div>

                    <div class="login_btn text-center">
                        <ul class="row">
                            <li class="col-xs-4"><a class="line_bg" href="./login.php">취소</a></li>
                            <li class="col-xs-4"><a class="line_bg" href="./find_id.php">아이디 찾기</a></li>
                            <li class="col-xs-4"><input style="margin-top: 0; height: 42px;" class="main_bg" type="submit" value="확인"></li>
                        </ul>
                    </div>
                </form>

            </div><!-- form_wrap -->
        </div><!-- login_wrap -->

    </div><!-- container -->
</div><!-- member -->
<script>
function fpasswordlost_submit(f){
    if(!f.srchEmail.value){
        alert("true");
        return false;
    }
}

function goMove()
{
    location.href="<?php echo G5_URL; ?>";
}
</script>
