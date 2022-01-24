<!--피씨용 텝메뉴-->
<div class="left_gnb">
	<h3><?=$title;?></h3>
	<ul class="menu">
	<?
	$result	= $db->select("cs_page", "where 1 order by idx desc" );
	while( $row = mysqli_fetch_object($result)) {
		if($row->fixed==1){?>
			<?if($TARGETFILENAME=="mail_to_admin.php"){?>
			<li><a class="sensbutton-checked" onclick="javascript:location='mail_to_admin.php'"><?=$row->title;?></a></li>
			<?}else{?>
			<li><a onclick="javascript:location='mail_to_admin.php'"><?=$row->title;?></a></li>
			<?}?>
		<?}else{?>
			<?if($_GET[url]==$row->page_index){?>
			<li><a class="sensbutton-checked" onclick="javascript:location='pageview.php?url=<?=$row->page_index;?>'"><?=$row->title;?></a></li>
			<?}else{?>
			<li><a onclick="javascript:location='pageview.php?url=<?=$row->page_index;?>'"><?=$row->title;?></a></li>
			<?}?>
		<?}?>
	<?}?>
	</ul>
	<ul class="info">
		<li class="tel">
			<a href="tel:<?=$admin_stat->shop_tel1;?>"><?=$admin_stat->shop_tel1;?></a>
		</li>
		<li class="time"><?=$tools->strHtmlBr($admin_stat->week);?></li>
		<?
		$bankResult = $db->select( "cs_banklist", "where main_marking=1 order by idx asc");
		while( $bankRow = @mysqli_fetch_object($bankResult) ) {?>
		<?}?>
	</ul>
</div>