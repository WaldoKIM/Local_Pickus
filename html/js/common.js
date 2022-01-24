$(document).ready(function() {

	$(".mob_btn").click(function() {
  		$("#menu,.page_cover,html").addClass("open");	// 메뉴 버튼을 눌렀을때 메뉴, 커버, html에 open 클래스를 추가해서 효과를 준다.
  		window.location.hash = "#open";					// 페이지가 이동한것 처럼 URL 뒤에 #를 추가해 준다.
	});

	$(".close").click(function() {
  		$("#menu,.page_cover,html").removeClass("open");	// 메뉴 버튼을 눌렀을때 메뉴, 커버, html에 open 클래스를 추가해서 효과를 준다.
	});
	
	window.onhashchange = function() {
  		if (location.hash != "#open") {// URL에 #가 있을 경우 아래 명령을 실행한다.
    		$("#menu,.page_cover,html").removeClass("open");// open 클래스를 지워 원래대로 돌린다.
  		}
	};

	$(function(){
	$(window).scroll(function(){  //스크롤하면 아래 코드 실행
	       var num = $(this).scrollTop();  // 스크롤값
	       if( num > 0 ){  // 스크롤을 36이상 했을 때
	          $("header").addClass( 'fix' );
	       }else{
	           $("header").removeClass( 'fix' );
	       }
	  });
	});

	//상단메뉴
	// var jbOffset = $( 'header' ).offset();
	// $( window ).scroll( function() {
	// 	if ( $( document ).scrollTop() > jbOffset.top ) {
	// 		$( 'header' ).addClass( 'fix' );
	// 	}
	// 	else {
	// 		$( 'header' ).removeClass( 'fix' );
	// 	}
	// });

});

(function($) {
	  $.fn.inputFilter = function(inputFilter) {
	    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
	      if (inputFilter(this.value)) {
	        this.oldValue = this.value;
	        this.oldSelectionStart = this.selectionStart;
	        this.oldSelectionEnd = this.selectionEnd;
	      } else if (this.hasOwnProperty("oldValue")) {
	        this.value = this.oldValue;
	        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	      }
	    });
	  };
	}(jQuery));

//---- 모바일 화면 좌측 메뉴 오픈
function open_menu(obj) {
	var is_menu_open = $(obj).hasClass('open');

	//---- 메뉴 항목이 열려 있는 경우
	if(is_menu_open) {
		$(obj).children(".nav_left_sub_menu").slideUp('fast', function() {
			$(obj).removeClass('open');
		});

	//---- 메뉴 항목이 닫혀 있는 경우
	} else {
		$(obj).children(".nav_left_sub_menu").slideDown('fast', function() {
			$(obj).addClass('open');
		});
	}
}

//---- 하단 GO_TOP
function go_top() {
	var animate_speed = 500;
	$('html, body').stop().animate({ scrollTop: 0 }, animate_speed, 'easeOutCubic');
}



var winname_1;
var openF = 0;

function cfnOpenPopup(fileName, intWidth, intHeight, intLeft, intTop, vScrollbars, vResizable, vStatus)
{
    today = new Date();
    winName = today.getTime();
    
    var screenWidth = screen.availwidth;
    var screenHeight = screen.availheight;

    if(intWidth >= screenWidth){ //스크린 상태에 따라 스크롤바 자동표시
            intWidth = screenWidth - 40;
            vScrollbars = 1;
    }
    if(intHeight >= screenHeight){ //스크린 상태에 따라 스크롤바 자동표시
            intHeight = screenHeight - 40;
            intWidth = intWidth + 20;
            vScrollbars = 1;
    }
    if(intLeft == 'auto' || intTop == 'auto'){ //스크린 중앙에 위치 시키기
            intLeft = (screenWidth - intWidth) / 2;
            intTop = (screenHeight - intHeight) / 2;
    }
    var features = eval("'width=" + intWidth + ",height=" + intHeight + ",left=" + intLeft + ",top=" + intTop + ",scrollbars=" + vScrollbars + ",resizable=" + vResizable + ",status=" + vStatus + "'");

    if(openF == 1){
            if(winname_1.closed){
                    winname_1 = window.open(fileName,winName,features);
            }else{
                    winname_1.close();
                    winname_1 = window.open(fileName,winName,features);
            }
    }else{
            winname_1 = window.open(fileName,winName,features);
            openF = 1;
    }	
}


function cfnEstimateInfo(gubun,nWidth,nHeight)
{
	cfnOpenPopup("../jsp/image/estimateInfo"+gubun+".jsp",nWidth, nHeight);
}

