/*
 *  Amina Comment Image Upload 1.0
 *
 *  Copyright (c) 2015 Amina
 *  http://amina.co.kr
 *
 */

 $(function(){
	$('#ajaxImgUploadForm').ajaxForm({
		beforeSubmit: function () {
			var imgFile = $("input[name='img_upload']").val();

			if(ajaxImgAuth) {
				alert(ajaxImgAuth);
				return false;
			}

			if(!imgFile) {
				alert("업로드 할 파일을 선택해 주세요.");
				return false;
			}

			if(ajaxImgFile) {
				var imgExt = imgFile.split('.').pop().toLowerCase();

				if($.inArray(imgExt, ['gif','png','jpg']) == -1) {
					alert('JPG/GIF/PNG 이미지파일만 업로드 할 수 있습니다.');
					return false;
				}
			}
		},
		dataType: 'json',
		success: function(data){
			if(data.success) {
				var imgUrl = data.success;
				var imgName = data.name;
				var imgInput = $("input[name='img_upload']");

				if(imgName) {
					document.getElementById("wr_content").value += '{첨부:' + imgName + '|' + imgUrl +'}\n';
				} else {
					//Imgur
					if(ajaxImgur) {
						$("#ajaxImgTag").html('<img src="' + imgUrl + '">');
					}
					document.getElementById("wr_content").value += '[' + imgUrl + ']\n';
				}

				//Modal
				$('#cmtImageUpload').modal('hide');

				//Empty
				if ($.browser.msie) { //IE
					imgInput.replaceWith(imgInput.clone(true));
				} else {
					imgInput.val('');
				}
			} else {
				var imgErr = data.error;
				
				if(!imgErr) {
					imgErr = '오류가 발생하였습니다.';
				}

				alert(data.error);
			}
		},
		error: function(){
			alert('오류가 발생하였습니다.');
		}                               
	});
});