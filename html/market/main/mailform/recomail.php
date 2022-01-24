<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
.menu {
font-family: "돋움";
font-size: 12px;
color: #666666;
}
.menubw {
font-family: "돋움";
font-size: 12px;
color: #FFFFFF;
}
-->
</style>
</head>

<body>
<table width="600" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor='#BDBEBD' style='border-collapse: collapse'>
<tr align="center" bgcolor="8C8E8C"> 
<td height="25" colspan="2" class="menubw"><b>test 님이 보내신 제품 추천 메일입니다</b></td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">보낸사람</td>
<td height="25" width="480" class="menu">test@test.co.kr</td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">받는사람</td>
<td height="25" width="480" class="menu">aaa@aaa.co.kr</td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">내용</td>
<td height="25" width="480" class="menu">test입니다</td>
</tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="65" align="center"><img src="images/bt_goshop.gif" width="160" height="41"></td>
</tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
<td><img src="images/bar_product_info.gif" width="100" height="23"></td>
</tr>
</table>
<table width="600" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#ADAEAD' style='border-collapse: collapse'>
<tr> 
<td width="405" align="center">상품이미지</td>
<td width="195" align="center"><table width="175" border="0" cellpadding="0" cellspacing="0" class="menu">
<form method="post" name="goods_form">
<tr> 
<td width="85" height="25" align="right">판매가격 :</td>
<td width="90" height="25" align="right"> 원</td>
</tr>
<tr> 
<td width="85"25" align="right">소비자가 :</td>
<td width="90" height="25" align="right"><del> 
<?=number_format($goods_stat->old_price);?>
              원</del>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right"><font color="#FF0000">ⓟ</font> 
              Point :</td>
            <td width="90" height="25" align="right"> 
              <?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>
              P&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right">상품코드 :</td>
            <td width="90" height="25" align="right"> 
              <?=$goods_stat->code;?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <!-- 옵션출력 -->
          <? if($goods_stat->option_check==1) {?>
          <? } else if($goods_stat->option_check==2) {?>
          <? }?>
          <!-- 옵션출력 -->
          <? if($goods_stat->goods_file) {?>
          <? }?>
          <? if($admin_stat->delivery_company) {?>
          <tr> 
            <td width="85" height="25" align="right">배송방법 :</td>
            <td width="90" height="25" align="right"> 
              <?=$admin_stat->delivery_company;?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <?}?>
          <tr> 
            <td width="85" height="25" align="right">판매수량 :</td>
            <td width="90" height="25" align="right"> 
              <? if($goods_stat->unlimit==0) { if($goods_stat->number==0) { echo('품절'); } else { echo($goods_stat->number."&nbsp;개");}} else { echo('재고보유');}?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right">주문수량 :</td>
            <td width="90" height="25" align="right"><input name="buy_goods_cnt" type="text" class="input" size="5" value="1" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
              개&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2"><blockquote class="menu"><br>
        제품설명 <br>
        <br>
      </blockquote></td>
  </tr>
</table>
</body>
</html>
