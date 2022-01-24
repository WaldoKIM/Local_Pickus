<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=crm1.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 

$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
$eeee = iconv("UTF-8","EUC-KR","번호, 제품명, 제품번호, 판매가격, 판매수량, 판매금액"); 
echo $eeee;		 //  타이틀 쓰고
echo($newline);                     //  줄바꾸기 
$result		    = $db->result( "select (sum(goods_cnt)*goods_price), goods_price,  sum(goods_cnt), goods_name, goods_code from cs_trade_goods inner join cs_trade USING(trade_code) where cs_trade.trade_stat=4 group by goods_code order by 1 desc" );
while( $row = @mysqli_fetch_array($result)) {
	++$listNo;
	$name = iconv("UTF-8","EUC-KR",$row[3]); 
	
	echo( $listNo.",".$name.",".$row[4].",".$row[1].",".$row[2].",".$row[0]);
	echo( $newline);     // 줄 바꾸기             
}
?>