function cfnMoveMenu(url, isLogout)
{
	if(isLogout)
	{
		var params={};

		var url = "../common/logoutCheck.do";	
		$.ajax({
			type: "POST",
			url : url,
			data: params,
			success : function(data) {
				location.href=url;		
			},
		    beforeSend : function(){
		    	
			},
			complete : function(){
				
		    },
			error: function(jqXHR, textStatus, errorThrown){
				
		    }
		});		
	}else{
		location.href=url;
	}
}

function cfnInsertNotify(email, notiType, title, content, estimateIdx, marketIdx)
{
	var params1={};

	var url1 = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url1,
		data: params1,
		success : function(data) {
			var vEmail;
			if(!email){
				vEmail = data.email;
			}else{
				vEmail = email;
			}
			
			var params2={
				email:email,	
				notiType:notiType,	
				title:title,	
				content:content,	
				estimateIdx:estimateIdx,	
				marketIdx:marketIdx	
			};

			var url2 = "../common/insertNotify.do";	
			$.ajax({
				type: "POST",
				url : url2,
				data: params2,
				success : function(data) {
					var vEmail;
					if(!email){
						vEmail = data.email;
					}else{
						vEmail = email;
					}
				},
			    beforeSend : function(){
			    	
				},
				complete : function(){
					
			    },
				error: function(jqXHR, textStatus, errorThrown){
					
			    }
			});		
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});		
}

function cfnCloseMenu()
{
	$("html").removeClass("open");
	$("#menu").removeClass("open");
}
function cfnLogout()
{
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag != "1")
			{
				location.href="../main/main.do";
			}else{
				if(!confirm("로그아웃 하시겠습니까?")) return;
				location.href="../customer/logout.do";
			}			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

function cfnLoginCheck(typeGb1, typeGb2, typeGb3, typeGb4, chkFlag)
{
	//if(!chkFlag) chkFlag = true;
	//alert(chkFlag);
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.flag != "1")
			{
				alert("로그인 창으로 이동합니다.")
				location.href="../customer/login.do";
			}else{
				var vFlag = false;
				if(data.typeGb == typeGb1)
				{
					vFlag = true;
				}
				
				if(data.typeGb == typeGb2)
				{
					vFlag = true;
				}

				if(data.typeGb == typeGb3)
				{
					vFlag = true;
				}

				if(data.typeGb == typeGb4)
				{
					vFlag = true;
				}
				
				if(!vFlag){
					alert("메인 창으로 이동합니다.");
					location.href="../main/main.do";
				}else{
					if(data.typeGb == "0")
					{
						if(!data.phone && !chkFlag){
							alert("핸드폰 번호를 입력하셔야 합니다.");
							location.href="../customer/myPage.do";
						}
					}
				}
			}			
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function cfnNullCheckSelect(val, txt)
{
	if(!val)
	{
		alert(txt+"을(를) 선택하십시오.");
		return false;
	}
	
	return true;
}

function cfnNullCheckInput(val, txt)
{
	if(!val)
	{
		alert(txt+"을(를) 입력하십시오.");
		return false;
	}
	
	return true;
}

function cfnNumberCommaEstimate( number )
{
	if(!number) return number;
	
	if(number == "0") return "무료수거";
	
	if( String(number).length > 3 )
	{
		var nArr = String(number).split('').join(',').split('');
		for( var i=nArr.length-1, j=1; i>=0; i--, j++)  if( j%6 != 0 && j%2 == 0) nArr[i] = '';
		return nArr.join('');
	}
	else return number+"원";
}

function cfnNumberComma( number )
{
	if(!number) return number;
	if( String(number).length > 3 )
	{
		var nArr = String(number).split('').join(',').split('');
		for( var i=nArr.length-1, j=1; i>=0; i--, j++)  if( j%6 != 0 && j%2 == 0) nArr[i] = '';
		return nArr.join('');
	}
	else return number;
}

function cfnNumberCommaOne(number)
{
	if(!number) return "";
	if(number == "0") return "";
	
	return cfnNumberComma( number )+" 원";
}
function cfnNumberRemoveComma(str) {
	if(!str) return str;
	while(str.indexOf(",") > -1) {
		str = str.replace(",", "");
	}
	return str;
}

function cfnNumberRemoveCommaZero(str) {
	if(!str) return "0";
	while(str.indexOf(",") > -1) {
		str = str.replace(",", "");
	}
	
	if(!str) return "0";
	
	return str;
}

function cfNvl1(value)
{
	var result = false;
	if( value == "" ) {
		result =  true;
	}
	if( value == "null" ) {
		result =  true;
	}
	
	if( value == null ) {
		result =  true;
	}
	
	if( /^\s+$/.test(value) ) {
		value = "";
		result =  true;
	}
	if(result)
	{
		return "";
	}else{
		return value;
	}
	
}

