<? include('../common.php');?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/popup.css">
<link rel="stylesheet" type="text/css" href="css/joinform_style.css">
<?
//상품아이콘배열화
$iconRe		= $db->select("cs_icon_list", "order by idx asc" );
$arrPicon = array();
while( $iconRow = mysqli_fetch_object($iconRe) ) {
	$arrPicon[$iconRow->idx] = $iconRow->icon;
}
 
$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
if($_GET[idx] )						{ $idx = $_GET[idx]; }											else { $idx = $goods_data[idx]; }
if($_GET[part_idx] )			{ $part_idx = $_GET[part_idx]; }						else { $part_idx = $goods_data[part_idx]; }
if($_GET[type] )			{ $type = $_GET[type]; }						else { $type = $goods_data[type]; }
$goods_stat = $db->object("cs_goods", "where idx=$idx");
$db->update("cs_goods", "click=$goods_stat->click+1 where idx=$goods_stat->idx");
$arrIcon = explode(",",",".$goods_stat->iconidx);
$arrIcon2 = explode(",",",".$goods_stat->substimg);
$optArr = explode("/^CUT/^", $goods_stat->opt_data);
?>
<script language="javascript">
<!--
	// 구매 링크 리스트
	function goodsBuySendit(check){
		var form=document.goods_form;
		var k=0;
		for(var i=1; i<document.forms['goods_form']['option_select[]'].length; i++) {
			if(document.forms['goods_form']['option_select[]'][i].value=='none') {
				k=1;
			}
		}
		if(form.buy_goods_cnt.value=="" || form.buy_goods_cnt.value=="0" || form.buy_goods_cnt.value==0) {
			alert("구입수량을 입력해 주십시오.");
			form.buy_goods_cnt.focus();
		}else if(k==1){
			for(var i=1; i<document.forms['goods_form']['option_select[]'].length; i++) {
				if(document.forms['goods_form']['option_select[]'][i].value=='none') {
					alert('옵션을 선택해주세요');
					document.forms['goods_form']['option_select[]'][i].focus();
					break;
				}
			}
		}<? if(!$goods_stat->unlimit) { ?>
		else if(form.buy_goods_cnt.value > <?=$goods_stat->number;?>) {
			alert("상품 재고수량이 부족합니다.");
			form.buy_goods_cnt.focus();
		}<?}?>else{
			if(check==1) { // 장바구니추가
				form.target = "item_target";
				form.action="cart.iframe.php?cart_method=1&goods_data=<?=$mv_data;?>";
				form.submit();
				cartdiv.style.display="";
			} else if(check==2) { // 즉시 구매
				form.target = "_parent";
				form.action="order_once_ok.php?trade_method=2&goods_data=<?=$mv_data;?>";
				form.submit();
			} else if(check==3) { // withlist 추가
				form.target = "item_target";
				form.action="my_wishlist.iframe.php?wishlist_method=1&goods_data=<?=$mv_data;?>";
				form.submit();
				wishdiv.style.display="";
			}
		}
	}
	function priceCheck(){
		var form=document.goods_form;
		var totalPrice = Number(<?=$goods_stat->shop_price?>);
		for(var data_cnt=0; data_cnt < document.forms['goods_form']['option_select[]'].length; data_cnt ++) {
			optionCut = document.forms['goods_form']['option_select[]'][data_cnt].value.split(":");
			if(optionCut[1]){
				totalPrice = Number(totalPrice) + Number(trim(optionCut[1]));
			}
		}
		form.hidden_price.value = totalPrice;
		document.all.viewPrice.innerHTML = "<img src='skinimage/icon_product_view.gif'><b><font color='#E80700'>"+commify(totalPrice)+"원</b></font>";
	}
	function commify(n) {
	  var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
	  n += '';                          // 숫자를 문자열로 변환
	  while (reg.test(n))
		n = n.replace(reg, '$1' + ',' + '$2');
	  return n;
	}
	function trim(str) {
		return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	 }
	//-->
</script>
</head>
<!--제품 기본정보 출력 테이블 시작-->
<body>
<div id='cartdiv' style="position:absolute;width:100%;height:100%;display:none;z-index:130;background-color:#FFFFFF;">
<table width="100%">
    <tr>
        <td style="width:32px;height:31px;background:#222;color:#fff;font-size:1.2em;font-weight:400;position:absolute;right:3.2%;top:1.8%"></td>
        <td height="100" align="center"><h2>장바구니에 상품이 등록되었습니다.</h2></td>
	</tr>
</table>
<table width="100%">
    <tr>
        <td height="100" align="center"><a href="cart.php" target="_parent" style='width:100px;' class='btn-type6_view'>장바구니로 이동</a></td>
	</tr>
