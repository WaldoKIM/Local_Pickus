<?// 네이버 로그인 ?>

<?
//session_start();
// NAVER LOGIN
define('NAVER_CLIENT_ID', '1UXNkDr4n65fMZOLztQ0');
define('NAVER_CLIENT_SECRET', 'DKU4uDZK6F');
define('NAVER_CALLBACK_URL', 'http://liivmstore.com/main/naver_login_ok.php');
 
// 네이버 로그인 접근토큰 요청
$naver_state = md5(microtime() . mt_rand());
$_SESSION['naver_state'] = $naver_state;
$naver_apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&state=".$naver_state;
?>

<div style="text-align:center;padding:10px;">
	<a href="<?=$naver_apiURL;?>"><img src="./images/login_naver2.png"></a>
</div>


<?///카카오 로그인 ?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<div style="text-align:center; style="text-align:center;padding:10px;">
	<a id="kakao-login-btn"></a>
<a href="http://developers.kakao.com/logout"></a>
</div>

<script type='text/javascript'>
  //<![CDATA[
    // 사용할 앱의 JavaScript 키.
    Kakao.init('04a002d1b651ba6bcc4d4a1fbffa5fb2');
    // 카카오 로그인 버튼을 생성합니다.
    Kakao.Auth.createLoginButton({
      container: '#kakao-login-btn',
      success: function(authObj) {
        //alert(JSON.stringify(authObj));
		window.location.href ="./kakao_ok.php?code="+Kakao.Auth.getAccessToken();  
      },
      fail: function(err) {
         alert(JSON.stringify(err));
      }
    });
  //]]>

  Kakao.Auth.getAccessToken()
</script>



<!--------------- 아래의 코드는 삭제해주세요. 샘플이 제대로 동작하지 않을 수 있습니다. ---------------------->

<?
/*
<a href="javascript:Kakao.Auth.getAccessToken()">kakao</a>
<a href="javascript:Kakao.Auth.logout()">logout</a>
<a href="https://kauth.kakao.com/oauth/authorize?client_id=719cf04e5d9ce2c9c48fdd786bdba03e&redirect_uri=http://www.oolim.net/skin_ws1&response_type=code">카카오 로그인</a>
*/
?>


