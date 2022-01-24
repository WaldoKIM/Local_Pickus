<? include('../common.php');?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="css/popup.css">
<link rel="stylesheet" type="text/css" href="css/joinform_style.css">

<!-- /main 내용 출력 시작  -->
<body oncontextmenu="return false" onselectstart="return false"<?//우클릭 방지?>>
<main role="main">

	<!--메인 컨텐츠시작-->
	<div id="main" class="row nine_height" style="background-color:#000; padding-top:30px;">
		<div class="row-content buffer-left buffer-right clear-after">

			<!-- 내용 컨텐츠 테이블 시작 -->
			<div class="contects_T contects_sline" align="center">
				<!--내용출력시작-->
				<div class="sub_contents_all" style="padding:10px; background-color:#000" >				
					<?	
						$goods_data	= $tools->decode( $_GET[goods_data] );
						$idx = $goods_data[idx];
						$goods_stat = $db->object("cs_goods", "where idx=$idx");
						if($_GET[audio] == 1){
							$goods_file_name=explode("&&", $goods_stat->goods_file );
						}else if($_GET[audio] == 2){
							$goods_file_name=explode("&&", $goods_stat->goods_file2 );
						}else if($_GET[audio] == 3){
							$goods_file_name=explode("&&", $goods_stat->goods_file3 );
						}
						$goods_file_name=preg_replace("/.mp3/", "",$goods_file_name[1]);
					?>
					<span style="font-weight:700; font-size:1.5em;color:#999; line-height:50px;"><?//=$db->stripSlash($goods_stat->name);?> <?=$goods_file_name;?></span>
					<audio src="./audio_download.php?goods_data=<?=$_GET['goods_data'];?>&audio=<?=$_GET[audio];?>&download=1" controls="play" <?=$_GET[autoplay]?> preload="auto" type="audio/mp3"></audio>
					<br>
					<!-- 출력내용 -->
				</div>
				<!--내용출력 끝-->
			</div>
			<!-- 내용 컨텐츠 테이블 끝 -->
		</div>
	</div><!-- row -->
	<!--메인 컨텐츠 끝-->

</main>
<!-- /main 내용 출력 끝  -->
</body>
</html>