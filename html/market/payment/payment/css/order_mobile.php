<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��û PAGE                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =   �Ʒ��� �� �ʼ�, �� �ɼ� �κа� �Ŵ����� �����ϼż� ������   = */
    /* =   �����Ͽ� �ֽñ� �ٶ��ϴ�.                                          = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ������ ������ �߻��ϴ� ��� �Ʒ��� �ּҷ� �����ϼż� Ȯ���Ͻñ� �ٶ��ϴ�.= */
    /* =   ���� �ּ� : http://kcp.co.kr/technique.requestcode.do			        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2016  NHN KCP Inc.   All Rights Reserverd.                = */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* =   ȯ�� ���� ���� Include                                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   �� �ʼ�                                                                  = */
    /* =   �׽�Ʈ �� �ǰ��� ������ site_conf_inc.jsp ������ �����Ͻñ� �ٶ��ϴ�.    = */
    /* = -------------------------------------------------------------------------- = */

     include "../cfg/site_conf_inc.php";       // ȯ�漳�� ���� include

?>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   ȯ�� ���� ���� Include END                                               = */
    /* ============================================================================== */
?>
<?
    /* kcp�� ����� kcp �������� ���۵Ǵ� ���� ��û ���� */
    $req_tx          = $_POST[ "req_tx"         ]; // ��û ����         
    $res_cd          = $_POST[ "res_cd"         ]; // ���� �ڵ�         
    $tran_cd         = $_POST[ "tran_cd"        ]; // Ʈ����� �ڵ�     
    $ordr_idxx       = $_POST[ "ordr_idxx"      ]; // ���θ� �ֹ���ȣ   
    $good_name       = $_POST[ "good_name"      ]; // ��ǰ��            
    $good_mny        = $_POST[ "good_mny"       ]; // ���� �ѱݾ�       
    $buyr_name       = $_POST[ "buyr_name"      ]; // �ֹ��ڸ�          
    $buyr_tel1       = $_POST[ "buyr_tel1"      ]; // �ֹ��� ��ȭ��ȣ   
    $buyr_tel2       = $_POST[ "buyr_tel2"      ]; // �ֹ��� �ڵ��� ��ȣ
    $buyr_mail       = $_POST[ "buyr_mail"      ]; // �ֹ��� E-mail �ּ�
    $use_pay_method  = $_POST[ "use_pay_method" ]; // ���� ���         
	$enc_info        = $_POST[ "enc_info"       ]; // ��ȣȭ ����       
    $enc_data        = $_POST[ "enc_data"       ]; // ��ȣȭ ������     
    $cash_yn         = $_POST[ "cash_yn"        ];
    $cash_tr_code    = $_POST[ "cash_tr_code"   ];
    /* ��Ÿ �Ķ���� �߰� �κ� - Start - */
    $param_opt_1    = $_POST[ "param_opt_1"     ]; // ��Ÿ �Ķ���� �߰� �κ�
    $param_opt_2    = $_POST[ "param_opt_2"     ]; // ��Ÿ �Ķ���� �߰� �κ�
    $param_opt_3    = $_POST[ "param_opt_3"     ]; // ��Ÿ �Ķ���� �߰� �κ�
    /* ��Ÿ �Ķ���� �߰� �κ� - End -   */

  $tablet_size     = "1.0"; // ȭ�� ������ ����
  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title>����ü���ս�������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">

<meta name="viewport" content="width=device-width, user-scalable=<?=$tablet_size?>, initial-scale=<?=$tablet_size?>, maximum-scale=<?=$tablet_size?>, minimum-scale=<?=$tablet_size?>">

<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
<link href="css/payment.css" type="text/css" rel="stylesheet" />

<!-- �ŷ���� �ϴ� kcp ������ ����� ���� ��ũ��Ʈ-->
<script type="text/javascript" src="js/approval_key.js"></script>

<script type="text/javascript">
  var controlCss = "css/style_mobile.css";
  var isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };

  if( isMobile.any() )
    document.getElementById("cssLink").setAttribute("href", controlCss);
