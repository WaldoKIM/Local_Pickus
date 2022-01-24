var vPageCount = 10;
var vPageNum;

jQuery(document).ready(function(){
	doSearch(1);
	
	$('input[name="customerGubun"]').change(function() { 
		var url = $('input[name="customerGubun"]:checked').val()
		location.href="../admin/"+url;
	}); 
});


function doSearch(pageNum)
{
	vPageNum = pageNum;
	var params={
			pageCount:vPageCount,
			pageNum:pageNum
	};
	var url = "selectNoticeList.do";
	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$("#tableList").html("");
			$("#pageList").html("");
			var fvHtml="";
			if(data.totalCount > 0 )
			{
				for(var i=0; i<data.row.length; i++)
				{
					fvHtml+="<tr>";
					
					fvHtml+="<td>"+cfNvl1(data.row[i].idx)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].title)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].updatetime)+"</td>";
					fvHtml+="<td>"+cfNvl1(data.row[i].hit)+"</td>";
					fvHtml+= "<td>";
					fvHtml += "<ul>";
					fvHtml += "<li class='col-xs-6'><a class='main_bg' href='#!' onClick='doModifyNotice(\""+data.row[i].idx+"\")'>수정<a></li>";
					fvHtml += "<li class='col-xs-6'><a class='red_bg' href='#!' onClick='doDeleteNotice(\""+data.row[i].idx+"\")'>삭제<a></li>";
					fvHtml += "</ul>";
					fvHtml+= "</td>";
					fvHtml+="</tr>";
				}
				$("#tableList").html(fvHtml);
				
				//페이징 처리.
				var pageHtml = "<span>";
				var lv_TotCnt  = parseInt(data.totalCount);
				var lv_CurPage = pageNum;
				var lv_TotPage = parseInt(data.totalPage);
				
				var lv_last = lv_TotPage%5-1;
				
				if(lv_last == -1) lv_last = 4;
				
				lv_last = lv_TotPage - lv_last;
				
				var lv_InitVal  = 1;
				if(lv_CurPage%5 == 0 && lv_CurPage > 5){	
					lv_InitVal = lv_CurPage - 4;
				}else if(lv_CurPage > 5){
					lv_InitVal =lv_CurPage - (lv_CurPage%5) + 1;
				}
				
				var lv_PageGab  = lv_TotPage - lv_InitVal + 1;
				
				if(lv_PageGab > 5)	lv_PageGab = 5;
				
				if(lv_TotCnt > 0 && lv_CurPage > 5)
				{
					pageHtml += "<a href='#none' onClick='doSearch("+(lv_InitVal-1)+");' class='prev' title='이전 블럭'></a>";
				}
				for(var t=1; t<=lv_PageGab; t++)
				{
					var lv_value = lv_InitVal-1+t;
					if(lv_value == lv_CurPage)
					{
						pageHtml += "<a href='#none' onClick='doSearch("+lv_value+");' class='on'>"+lv_value+"</a>";
					}else{
						pageHtml += "<a href='#none' onClick='doSearch("+lv_value+");' class=''>"+lv_value+"</a>";
					}
				}
				if(lv_TotPage > lv_InitVal+4){
					pageHtml += "<a href='#none' onClick='doSearch("+(lv_InitVal+5)+");' class='next' title='다음 블럭'></a>";
				}
				pageHtml += "</span>";
				
				$("#page").html(pageHtml);
			}else{
				fvHtml+="<tr>";
				
				fvHtml+="<td colspan='5' class='text-center'>공지사항이 없습니다.</td>";
				fvHtml+="</tr>";	
				$("#tableList").html(fvHtml);
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

function doAddNotice(){
	$('#flag').val("I");
	$('#idx').val("");
	$('#photo1').val("");
	$('#photo2').val("");
	$('#photo3').val("");
	$('#title').val("");
	$('#content').val("");
	
	for(var i=1; i<=3;i++)
	{
		doInitImage('photo'+i, 'divPhoto'+i, '사진 업로드');
	}
	$('#modal_notice').modal();
}

function doSetImage(vDiv, vComp, vTitle, filePath, fileRotate)
{
	$("#"+vComp).val(filePath);
	$("#"+vComp+"Rotate").val(fileRotate);
	var vHtml2 = "";
	vHtml2 += "<div class='estimate_image_bg'>";
	vHtml2 += "<div class='estimate_image_del_bg'>";
	vHtml2 += "<a href='#none' onClick='doInitImage(\""+vComp+"\",\""+vDiv+"\",\""+vTitle+"\");'>";
	vHtml2 += "<i class='xi-close-min'></i>";
	vHtml2 += "</a>";
	vHtml2 += "</div>";
	vHtml2 += "<img class='rotate"+fileRotate+"' src='../common/file/imageDownload.do?fileNewName="+filePath+"' style='width:100%;height:180px'/>";
	vHtml2 += "</div>";
	$("#"+vDiv).empty().html(vHtml2);
}

function doInitImage(vComp, vDivComp, vText)
{
	$("#"+vComp).val("");
	
	var fileId = "input_"+vComp+"_file";
	var formId = "form_"+vComp;
	var vHtml1 = "";
	vHtml1 += "<div class='estimate_image_click_bg'>";
	vHtml1 += "<input type='file' id='"+fileId+"' accept='image/*' style='height: 180px;'  onchange=\"cfnGetFileSize(this);\"/>";
	vHtml1 += "<img src='../img/common/estimate_icon_image_info.png'/>";
	vHtml1 += "<p>"+vText+"</p>";
	vHtml1 += "</div>";
	vHtml1 += "<form id='"+formId+"' name='"+formId+"' method='post' enctype='multipart/form-data'></form>";
	$("#"+vDivComp).empty().html(vHtml1);
	
	$("#"+fileId).bind('change', function() {
		var fv_file = this.files[0].name;
		var fv_type = fv_file.substring(fv_file.length-3,fv_file.length);
		fv_type = fv_type.toUpperCase();
		if(fv_type=="JPG"||fv_type=="PNG"||fv_type=="GIF"||fv_type=="BMP")
		{
			var form = $('#'+formId);
			var formData = new FormData(form);	
			formData.append('files', this.files[0]);
			$.ajax({
				url : "../common/file/imageUploadJSon.do",
				data : formData,
				type : 'POST',
				enctype : 'multipart/form-data',
				processData : false,
				contentType : false,
				dataType : 'json',
				cache : false,
				success : function(data) {
					var vFileName = data.uploadPath+data.fileName;
					$("#"+vComp).val(vFileName);
					$("#"+vComp+"Rotate").val(data.fileRotation);
					var vHtml2 = "";
					vHtml2 += "<div class='estimate_image_bg'>";
					vHtml2 += "<div class='estimate_image_del_bg'>";
					vHtml2 += "<a href='#none' onClick='doInitImage(\""+vComp+"\",\""+vDivComp+"\",\""+vText+"\");'>";
					vHtml2 += "<i class='xi-close-min'></i>";
					vHtml2 += "</a>";
					vHtml2 += "</div>";
					vHtml2 += "<img class='rotate"+data.fileRotation+"' src='../common/file/imageDownload.do?fileNewName="+vFileName+"' style='width:100%;height:180px;'/>";
					vHtml2 += "</div>";
					$("#"+vDivComp).empty().html(vHtml2);
				}
			});
		}else{
			alert("이미지 파일만 업로드 가능합니다.");
		}
	});	
}


function doModifyNotice(idx){
	var params={
			idx:idx
	};	
	
	var url = "selectNoticeDetail.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			var photo1 = cfNvl1(data.photo1);
			var photo2 = cfNvl1(data.photo2);
			var photo3 = cfNvl1(data.photo3);
			$('#flag').val("U");
			$('#idx').val(data.idx);
			$('#title').val(data.title);
			$('#content').val(data.content);
			$('#photo1').val(photo1);
			$('#photo2').val(photo2);
			$('#photo3').val(photo3);
			if(photo1){
				doSetImage('divPhoto1','photo1','사진 업로드', photo1, "0");
			}else{
				doInitImage('photo1', 'divPhoto1', '사진 업로드');
			}

			if(photo2){
				doSetImage('divPhoto2','photo2','사진 업로드', photo2, "0");
			}else{
				doInitImage('photo2', 'divPhoto2', '사진 업로드');
			}
			
			if(photo3){
				doSetImage('divPhoto3','photo3','사진 업로드', photo3, "0");
			}else{
				doInitImage('photo3', 'divPhoto3', '사진 업로드');
			}
			
			$('#modal_notice').modal();
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
	
}

function doSaveNotice()
{
	if(!cfnNullCheckSelect($('#title').val(),"제목")) return;
	if(!cfnNullCheckSelect($('#content').val(),"작성내역")) return;

	var params={
			idx:$("#idx").val(),
			title:$("#title").val(),
			content:$('#content').val(),
			photo1:$('#photo1').val(),
			photo2:$('#photo2').val(),
			photo3:$('#photo3').val()
	};	
	
	var url;
	if($("#flag").val() == "I")
	{
		url = "insertNotice.do";
	}else{
		url = "updateNotice.do";
	}
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			$('#modal_notice').modal("hide");
			if($("#flag").val() == "I")
			{
				doSearch(1);
			}else{
				doSearch(vPageNum);
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

function doCloseNotice()
{
	$('#modal_notice').modal("hide");
}

function doDeleteNotice(idx){
	if(!confirm("삭제하시겠습니까?")) return;
	
	var params={
			idx:idx
	};	
	
	var url = "deleteNotice.do";	
	$.ajax({
		type: "POST",
		url : url,
		data: params,
		success : function(data) {
			doSearch(vPageNum);
		},
	    beforeSend : function(){
	    	
		},
		complete : function(){
			
	    },
		error: function(jqXHR, textStatus, errorThrown){
			
	    }
	});	
}

