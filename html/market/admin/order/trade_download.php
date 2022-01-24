<?
include('../../common.php');

// 거래 정보 수정
$mv_data	= $_GET[trade_data];
$trade_data	= $tools->decode( $_GET[trade_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $trade_data[idx]; }
if($_GET[trade_stat] )			{ $trade_stat = $_GET[trade_stat]; }				else { $trade_stat = $trade_data[trade_stat]; }
if($_GET[listNo] )					{ $listNo = $_GET[listNo]; }									else { $listNo = $trade_data[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }					else { $startPage	= $trade_data[startPage]; }
//검색
if($_GET[search_item_chk] )		{ $search_item_chk = $_GET[search_item_chk]; }				else { $search_item_chk	= $trade_data[search_item_chk]; }
if($_GET[search_mem_item] )		{ $search_mem_item = $_GET[search_mem_item]; }			else { $search_mem_item	= $trade_data[search_mem_item]; }
if($_GET[search_trade_item] )	{ $search_trade_item = $_GET[search_trade_item]; }		else { $search_trade_item	= $trade_data[search_trade_item]; }
if($_GET[search_order] )	{ $search_order = $_GET[search_order]; }		else { $search_order	= $trade_data[search_order]; }

if($_GET[search_day] )	 	{ $search_day = $_GET[search_day]; }				else { $search_day	= $trade_data[search_day]; }
if($_GET[search_day_str] )	 { $search_day_str = $_GET[search_day_str]; }		else { $search_day_str	= $trade_data[search_day_str]; }

// 상세정보를 저장
if($_GET[search_day] == 5 &&  $_GET[start_year] && $_GET[start_mon] && $_GET[start_day] && $_GET[end_year] && $_GET[end_mon] && $_GET[end_day] ) {
	$search_day_str = $_GET[start_year]."+".$_GET[start_mon]."+".$_GET[start_day]."+".$_GET[end_year]."+".$_GET[end_mon]."+".$_GET[end_day];
	$search_day_array = explode("+", $search_day_str );
}else{
	$search_day_array = explode("+", $search_day_str );
}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=order.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 

				// 상태 검색
				if(empty($trade_stat)) {
					$trade_stat_sql="";
				} else if($trade_stat==1) {
					$trade_stat_noand_sql="where trade_stat=1 ";		
					$trade_stat_sql="and trade_stat=1 ";		
				} else if($trade_stat==2) {
					$trade_stat_noand_sql="where trade_stat=2";		
					$trade_stat_sql="and trade_stat=2";		
				} else if($trade_stat==3) {
					$trade_stat_noand_sql="where trade_stat=3";		
					$trade_stat_sql="and trade_stat=3";		
				} else if($trade_stat==4) {
					$trade_stat_noand_sql="where trade_stat=4";		
					$trade_stat_sql="and trade_stat=4";		
				}

				// 날자 검색
				if($search_day==1) {
					// 오늘 주문검색
					$trade_day_sql = "where TO_DAYS(trade_day)=TO_DAYS(NOW()) $trade_stat_sql";
				} else if($search_day==2) {
					// 최근 일주일 주문검색
					$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=7 $trade_stat_sql";
				} else if($search_day==3) {
					// 최근 한달 주문검색
					$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=30 $trade_stat_sql";
				} else if($search_day==4) {
					// 최근 1년 주문검색
					$trade_day_sql = "where TO_DAYS(NOW())-TO_DAYS(trade_day)<=365 $trade_stat_sql";
				} else if($search_day==5) {
					// 상세 주문검색
					$trade_day_sql = "where DATE_FORMAT(trade_day,'%Y-%m-%d')>='$search_day_array[0]-$search_day_array[1]-$search_day_array[2]' and DATE_FORMAT(trade_day,'%Y-%m-%d')<='$search_day_array[3]-$search_day_array[4]-$search_day_array[5]' $trade_stat_sql";
				} else {
					// 주문검색
					$trade_day_sql = $trade_stat_noand_sql;
				}

				// 정보 검색
				if($search_item_chk == 1) {
					if($search_mem_item ==1) {
						$search_item_sql = "and order_userid like '%$search_order%'";
					} else if($search_mem_item ==2) {
						$search_item_sql = "and order_name like '%$search_order%'";
					} else if($search_mem_item ==3) {
						$search_item_sql = "and order_email like '%$search_order%'";
					} 
				} else if($search_item_chk == 2) {
					if($search_trade_item ==1) {
						$search_item_sql = "and trade_method = 1";
					} else if($search_trade_item ==2) {
						$search_item_sql = "and trade_method = 2";
					} else if($search_trade_item ==3) {
						$search_item_sql = "and trade_method = 3";
					} else if($search_trade_item ==4) {
						$search_item_sql = "and trade_method = 4";
					} else if($search_trade_item ==5) {
						$search_item_sql = "and trade_method = 5";
					} else if($search_trade_item ==6) {
						$search_item_sql = "and trade_method = 6";
					} 
				}
				
				$exc_result	= $db->select( "cs_trade", "$trade_day_sql $search_item_sql" );


// 엑셀파일 생성  ---------------------------------------------------------------------------------------------------------------------------------------//
$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
echo iconv("UTF-8","EUC-KR","번호, 주문번호, 주문상품, 주문자, 수신자, 결제금액, 결제방법, 연락처,수신자전화,수신자핸드폰, 주소, 주문일, 거래상태, 배송비");		 //  타이틀 쓰고 
echo($newline);                     //  줄바꾸기 
$No=0;
while($exc_row = @mysqli_fetch_object( $exc_result )) { 
	$No++;
	$trade_sql="where trade_code='".$exc_row->trade_code."' order by idx desc limit 1";
	$goods_result		= $db->select("cs_trade_goods", "$trade_sql");
	$goods_row = mysqli_fetch_object($goods_result);
	$goods_cnt		= $db->cnt("cs_trade_goods", "where trade_code='".$exc_row->trade_code."' ");
	$goodsnames = "0";


	if( $exc_row->trade_stat == 1 ) { $trade_stat_str="결제대기중";} else if( $exc_row->trade_stat == 2 ) { $trade_stat_str="결제확인됨";} else if( $exc_row->trade_stat == 3 ) { $trade_stat_str="상품배송중";} else if( $exc_row->trade_stat == 4 ) { $trade_stat_str="판매완료됨";}
	if( $exc_row->trade_method == 1 ) { $method="카드결제";} else if( $exc_row->trade_method == 2 ) { $method="계좌이체";} else if( $exc_row->trade_method == 3 ) { $method="휴대폰";} else if( $exc_row->trade_method == 4 ) { $method="가상계좌";} else if( $exc_row->trade_method == 5 ) { $method="무통장";} else if( $exc_row->trade_method == 6 ) { $method="포인트결제";}

	$trade_stat_str = iconv("UTF-8","EUC-KR",$trade_stat_str); 
	$method = iconv("UTF-8","EUC-KR",$method); 
	$exc_row->order_name = iconv("UTF-8","EUC-KR",$exc_row->order_name); 
	$exc_row->deliv_name = iconv("UTF-8","EUC-KR",$exc_row->deliv_name); 
	if($goods_cnt>1){
		$goodsnames = $goods_cnt-1;
		$goodsnames = iconv("UTF-8","EUC-KR",$goods_row->goods_name." 외 ".$goodsnames."건"); 
	}else{
		$goodsnames = iconv("UTF-8","EUC-KR",$goods_row->goods_name); 
	}
	$exc_row->deliv_add1 = iconv("UTF-8","EUC-KR",$exc_row->deliv_add1); 
	$exc_row->deliv_add2 = iconv("UTF-8","EUC-KR",$exc_row->deliv_add2); 

	echo($No.",".$exc_row->trade_code.",".$goodsnames.",".$exc_row->order_name.",".$exc_row->deliv_name.",".$exc_row->trade_price.",".$method.",".$exc_row->order_tel1."-".$exc_row->order_tel2."-".$exc_row->order_tel3.",".$exc_row->deliv_tel1."-".$exc_row->deliv_tel2."-".$exc_row->deliv_tel3.",".$exc_row->deliv_phone1."-".$exc_row->deliv_phone2."-".$exc_row->deliv_phone3.",".$exc_row->deliv_add1." ".$exc_row->deliv_add2 .",".$exc_row->trade_day.",".$trade_stat_str.",".$exc_row->trade_deliv_price);
	echo($newline);     // 줄 바꾸기
} 
//--------------------------------------------------------------------------------------------------------------------------------------------------------------//



?>