</script>
<script type="text/javascript">
   /* �ֹ���ȣ ���� ���� */
  function init_orderid()
  {
    var today = new Date();
    var year  = today.getFullYear();
    var month = today.getMonth() + 1;
    var date  = today.getDate();
    var time  = today.getTime();

    if (parseInt(month) < 10)
      month = "0" + month;

    if (parseInt(date) < 10)
      date  = "0" + date;

    var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;
    var ipgm_date  = year + "" + month + "" + date;

    document.order_info.ordr_idxx.value = order_idxx;
    document.order_info.ipgm_date.value = ipgm_date;
  }

   /* kcp web ����â ȣ�� (����Ұ�) */
  function call_pay_form()
  {
    var v_frm = document.order_info; 
    
    v_frm.action = PayUrl;

    if (v_frm.Ret_URL.value == "")
    {
	  /* Ret_URL���� �� �������� URL �Դϴ�. */
	  alert("������ Ret_URL�� �ݵ�� �����ϼž� �˴ϴ�.");
      return false;
    }
    else
    {
      v_frm.submit();
    }
  }

   /* kcp ����� ���� ���� ��ȣȭ ���� üũ �� ���� ��û (����Ұ�) */
  function chk_pay()
  {
    self.name = "tar_opener";
    var pay_form = document.pay_form;

    if (pay_form.res_cd.value == "3001" )
    {
      alert("����ڰ� ����Ͽ����ϴ�.");
      pay_form.res_cd.value = "";
    }
    
    if (pay_form.enc_info.value)
      pay_form.submit();
  }

  function jsf__chk_type()
  {
    if ( document.order_info.ActionResult.value == "card" )
    {
      document.order_info.pay_method.value = "CARD";
    }
    else if ( document.order_info.ActionResult.value == "acnt" )
    {
      document.order_info.pay_method.value = "BANK";
    }
    else if ( document.order_info.ActionResult.value == "vcnt" )
    {
      document.order_info.pay_method.value = "VCNT";
    }
    else if ( document.order_info.ActionResult.value == "mobx" )
    {
      document.order_info.pay_method.value = "MOBX";
    }
    else if ( document.order_info.ActionResult.value == "ocb" )
    {
      document.order_info.pay_method.value = "TPNT";
      document.order_info.van_code.value = "SCSK";
    }
    else if ( document.order_info.ActionResult.value == "tpnt" )
    {
      document.order_info.pay_method.value = "TPNT";
      document.order_info.van_code.value = "SCWB";
    }
    else if ( document.order_info.ActionResult.value == "scbl" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCBL";
    }
    else if ( document.order_info.ActionResult.value == "sccl" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCCL";
    }
    else if ( document.order_info.ActionResult.value == "schm" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCHM";
    }
  }
</script>
</head>

