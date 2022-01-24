<?php
include_once('./_common.php');

include_once(G5_PATH . '/head.php');
$g5['title'] = '견적신청';

if ($member['mb_level'] == '2') {
	alert('업체회원은 이용하실 수 없습니다.');
}
?>
<div style="width:500px; height:200px;">
	<input type="text" id="model_code" placeholder="모델명을 입력해주세요."><input type="submit" value="검색하기" onclick="model_search()">
	<div>
		<div>
			<p>제조사 :</p>
			<div id="search_brand"></div>
		</div>
		<div>
			<p>카테고리 :</p>
			<div id="search_category"></div>
		</div>
	</div>
</div>

<script>
	function model_search() {
		if ($('#model_code') != null) {
			$.ajax({
				type: "GET",
				url: "<?php echo G5_URL ?>/ajax.mongo.php",
				data: {
					model_code: $('#model_code').val()
				},
				success: function(data) {
					// var search_result = JSON.stringify(data);
					// console.log(JSON.stringify(data));
					// $('#search_result').text(search_result);
					var brand = [];
					var category = [];
					var obj = JSON.parse(JSON.stringify(data));
					for (var objs of obj) {
						Object.keys(objs).forEach(function(v, v1) {
							if (v == 'brand') brand.push(objs[v]);
							if (v == 'category3') category.push(objs[v]);
						})
					}

					console.log(brand);
					console.log(category);
					$('#search_brand').text(brand[0]);
					$('#search_category').text(category[0]);
				},
				error: function(data) {
					//통신 실패시 발생하는 함수(콜백)
					alert('검색하신 상품이 없습니다.');
				}
			});
		}
	}
</script>
<?php
include_once(G5_PATH . '/tail.php');
?>