function cfNvl2(value, defaultValue)
{
	var result = false;
	if( value == "" ) {
		result =  true;
	}
	if( value == "null" ) {
		result =  true;
	}
	
	if( value == null ) {
		result =  true;
	}
	
	if( /^\s+$/.test(value) ) {
		value = "";
		result =  true;
	}
	if(result)
	{
		return defaultValue;
	}else{
		return value;
	}
	
}


function cfnSnsSignup(vGubun)
{
	location.href="../sns/"+vGubun+".do";
	//cfnOpenPopup("../jsp/sns/"+vGubun+"Login.jsp", 300, 100);
}

function cfnVideo()
{
	$('#modal_video').on('hidden.bs.modal', function (e) {
		  $("#divYoutube").html("");
	});
		
	$('#modal_video').on('hide.bs.modal', function (e) {
		$("#divYoutube").html("");
	});

	$("#divYoutube").html("<iframe width='640' height='360' src='https://www.youtube.com/embed/g0tdQXMIBaA?start=4' frameborder='0' allowfullscreen='' style='line-height: 1.5;'></iframe>");
	
	$('#modal_video').modal();
}

function cfnKakaoChat()
{
	Kakao.init('72c463c33e04eb2f613f713f3407aa36');

	Kakao.PlusFriend.chat({
        plusFriendId: '_qBNaxl'
    });

}

function cfnGetCookiePopup( name ){ 
	var nameOfCookie = name + "=";
	var x = 0; 
	while ( x <= document.cookie.length ) { 
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) endOfCookie = document.cookie.length; 
				return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 ) break; 
	} 
	return "";
}

function cfnSetCookiePopup( name, value, expiredays ) 
{ 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"  
} 


function cfnIsMobile()
{
	var strOs = false;
	if(navigator.userAgent.indexOf("Windows") < -1){
		strOs = true;
	}	
	
	return strOs;
}

function cfnReload()
{
	location.reload();
}

function cfnAdminChangePswd()
{
	$("#password_old").val("");
	$("#password_new").val("");
	$("#password_new_re").val("");
	$("#modal_admin_pswd").modal();
}

function cfnAdminChangePswdSave()
{
	var vPasswordOld   = $("#password_old").val();
	var vPasswordNew   = $("#password_new").val();
	var vPasswordNewRe = $("#password_new_re").val();
	
	if(!$("#password_old").val()){
		alert("이전 비밀번호를 입력해주세요.");
		return false;
	}
	
	if(!$("#password_new").val()){
		alert("변경할 비밀번호를 입력해주세요.");
		return false;
	}

	if(!$("#password_new_re").val()){
		alert("변경할 비밀번호 확인을 입력해주세요.");
		return false;
	}

	if($("#password_new").val()!=$("#password_new_re").val()){
		alert("변경 비밀번호와 변경 비밀번호확인이 일치하지 않습니다.");
		return false;
	}

	if($("#password_new").val().length  < 8 || $("#password_new").val().length  > 15){
		alert("비밀번호는 8자 이상 15자 이하입니다.");
		return false;
	}
	
	if($("#password_new").val() == $("#password_old").val()){
		alert("이전 비밀번호와 변경 비밀번호가 같을 수 없습니다.");
		return false;
	}
	
	var params={};

	var url = "../common/loginCheck.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			if(data.password != hex_md5($("#password_old").val()))
			{
				alert("이전 비밀번호가 같지 않습니다.");
				return;
			}
			
			if(!confirm("비밀번호를 변경하시겠습니까?")) return;
			
			var params={
				password:hex_md5($("#password_new").val())
			};

			var url = "../admin/changePassword.do";	
			$.ajax({
				type: "POST",
				url : url,
				data: params,
				success : function(data) {
					location.reload();
					
				},
			    beforeSend : function(){
			    	
				},
				complete : function(){
					
			    },
				error: function(jqXHR, textStatus, errorThrown){
					
			    }
			});
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});
}

function cfnAdminChangePswdClose()
{
	
	$("#modal_admin_pswd").modal("hide");
}

var arrLargeImage  = [];
var arrLargeRotate = [];
var largeImageIdx  = 0;
var largeImageLast = 0;
function cfnLargeImageView(arrImage, arrRotate, idx)
{
	arrLargeImage  = [];
	arrLargeRotate = [];
	arrLargeImage  = arrImage;
	arrLargeRotate = arrRotate;
	largeImageIdx  = idx;
	largeImageLast = arrLargeImage.length - 1;
	cfnLargeImageHtml(idx);
	$("#modal_large_image").modal();
}

