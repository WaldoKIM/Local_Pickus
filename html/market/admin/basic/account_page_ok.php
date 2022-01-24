<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

$pgInfo = $db->object("cs_pgsetup", "");

//$_POST=&$HTTP_POST_VARS;

	if($_POST[del_pg_logo]){
		@unlink("../../data/designImages/".$pgInfo->pg_logo); 
		$pg_logo_img = "";
	}else{
		if( $_FILES[pg_logo][size] > 0 ) {
			$TempExt = explode(".",$_FILES[pg_logo][name]); 
			if( $_FILES[pg_logo][size] > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
			$pg_logo_img = 'PG_LOGO_'.time().".".$TempExt[count($TempExt)-1];
			if( !@move_uploaded_file( $_FILES[pg_logo][tmp_name], "../../data/designImages/".$pg_logo_img )) {
				$tools->errMsg("파일 업로드 에러"); 
			} else {
				//원본삭제
				@unlink("../../data/designImages/".$pgInfo->pg_logo); 
				//임시파일삭제
				@unlink($_FILES[pg_logo][tmp_name]); 
			} 
		}else{
			$pg_logo_img = $pgInfo->pg_logo;
		}
	}

	if($_POST[del_escicon]){
		@unlink("../../data/designImages/".$pgInfo->escicon); 
		$pg_escicon = "";
	}else{
		if( $_FILES[escicon][size] > 0 ) {
			$TempExt = explode(".",$_FILES[escicon][name]); 
			if( $_FILES[escicon][size] > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n1메가 까지 업로드 가능합니다"); exit(); }
			$pg_escicon = 'PG_LOGO_'.time().".".$TempExt[count($TempExt)-1];
			if( !@move_uploaded_file( $_FILES[escicon][tmp_name], "../../data/designImages/".$pg_escicon )) {
				$tools->errMsg("파일 업로드 에러"); 
			} else {
				//원본삭제
				@unlink("../../data/designImages/".$pgInfo->escicon); 
				//임시파일삭제
				@unlink($_FILES[escicon][tmp_name]); 
			} 
		}else{
			$pg_escicon = $pgInfo->escicon;
		}
	}

if(!$_POST[pg_true]){$_POST[pg_true] = 0;}
if(!$_POST[pg_card]){$_POST[pg_card] = 0;}
if(!$_POST[pg_ich]){$_POST[pg_ich] = 0;}
if(!$_POST[pg_ich_escr]){$_POST[pg_ich_escr] = 0;}
if(!$_POST[pg_vich]){$_POST[pg_vich] = 0;}
if(!$_POST[pg_vich_escr]){$_POST[pg_vich_escr] = 0;}
if(!$_POST[pg_logo_option]){$_POST[pg_logo_option] = 0;}
if(!$_POST[pg_phone]){$_POST[pg_phone] = 0;}

	// 디비입력 쿼리
	$sql="pg_true=$_POST[pg_true], pg_card=$_POST[pg_card], pg_ich=$_POST[pg_ich], pg_ich_escr=$_POST[pg_ich_escr],  pg_vich=$_POST[pg_vich], pg_vich_escr=$_POST[pg_vich_escr], pg_phone=$_POST[pg_phone], pg_code='$_POST[pg_code]', pg_key='$_POST[pg_key]', pg_logo_option=$_POST[pg_logo_option], pg_logo='$pg_logo_img', escicon='$pg_escicon'";

	// 디비입력
	if( $db->cnt("cs_pgsetup", "")) {
		if( $db->update("cs_pgsetup", $sql) ) {
			$tools->alertJavaGo("저장 완료 되었습니다.", "account_page.php");
		} else {
			$tools->errMsg('비상적으로 입력 되었습니다.'); 
		}
	} else { if( $db->insert("cs_pgsetup", $sql) ) { $tools->alertJavaGo("저장 완료 되었습니다.", "account_page.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
?>
