<?
phpinfo();
echo "<br>1설치 확인, 없으면 설치 안되어 있음<br>";
echo "<br><br>iconv 설치체크 : ".extension_loaded("iconv")."=====.";
echo "<br><br>gd 설치체크 : ".extension_loaded("gd")."=====";
echo "<br><br>exif 설치체크 : ".extension_loaded("exif")."=====";
echo "<br><br>exif SOAP 설치체크: ".extension_loaded("SOAP")."=====";

$ROOT_PATH = @fgets( popen("pwd", "r"), 256 );
$ROOT_PATH = str_replace("\n", "", $ROOT_PATH)."/"; 
echo $ROOT_PATH;
?>
