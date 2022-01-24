<?
$recipient = "sinenmin@gmail.com";    // 받는 사람의 메일주소
$subject = "안녕하세요";           // 제목
$mail_body = "이번주 일요일에 시간되세요? ^^";    // 내용


$header = "From:postmaster@wizmro.com\n";
$header .= "Content-type:text/html;\n";    // 텍스트 타입 설정 (text/html 형식 사용)
$header .= "charset=euc-kr";              // 캐릭터 설정

$email = mail($recipient, $subject, $mail_body, $header);    // 메일보내기
if(!$email) {echo "메일 보내기 실패"; }        // 메일 보내기 실패시 출력
else{echo "$recipient 메일 보내기 성공";}
?>