function cfnLargeImageHtml(idx)
{

	var vHtml = "";
	if(idx > 0)
	{
		vHtml += "<a id='img_popup_prev' href='#!' onClick='cfnLargeImagePrev();' style='left:5px;' ><span class='xi-angle-left-thin'></span></a>";
	}
	vHtml += "<img id='img_popup_img_"+idx+"' class='rotate"+arrLargeRotate[idx]+"'src='"+arrLargeImage[idx]+"'/>";
	if(idx < largeImageLast)
	{
		vHtml += "<a id='img_popup_next' href='#' onClick='cfnLargeImageNext();' style='right:5px;'><span class='xi-angle-right-thin'></span></a>";
	}
	
	$("#divLargeImage").html(vHtml);
}


function cfnLargeImagePrev()
{
	largeImageIdx--;
	cfnLargeImageHtml(largeImageIdx);
}

function cfnLargeImageNext()
{
	largeImageIdx++;
	cfnLargeImageHtml(largeImageIdx);

	/*
	alert("next");
	var orgIdx = largeImageIdx; 
	largeImageIdx++;
	var newIdx = largeImageIdx;
	if(newIdx == largeImageLast){
		$("#img_popup_next").hide();
	}else{
		$("#img_popup_prev").show();
		$("#img_popup_next").show();
	}
	*/
	//$("#img_popup_img_"+orgIdx).hide();
	//$("#img_popup_img_"+newIdx).show();
		
}

function cfnGetFileSize(obj){
   var maxSize = 5000000; //5M
   var filesize = obj.files[0].size;
   if(filesize > maxSize){
     alert("파일용량이 초과되었습니다. 최대 5MB입니다.");
     obj.value = "";
     return;
   }
}

//--이미지 생성.
function doInitImageAjax(vComp, vDivComp, vText)
{
    $("#"+vComp).val("");
    
    var fileId = "input_"+vComp+"_file";
    var formId = "form_"+vComp;
    var vHtml1 = "";
    vHtml1 += "<div class='estimate_image_click_bg'>";
    vHtml1 += "<input type='file' id='"+fileId+"' accept='image/*' style='height: 370px;'/>";
    vHtml1 += "<img src='../img/common/estimate_icon_image_info.png'/>";
    vHtml1 += "<p>"+vText+"</p>";
    vHtml1 += "</div>";
    vHtml1 += "<form id='"+formId+"' name='"+formId+"' method='post' enctype='multipart/form-data'></form>";
    $("#"+vDivComp).empty().html(vHtml1);
    
    $("#"+fileId).bind('change', function() {
        var fv_file = this.files[0].name;
        var fv_type = fv_file.substring(fv_file.length-3,fv_file.length);
        fv_type = fv_type.toUpperCase();
        if(fv_type=="PEG" || fv_type=="JPG"||fv_type=="PNG"||fv_type=="GIF"||fv_type=="BMP")
        {
            var form = $('#'+formId);
            var formData = new FormData();  
            formData.append('et_img', this.files[0]);
            $.ajax({
                url : "/estimate/ajax.image_upload.php",
                data : formData,
                type : 'POST',
                enctype : 'multipart/form-data',
                processData : false,
                contentType : false,
                dataType : 'text',
                cache : false,
                success : function(result) {
                    if(result){
                        var arrResult = result.split(",");
                        $("#"+vComp).val(arrResult[0]);
                        var vHtml2 = "";
                        vHtml2 += "<div class='estimate_image_bg'>";
                        vHtml2 += "<div class='estimate_image_del_bg'>";
                        vHtml2 += "<a href='#none' onClick='doInitImageAjax(\""+vComp+"\",\""+vDivComp+"\",\""+vText+"\");'>";
                        vHtml2 += "<i class='xi-close-min'></i>";
                        vHtml2 += "</a>";
                        vHtml2 += "</div>";
                        vHtml2 += "<img src='/data/estimate/"+arrResult[1]+"' style='width:100%;'/>";
                        vHtml2 += "</div>";
                        $("#"+vDivComp).empty().html(vHtml2);
                    }
                }
            });
        }else{
            alert("이미지 파일만 업로드 가능합니다.");
        }
    }); 
}

