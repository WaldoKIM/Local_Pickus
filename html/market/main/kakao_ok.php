<?include('../common.php');?>
<?php
 $TOKEN_API_URL = "https://kapi.kakao.com/v2/user/me"; 
 $access_token = $_GET[code];
 
 $opts = array( 
   CURLOPT_URL => $TOKEN_API_URL, 
   CURLOPT_SSL_VERIFYPEER => false, 
   CURLOPT_SSLVERSION => 1, 
   CURLOPT_POST => true, 
   CURLOPT_POSTFIELDS => false, 
   CURLOPT_RETURNTRANSFER => true, 
   CURLOPT_HTTPHEADER => array( 
	"Authorization: Bearer " . $access_token
   )
 ); 
 
 
 $curlSession = curl_init(); 
 curl_setopt_array($curlSession, $opts); 
 $accessTokenJson = curl_exec($curlSession); 
 curl_close($curlSession); 
 
// echo "$accessTokenJson"."<br>"; 
?>


<?
    $decode = json_decode($accessTokenJson,True);
?>	
	<script type="text/javascript">
	location.href="login_ok.php?loginType=kakao&userid=kakao_<?=$decode[id]?>&name=<?=$decode[properties][nickname]?>&email=<?=$decode[kaccount_email]?>";
	</script>	
