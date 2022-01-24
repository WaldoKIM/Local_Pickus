<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	h2{font-size: 18px; text-align: center;}
	table{margin: 0 auto;border: 3px solid #1379cd; margin-top: 25px; border-radius: 10px; padding: 15px;}
	input[type="text"],select{width: 200px; height: 30px;}
	input[type="button"]{width: 50%; margin: 0 auto; display: block; height: 35px; font-size: 16px; font-weight: bold; margin-top: 20px; background-color: #1379cd; color: #fff; border: 0; cursor: pointer; border-radius: 5px;}
	td{padding: 5px 10px;}
</style>
<div id="section1">
	<h2>물품구매정보</h2>
	<!-- <div style="text-align: center;">
		<input type="text" name="search_goods" id="search_goods" placeholder="검색">
	</div> -->
	<table>
		<tr>
			<td>구매내역제목</td>
			<td><input type="text" name=""></td>
		</tr>
		<tr>
			<td>장소</td>
			<td>
				<select>
					<option value="가전">가전</option>
					<option value="주방집기">주방집기</option>
					<option value="헬스용품">헬스용품</option>
					<option value="가구">가구</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>구매품목리스트</td>
			<td>
				<input type="radio" name="test_text1" value="가전,가구매입" id="test_select">가전/가구 매입
				<input type="radio" name="test_text1" value="대량매입" id="test_select">대량 매입
				<input type="radio" name="test_text1" value="철거,원상복구" id="test_select">철거/원상복구
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="text" name="search_goods_" id="search_goods_" placeholder="검색"></td>
		</tr>
		<tr>
			<td>예상비용</td>
			<td><input type="text" name="test_text2" id="test_text2">만원 (0 입력시 협의)</td>
		</tr>
	</table>
	<div>
		<h3>견적바구니</h3>
		<div id="log">
			
		</div>
	</div>
	<input type="button" value="견적요청" id="btn_send1">
	
</div>
<div id="section2" style="display: none;">
	<h2>배송정보입력</h2>
	<table>
		<tr>
			<td>배송지역</td>
			<td><input type="text" name="test_text2" id="test_text2"></td>
		</tr>
		<tr>
			<td>견적마감일</td>
			<td><input type="text" name="test_text3" id="test_text3"></td>
		</tr>
		<tr>
			<td>배송요청일</td>
			<td><input type="text" name="test_text3" id="test_text3"></td>
		</tr>
		<tr>
			<td>기타요청사항</td>
			<td><input type="date" name="test_text3" id="test_text3"></td>
		</tr>
	</table>
	<input type="button" value="배송정보 입력완료" id="btn_send2">
</div>
<div id="section3" style="display: none;">
	<h2>견적신청</h2>
	<table>
		<tr>
			<td>이름</td>
			<td><input type="text" name="test_text2" id="test_text2"></td>
		</tr>
		<tr>
			<td>이메일</td>
			<td><input type="text" name="test_text3" id="test_text3"></td>
		</tr>
		<tr>
			<td>휴대폰</td>
			<td><input type="text" name="test_text3" id="test_text3"></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">서비스 이용약관 및 개인정보 취급방취 동의합니다.</td>
		</tr>
	</table>
	<input type="button" value="견적요청완료" id="btn_send3">

	
</div>
<script type="text/javascript">

	$(document).ready(function(){

		
		

		var availableTags = [
	      "냉장고",
	      "세탁기",
	      "에어컨",
	      "공기청정기",
	      "진공청소기",
	      "로봇청소기",
	      "건조기",
	      "의류건조기",
	      "컴퓨터",
	      "노트북",
	      "휴대폰",
	      "태블릿",
	      "컴퓨터 부품"
	    ];
	    $( "#search_goods" ).autocomplete({
	      source: availableTags
	    });
	    function log( message ) {
	      $( "<div>" ).text( message ).prependTo( "#log" );
	      $( "#log" ).scrollTop( 0 );
	    }
	    $( "#search_goods_" ).autocomplete({
	      source: availableTags,
	      select: function( event, ui ) {
	        log( ui.item.value );
	      }
	    });

		var get_subject = $(opener.document).find('#wr_subject');
		$( "#test_text3" ).datepicker({dateFormat: "yy-mm-dd"});


		$('#btn_send3').click(function(){
			$(opener.document).find('#edate').val($('#test_text3').val());

			$(get_subject).val( $('#test_text3').val() + ' ' + get_subject.val());
			self.close();

		});
		$('#btn_send2').click(function(){
			
			$('#section2').css('display', 'none');
			$('#section3').css('display', 'block');
		});
		$('#btn_send1').click(function(){
			$(opener.document).find('#ca_name').val($('input[name="test_text1"]:checked').val());
			$(opener.document).find('#as_view').val($('#test_text2').val());

			$(get_subject).val( get_subject.val() + ' ' + $('#test_text2').val() + '만원 ');
			$(opener.document).find('#wr_subject').val($('input[name="test_text1"]:checked').val());

			$('#section1').css('display', 'none');
			$('#section2').css('display', 'block');
		});

	});
</script>