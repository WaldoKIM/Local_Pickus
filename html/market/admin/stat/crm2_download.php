<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=crm2.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 

//$_GET=&$HTTP_GET_VARS;
if($_GET[date]==1) {
	$result=$db->result("select left(trade_day, 4), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by left(trade_day, 4)");	
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","연도, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고


	echo($newline);                     //  줄바꾸기 

	while($row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}

} else if($_GET[date]==2) {
	$result=$db->result("select substring(trade_day, 6, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by substring(trade_day, 6, 2)");
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","월별, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 

	while( $row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}
} else if($_GET[date]==3) {
	$result=$db->result("select substring(trade_day, 9, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by substring(trade_day, 9, 2)");
	
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","일별, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 

	while( $row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}

} else if($_GET[date]==4) {
	$result=$db->result("select DAYNAME(left(trade_day, 10)), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by DAYNAME(left(trade_day, 10))");

	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","요일별, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 
	while( $row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}
} else if($_GET[date]==5 && $_GET[year]==0 && $_GET[mon]==0) {
	$result=$db->result("select left(trade_day, 4), count(idx), sum(trade_price), count(order_userid) from cs_trade where trade_stat=4 group by left(trade_day, 4)");	
	
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","연도, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 
	while($row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}

} else if($_GET[date]==5 && $_GET[year] && $_GET[mon]==0) {
	// 판매완료한 총 구매수
	$total_trade_cnt=$db->cnt("cs_trade", "where left(trade_day, 4)='$_GET[year]' and trade_stat=4");
	// 판매완료한 총 구입금액
	$total_trade_price=$db->sum("cs_trade", "where left(trade_day, 4)='$_GET[year]' and trade_stat=4", "trade_price");
	$result=$db->result("select substring(trade_day, 6, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where left(trade_day, 4)='$_GET[year]' and trade_stat=4 group by substring(trade_day, 6, 2)");
	
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","월별, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 
	while( $row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}

} else if($_GET[date]==5 && $_GET[year] && $_GET[mon]) {
	// 판매완료한 총 구매수
	$total_trade_cnt=$db->cnt("cs_trade", "where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4");
	// 판매완료한 총 구입금액
	$total_trade_price=$db->sum("cs_trade", "where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4", "trade_price");
	$result=$db->result("select substring(trade_day, 9, 2), count(idx), sum(trade_price), count(order_userid) from cs_trade where left(trade_day, 4)='$_GET[year]' and substring(trade_day, 6, 2)=$_GET[mon] and trade_stat=4 group by substring(trade_day, 9, 2)");
	
	$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
	$eeee = iconv("UTF-8","EUC-KR","일별, 판매수, 구매금액, 구매자정보"); 
	echo $eeee;		 //  타이틀 쓰고
	echo($newline);                     //  줄바꾸기 

	while( $row = @mysqli_fetch_array( $result )) {
		echo( $row[0].",".$row[1].",".$row[2].",".iconv("UTF-8","EUC-KR","회원")."(".$row[3].")"." / ".iconv("UTF-8","EUC-KR","비회원")."(".$no_cnt.")");
		echo( $newline);     // 줄 바꾸기             
	}
}









?>
