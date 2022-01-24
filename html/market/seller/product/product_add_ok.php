<?
include('../../common.php'); 
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;
//$_FILES=&$HTTP_POST_FILES;

function resize($max_width, $max_height, $source_file, $dst_dir, $crop = false, $watermark = false, $quality = 100) {
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    switch($mime){
        case 'image/gif':
            $image_create = 'imagecreatefromgif';
            $image = 'imagegif';
            break;

        case 'image/png':
            $image_create = 'imagecreatefrompng';
            $image = 'imagepng';
            $quality = 7;
            break;

        case 'image/jpeg':
            $image_create = 'imagecreatefromjpeg';
            $image = 'imagejpeg';
            $quality = 80;
            break;

        default:
            return false;
            break;
    }
    
    $src_img = $image_create($source_file);

    $is_lotate = false;
    if ($mime == 'image/jpeg') {
        // 자동으로 이미지가 회전되는 현상 해결
        $exif = exif_read_data($source_file);
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 8:
                    $src_img = imagerotate($src_img, 90, 0);
                    $is_lotate = true;
                    break;
                case 3:
                    $src_img = imagerotate($src_img, 180, 0);
                    break;
                case 6:
                    $src_img = imagerotate($src_img, -90, 0);
                    $is_lotate = true;
                    break;
            }
        }
    }

    if (!$crop) {
        // 회전됨에 따라 가로, 세로 뒤바꾸기
        if ($is_lotate) {
            $tmp_max_width = $max_width;
            $max_width = $max_height;
            $max_height = $tmp_max_width;
            $tmp_width = $width;
            $width = $height;
            $height = $tmp_width;
        }

        if ($width >= $height) {
            // 가로가 클 경우 - 가로 제한을 기준으로 리사이즈 (세로:비율에 따른 축소, 가로:max-width) -- (original height / original width) x new width = new height
            $max_height = ceil(($height / $width) * $max_width);
            $max_width = $max_width;
        } else {
            // 세로가 클 경우 - 세로 제한을 기준으로 리사이즈 (세로:max-height, 가로:비율에 따른 축소) -- (original width / original height) x new height = new width
            // $max_width = ceil(($width / $height) * $max_height);
            $max_height = $max_height;
        }
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);

    // png는 배경 불투명하게 
    if ( $mime == 'image/png' ) {
        imagealphablending($dst_img, false);
        imagesavealpha($dst_img, true);
        $transparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
        imagefilledrectangle($dst_img, 0, 0, $width, $height, $transparent);
    }

    if ($crop) {
        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }
    } else {
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, $width, $height);
    }

    $image($dst_img, $dst_dir, $quality);

    if( $watermark == true ) {
        $stamp = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/images/watermark.png');
        $im = imagecreatefromjpeg($dst_dir);

        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        $x_dst = ( $max_width - $sx ) / 2;
        $y_dst = ( $max_height - $sy ) / 2;

        imagecopy($im, $stamp, $x_dst, $y_dst, 0, 0, imagesx($stamp), imagesy($stamp));
        imagejpeg($im, $dst_dir, 100);
        if($im)imagedestroy($im);
    }

    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);
}


// 관리자 기본설정을 가져온다
$admin_row = $db->object("cs_admin", "", "point_basic");