//--이미지 생성.
function doInitImage(vComp, vDivComp, vText, vHeight)
{
    $("#"+vComp).val("");
    
    var fileId = "input_"+vComp+"_file";
    var formId = "form_"+vComp;
    var vHtml1 = "";
    vHtml1 += "<input type='file' id='"+fileId+"' name='"+fileId+"' accept='image/*' style='height: "+vHeight+";'/>";
    vHtml1 += "<div class='estimate_image_click_bg'>";
    vHtml1 += "<img src='../img/common/estimate_icon_image_info.png'/>";
    vHtml1 += "<p>"+vText+"</p>";
    vHtml1 += "</div>";
    $("#"+vDivComp).empty().html(vHtml1);
    
    $("#"+fileId).bind('change', function() {
        var fv_file = this.files[0].name;
        var fv_type = fv_file.substring(fv_file.length-3,fv_file.length);
        fv_type = fv_type.toUpperCase();
        if(fv_type=="PEG" || fv_type=="JPG"||fv_type=="PNG"||fv_type=="GIF"||fv_type=="BMP")
        {
        	var files = this.files[0];

        	var reader = new FileReader();

        	//파일정보 수집        
	        reader.onload = (function(theFile) 
	        {
	            return function(e) 
	            {
	                //이미지 뷰
	                var img_view = ['<img src="', e.target.result, '" title="', escape(theFile.name), '" style="width:100%;height:'+vHeight+'px;"/>'].join('');                
                    var vHtml2 = "";
                    vHtml2 += "<div class='estimate_image_bg'>";
                    vHtml2 += "<div class='estimate_image_del_bg'>";
                    vHtml2 += "<a href='#none' onClick='doInitImage(\""+vComp+"\",\""+vDivComp+"\",\""+vText+"\",\""+vHeight+"\");'>";
                    vHtml2 += "<i class='xi-close-min'></i>";
                    vHtml2 += "</a>";
                    vHtml2 += "</div>";
                    vHtml2 += img_view;
                    vHtml2 += "</div>";
                    $("#"+vDivComp).find(".estimate_image_click_bg").remove();
                    $("#"+vDivComp).append(vHtml2);	                
	            };
	 
	        })(files);
	            
	        reader.readAsDataURL(files);    

        }else{
            alert("이미지 파일만 업로드 가능합니다.");
        }
    }); 
}

var photo_count = 0;

//--이미지 생성.
function doInitImage2(vHeight)
{//with KJS dance 중고 판매 매칭 업체 상세견적서 작성시 사진 무한 업로드 차단 20220117 *AAA 
 //   alert(photo_count);
    if(photo_count>=6){
        alert('최대 6개 까지 등록 가능합니다');
    return false
    }
	var vHtml = "";
	vHtml += "<div class='estimate_photo col-md-4 text-center'>";
    vHtml += "<input type='file' name='photo[]' accept='image/*' style='height: "+vHeight+";' class='estimate_photo_file'/>";
    vHtml += "<div class='estimate_image_click_bg'>";
    vHtml += "<img src='../img/common/estimate_icon_image_info.png'/>";
    vHtml += "<p>사진파일 업로드</p>";
	vHtml += "</div>";
    
    $("#imageList").append(vHtml);
    
    $(".estimate_photo_file").bind('change', function() {
        var fv_file = this.files[0].name;
        var fv_type = fv_file.substring(fv_file.length-3,fv_file.length);
        fv_type = fv_type.toUpperCase();
        
        if(fv_type=="PEG"||fv_type=="JPG"||fv_type=="PNG"||fv_type=="GIF"||fv_type=="BMP")
        {
        	var $el_div = $(this).closest(".estimate_photo");
            loadImage(
                this.files[0],
                function (img) {
                    //업로드 된 사진 클릭 차단으로 사진 중복 업로드 방지  with KJS dance *BBB                    
                    $el_div.find(".estimate_photo_file").css("pointer-events","none");
                    
                    $el_div.find(".estimate_image_click_bg").remove();
                    var vHtml2 = "";

                    vHtml2 += "<div class='estimate_image_del_bg'><a href='javascript:' class='estimate_photo_file_remove'><i class='xi-close-min'></i></a></div>";
                    $el_div.append(vHtml2);  
                    $el_div.append(img);     
                }, {orientation:true,maxWidth: 150}
            )
            photo_count++;      
            
            doInitImage2(vHeight);   
          

        }else{
            alert("이미지 파일만 업로드 가능합니다.");
        }
    }); 
//업로드 된 파일 삭제시 카운트 오류 임시 디버깅, 주석 처리 후 함수 외부로 빼냄 *CCC참조 with KJS dance  
  // setTimeout(function() {
    //  $('.estimate_photo_file_remove').click(function(){
      //      var photos = $(this).closest(".estimate_photo");
        //    photos.remove();
          //  photo_count--;
   //     });
  // }, 500);
}

	 //사진 업로드 하다 지우면 지운 수 만큼 최대 사진 수가 늘어나는 현상차단   with KJS dance *CCC 
     $(document).on("click", ".estimate_photo_file_remove", function(vHeight) {
        var photos = $(this).closest(".estimate_photo");
//        alert(photo_count);
//최대 업로드 된 상태에서 삭제를 한 경우 다시 업로드 기능 활성화   with KJS dance *DDD
        if(photo_count>=6){
            photos.remove();
            photo_count = photo_count-1;
            doInitImage2(vHeight);
            //alert(photo_count);
            }
            else{
        photos.remove();
        photo_count = photo_count-1;
//        alert(photo_count);
    }
    });

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function doTel(telNo)
{
        if(telNo == "-"){
                alert("연락처가 없습니다.");
                return;
        }

        location.href="tel:"+telNo;
}


