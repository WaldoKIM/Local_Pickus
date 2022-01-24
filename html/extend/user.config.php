<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 게시글보기 썸네일 생성
function get_view_thumbnail2($contents, $thumb_width=0)
{
    global $board, $config;

    if (!$thumb_width)
        $thumb_width = $board['bo_image_width'];

    // $contents 중 img 태그 추출
    $matches = get_editor_image($contents, true);

    if(empty($matches))
        return $contents;

	// Exif
	$exif = array();

	$is_exif = false;
	if(isset($board['as_exif']) && $board['as_exif']) {
		$extxt = load_aslang('exif');
		$is_exif = true;
	}

	// View Original
	$is_view = (isset($board['as_lightbox']) && $board['as_lightbox']) ? $board['as_lightbox'] : 0;
	
	// Lightbox
	if($is_view == "1" || $is_view == "3") {
		apms_script('lightbox');
	}

	if(!is_array($matches[1])) {
		$matches[1] = array();
	}

    for($i=0; $i<count($matches[1]); $i++) {

		$img_tag = $matches[0][$i];
        $img = $matches[1][$i];

        preg_match("/src=[\'\"]?([^>\'\"]+[^>\'\"]+)/i", $img, $m);
        $src = $m[1];
        preg_match("/style=[\"\']?([^\"\'>]+)/i", $img, $m);
        $style = $m[1];

		//높이는 체크안함
		preg_match("/width:\s*(\d+)px/", $style, $m);
        $width = $m[1];
		if(!$width) {
			preg_match("/width=[\"\']?([^\"\'>]+)/i", $img, $m);
			$width = $m[1];
		}
		preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $img, $m);
        $alt = get_text($m[1]);
		if($is_view == "4") { //사용안함
		    $link = 1;
		} else {
			preg_match("/link=[\"\']?([^\"\']*)[\"\']?/", $img, $m); // APMS 추가
		    $link = get_text($m[1]);
		}
		preg_match("/align=[\"\']?([^\"\']*)[\"\']?/", $img, $m); // APMS 추가
        $align = get_text($m[1]);
        preg_match("/class=[\"\']?([^\"\']*)[\"\']?/", $img, $m); // APMS 추가
        $class = get_text($m[1]);

		// 이미지 속성정리
		$img_attr = '';
		if($align) $img_attr .= ' align="'.$align.'"';
		if($width) $img_attr .= ' style="width:'.$width.'px;"';

        // 이미지 path 구함
        $p = @parse_url($src);
        if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
            $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
        else
            $data_path = $p['path'];

        $srcfile = G5_PATH.$data_path;

		$itemprop = ($i == 0) ? ' itemprop="image" content="'.$src.'"' : '';

		// Exif
		unset($exif);
		$exif_info = '';

        if(is_file($srcfile)) {
            $size = @getimagesize($srcfile);
            if(empty($size))
                continue;

            // jpg 이면 exif 체크
            if($size[2] == 2 && function_exists('exif_read_data')) {
                $degree = 0;
                $exif = @exif_read_data($srcfile);
                if(!empty($exif['Orientation'])) {
                    switch($exif['Orientation']) {
                        case 8:
                            $degree = 90;
                            break;
                        case 3:
                            $degree = 180;
                            break;
                        case 6:
                            $degree = -90;
                            break;
                    }

                    // 세로사진의 경우 가로, 세로 값 바꿈
                    if($degree == 90 || $degree == -90) {
                        $tmp = $size;
                        $size[0] = $tmp[1];
                        $size[1] = $tmp[0];
                    }
                }

				// Exif 정보 체크
				if($is_exif) {
					$exif_info = apms_get_view_exif($exif, $srcfile, $extxt);
				}
			}

            // 원본 width가 thumb_width보다 작다면 썸네일생성 안함
            if($size[0] <= $thumb_width) {

				$thumb_tag = '<img'.$itemprop.' src="'.$src.'" alt="'.$alt.'" class="img-tag '.$class.'"'.$img_attr.'/>';

				// 원본이 600보다 클 경우 $img_tag에 editor 경로가 있으면 원본보기 링크 추가
				if(!$link && $size[0] > 600 && preg_match("/\.({$config['cf_image_extension']})$/i", basename($srcfile))) {
					if($is_view == "1" || $is_view == "3") {
						$caption = ($alt) ? ' data-title="'.$alt.'"' : '';
						$thumb_tag = '<a href="'.$src.'" data-lightbox="view-lightbox"'.$caption.' target="_blank">'.$thumb_tag.'</a>';
					} else if (strpos($img_tag, G5_DATA_DIR.'/'.G5_EDITOR_DIR) || strpos($img_tag, G5_DATA_DIR.'/file')) {
						//$thumb_tag = '<a href="'.G5_BBS_URL.'/view_image.php?fn='.urlencode(str_replace(G5_URL, "", $src)).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
					} else {
						//$thumb_tag = '<a href="'.G5_BBS_URL.'/view_img.php?img='.urlencode($src).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
					}
				}

				// Exif 정보출력
				if($exif_info) {
					$thumb_tag = '<div class="img-exif">'.$thumb_tag.''.$exif_info.'</div>'.PHP_EOL;
				}

				$contents = str_replace($img_tag, $thumb_tag, $contents);

				continue;
			}

            // Animated GIF 체크
            $is_animated = false;
            if($size[2] == 1) {
                $is_animated = is_animated_gif($srcfile);
            }

            // 썸네일 높이
            $thumb_height = round(($thumb_width * $size[1]) / $size[0]);
            $filename = basename($srcfile);
            $filepath = dirname($srcfile);

            // 썸네일 생성
            if(!$is_animated)
                $thumb_file = thumbnail($filename, $filepath, $filepath, $thumb_width, $thumb_height, false);
            else
                $thumb_file = $filename;

            if(!$thumb_file)
                $thumb_file = $filename;

			// 이미지
			$thumb_tag = '<img'.$itemprop.' src="'.G5_URL.str_replace($filename, $thumb_file, $data_path).'" alt="'.$alt.'" class="img-tag '.$class.'"'.$img_attr.'/>';

            // 원본이 600보다 클 경우 $img_tag에 editor 경로가 있으면 원본보기 링크 추가
			if(!$link && $size[0] > 600 && preg_match("/\.({$config['cf_image_extension']})$/i", $filename)) {
				if($is_view == "1" || $is_view == "3") {
					$caption = ($alt) ? ' data-title="'.$alt.'"' : '';
					//$thumb_tag = '<a href="'.$src.'" data-lightbox="view-lightbox"'.$caption.' target="_blank">'.$thumb_tag.'</a>';
				} else if (strpos($img_tag, G5_DATA_DIR.'/'.G5_EDITOR_DIR) || strpos($img_tag, G5_DATA_DIR.'/file')) {
					//$thumb_tag = '<a href="'.G5_BBS_URL.'/view_image.php?fn='.urlencode(str_replace(G5_URL, "", $src)).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
				} else {
					//$thumb_tag = '<a href="'.G5_BBS_URL.'/view_img.php?img='.urlencode($src).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
				}
			}

			// Exif 정보출력
			if($exif_info) {
				$thumb_tag = '<div class="img-exif">'.$thumb_tag.''.$exif_info.'</div>'.PHP_EOL;
			}

            $contents = str_replace($img_tag, $thumb_tag, $contents);

		} else {

			$thumb_tag = '<img'.$itemprop.' src="'.$src.'" alt="'.$alt.'" class="img-tag '.$class.'"'.$img_attr.'/>';

			if($link || $is_view > 1) {
				;
			} else {
				if($is_view == "1") {
					$caption = ($alt) ? ' data-title="'.$alt.'"' : '';
					$thumb_tag = '<a href="'.$src.'" data-lightbox="view-lightbox"'.$caption.' target="_blank">'.$thumb_tag.'</a>';
				} else {
					$thumb_tag = '<a href="'.G5_BBS_URL.'/view_img.php?img='.urlencode($src).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
				}
			}

			$contents = str_replace($img_tag, $thumb_tag, $contents);
		}
    }

    return $contents;
}
?>