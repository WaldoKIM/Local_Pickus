<?
include('../../common.php');
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}

Header("Content-type: file/unknown");     
Header("Content-Disposition: attachment;  filename=crm0.csv");   
Header("Content-Description: PHP3 Generated Data"); 
Header("Pragma: no-cache"); 
Header("Expires: 0"); 


$newline = chr(10);            //  LF(줄바꿈)의 ascii 값을 얻는다. 
$eeee = iconv("UTF-8","EUC-KR","번호, 제품명, 제품번호, 소비자가격, 쇼핑몰가격, 조회수"); 
echo $eeee;		 //  타이틀 쓰고

echo($newline);                     //  줄바꾸기 
$result		    = $db->select("cs_goods", "order by click desc" );
while( $row = @mysqli_fetch_object($result)) {
	++$listNo;
	$name = iconv("UTF-8","EUC-KR",$row->name); 
	echo( $listNo.",".$name.",".$row->code.",".$row->old_price.",".$row->shop_price.",".$row->click);
	echo( $newline);     // 줄 바꾸기             
}

?>
