<?php
include_once('./_common.php');


if($member['mb_level'] != "0" && $member['mb_level'] != "8"){
	alert("메인 창으로 이동합니다.",G5_URL);
}


$g5['title'] = '중고매칭';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>

<div class="sub_title">
	<h1 class="main_co">중고 매칭</h1>
</div><!-- sub_title -->
<form name="frmregister" action="<?php echo G5_URL; ?>/estimate/my_match_register_form_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="member com_pd">
	<div class="container">
		
		<div class="request">
			<div class="form_wrap">
				<form>
					<div class="form-group">
						<h2 class="txt_title"><span>지역선택</span></h2>
					</div>
					
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								기본주소
							</li>
							<li class="col-md-5 col-xs-6">
								<select id="area1" name="area1">
									<option value="" selected>선택</option>
								</select>
							</li>
							<li class="col-md-5 col-xs-6">
								<select id="area2" name="area2">
									<option value="" selected>선택</option>
								</select>
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								상세주소
							</li>
							<li class="col-md-10">
								<input type="text" id="area3" name="area3" aria-describedby="상세주소를 입력해 주세요" placeholder="상세주소를 입력해 주세요">
							</li>
						</ul>
					</div>
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								층수
							</li>
							<li class="col-md-4">
								<input type="text" id="floor" name="floor" aria-describedby="ex) 아파트 8층" placeholder="ex) 아파트 8층">
							</li>
							<li class="col-md-2 title">
								엘리베이터
							</li>
							<li class="col-md-2 col-xs-6">
								<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn1" value="엘리베이터 있음" checked/><i>유</i></label>
							</li>
							<li class="col-md-2 col-xs-6">
								<label class="box"><input type="radio" name="elevator_yn" id="elevator_yn2" value="엘리베이터 없음"/><i>무</i></label>
							</li>
						</ul>
					</div>
					<div class="form-group">
						<h2 class="txt_title"><span>물품정보</span></h2>
						<p class="red_co text-right">* 작동되지 않는 가전과 부서진 가구는 견적이 불가 합니다.</p>
					</div>
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								품목
							</li>
							<li class="col-md-2 col-xs-3">
								<label class="box"><input type="radio" name="item_cat" id="item_cat1" value="가전" checked/><i>가전</i></label>
							</li>
							<li class="col-md-2 col-xs-3">
								<label class="box"><input type="radio" name="item_cat" id="item_cat2" value="주방집기"/><i>주방집기</i></label>
							</li>
							<li class="col-md-2 col-xs-3">
								<label class="box"><input type="radio" name="item_cat" id="item_cat3" value="헬스용품"/><i>헬스용품</i></label>
							</li>
							<li class="col-md-2 col-xs-3">
								<label class="box"><input type="radio" name="item_cat" id="item_cat4" value="가구"/><i>가구</i></label>
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								세부카테고리
							</li>
							<li class="col-md-5 col-xs-6">
								<input type="hidden" name="item_cat_dtl" id="item_cat_dtl">
								<select id="item_cat_dtl_s" name="item_cat_dtl_s">
									<option value="" selected>선택</option>
								</select>
							</li>
							<li class="col-md-5 col-xs-6">
								<input type="text" id="item_cat_dtl_etc" name="item_cat_dtl_etc" style="display:none;">
							</li>
						</ul>
					</div>
										
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								매칭제목
							</li>
							<li class="col-md-10">
								<input type="text" id="title" name="title">
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<ul>
							<li class="title">
								참고사항
							</li>
							<li>
								<textarea id="content" name="content"></textarea> 
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<h2 class="txt_title">
							<ul class="row">
								<li class="col-xs-6"><span>사진등록</span></li>
							</ul>
						</h2>
					</div>
					
					<div class="form-group">
						
						<div class="row" id="imageList">
							<div class='col-md-4 text-center' id="divPhoto1"></div>
							<div class='col-md-4 text-center' id="divPhoto2"></div>
							<div class='col-md-4 text-center' id="divPhoto3"></div>
							<div class='col-md-4 text-center' id="divPhoto4"></div>
							<div class='col-md-4 text-center' id="divPhoto5"></div>
							<div class='col-md-4 text-center' id="divPhoto6"></div>
						</div><!-- imageList -->

						<input type="hidden" id="photo1" name="photo1">
						<input type="hidden" id="photo2" name="photo2">
						<input type="hidden" id="photo3" name="photo3">
						<input type="hidden" id="photo4" name="photo4">
						<input type="hidden" id="photo5" name="photo5">
						<input type="hidden" id="photo6" name="photo6">
						<input type="hidden" id="photo1_rotate" name="photo1_rotate">
						<input type="hidden" id="photo2_rotate" name="photo2_rotate">
						<input type="hidden" id="photo3_rotate" name="photo3_rotate">
						<input type="hidden" id="photo4_rotate" name="photo4_rotate">
						<input type="hidden" id="photo5_rotate" name="photo5_rotate">
						<input type="hidden" id="photo6_rotate" name="photo6_rotate">
							
					</div><!-- 사진업로드 -->		
					
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-md-4 col-xs-6 col-xs-offset-3 col-md-offset-4">
								<input class="main_bg" type="button" value="매칭신청하기"  onClick="doRegistMatch();">
							</li>
						</ul>
					</div>
								
				</form>			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var imageMaxCnt = 6;
