<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=member.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 
// 엑셀파일 생성  ---------------------------------------------------------------------------------------------------------------------------------------//
$result		= $db->select("cs_member", "order by idx asc");
$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
$eeee = iconv("UTF-8","EUC-KR","번호, 아이디, 회원레벨, 이름, 전화번호, 메일주소, 주민번호, 우편번호, 주소, 가입일, 추천인, 접속수"); 
echo($eeee); // 타이틀 쓰고  
echo($newline);                     //  줄바꾸기 
$No=0;
while($row = @mysqli_fetch_object( $result )) { 
	$No++;
 $row->userid = iconv("UTF-8","EUC-KR",$row->userid); 
 $row->level = iconv("UTF-8","EUC-KR",$row->level); 
 $row->name = iconv("UTF-8","EUC-KR",$row->name); 
 $row->tel1 = iconv("UTF-8","EUC-KR",$row->tel1); 
 $row->tel2 = iconv("UTF-8","EUC-KR",$row->tel2); 
 $row->tel3 = iconv("UTF-8","EUC-KR",$row->tel3);  
 $row->email = iconv("UTF-8","EUC-KR",$row->email); 
 $row->jumin1 = iconv("UTF-8","EUC-KR",$row->jumin1); 
 $row->jumin2 = iconv("UTF-8","EUC-KR",$row->jumin2); 
 $row->zip = iconv("UTF-8","EUC-KR",$row->zip); 
 $row->add1 = iconv("UTF-8","EUC-KR",$row->add1); 
 $row->add2 = iconv("UTF-8","EUC-KR",$row->add2); 
 $row->register = iconv("UTF-8","EUC-KR",$row->register); 
 $row->recomid = iconv("UTF-8","EUC-KR",$row->recomid); 
 $row->connect = iconv("UTF-8","EUC-KR",$row->connect); 

	echo( $No.",".$row->userid.",".$row->level.",".$row->name.",".$row->tel1."-".$row->tel2."-".$row->tel3.",".$row->email.",".$row->jumin1."-".$row->jumin2.",".$row->zip1."-".$row->zip2.",".$row->add1."asdf".$row->add2.",".$row->register.",".$row->recomid.",".$row->connect);
	echo( $newline);     // 줄 바꾸기             
} 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------//



?>