function set_cookie(name, value, expirehours, domain)
{
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}

function check_field(fld, msg)
{
    if ((fld.value = trim(fld.value)) == "")
        error_field(fld, msg);
    else
        clear_field(fld);
    return;
}

// 필드 오류 표시
function error_field(fld, msg)
{
    if (msg != "")
        errmsg += msg + "\n";
    if (!errfld) errfld = fld;
    fld.style.background = "#BDDEF7";
}

// 필드를 깨끗하게
function clear_field(fld)
{
    fld.style.background = "#FFFFFF";
}

function trim(s)
{
    var t = "";
    var from_pos = to_pos = 0;

    for (i=0; i<s.length; i++)
    {
        if (s.charAt(i) == ' ')
            continue;
        else
        {
            from_pos = i;
            break;
        }
    }

    for (i=s.length; i>=0; i--)
    {
        if (s.charAt(i-1) == ' ')
            continue;
        else
        {
            to_pos = i;
            break;
        }
    }

    t = s.substring(from_pos, to_pos);
    //				alert(from_pos + ',' + to_pos + ',' + t+'.');
    return t;
}

// 자바스크립트로 PHP의 number_format 흉내를 냄
// 숫자에 , 를 출력
function number_format(data)
{

    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
    
    data = data + '';

    var sign = data.match(/^[\+\-]/);
    if(sign) {
        data = data.replace(/^[\+\-]/, "");
    }

    len = data.length;
    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++)
    {
        number = number + data.charAt(i);

        if (i < data.length - 1)
        {
            k++;
            if ((k % cutlen) == 0)
            {
                number = number + comma;
                k = 0;
            }
        }
    }

    if(sign != null)
        number = sign+number;

    return number;
}

// 새 창
function popup_window(url, winname, opt)
{
    window.open(url, winname, opt);
}


// 폼메일 창
function popup_formmail(url)
{
    opt = 'scrollbars=yes,width=417,height=385,top=10,left=20';
    popup_window(url, "wformmail", opt);
}

// , 를 없앤다.
function no_comma(data)
{
    var tmp = '';
    var comma = ',';
    var i;

    for (i=0; i<data.length; i++)
    {
        if (data.charAt(i) != comma)
            tmp += data.charAt(i);
    }
    return tmp;
}

// 삭제 검사 확인
function del(href)
{
    if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        var iev = -1;
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                iev = parseFloat(RegExp.$1);
        }

        // IE6 이하에서 한글깨짐 방지
        if (iev != -1 && iev < 7) {
            document.location.href = encodeURI(href);
        } else {
            document.location.href = href;
        }
    }
}

// 쿠키 입력
function set_cookie(name, value, expirehours, domain)
{
    var today = new Date();
    today.setTime(today.getTime() + (60*60*1000*expirehours));
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
    if (domain) {
        document.cookie += "domain=" + domain + ";";
    }
}

// 쿠키 얻음
function get_cookie(name)
{
    var find_sw = false;
    var start, end;
    var i = 0;

    for (i=0; i<= document.cookie.length; i++)
    {
        start = i;
        end = start + name.length;

        if(document.cookie.substring(start, end) == name)
        {
            find_sw = true
            break
        }
    }

    if (find_sw == true)
    {
        start = end + 1;
        end = document.cookie.indexOf(";", start);

        if(end < start)
            end = document.cookie.length;

        return unescape(document.cookie.substring(start, end));
    }
    return "";
}

