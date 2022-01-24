<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=crm3.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 


$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 

$eeee = iconv("UTF-8","EUC-KR","번호, 회원아이디, 이름, 구매횟수, 구매금액, 사용포인트, 적립포인트, 접속수"); 
echo $eeee;		 //  타이틀 쓰고
echo($newline);                     //  줄바꾸기 
$sql="select sum(t.trade_price), t.order_userid, t.order_name, count(*), m.connect, sum(t.trade_use_point), sum(t.trade_save_point) from cs_member m left join cs_trade t on t.order_userid=m.userid where order_userid!='' group by userid,order_name order by 1 desc";
$result=$db->result($sql);
while($row=mysqli_fetch_array($result)) {
	++$listNo;
	if($row[1]) $id=$row[1]; else $id="-";
	$name = iconv("UTF-8","EUC-KR",$row[2]); 
	echo( $listNo.",".$id.",".$name.",".$row[3].",".$row[0].",".$row[5].",".$row[6].",".$row[4]);
	echo( $newline);     // 줄 바꾸기             
}

?>
