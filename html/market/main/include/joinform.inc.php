<?
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            width : '100%',
            height : '100%'
        }).embed(element_layer);
        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';
        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }
    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition(){
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
       // element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
       // element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }
</script>
<script language="javascript">
<!--
// 아이디중복검색	 && 추천인 아이디 검색
// 우편번호찾기
function sendit() {
	<?if($admin_stat->member_addr==1 && $admin_stat->member_addr_use==1){?>
        $(this).next('span.message').hide();
		});
	});
</script>
<form class="join_form" method="post" name="join_form" enctype="multipart/form-data">
		<input type="hidden" name="coinfo1"  value="<?=$_POST[coinfo1]?>">
		<input type="hidden" name="coinfo2"  value="<?=$_POST[coinfo2]?>">
		<input type="hidden" name="ciupdate"  value="<?=$_POST[ciupdate]?>">
		<input type="hidden" name="checktype" value="<?=$_POST[checktype]?>">
		<input type="hidden" name="idch" value="1">
			<li class='jointable_tdS'></li>
			-->
			<li class="user_enter u_id">
				<span class="info_text2">이메일 주소를 입력해 주세요.</span>
				<span id="email_page_msg" name="email_page_msg" class="info_text">이메일 주소를 입력후 중복체크해 주세요.</span>
			</li>
			<li class="user_enter u_pw">
			<li class="user_enter u_pw_check">
			<li class="user_enter u_name">
			<li class="user_enter u_email">
			<?if($admin_stat->member_tel==1){?>
			</li>
			<?if($admin_stat->member_phone==1){?>
			<li class="user_enter u_phone">
				<div>
					<input name="phone1" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="휴대폰">
					<span class="hyphen">-</span>
					<input name="phone2" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
					<span class="hyphen">-</span>
					<input name="phone3" type="text" class="enter textphone" maxlength="4" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
				</div>
			</li>
			<?}?>
			<li class="user_enter u_addr">
				<div>
					<input name="zip" id="zip" type="text" class="enter textPost" maxlength="5" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;" placeholder="주소(우편번호)">
				</div>
				<a href="javascript:sample2_execDaumPostcode()" class="form_btn" title="우편번호검색">우편번호검색</a>
				<div style="width:100%;margin-top:5px">
					<input name="add1" id="add1" type="text" class="enter textAddr01" placeholder="주소">
				</div>
			</li>
		</ul>
		<hr/>
		<div class="user_sel">
			<h3>선택항목</h3>
			<dl class="bir">
				<dt>생년월일</dt>
				<dd>
					<select name="birthy" size="1" class="formSelect">
						<option value="">년도 선택</option>
						<?for($i=date("Y")-70;$i<=date("Y");$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
					<select name="birthm" size="1" class="formSelect">
						<option value="">월 선택</option>
						<?for($i=1;$i<=12;$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
					<select name="birthd" size="1" class="formSelect">
						<option value="">일 선택</option>
						<?for($i=1;$i<=31;$i++){?>
						<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
				</dd>
			</dl>