// 쿠키 지움
function delete_cookie(name)
{
    var today = new Date();

    today.setTime(today.getTime() - 1);
    var value = get_cookie(name);
    if(value != "")
        document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

var last_id = null;
function menu(id)
{
    if (id != last_id)
    {
        if (last_id != null)
            document.getElementById(last_id).style.display = "none";
        document.getElementById(id).style.display = "block";
        last_id = id;
    }
    else
    {
        document.getElementById(id).style.display = "none";
        last_id = null;
    }
}

function textarea_decrease(id, row)
{
    if (document.getElementById(id).rows - row > 0)
        document.getElementById(id).rows -= row;
}

function textarea_original(id, row)
{
    document.getElementById(id).rows = row;
}

function textarea_increase(id, row)
{
    document.getElementById(id).rows += row;
}

// 글숫자 검사
function check_byte(content, target)
{
    var i = 0;
    var cnt = 0;
    var ch = '';
    var cont = document.getElementById(content).value;

    for (i=0; i<cont.length; i++) {
        ch = cont.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }
    // 숫자를 출력
    document.getElementById(target).innerHTML = cnt;

    return cnt;
}

// 브라우저에서 오브젝트의 왼쪽 좌표
function get_left_pos(obj)
{
    var parentObj = null;
    var clientObj = obj;
    //var left = obj.offsetLeft + document.body.clientLeft;
    var left = obj.offsetLeft;

    while((parentObj=clientObj.offsetParent) != null)
    {
        left = left + parentObj.offsetLeft;
        clientObj = parentObj;
    }

    return left;
}

// 브라우저에서 오브젝트의 상단 좌표
function get_top_pos(obj)
{
    var parentObj = null;
    var clientObj = obj;
    //var top = obj.offsetTop + document.body.clientTop;
    var top = obj.offsetTop;

    while((parentObj=clientObj.offsetParent) != null)
    {
        top = top + parentObj.offsetTop;
        clientObj = parentObj;
    }

    return top;
}

function flash_movie(src, ids, width, height, wmode)
{
    var wh = "";
    if (parseInt(width) && parseInt(height))
        wh = " width='"+width+"' height='"+height+"' ";
    return "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' "+wh+" id="+ids+"><param name=wmode value="+wmode+"><param name=movie value="+src+"><param name=quality value=high><embed src="+src+" quality=high wmode="+wmode+" type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash' "+wh+"></embed></object>";
}

function obj_movie(src, ids, width, height, autostart)
{
    var wh = "";
    if (parseInt(width) && parseInt(height))
        wh = " width='"+width+"' height='"+height+"' ";
    if (!autostart) autostart = false;
    return "<embed src='"+src+"' "+wh+" autostart='"+autostart+"'></embed>";
}

function doc_write(cont)
{
    document.write(cont);
}

var win_password_lost = function(href) {
    window.open(href, "win_password_lost", "left=50, top=50, width=617, height=330, scrollbars=1");
}

$(document).ready(function(){
    $("#login_password_lost, #ol_password_lost").click(function(){
        win_password_lost(this.href);
        return false;
    });
});

/**
 * 포인트 창
 **/
var win_point = function(href) {
    var new_win = window.open(href, 'win_point', 'left=100,top=100,width=600, height=600, scrollbars=1');
    new_win.focus();
}

/**
 * 쪽지 창
 **/
var win_memo = function(href) {
    var new_win = window.open(href, 'win_memo', 'left=100,top=100,width=620,height=500,scrollbars=1');
    new_win.focus();
}

/**
 * 쪽지 창
 **/
var check_goto_new = function(href, event) {
    if( !(typeof g5_is_mobile != "undefined" && g5_is_mobile) ){
        if (window.opener && window.opener.document && window.opener.document.getElementById) {
            event.preventDefault ? event.preventDefault() : (event.returnValue = false);
            window.open(href);
            //window.opener.document.location.href = href;
        }
    }
}

/**
 * 메일 창
 **/
var win_email = function(href) {
    var new_win = window.open(href, 'win_email', 'left=100,top=100,width=600,height=580,scrollbars=1');
    new_win.focus();
}

/**
 * 자기소개 창
 **/
var win_profile = function(href) {
    var new_win = window.open(href, 'win_profile', 'left=100,top=100,width=620,height=510,scrollbars=1');
    new_win.focus();
}

/**
 * 스크랩 창
 **/
var win_scrap = function(href) {
    var new_win = window.open(href, 'win_scrap', 'left=100,top=100,width=600,height=600,scrollbars=1');
    new_win.focus();
}

/**
 * 홈페이지 창
 **/
var win_homepage = function(href) {
    var new_win = window.open(href, 'win_homepage', '');
    new_win.focus();
}

/**
 * 우편번호 창
 **/
var win_zip = function(frm_name, frm_zip, frm_addr1, frm_addr2, frm_addr3, frm_jibeon) {
    if(typeof daum === 'undefined'){
        alert("다음 우편번호 postcode.v2.js 파일이 로드되지 않았습니다.");
        return false;
    }

    var zip_case = 1;   //0이면 레이어, 1이면 페이지에 끼워 넣기, 2이면 새창

    var complete_fn = function(data){
        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
        var fullAddr = ''; // 최종 주소 변수
        var extraAddr = ''; // 조합형 주소 변수

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }

        // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
        if(data.userSelectedType === 'R'){
            //법정동명이 있을 경우 추가한다.
            if(data.bname !== ''){
                extraAddr += data.bname;
            }
            // 건물명이 있을 경우 추가한다.
            if(data.buildingName !== ''){
                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
            extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
        }

        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
        var of = document[frm_name];

        of[frm_zip].value = data.zonecode;

        of[frm_addr1].value = fullAddr;
        of[frm_addr3].value = extraAddr;

        if(of[frm_jibeon] !== undefined){
            of[frm_jibeon].value = data.userSelectedType;
        }
        
        setTimeout(function(){
            of[frm_addr2].focus();
        } , 100);
    };

    switch(zip_case) {
        case 1 :    //iframe을 이용하여 페이지에 끼워 넣기
            var daum_pape_id = 'daum_juso_page'+frm_zip,
                element_wrap = document.getElementById(daum_pape_id),
                currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
            if (element_wrap == null) {
                element_wrap = document.createElement("div");
                element_wrap.setAttribute("id", daum_pape_id);
                element_wrap.style.cssText = 'display:none;border:1px solid;left:0;width:100%;height:300px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;';
                element_wrap.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-21px;z-index:1" class="close_daum_juso" alt="접기 버튼">';
                jQuery('form[name="'+frm_name+'"]').find('input[name="'+frm_addr1+'"]').before(element_wrap);
                jQuery("#"+daum_pape_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_wrap.style.display = 'none';
                    // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                    document.body.scrollTop = currentScroll;
                },
                // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분.
                // iframe을 넣은 element의 높이값을 조정한다.
                onresize : function(size) {
                    element_wrap.style.height = size.height + "px";
                },
                maxSuggestItems : g5_is_mobile ? 6 : 10,
                width : '100%',
                height : '100%'
            }).embed(element_wrap);

            // iframe을 넣은 element를 보이게 한다.
            element_wrap.style.display = 'block';
            break;
        case 2 :    //새창으로 띄우기
            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                }
            }).open();
            break;
        default :   //iframe을 이용하여 레이어 띄우기
            var rayer_id = 'daum_juso_rayer'+frm_zip,
                element_layer = document.getElementById(rayer_id);
            if (element_layer == null) {
                element_layer = document.createElement("div");
                element_layer.setAttribute("id", rayer_id);
                element_layer.style.cssText = 'display:none;border:5px solid;position:fixed;width:300px;height:460px;left:50%;margin-left:-155px;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:10000';
                element_layer.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" class="close_daum_juso" alt="닫기 버튼">';
                document.body.appendChild(element_layer);
                jQuery("#"+rayer_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_layer.style.display = 'none';
                },
                maxSuggestItems : g5_is_mobile ? 6 : 10,
                width : '100%',
                height : '100%'
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';
    }
}

