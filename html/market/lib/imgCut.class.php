<?
class thumClass{
	function LoadImage ($flag,$fileName,$new_w,$new_h) {
		switch ($flag) {
			case 2:                                                                                    //jpg
			$im = @ImageCreateFromJPEG ($fileName);
			break;
			case 1:
			$im = @ImageCreateFromGIF ($fileName);
			break;
			case 3:                                                                                    //PNG
			$im = @ImageCreateFromPNG ($fileName);
			break;
		}
		return $im;
	}

	function create_image ($fileRoot,$static_w,$static_h) {
		header("Content-type:image/JPEG");
		$size=@getimagesize($fileRoot);                                                 //원본 이미지사이즈

		//목표크기보다 가로,세로 모두 작을 경우 원본사이즈크기
		if($static_w==0 || $static_h==0){
			$new_w=$size[0];
			$new_h=$size[1];
		}
		else{
			if($size[0]<$static_w && $size[1]<$static_h){
				$new_w=$size[0];
				$new_h=$size[1];
			}
			else if($size[0]>$size[1]){
				$new_h=($size[1]*$static_w)/$size[0];
				$new_w=$static_w;
			}
			else if($size[0]<$size[1]){
				$new_w=($size[0]*$static_h)/$size[1];
				$new_h=$static_h;
			}
			else if($size[0]==$size[1]){
				//
				$new_w=$static_w;
				$new_h=$static_h;
			}
		}


		$src_im=$this->LoadImage($size[2],$fileRoot,$new_w,$new_h);       //ImageCreateFrom%
		$dst_im = ImageCreatetruecolor($new_w,$new_h);                            //1,2번째 변수는 아무값

		imagealphablending($dst_im, false); 
		imagesavealpha($dst_im, true);

		Imagecopyresampled($dst_im,$src_im,0,0,0,0,$new_w,$new_h,imagesx($src_im),imagesy($src_im));
		ImagePNG($dst_im,"",9);
		ImageDestroy($dst_im);
		return $dst_im;
	}
}
?>