if( $tools->chkDigit($_POST[part_code] )) {
	$part_row=$db->object("cs_part", "where part1_code='$_POST[part_code]' or part2_code='$_POST[part_code]' or part3_code='$_POST[part_code]'", "idx");
	// 따음표 체크
	$_POST[name]				= $db->addSlash ( $_POST[name] );
	$_POST[company]			= $db->addSlash ( $_POST[company] );
	if( $_POST[option_check] ==1) 	{ $_POST[option1_name]	= $db->addSlash ( $_POST[option1_name] );}
	if( $_POST[option_check] ==2) 	{ $_POST[option1_name]	= $db->addSlash ( $_POST[option1_name] ); $_POST[option2_name]	= $db->addSlash ( $_POST[option2_name] );}
	//$_POST[content]				= $db->addSlash ( $_POST[content] );
	
	// 포인트에 값이 없을 경우에는 관리자의 기본 포인트를 사용합니다.
	if( !$_POST[point] ) { $_POST[point]=$admin_row->point_basic; }

	// 수량 체크
	if( !$_POST[number]) { $_POST[number]=0;}
	if( !$_POST[unlimit]) { $_POST[unlimit]=0;
}

	// 중량 배송을 사용하지 않을 경우
	if( !$_POST[box] ) { $_POST[box]=0; }


	// 옵션 체크 ( 구분자 : && )
	for($j=0;$j<sizeof($_POST[optName]);$j++) {
		if($_POST[optName][$j]){ $Optdata .= $_POST[optName][$j]."/^/^".$_POST[hidden_option_data][$j]."/^CUT/^"; }
	}


	for($i=1;$i<=3;$i++){
		if( $_FILES["images".$i][size] > 0 ) {
			if( $_FILES["images".$i][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
			$EXT_TMP = explode( ".", $_FILES["images".$i][name]);
			${"images".$i} = 'GOODS'.$i.'_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file( $_FILES["images".$i][tmp_name], "../../data/goodsImages/".${"images".$i} )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES["images".$i][tmp_name]); } 
			
			$source_file = "../../data/goodsImages/".${"images".$i}; //업로드 된 이미지
			$dst_dir = "../../data/goodsImages/".${"images".$i}; //앞에 64_ 를 붙히고 저장
						
			resize(500, 500, $source_file, $dst_dir);
			

		}else{
			${"images".$i} = "";
		}
	}


	// 추가 상품 이미지 등록
	for($i=1;$i<=5;$i++){
		if( $_FILES["add_images".$i][size] > 0 ) {
			if( $_FILES["add_images".$i][size] > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
			$EXT_TMP = explode( ".", $_FILES["add_images".$i][name]);
			${"add_images".$i} = 'ADD_GOODS'.$i.'_'.time().".".$EXT_TMP[count($EXT_TMP)-1];
			if( !@move_uploaded_file( $_FILES["add_images".$i][tmp_name], "../../data/goodsImages/".${"add_images".$i} )) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES["add_images".$i][tmp_name]); } 
		
			$source_file = "../../data/goodsImages/".${"add_images".$i}; //업로드 된 이미지
			$dst_dir = "../../data/goodsImages/".${"add_images".$i}; //앞에 64_ 를 붙히고 저장
						
			resize(500, 500, $source_file, $dst_dir);

		} else {
			${"add_images".$i} = "";
		}
	}

	// 상품 첨부파일
	if( $_POST[file_check] == 1 ) {
		if( $_FILES[goods_file][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( !strstr( $_FILES[goods_file][name], ".")) { $tools->errMsg( strtoupper("확장자가 없는 ".$_FILES[goods_file][name])." 은 업로드 할수 없습니다." ); } else if( $EXT_TMP = explode( ".", $_FILES[goods_file][name])) { foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." );}}}
			if( $_FILES[goods_file][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
			$goods_file_name	= time()."&&".$_FILES[goods_file][name];
			if( !@move_uploaded_file($_FILES[goods_file][tmp_name], "../../data/goodsImages/".$goods_file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[goods_file][tmp_name]);} 
		}
		
		if( $_FILES[goods_file2][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( !strstr( $_FILES[goods_file2][name], ".")) { $tools->errMsg( strtoupper("확장자가 없는 ".$_FILES[goods_file2][name])." 은 업로드 할수 없습니다." ); } else if( $EXT_TMP = explode( ".", $_FILES[goods_file2][name])) { foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." );}}}
			if( $_FILES[goods_file2][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
			$goods_file2_name	= time()."&&".$_FILES[goods_file2][name];
			if( !@move_uploaded_file($_FILES[goods_file2][tmp_name], "../../data/goodsImages/".$goods_file2_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[goods_file2][tmp_name]);} 
		}

		if( $_FILES[goods_file3][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( !strstr( $_FILES[goods_file3][name], ".")) { $tools->errMsg( strtoupper("확장자가 없는 ".$_FILES[goods_file3][name])." 은 업로드 할수 없습니다." ); } else if( $EXT_TMP = explode( ".", $_FILES[goods_file3][name])) { foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." );}}}
			if( $_FILES[goods_file3][size]  > 1024*1024*$MAXFILESIZE) { $tools->errMsg("업로드 용량 초과입니다\\n\\n$MAXFILESIZE 메가 까지 업로드 가능합니다"); exit(); }
			$goods_file3_name	= time()."&&".$_FILES[goods_file3][name];
			if( !@move_uploaded_file($_FILES[goods_file3][tmp_name], "../../data/goodsImages/".$goods_file3_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[goods_file3][tmp_name]);} 
		}
	} else {
		$goods_file_name 	= "";
		$goods_file2_name 	= "";
		$goods_file3_name 	= "";
	}

	$result = $db->object("cs_goods","order by ranking desc limit 1");
	$ranking = $result->ranking+1;

	//추가필드 정리
	for($j=0;$j<sizeof($_POST[fieldname]);$j++) {
		if($_POST[fieldname][$j]){
			${"addfieldname".($j+1)} = $_POST[fieldname][$j];
			${"addfielddata".($j+1)} = $_POST[fielddata][$j];
		}
	}

	
	// 이벤트아이콘설정
	for($i=0;$i<sizeof($_POST[iconidx]);$i++) {
		if($i==0) $iconlist = $_POST[iconidx][$i];
		else $iconlist .= ",".$_POST[iconidx][$i];
	}

	// 대체아이콘
	for($i=0;$i<sizeof($_POST[substimg]);$i++) {
		if($i==0) $iconlist2 = $_POST[substimg][$i];
		else $iconlist2 .= ",".$_POST[substimg][$i];
	}

	// $subitemtarget = "";
	// if($_POST['subitemtarget'] == ''){
	// 	$subitemtarget = 0;
	// }else{
	// 	$subitemtarget=$_POST['subitemtarget'];
	// }

	// $subst = "";
	// if($_POST['subst'] == ''){
	// 	$subst = 0;
	// }else{
	// 	$subst=$_POST['subst'];
	// }

	// $old_price = "";
	// if($_POST['old_price'] == ''){
	// 	$old_price = 0;
	// }else{
	// 	$old_price=$_POST['old_price'];
	// }

	$subitemtarget=$_POST['subitemtarget']?$_POST['subitemtarget']:0;
	$subst=$_POST['subst']?$_POST['subst']:0;
	$old_price=$_POST['old_price']?$_POST['old_price']:0;
	$mincnt=$_POST['mincnt']?$_POST['mincnt']:0;
	$deliv_fee=$_POST['deliv_fee']?$_POST['deliv_fee']:0;
	$deliv_exc=$_POST['deliv_exc']?$_POST['deliv_exc']:0;

	$sql = "part_idx=$part_row->idx, display='$_POST[display]', subitem='$_POST[subitem]', subitemtarget=$subitemtarget,
			itemlist='$_POST[itemlist]', tag='$_POST[tag]', description='$_POST[description]', code='$_POST[code]', subst=$subst, 
			substtxt='$_POST[substtxt]', resize='$_POST[resize]', substimg='$iconlist2', name='$_POST[name]', iconidx='$iconlist', company='$_POST[company]', 
			old_price=$old_price, shop_price=$_POST[shop_price], mincnt=$mincnt, unlimit=$_POST[unlimit], number=$_POST[number], 
			point='$_POST[point]', box=$_POST[box], opt_data='$Optdata', images1='$images1', images2='$images2', images3='$images3', add_images1='$add_images1', 
			add_images2='$add_images2', add_images3='$add_images3', add_images4='$add_images4', add_images5='$add_images5', 
			goods_file='$goods_file_name', goods_file2='$goods_file2_name', goods_file3='$goods_file3_name', 
			content='$_POST[content]', register=now(), ranking = $ranking, fieldname1='$addfieldname1', fielddata1='$addfielddata1', fieldname2='$addfieldname2', 
			fielddata2='$addfielddata2', fieldname3='$addfieldname3', fielddata3='$addfielddata3', fieldname4='$addfieldname4', fielddata4='$addfielddata4', 
			fieldname5='$addfieldname5', fielddata5='$addfielddata5', fieldname6='$addfieldname6', fielddata6='$addfielddata6', fieldname7='$addfieldname7', 
			fielddata7='$addfielddata7', fieldname8='$addfieldname8', fielddata8='$addfielddata8', fieldname9='$addfieldname9', fielddata9='$addfielddata9', 
			fieldname10='$addfieldname10', fielddata10='$addfielddata10', fieldname11='$addfieldname11', fielddata11='$addfielddata11', fieldname12='$addfieldname12', 
			fielddata12='$addfielddata12', fieldname13='$addfieldname13', fielddata13='$addfielddata13',  fieldname14='$addfieldname14', fielddata14='$addfielddata14', 
			fieldname15='$addfieldname15', fielddata15='$addfielddata15', main_position='2',
			deliv_fee=$deliv_exc, deliv_exc=$deliv_exc, seller='$_SESSION[USERID]', area='$_POST[area]', model_name='$_POST[model_name]', editorlist='$_POST[editorlist]' ";

	if( $db->insert("cs_goods", $sql) ) { $tools->javaGo("product_list.php"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
