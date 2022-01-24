<!--고정메뉴-->
<?
$table = "cs_page";
$list_check = $totalCnt	= $db->cnt( $table, "" );
$result	= $db->select( $table, "where position=2 or position=4 order by idx desc" );
while( $row = mysqli_fetch_object($result)) {
?>
<li>
	<a href="<?if($row->fixed==1){?>mail_to_admin.php<?}else{?>pageview.php?url=<?=$row->page_index;?><?}?>" class='sf-menu_link'>
	<?=$row->title;?>
	</a>
</li>
<?}?>
<!--고정메뉴-->