</table>
</div>
<div id='wishdiv' style="position:absolute;width:100%;height:100%;display:none;z-index:130;background-color:#FFFFFF;">
<table width="100%">
    <tr>
        <td height="100" align="center"><h2>찜목록에 상품이 등록되었습니다.</h2></td>
	</tr>
</table>
<table width="100%">
    <tr>
        <td height="100" align="center"><a href="my_wishlist.php" target="_parent" style='width:100px;' class='btn-type6_view'>찜목록 이동</a></td>
	</tr>
</table>
</div>
<iframe src='' name='item_target' style="display:none"></iframe>
<table style="width:100%;">
<tr>
	<td valign="top">
		<!--제품기본정보 및 버튼 출력-->
		<table style="width:100%;">
		<tr>
			<td>
				<!--상품정보출력-->
                <table style="width:100%;">
                    <tr>
                        <?if($_GET[type]==1){?>
                        <td style="height:60px;background:#222;color:#fff;font-size:1.2em;font-weight:400;padding-left:20px;">장바구니 담기</td>
                        <?}else if($_GET[type]==2){?>
                        <td style="height:60px;background:#222;color:#fff;font-size:1.2em;font-weight:400;padding-left:20px;">바로 구매하기</td>
                        <?}else if($_GET[type]==3){?>
                        <td style="height:60px;background:#222;color:#fff;font-size:1.2em;font-weight:400;padding-left:20px;">관심상품 등록</td>
                        <?}?>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-shop" style="padding:0 15px;">
                                <div id="prev-next-links">
                                    <!--이전페이지 아이콘 Previous Item Link-->
                                    <? if($goods_prev_cnt>=1) {?><a id="link-previous-product" href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>&goods_move_page=prev&part_idx=<?=$part_idx?>&goods_code=<?=$goods_stat->code;?>" title='이전페이지'>&nbsp;</a><?}?>
                                    <!--다음페이지 아이콘 Next Item Link-->
                                    <? if($goods_next_cnt>=1) {?><a id="link-next-product" href="<?=$_SERVER[PHP_SELF];?>?goods_data=<?=$goods_data;?>&goods_move_page=next&part_idx=<?=$part_idx?>&goods_code=<?=$goods_stat->code;?>" title='다음페이지'>&nbsp;</a><?}?>
                                </div>
                                <div class="short-description">
                                    <div class="std">
                                        <!----상품정보출력-->
                                        <table style="width:100%;">
                                            <form method="post" name="goods_form">
                                                <input type="hidden" name="hidden_price" value="<?=$goods_stat->shop_price?>">
                                                <tr>
                                                    <td class="product-viewboxT">
                                                        <?=$db->stripSlash($goods_stat->name);?>
                                                        <?for($i=1;$i<count($arrIcon);$i++){ if($arrIcon[$i]>
                                                            0){
                                                            ?>
                                                            <img src="../data/designImages/<?=$arrPicon[$arrIcon[$i]]?>" align="absmiddle">
                                                            <?}}?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:2px;background:#000;"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">상품코드</td>
                                                                <td class='product-viewbox'><?=$goods_stat->code;?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <?if($goods_stat->subst==1){?>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">판매가격</td>
                                                                <td class='product-viewbox'>
                                                                    <span class="product-viewbox_price">
                                                                        <div id="viewPrice">
                                                                            <?if($goods_stat->substtxt){?><?=$goods_stat->substtxt?><?}?>
                                                                            <?for($i=1;$i<count($arrIcon2);$i++){ if($arrIcon2[$i]>
                                                                                0){
                                                                                ?>
                                                                                <img src="../data/designImages/<?=$arrPicon[$arrIcon2[$i]]?>" align="absmiddle">
                                                                                <?}}?>
                                                                        </div>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <?}else{?>
                                                <? if( !$_SESSION[USERID] && $admin_stat->nomember_old_price ) {?>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">시중가격</td>
                                                                <td class='product-viewbox'><span class="product-viewbox_price_old"><strike><?=number_format($goods_stat->old_price);?></strike>원</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <?} else if( $_SESSION[USERID] && $admin_stat->member_old_price ) {?>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">시중가격</td>
                                                                <td class='product-viewbox'><span class="product-viewbox_price_old"><strike><?=number_format($goods_stat->old_price);?></strike>원</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <?}?>
                                                <? if( !$_SESSION[USERID] && $admin_stat->nomember_shop_price ) { $ordercheck = 1;?>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">판매가격</td>
                                                                <td class='product-viewbox'><span class="product-viewbox_price"><div id="viewPrice"><?=number_format($goods_stat->shop_price);?>원</div></span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">적립금</td>
                                                                <td class='product-viewbox'><span class="sens_body3"><?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>&nbsp;원</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?} else if( $_SESSION[USERID] && $admin_stat->member_shop_price ) { $ordercheck = 1;?>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">판매가격</td>
                                                                <td class='product-viewbox'><span class="product-viewbox_price"><div id="viewPrice"><?=number_format($goods_stat->shop_price);?>원</div></span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="product-viewboxL">적립금</td>
                                                                <td class='product-viewbox'><span class="sens_body3"><?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>&nbsp;원</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?}?>
                                                <tr style="display:none">
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td></td>
                                                                <td class='product-viewbox'>
                                                                    <input type="hidden" name="part_name[]">
                                                                    <select name="option_select[]" class="input" onchange="priceCheck(this)">
                                                                        <option value="none">옵션선택</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="1" bgcolor="#dddddd"></td>
                                                </tr>
                                                <!-- 옵션출력 -->
                                                <? for($i=0;$i<count($optArr)-1;$i++){ $optRec=explode("/^/^", $optArr[$i]);
                                                                                       ?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL"><?=$optRec[0];?></td>
                                                                    <td class='product-viewbox'>
                                                                        <input type="hidden" name="part_name[]" value="<?=$optRec[0];?>">
                                                                        <select name="option_select[]" class="input" onchange="priceCheck(this)">
                                                                            <option value="none">옵션선택</option>
                                                                            <?
                                                                            $option1_arr = explode("&&", $optRec[1] );
                                                                            for( $ot1=0; $ot1 < count($option1_arr)-1; $ot1++ ) {
                                                                            $optView = "";
                                                                            $optView = explode(":", $option1_arr[$ot1] );
                                                                            ?>
                                                                            <option value="<?=$option1_arr[$ot1];?>"><?=$optView[0]?><?if($optView[1]){?>:<?=number_format($optView[1])?>원<?}?></option>
                                                                            <? }?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" bgcolor="#dddddd"></td>
                                                    </tr>
                                                    <?}?>
                                                    <?}?>
                                                    <!-- 옵션출력 -->
                                                    <? if($goods_stat->goods_file) {?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL">첨부자료</td>
                                                                    <td class='product-viewbox'><img src="images/bt_file.gif" border="0" align="absmiddle"> *주문완료후 마이페이지에서 다운로드가능</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" bgcolor="#dddddd"></td>
                                                    </tr>
                                                    <? }?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL">브랜드</td>
                                                                    <td class='product-viewbox'><?=$goods_stat->company;?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" bgcolor="#dddddd"></td>
                                                    </tr>
                                                    <? if($admin_stat->delivery_company) {?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL">배송방법</td>
                                                                    <td class='product-viewbox'><?=$admin_stat->delivery_company;?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="1" bgcolor="#dddddd"></td>
                                                    </tr>
                                                    <?}?>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL">판매수량</td>
                                                                    <td class='product-viewbox'><? if($goods_stat->unlimit==0) { if($goods_stat->number==0) { echo('품절'); } else { echo($goods_stat->number."&nbsp;개");}} else { echo('재고보유');}?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <?if($ordercheck==1){?>
                                                    <?if($goods_stat->subst!=1){?>
                                                    <tr>
                                                        <td height="1" bgcolor="#dddddd"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td class="product-viewboxL">주문수량</td>
                                                                    <td class='product-viewbox'><input name="buy_goods_cnt" type="text" class="formText juminsmall_size" size="5" value="1" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;"> 개</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <?}}?>
                                                    <tr>
                                                        <td height="1" bgcolor="#000"></td>
                                                    </tr>
                                            </form>
                                        </table>
                                        <!----상품정보출력-->
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="30"></td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <!--구매버튼출력-->
                            <?if($ordercheck==1){?>
                            <table style='margin:0 auto'>
                                <tr>
                                    <?if($_GET[type]==1){?>
                                    <td><a href="javascript:goodsBuySendit(1);" class="btn-type5_view">장바구니 담기</a></td>
                                    <?}else if($_GET[type]==2){?>
                                    <td><a href="javascript:goodsBuySendit(2);" class="btn-type5_view">바로 구매하기</a></td>
                                    <?}else if($_GET[type]==3){?>
                                    <td><? if($_SESSION[USERID]) {?><a href="javascript:goodsBuySendit(3);" class="btn-type5_view">관심상품 등록</a><?} else {?><a href="javascript:alert('회원 로그인 해주세요');" class="btn-type5_view">관심상품 등록</a><? }?></td>
                                    <?}?>
                                </tr>
                            </table>
                            <?}?>
                            <!--구매버튼출력-->
                        </td>
                    </tr>
                    <tr>
                        <td height="30"></td>
                    </tr>
                </table>
				<!--제품기본정보 및 버튼 출력-->
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>