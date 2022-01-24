<style>
/**********************카테고리속성****************************/
@media (min-width: 1022px) {
.sf-menu_cate {
	text-align:left;
	padding-top:1em;
	border-bottom:1px solid #efefef;
	border-left:1px solid #efefef;
	border-right:1px solid #efefef;
}
#category_cacontainer ul{
	margin:0;
	padding:0;
	list-style:none;
	font-family: 'RixSGo M', 'NanumBarunGothic', 'NanumBarunGothicBold', "Dotum", 'Gulim', sans-serif;
}
#category_cacontainer li{
	position:relative;
}
#category_cacontainer ul{
	position:absolute;
	display:none;
	top:0;
	z-index:9999;
}
#category_cacontainer li:hover>ul,#category_cacontainer li.sfHover>ul{
	display:block;
}
#category_cacontainer a{
	display:block;
	position:relative;
}
#category_cacontainer ul ul{
	top:-7px;left:100%;
}
#category_cacontainer{
	text-align:left;
}
#category_cacontainer a{
	padding:.10em 1.1em; /************pc 2차메뉴 간격****************/
	text-decoration:none;zoom:1;
}
#category_cacontainer li{
	white-space:nowrap;
	*white-space:normal;
	-webkit-transition:background .2s;
	transition:background .2s;
}
#category_cacontainer>li{
	display:inline-block;
	width:100%;
	line-height:40px;
	padding:0 0;   /************pc 1차메뉴 간격****************/
	position:relative;
	background-color:#fff;
	border-bottom:1px solid #D6D6D6;
}

#category_cacontainer>li+li:before{
	/*content:'';
	width:1px;
	height:20px;
	position:absolute;
	left:0;
	top:50%;
	margin-top:-9px;
	background-color:rgba(0,0,0,0.15);***********pc 서브메뉴 경계 라인****************/
}
#category_cacontainer ul a{
	text-transform:uppercase;
	background-color:#f9f9f9;
	color:#333;overflow:hidden; white-space:nowrap; text-overflow:ellipsis;
	border-bottom:1px solid #D6D6D6;/************pc 2차메뉴****************
}
#category_cacontainer ul>li+li:before{
	 /*position:absolute;
	content:'';
	height:1px;
	left:15px;
	right:15px;
	background-color:#f2f2f2;*/
}
#category_cacontainer ul a:hover,#category_cacontainer ul li.active a{
	color:#db2450;
}
}
</style>
<div id="category_cacontainer"></div>
<!--브랜트코너-->
<!--div class="layer-brand-search">
	<button class="btn btn-default" type="button" data-layer-target="#blandlayer-01"><i class='fa-search-plus layer-brand-search-icon' ></i>브랜드별 상품검색</button>
</div>
<div id="category_cacontainer_more"></div-->
<script type="text/javascript">
function ajaxcateitem(start, end){
	ajaxcatelist(start, end);
	ajaxcatemore(start, end);
}
function ajaxcateitemreset(start, end){
	ajaxcatelistrest(start, end);
	ajaxcatemore(start, end);
}
function ajaxcatelist(start, end){
	$.ajax({
		type: "GET",
		url: "ajax_category.php",
		data: "start="+start+"&end="+ end+"&part_idx="+<?=$_GET[part_idx];?>,
		cache: false,
		success: function(html)
		{
			$("div#category_cacontainer").append(html);
		}
	});
}
function ajaxcatelistrest(start, end){
	$.ajax({
		type: "GET",
		url: "ajax_category.php",
		data: "start="+start+"&end="+ end,
		cache: false,
		success: function(html)
		{
			$("div#category_cacontainer").html(html);
		}
	});
}
function ajaxcatemore(start, end){
	$.ajax({
		type: "GET",
		url: "ajax_category_more.php",
		data: "start="+start+"&end="+ end,
		cache: false,
		success: function(html)
		{
			$("div#category_cacontainer_more").html(html);
		}
	});
}
window.onload = function () {
	ajaxitem('<?=$mv_data?>');
	ajaxcateitem(0, 20);

}
</script>