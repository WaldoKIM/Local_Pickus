<!--PC용 팝업창-->
<table class='layernoneoolim'>
	<tr>
		<td>
			<div id='POPUP_COOKIE_<?=$code?>' style="position:absolute;width:<?=$popup_row->width?>px; left:<?=$popup_row->lefts?>px; top:<?=$popup_row->top?>px; display:block; <?if($popup_row->layercolor){?>border:1px solid <?=$popup_row->layercolor?>;<?}?> <?if($popup_row->bgcolor){?>background-color:<?=$popup_row->bgcolor?>;<?}?> z-index:300; padding:0px;" onMouseOver='dragObj=POPUP_COOKIE_<?=$code?>; drag=1; move=0' onMouseOut='drag=0'>
			<table width="100%">
				<tr>
					<td width="100%" height="100%" valign="top" class="b_tt">
					<? if($popup_row->display==0) {?><?=$tools->strHtml($popup_row->content);?><?} else if($popup_row->display==1) {?><? if($popup_row->link_url) {?><a href="<?=$popup_row->link_url;?>" target="<?=$popup_row->target?>"><img src='../data/designImages/<?=$popup_row->popup_images;?>' border='0'></a><?} else {?><img src='../data/designImages/<?=$popup_row->popup_images;?>' border='0'><?}?><?}?>
					</td>
				</tr>
				<form name="popup_form<?=$code?>">
				<tr>
					<td class='oolimbtn-popuop_table'><input type=checkbox name="popup_end"><? if($popup_row->live==0) {?>
					오늘 하루 이창을 열지 않습니다.&nbsp;&nbsp;<a href="javascript:closeWin('popup_form<?=$code?>', 'POPUP_COOKIE_<?=$code?>');" class='oolimbtn-popuop'><?} else if($popup_row->live==1) {?>이창은 다시는 띄우지 않습니다.&nbsp;&nbsp;<a href="javascript:closeWinyear('popup_form<?=$code?>', 'POPUP_COOKIE_<?=$code?>');" class='oolimbtn-popuop'><?}?>닫기</a>&nbsp;</td>
				</tr>
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
<!--모바일용 팝업창 등록이미지 최대 500px 사이즈로 등록-->
<?if($popup_row->popup_display==1){?>
<div class='layernoneoolim_pop'>
<div style='width:99.8%;display:inline-block;position:absolute;z-index:1998;top:130px;'>
	<div id='M_POPUP_COOKIE_<?=$code?>' style="margin:0 auto;width:100%;max-width:500px; <?if($popup_row->layercolor){?>border:1px solid <?=$popup_row->layercolor?>;<?}?> <?if($popup_row->bgcolor){?>background-color:<?=$popup_row->bgcolor?>;<?}?> ">
			<p><? if($popup_row->display==0) {?><?=$tools->strHtml($popup_row->content);?><?} else if($popup_row->display==1) {?><? if($popup_row->link_url) {?><a href="<?=$popup_row->link_url;?>" target="<?=$popup_row->target?>"><img src='../data/designImages/<?=$popup_row->popup_images;?>'></a><?} else {?><img src='../data/designImages/<?=$popup_row->popup_images;?>'><?}?><?}?></p>
		<form name="m_popup_form<?=$code?>">
			<div style='padding-top:10px;' class='oolimbtn-popuop_table'><input type=checkbox name="popup_end"><? if($popup_row->live==0) {?>
			오늘 하루 이창을 열지 않음&nbsp;&nbsp;<a href="javascript:closeWinm('m_popup_form<?=$code?>', 'M_POPUP_COOKIE_<?=$code?>', 'POPUP_COOKIE_<?=$code?>');" class='oolimbtn-popuop'><?} else if($popup_row->live==1) {?>이창은 다시는 띄우지 않음&nbsp;&nbsp;<a href="javascript:closeWinyearm('m_popup_form<?=$code?>', 'M_POPUP_COOKIE_<?=$code?>', 'POPUP_COOKIE_<?=$code?>');" class='oolimbtn-popuop'><?}?>닫기</a>
			</div>
		</form>
	</div>
</div>
</div>
<?}?>