<body onload="jsf__chk_type();init_orderid();chk_pay();">
<div id="sample_wrap">
<form name="order_info" method="post">
  <!-- Ÿ��Ʋ -->
	<div class="title">
	   ����ü ���� �������� ���
	</div>
	<div class="payform_div">
	<table class="payform_wrap" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<table class="payform" width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr>
						<td>
							<table class="payform_inner" width="100%" align="center" >
							  <tr>
								<th>���� ���</th>
								<td>
									<select name="ActionResult" onchange="jsf__chk_type();">
										<option value="" selected>�����Ͻʽÿ�</option>
										<option value="card">�ſ�ī��</option>
										<option value="acnt">������ü</option>
										<option value="vcnt">�������</option>
										<option value="mobx">�޴���</option>
										<option value="ocb">OKĳ����</option>
										<option value="tpnt">��������Ʈ</option>
										<option value="scbl">������ǰ��</option>
										<option value="sccl">��ȭ��ǰ��</option>
										<option value="schm">���ǸӴ�</option>
									</select>
								</td>
							  </tr>
							  <tr>
								<th>�ֹ� ��ȣ</th>
								<td><input type="text" name="ordr_idxx" class="w200" value=""></td>
							  </tr>
							  <tr>
								<th>��ǰ��</th>
								<td><input type="text" name="good_name" class="w100" value="�ڵ���"></td>
							  </tr>
							  <tr>
								<th>���� �ݾ�</th>
								<td><input type="text" name="good_mny" class="w100" value="1004"></td>
							  </tr>
							  <tr>
								<th>�ֹ��ڸ�</th>
								<td><input type="text" name="buyr_name" class="w100" value="ȫ�浿"></td>
							  </tr>
							  <tr>
								<th>E-mail</th>
								<td><input type="text" name="buyr_mail" class="w200" value="test@test.co.kr"></td>
							  </tr>
							  <tr>
								<th>��ȭ��ȣ</th>
								<td><input type="text" name="buyr_tel1" class="w100" value="02-2108-1000"></td>
							  </tr>
							  <tr>
								<th>�޴�����ȣ</th>
								<td><input type="text" name="buyr_tel2" class="w100" value="010-0000-0000"></td>
							  </tr>
							</table>
						</td>
					</tr>				
				</table>
			</td>
		</tr>		
	</table>
	
	<!-- ���� ��û/ó������ �̹��� -->
	<div class="btnset" id="display_pay_button" style="display:block">
		<div class="paybtn">
			<input name="" type="button"  class="pay_start" value="������û" onclick="kcp_AJAX();" />
			<?/*<a href="../" class="back" >ó������</a>	*/?>			
		</div>
	</div>
	<br>
  <div class="footer" style="text-align:center;">
	����ü ���� ��������.
  </div>			  

