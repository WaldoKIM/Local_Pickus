
<? 
	include('./include/head.inc.search.php');
	include($ROOT_DIR . "/lib/page_class.php");
?>
<link rel="stylesheet" href="./css/search_form.css">

<section class="search_section">
	<div class="search_form">
		<div id="history_back" class="search_form_back"><img src="./img/back.png" alt=""></div>
		<div class="search_form_search">
			<input type="text" id="search_input" class="search_input" placeholder="검색어를 입력하세요.">
			<a class="search_btn" id="search_btn"><img src="./img/search.png" alt=""></a>
		</div>
	</div>

	<div class="search_category">
		<div class="search_category_title">카테고리</div>
		<ul class="search_category_ul">
			<? include('./include/search_category.php'); ?>
		</ul>
	</div>

	<hr class="search_hr">

	<div class="search_keyword">
		<div class="search_keyword_title">인기 검색어</div>
		<ul class="search_keyword_ul">
			<? include('./include/search_keyword.php'); ?>
		</ul>
	</div>
</section>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6324853175392320" crossorigin="anonymous"></script>
<!-- 하단광고 -->
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6324853175392320" data-ad-slot="1465013656" data-ad-format="auto" data-full-width-responsive="true"></ins>
<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
</script>



<script type="text/javascript">
	$('#history_back').click(function(){
		window.history.back();
	});

	$("#search_input").keydown(function(key) {
		var mo_search_text = $("#search_input").val();
		if (key.keyCode == 13) {
			if (mo_search_text == false) {
				alert('검색어를 입력하세요1.');
			} else {
				search();
			}
		}
	});

	$("#search_btn").click(function() {
		var mo_search_text = $("#search_input").val();
		if (mo_search_text == false) {
			alert('검색어를 입력하세요2.');
		} else {
			search();
		}
	});

	function search_ok() {
		var mo_search_text = $("#search_input").val();
		location.href = "product_search.php?search=" + mo_search_text;
	};

	function search() {
		if ($('#search_input').val() != "") {
			$.ajax({
				type: "GET",
				url: "search_form_ok.php",
				data: {
					search_input: $('#search_input').val()
				},
				success: function(data) {
					search_ok();
					console.log(data);
				},
				error: function(data) {
					//통신 실패시 발생하는 함수(콜백)
					alert('다시 검색해주세요.');
				}
			});
		} else { 
			alert('검색어를 입력하세요3.');
			}
	}

	
</script>