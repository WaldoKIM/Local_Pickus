<?php
include_once('./_common.php');

$g5['title'] = "이용약관";

include_once('./_head.php');


    $url = "http://manage.usher.co.kr/common/api/counsel.do"; //운영

    $curl_date = array(
        'name' => '박성범',
        'birthday' => '1979년 7월 7일',
        'mobile_no' => '010-4706-4579',
        'e_mail' => 'paulpsb@naver.com',
        'gubun' => '주니어',
        'service' => '참강',
        'foregin' => '국내',
        'area' => '강남',
    );
    curl_request_async($url, $curl_date, 'POST');
    /*
    //CURL함수 사용 
    $ch=curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curl_date));

    $response = curl_exec($ch); 

    if(curl_error($ch)){ 
        $curl_data = null; 
    } else { 
        $curl_data = $response; 
    } 

    curl_close($ch);

*/

$sql = " select * from {$g5['content_table']} where co_id = 'privacy' ";
$row = sql_fetch($sql);
$privacy = $row['co_content'];

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title login">
	<h5>개인정보 취급방침</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->

<div class="member com_pd">
	<div class="container">
		<?php echo $privacy ; ?>
	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>
