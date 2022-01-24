$(document).ready(function() {

	$(".mob_btn").click(function() {
  		$("#menu,.page_cover,html").addClass("open");	// 메뉴 버튼을 눌렀을때 메뉴, 커버, html에 open 클래스를 추가해서 효과를 준다.
  		window.location.hash = "#open";					// 페이지가 이동한것 처럼 URL 뒤에 #를 추가해 준다.
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

function cfnGetFileSize(obj){
   var maxSize = 5000000; //5M
   var filesize = obj.files[0].size;
   if(filesize > maxSize){
     alert("파일용량이 초과되었습니다. 최대 5MB입니다.");
     obj.value = "";
     return;
   }
}