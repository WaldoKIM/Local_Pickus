<?
$banner_code = "banner_code2";
if($db->cnt( "cs_banner", "where status='$banner_code'" )) {
$bannerSortWC = 1;  // 가로수
$bannerSortHC = 10;  // 세로수
$banner_sort = $bannerSortWC * $bannerSortHC; //총출력수
?>
	<table width="100%">
		<tr>
		<?
		$bannerCnt = 0;
		$result	= $db->select("cs_banner", "where status='$banner_code' order by idx asc limit $banner_sort" );
		while( $row = mysqli_fetch_object($result)) {
			$bannerCnt++;
		?>
			<td align="center"><? if($row->type==1) {//HTML?><?=$row->content;?><?}else if($row->type==2){//IMG?><? if($row->link_url) {?><a href="http://<?=$row->link_url;?>" target="<? if($row->target) { echo('_self'); } else { echo('_blank');}?>"><img src="../data/designImages/<?=$row->banner_images;?>" height="<?=$row->img_height?>" width="<?=$row->img_width?>" border="0"></a><?} else {?><img src="../data/designImages/<?=$row->banner_images;?>" height="<?=$row->img_height?>" width="<?=$row->img_width?>" border="0"><?}?><?}else{?><script>MakeFlash1("../data/designImages/<?=$row->banner_images?>",<?=$row->img_width?>,<?=$row->img_height?>)</script><?}?></td>
			<?if($bannerCnt%$bannerSortWC==0){?>
		</tr>
		<tr>
		<?}}?>
	</table>
<?}else{?>
<table width="100%">
	<tr>
		<td align="center">
			<div align='center'><font color='red'>관리자페이지에서 디자인설정>배너설정부분의 banner_code2 등록해 주세요.</font></div>
		</td>
	</tr>
</table>
<?}?>