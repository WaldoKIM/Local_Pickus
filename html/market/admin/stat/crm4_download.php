<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=crm4.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 


$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
$eeee = iconv("UTF-8","EUC-KR","지역, 구매수, 구매금액"); 
echo $eeee;		 //  타이틀 쓰고

echo($newline);                     //  줄바꾸기 
$arrArea=Array("서울","부산","대구","인천","광주","대전","울산","경기","강원","충청북","충청남","경상북","경상남","전라북","전라남","제주");
$strArrArea=Array("서 울","부 산","대 구","인 천","광 주","대 전","울 산","경 기","강 원","충 북","충 남","경 북","경 남","전 북","전 남","제 주");
$total_trade_price=$db->sum("cs_trade", "where trade_stat=4", "trade_price");
$total_trade_cnt=0;
for($i=0;$i<count($arrArea);$i++) {
	$trade_cnt=0;
	$trade_price=0;
	$result=$db->result("select trade_price from cs_trade where trade_stat=4 and deliv_add1 like '$arrArea[$i]%'");
	while($area_row=@mysqli_fetch_array($result)) {
		$trade_cnt++;
		$trade_price+=$area_row[0];
	}
	$total_trade_cnt+=$trade_cnt;
	
	if($total_trade_price==0) { $wid=2;	} else { $wid=abs($trade_price/$total_trade_price)*400;	if($wid==0) $wid=0;}
	echo( iconv("UTF-8","EUC-KR",$strArrArea[$i]).",".$trade_cnt.",".$trade_price);
	echo( $newline);     // 줄 바꾸기
}

















?>
