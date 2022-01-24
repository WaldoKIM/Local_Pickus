<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');
?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<link rel="stylesheet" type="text/css" href="/css/estimate.css"/>
<div class="member com_pd">
	<div class="container">
		
		<div class="request">
			<div class="form_wrap">
				
				<form>
					<div class="form-group">
						<ul class="row">
							<li class="col-md-2 title">
								비밀번호
							</li>
							<li class="col-md-8">
								<input type="text" id="password" name="password">
							</li>
							<li class="col-md-2 title">
								<input class="main_bg" type="button" value="찾기"  onClick="doPassword();">
							</li>
						</ul>
					</div>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-md-12">
								<input type="text" id="password_new" name="password_new" readonly>
							</li>
						</ul>
					</div>

				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<script type="text/javascript">

function doPassword()
{
    $("#password_new").val(hex_md5($("#password").val()));
}

</script>
<?php

include_once('./_tail.php');
?>