/**
 * 새로운 비밀번호 분실 창 : 101123
 **/
win_password_lost = function(href)
{
    var new_win = window.open(href, 'win_password_lost', 'width=617, height=330, scrollbars=1');
    new_win.focus();
}

/**
 * 설문조사 결과
 **/
var win_poll = function(href) {
    var new_win = window.open(href, 'win_poll', 'width=616, height=500, scrollbars=1');
    new_win.focus();
}

/**
 * 스크린리더 미사용자를 위한 스크립트 - 지운아빠 2013-04-22
 * alt 값만 갖는 그래픽 링크에 마우스오버 시 title 값 부여, 마우스아웃 시 title 값 제거
 **/
$(function() {
    $('a img').mouseover(function() {
        $a_img_title = $(this).attr('alt');
        $(this).attr('title', $a_img_title);
    }).mouseout(function() {
        $(this).attr('title', '');
    });
});

/**
 * 텍스트 리사이즈
**/
function font_resize(id, rmv_class, add_class, othis)
{
    var $el = $("#"+id);

    $el.removeClass(rmv_class).addClass(add_class);

    set_cookie("ck_font_resize_rmv_class", rmv_class, 1, g5_cookie_domain);
    set_cookie("ck_font_resize_add_class", add_class, 1, g5_cookie_domain);

    if(typeof othis !== "undefined"){
        $(othis).addClass('select').siblings().removeClass('select');
    }
}

/**
 * 댓글 수정 토큰
**/
function set_comment_token(f)
{
    if(typeof f.token === "undefined")
        $(f).prepend('<input type="hidden" name="token" value="">');

    $.ajax({
        url: g5_bbs_url+"/ajax.comment_token.php",
        type: "GET",
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            f.token.value = data.token;
        }
    });
}