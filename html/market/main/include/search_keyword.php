<?
$keyword_result = $db->select( "cs_goods_keyword", "order by count desc limit 10");
$keyword_result2 = $db->selectkeyword( "cs_goods_keyword", "idx, search_name, sum(count) as count","group by search_name order by count desc limit 10");

// 주메뉴
$i = 0;
while( $keyword_row = @mysqli_fetch_object($keyword_result2) ) {
	$i++
?>
<li>
<a class="keyword_link" href="product_search.php?search=<?=$keyword_row->search_name;?>">
	<p class="keyword_link_rank"><?=$i;?></p>
	<p class="keyword_link_keyword"><?=$keyword_row->search_name;?></p>
	<img class="keyword_link_img" src="./img/up_arrow.png" alt="">
</a>
</li>
<?}?>