<?

	if(count($HTTP_GET_VARS)) { 
		foreach($HTTP_GET_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if(count($HTTP_POST_VARS)) { 
		foreach($HTTP_POST_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_COOKIE_VARS) ) { 
		foreach($HTTP_COOKIE_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_SESSION_VARS) ) { 
		foreach($HTTP_SESSION_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	if( $level && count($HTTP_SERVER_VARS) ) { 
		foreach($HTTP_SERVER_VARS as $key => $value) { 
		global ${$key}; 
		${$key} = $value; 
		} 
	} 

	@include("config.php");
	@include($ROOT_DIR.'/lib/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();
	$admin_stat = $db->object("cs_admin", "");
	
$ipAddress = $REMOTE_ADDR;
$site_url = $admin_stat->shop_url;

// 관리자 정보 불러오기
$design_stat = $db->object("cs_design", "");
$db->insert("cs_connect", "ip='$_SERVER[REMOTE_ADDR]', url='$_SERVER[HTTP_REFERER]', register=now()");
$skin_url = str_replace($admin_stat->shop_domain,'', $admin_stat->shop_url);
$skin_url = str_replace('/','', $skin_url);

	$query = $_SERVER[QUERY_STRING];
	$vars = array();

	foreach (explode('&', $query) as $pair) {
		list ($key, $value) = explode('=', $pair);
		$key = urldecode($key);
		$value = urldecode($value);
		$vars[$key][] = $value;
	}
	
	$itemIds = $vars[ITEM_ID];
	if (count($itemIds) < 1) 
	{
		exit('ITEM_ID 는 필수입니다.');
	}

header('Content-Type: application/xml;charset=utf-8');	
	echo ('<?xml version="1.0" encoding="utf-8"?>');
?>
<response>
<?
	foreach ($vars[ITEM_ID] as $itemId) 
	{
		if(strlen($itemId) < 9){
		$goods_stat = $db->object("cs_goods", "where idx = $itemId");
		}else{
		$goods_stat = $db->object("cs_goods", "where code = $itemId");	
		}

	$imageEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=500&h=500");
	$thumbEncode = $tools->encode("idx=".$goods_stat->idx."&table=cs_goods&img=images1&dire=goodsImages&w=270&h=270");
	$link_data = $tools->encode("&idx=".$goods_stat->idx);	
	
		$id = $goods_stat->code;
		$name = addslashes($goods_stat->name);
		$category = $goods_stat->part_idx;
		$url =  "http://".$site_url."/".$skin_url."/product_view.php?part_idx=".$goods_stat->part_idx."&goods_data=".$link_data;
		$image = "http://".$site_url."/".$skin_url."/thumbnail.img.php?ThumbEncode=".$imageEncode;
		$thumbImage = "http://".$site_url."/".$skin_url."/thumbnail.img.php?ThumbEncode=".$thumbEncode;
		$price = $goods_stat->shop_price;
		$description = $goods_stat->content;
		if($goods_stat->unlimit == 1){$quantity = "100"; }else{$quantity = $goods_stat->number ;}

						//카테고리 찾기
						$part_idx = $goods_stat->part_idx;
						$part_stat = $db->object("cs_part", "where idx=$part_idx");
						if( $part_stat->part_index == 1 ) {
						$part_name_result = $db->select("cs_part", "where part1_code='$part_stat->part1_code' && part_index=1 order by idx asc", "idx, part_name");
						} else if( $part_stat->part_index == 2 ) {
						$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) order by idx asc", "idx,part_name");
						} else if( $part_stat->part_index == 3 ) {
						$part_name_result = $db->select("cs_part", "where (part1_code='$part_stat->part1_code' && part_index=1) || (part2_code ='$part_stat->part2_code' && part_index=2) || (part3_code='$part_stat->part3_code' && part_index=3) order by idx asc", "idx, part_name");
						}
						//카테고리 찾기 END
	
?>
	<item id="<?=$id?>">
	
		<name><![CDATA[<?=$name?>]]></name>
		<url><![CDATA[<?=$url?>]]></url>
		<description><![CDATA[<?=$description?>]]></description>
		<image><?=$image?></image>
		<thumb><?=$thumbImage?></thumb>
		<price><?=$price?></price>
		<quantity><?=$quantity?></quantity>
        <category>
		<? $i=0; while( $part_name_stat_row = @mysqli_fetch_object( $part_name_result )) {	++$i;?><? if( $i==1 && $part_stat->part_index == 3) { $part_name_idx=$part_name_stat_row->idx; $depthopen = "<first>"; $depthclose ="</first>";}?><? if( $i==3 && $part_stat->part_index == 3) { $part_name_idx=$part_name_stat_row->idx; $depthopen = "<third>"; $depthclose ="</third>";}?><? if( $i==2 && $part_stat->part_index == 3) {?><second><?=$part_name_stat_row->part_name;?></second><?} else {?><?=$depthopen?><?=$part_name_stat_row->part_name;?><?=$depthclose?><?}?><?}?>
		
		</category> 
<? 
/*
	if ($data[option_value_1]) 
	{
		echo('<options>');
		for ($i = 1; $i <= 8; $i++) 
		{
			if ($data['option_value_'.$i]) 
			{
				echo('<option name="' . $data['option_name_'.$i] . '">');
				foreach(explode('/', $data['option_value_'.$i]) as $key => $value) 
				{
					echo('<select><![CDATA['.$value.']]></select>');
				}
				echo('</option>');
			}
		}
		echo('</options>');

	}
*/
?>
<? 
/*
	if ($category) { ?>
		<category>
			<first id="<?=$category?>">
		</category>
<? }
*/	
?>
	</item>
<? } ?>	
</response>
<?
/*
<!-- 
상품정보 연동시 상품정보 제공 내용은 다음과 같다.
ITEM_ID(item id) : 상품정보를 요청할때 쓰이며, 고유하며 식별가능한 가맹점의 상품아이디이다.
name : 상품명
url : 해당상품의 페이지
description : 상품에 대한 설명 (글자 수 제한은 없으나, 간결하게 표기한다.)
image : 상품이미지url
thumb 상품썸네일이미지url
price : 상품의 정상가격
options : 해당상품의 옵션사항
category : 상품의 카테고리
-->
*/
?>