</div>
						  <!--footer-->
						  <div class="footer">
							Copyright (c) NHN KCP INC. All Rights reserved.
						  </div>
						  <!--//footer-->
						  
						  <!-- �������� -->
						  <input type="hidden" name="req_tx"          value="pay">                           <!-- ��û ���� -->
						  <input type="hidden" name="shop_name"       value="<?= $g_conf_site_name ?>">      <!-- ����Ʈ �̸� --> 
						  <input type="hidden" name="site_cd"         value="<?= $g_conf_site_cd   ?>">      <!-- ����Ʈ �ڵ� -->
						  <input type="hidden" name="currency"        value="410"/>                          <!-- ��ȭ �ڵ� -->
						  <input type="hidden" name="eng_flag"        value="N"/>                            <!-- �� / �� -->
						  <!-- ������� Ű -->
						  <input type="hidden" name="approval_key"    id="approval">
						  <!-- ������ �ʿ��� �Ķ����(����Ұ�)-->
						  <input type="hidden" name="escw_used"       value="N">
						  <input type="hidden" name="pay_method"      value="">
						  <input type="hidden" name="van_code"        value="">
						  <!-- �ſ�ī�� ���� -->
						  <input type="hidden" name="quotaopt"        value="12"/>                           <!-- �ִ� �Һΰ����� -->
						  <!-- ������� ���� -->
						  <input type="hidden" name="ipgm_date"       value=""/>
						  <!-- ���������� �����ϴ� ���� ���̵� ������ �ؾ� �մϴ�.(�ʼ� ����) -->
						  <input type="hidden" name="shop_user_id"    value=""/>
						  <!-- ��������Ʈ ������ �������� �Ҵ�Ǿ��� �ڵ� ���� �Է��ؾ��մϴ�.(�ʼ� ����) -->
						  <input type="hidden" name="pt_memcorp_cd"   value=""/>
						  <!-- ���ݿ����� ���� -->
						  <input type="hidden" name="disp_tax_yn"     value="Y"/>
						  <!-- ���� URL (kcp�� ����� ������ ��û�� �� �ִ� ��ȣȭ �����͸� ���� ���� �������� �ֹ������� URL) -->
						  <input type="hidden" name="Ret_URL"         value="<?=$url?>">
						  <!-- ȭ�� ũ������ -->
						  <input type="hidden" name="tablet_size"     value="<?=$tablet_size?>">

						  <!-- �߰� �Ķ���� ( ���������� ������ �����޽� param_opt �� ����Ͽ� �� ���� ) -->
						  <input type="hidden" name="param_opt_1"     value="">
						  <input type="hidden" name="param_opt_2"     value="">
						  <input type="hidden" name="param_opt_3"     value="">

						<?
							/* ============================================================================== */
							/* =   �ɼ� ����                                                                = */
							/* = -------------------------------------------------------------------------- = */
							/* =   �� �ɼ� - ������ �ʿ��� �߰� �ɼ� ������ �Է� �� �����մϴ�.             = */
							/* = -------------------------------------------------------------------------- = */
							/* ī��� ����Ʈ ����
							��) ��ī��� ����ī�� ��� ������
							<input type="hidden" name='used_card'    value="CCBC:CCLG">

							/*  ������ �ɼ�
									�� �����Һ�    (������ ������ �������� ���� �� ������ ������ ������)                             - "" �� ����
									�� �Ϲ��Һ�    (KCP �̺�Ʈ �̿ܿ� ���� �� ��� ������ ������ �����Ѵ�)                           - "N" �� ����
									�� ������ �Һ� (������ ������ �������� ���� �� ������ �̺�Ʈ �� ���ϴ� ������ ������ �����Ѵ�)   - "Y" �� ����
							<input type="hidden" name="kcp_noint"       value=""/> */

							/*  ������ ����
									�� ���� 1 : �Һδ� �����ݾ��� 50,000 �� �̻��� ��쿡�� ����
									�� ���� 2 : ������ �������� ������ �ɼ��� Y�� ��쿡�� ���� â�� ����
									��) BC 2,3,6����, ���� 3,6����, �Ｚ 6,9���� ������ : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
							<input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */

							/* KCP�� ������ǰ�� �������ǰ�� ���ÿ� �Ǹ��ϴ� ��ü���� ���������� ���� ���Ǽ��� �����ص帮����, 
							   ���հ��� ���� ����Ʈ�ڵ带 ������ �帮�� �� �ݾ׿� ���� ���հ��� ó���� �����ϵ��� �����ϰ� �ֽ��ϴ�
							   ���հ��� ���� ����Ʈ �ڵ�� ����Ͻ� ���������� �ش��� �˴ϴ�
							   ��ǰ���� �ƴ϶� �ݾ����� �����Ͽ� ��û�ϼž� �մϴ�
							   �Ѱ��� �ݾ��� �����ݾ� + �ΰ��� + ������ݾ��� �հ� ���ƾ� �մϴ�. 
							   (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)
							
								<input type="hidden" name="tax_flag"       value="TG03">  <!-- ����Ұ�	   -->
								<input type="hidden" name="comm_tax_mny"   value=""    >  <!-- �����ݾ�	   --> 
								<input type="hidden" name="comm_vat_mny"   value=""    >  <!-- �ΰ���	   -->
								<input type="hidden" name="comm_free_mny"  value=""    >  <!-- ����� �ݾ� --> */
							/* = -------------------------------------------------------------------------- = */
							/* =   �ɼ� ���� END                                                            = */
							/* ============================================================================== */
						?>

	</form>
</div>

<form name="pay_form" method="post" action="pp_cli_hub.php">
    <input type="hidden" name="req_tx"         value="<?=$req_tx?>">               <!-- ��û ����          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">               <!-- ��� �ڵ�          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">              <!-- Ʈ����� �ڵ�      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">            <!-- �ֹ���ȣ           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- �޴��� �����ݾ�    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- ��ǰ��             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">            <!-- �ֹ��ڸ�           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">            <!-- �ֹ��� ��ȭ��ȣ    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">            <!-- �ֹ��� �޴�����ȣ  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">            <!-- �ֹ��� E-mail      -->
	<input type="hidden" name="cash_yn"		   value="<?=$cash_yn?>">              <!-- ���ݿ����� ��Ͽ���-->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">
    <input type="hidden" name="cash_tr_code"   value="<?=$cash_tr_code?>">

    <!-- �߰� �Ķ���� -->
	<input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
	<input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
	<input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>
</body>
</html>