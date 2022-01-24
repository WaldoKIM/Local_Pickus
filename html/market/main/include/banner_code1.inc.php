<?
$banner_code = "banner_code1";
if($db->cnt( "cs_banner", "where status='$banner_code'" )) {
?>
	<?
	$bannerCnt = 0;
	$result	= $db->select("cs_banner", "where status='$banner_code' order by idx asc limit 2" );
	while( $row = mysqli_fetch_object($result)) {
		$bannerCnt++;
	?>
		<? if($row->type==1) {//HTML?>
			<?=$row->content;?>
		<?}else if($row->type==2){//IMG?>
			<div class="banner banner<?=$bannerCnt?>"><? if($row->link_url) {?><a href="http://<?=$row->link_url;?>" target="<? if($row->target) { echo('_self'); } else { echo('_blank');}?>"><img src="../data/designImages/<?=$row->banner_images;?>"  border="0"></a><?} else {?><img src="../data/designImages/<?=$row->banner_images;?>" border="0"><?}?></div>
		<?}
	}?>
<?}else{?>
<table width="315">
	<tr>
		<td align="center"><font color='red'>관리자페이지에서 디자인설정>배너설정부분의 banner_code1 등록해 주세요.</font></td>
	</tr>
</table>
<?}?>