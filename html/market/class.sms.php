<?
///////////////////////////////////////////////////////////////////////////////////////////
// 이 부분은 건드릴 필요가 없습니다.
function get_coins($url,$sms_id,$sms_pw){

 

           $data = array(

                     'sms_id' => $sms_id,

                     'sms_pw' => $sms_pw

           );

 

           while(list($n,$v) = each($data)){

                     $send_data[] = "$n=$v";     

           }

           $send_data = implode('&', $send_data);

 

           //url 파싱

           $url = parse_url($url);

 

           $host = $url['host'];

           $path = $url['path'];

 

           //소켓 오픈     

           $fp = fsockopen($host, 80, $errno, $errstr, 10.0);

           if (!is_resource($fp)){

                     echo "not connect host : errno=$errno,errstr=$errstr";

                     exit;

           }

 

           fputs($fp, "POST $path HTTP/1.1\r\n");

           fputs($fp, "Host: $host\r\n");

           fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");

           fputs($fp, "Content-length: " . strlen($send_data) . "\r\n");

           fputs($fp, "Connection:close" . "\r\n\r\n");

           fputs($fp, $send_data);

 

           //반환값 받기

           $result = "";

           while(!feof($fp)) {

                     $result .= fgets($fp, 128);

           }

           fclose($fp);

 

           //헤더와 컨텐츠 구분     

           $result = explode("\r\n\r\n", $result, 2);

           $header = isset($result[0]) ? $result[0] : '';

           $content = isset($result[1]) ? $result[1] : '';

           

 

           $rMsg = explode("-#^#-", $content); 

           $r_coins[0] = $rMsg[0]; //잔여금액 

           $r_coins[1] = $rMsg[1]; //발송가능건수

           $r_coins[2] = $rMsg[2]; //건당요금

 

           return $r_coins;

}

function spacing($text,$size) {
	for ($i=0; $i<$size; $i++) $text.=" ";
	$text = substr($text,0,$size);
	return $text;
}

function cut_char($word, $cut) {
//	$word=trim(stripslashes($word));
	$word=substr($word,0,$cut);						// 필요한 길이만큼 취함.
	for ($k=$cut-1; $k>1; $k--) {	 
		if (ord(substr($word,$k,1))<128) break;		// 한글값은 160 이상.
	}
	$word=substr($word,0,$cut-($cut-$k+1)%2);
	return $word;
}

function CheckCommonType($dest, $rsvTime) {
	$dest=preg_match("/[^0-9]/","",$dest);
	if (strlen($dest)<10 || strlen($dest)>11) return "휴대폰 번호가 틀렸습니다";
	$CID=substr($dest,0,3);
	if ( preg_match("/[^0-9]/",$CID) || ($CID!='010' && $CID!='011' && $CID!='016' && $CID!='017' && $CID!='018' && $CID!='019') ) return "휴대폰 앞자리 번호가 잘못되었습니다";
	$rsvTime=preg_match("[^0-9]","",$rsvTime);
	if ($rsvTime) {
		if (!checkdate(substr($rsvTime,4,2),substr($rsvTime,6,2),substr($rsvTime,0,4))) return "예약날짜가 잘못되었습니다";
		if (substr($rsvTime,8,2)>23 || substr($rsvTime,10,2)>59) return "예약시간이 잘못되었습니다";
	}
}

class SMS {
	var $ID;
	var $PWD;
	var $SMS_Server;
	var $port;
	var $SMS_Port;
	var $Data = array();
	var $Result = array();

	function SMS_con($sms_server,$sms_id,$sms_pw,$portcode) {
		if ($portcode == 1) {
			$port=(int)rand(7192,7195); 
		} else {
			$port=(int)rand(7196,7199); 
		}

		$this->ID=$sms_id;		// 계약 후 지정
		$this->PWD=$sms_pw;		// 계약 후 지정
		$this->SMS_Server=$sms_server;
		$this->SMS_Port=$port;
		$this->ID = spacing($this->ID,10);
		$this->PWD = spacing($this->PWD,10);
	}

	function Init() {
		$this->Data = "";
		$this->Result = "";
	}

	function Add($dest, $callBack, $Caller, $msg, $rsvTime="") {
		// 내용 검사 1
		$Error = CheckCommonType($dest, $rsvTime);
		if ($Error) return $Error;
		// 내용 검사 2
		if ( preg_match("/[^0-9]/",$callBack) ) return "회신 전화번호가 잘못되었습니다";
		$msg=cut_char($msg,80); // 80자 제한
		// 보낼 내용을 배열에 집어넣기
		$dest = spacing($dest,11);
		$callBack = spacing($callBack,11);
		$Caller = spacing($Caller,10);
		$rsvTime = spacing($rsvTime,12);
		$msg = spacing($msg,80);
		$this->Data[] = '01144 '.$this->ID.$this->PWD.$dest.$callBack.$Caller.$rsvTime.$msg;
		return "";
	}

	function AddURL($dest, $callBack, $URL, $msg, $rsvTime="") {
		// 내용 검사 1
		$Error = CheckCommonType($dest, $rsvTime);
		if ($Error) return $Error;
		// 내용 검사 2
		//$URL=str_replace("http://","",$URL);
		if (strlen($URL)>50) return "URL이 50자가 넘었습니다";
		switch (substr($dest,0,3)) {
			case '010': //20바이트
                $msg=cut_char($msg,20);
				break;
			case '011': //80바이트
                $msg=cut_char($msg,80);
				break;
			case '016': // 80바이트
				$msg=cut_char($msg,80);
				break;
			case '017': // URL 포함 80바이트
				$msg=cut_char($msg,80-strlen($URL));
				break;
			case '018': // 20바이트
				$msg=cut_char($msg,20);
				break;
			case '019': // 20바이트
				$msg=cut_char($msg,20);
				break;
			default:
				return "아직 URL CallBack이 지원되지 않는 번호입니다";
				break;
		}
		// 보낼 내용을 배열에 집어넣기
		$dest = spacing($dest,11);
		$URL = spacing($URL,50);
		$callBack = spacing($callBack,11);
		$rsvTime = spacing($rsvTime,12);
		$msg = spacing($msg,80);
		$this->Data[] = '05173 '.$this->ID.$this->PWD.$dest.$callBack.$URL.$rsvTime.$msg;
		return "";
	}

	function Send () {
		$fp=fsockopen($this->SMS_Server,$this->SMS_Port);
		if (!$fp) return false;
		set_time_limit(300);

		## php4.3.10일경우
        ## zend 최신버전으로 업해주세요.. 
        ## 또는 128번째 줄을 $this->Data as $tmp => $puts 로 변경해 주세요.

		foreach($this->Data as $puts) {
			$dest = substr($puts,26,11);
			fputs($fp,$puts);
			while(!$gets) { $gets=fgets($fp,30); }
			if (substr($gets,0,19)=="0223  00".$dest) $this->Result[]=$dest.":".substr($gets,19,10);
			else $this->Result[$dest]=$dest.":Error";
			$gets="";
		}
		fclose($fp);
		$this->Data="";
		return true;
	}

}
?>