jQuery(document).ready(function(){	
	for(var i=1; i<=imageMaxCnt; i++)
	{
		var vComp    = "photo"+i;
		var vDivComp = "divPhoto"+i;
		var vText    = "사진파일 업로드";
		
		doInitImage(vComp, vDivComp, vText);

	}

	doSelectArea1();

	$('input[name="item_cat"]').change(function() { 
		doSelectCategory2();

	}); 

	doSelectCategory2();
});	
function doSelectArea1()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area1.php",
        data: {
        	"area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml = "<option value=\"\" selected>선택</option>";
            fvHtml += data;
            $("#area1").html(fvHtml);
            fvHtml="<option value=\"\" selected>선택</option>";
			$("#area2").html(fvHtml);
			$('#area1').change(function(){ 
				doSelectArea2(); 
			}); 
        }
    });
}

function doSelectArea2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.area2.php",
        data: {
        	"area1": $('#area1').val()
        },
        cache: false,
        success: function(data) {
            var fvHtml="";
			fvHtml += "<option value=\"\" selected>선택</option>";
			fvHtml += data;
			$("#area2").html(fvHtml);

        }
    });
}

function doSelectCategory2()
{
    $.ajax({
        type: "POST",
        url: "<?php echo G5_URL ?>/estimate/ajax.category2.php",
        data: {
        	category1:$('input[name="item_cat"]:checked').val()
        },
        cache: false,
        success: function(data) {
            $('#item_cat_dtl_etc').hide();
			$("#item_cat_dtl_s").html("");
			var fvHtml="<option value=\"\" selected>선택</option>";
			if($('input[name="item_cat"]:checked').val())
			{
				fvHtml += data;

				$("#item_cat_dtl_s").html(fvHtml);
				$('#item_cat_dtl_s').change(function(){
					$('#item_cat_dtl_etc').val("");
					if($(this).val() == "직접입력")
					{
						$('#item_cat_dtl_etc').show();
					}else{
						$('#item_cat_dtl_etc').hide();
					}
				});

				
			}
			$("#item_cat_dtl_s").html(fvHtml);
        }
    });
}

function doRegistMatch()
{
	var f = document.frmregister;
	if(!cfnNullCheckSelect($("#area1").val(), "기본주소")) return;
	if(!cfnNullCheckSelect($("#area2").val(), "기본주소")) return;
	if(!cfnNullCheckInput($("#area3").val(), "상세주소")) return;
	if(!cfnNullCheckInput($("#title").val(), "제목")) return;
	if(!cfnNullCheckInput($("#content").val(), "챀고사항")) return;
	
	var itemCatDtl = $("#item_cat_dtl_s").val();
	if(itemCatDtl == "직접입력")
	{
		itemCatDtl = $("#item_cat_dtl_etc").val();
	}
	
	if(!cfnNullCheckSelect(itemCatDtl, "세부카테고리")) return;

	f.item_cat_dtl.value = itemCatDtl;

	var nCnt = 0;
	for(var i=1; i<=imageMaxCnt; i++)
	{
		if($("#photo"+i).val()){
			nCnt++;
		}
		
	}
	
	if(nCnt == 0){
		alert("사진을 등록하십시오.");
		return;
	}

	f.submit();
}
</script>
<?php
include_once('./_tail.php');
?>