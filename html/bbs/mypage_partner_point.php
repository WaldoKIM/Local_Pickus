<?php
include_once('./_common.php');
/*
if (!$is_member || $member['mb_level'] != "2")
	alert("회원만 가능합니다.", G5_URL);*/

include_once('./_head.php');

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';

$sql = " select 
			date_format(po_datetime,'%Y-%m-%d') as po_datetime,
			case when po_point > 0 then po_content else '사용'  end as po_content,
			case when po_point > 0 then po_point else null end as po_add_point,
			case when po_point < 0 then abs(po_point) else null end as po_use_point,
			'' as po_etc
		from 
			g5_point 
		where 
			mb_id = '{$member['mb_id']}' 
		order by po_id desc ";

$result = sql_query($sql);

?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="sub_title login">
	<h5>충전내역</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div><!-- sub_title -->
<input type="hidden" id="userPoint" value="<c:out value="${userInfo.point}"/>
<div class="member com_pd">
	<div class="container">

		<div>
			<ul class="tab">
				<li class="col-xs-6">
					<a href="./mypage_partner.php">마이페이지</a>
				</li>
				<li class="col-xs-6 on">
					<a href="#.">충전내역</a>
				</li>
			</ul>
		</div>

		<div class="btn_wrap">
			<ul class="row">
				<li class="col-xs-3 text-left" id="liUserPoint"></li>
			<!--
				<li class="col-xs-3 col-xs-offset-6"><a class="main_bg" href="#none" onClick="doPoint();">충전하기</a></li>
			-->
			</ul>
		</div>
		
		<div id="board">

			<div class="list">
				<table>
					<thead>
						<tr>
							<th>날짜</th>
							<th>충전</th>
							<th>사용</th>
							<th>비고</th>
						</tr>
					</thead>
					<tbody id="tableList">
					<?php
    				for ($i=0; $row=sql_fetch_array($result); $i++) {
    					echo '<tr>';
    					echo '<td class="web_td">'.$row['po_datetime'].'</td>';
    					echo '<td class="web_td">'.$row['po_add_point'].'</td>';
    					echo '<td class="web_td">'.$row['po_use_point'].'</td>';
    					echo '<td class="web_td">'.$row['po_etc'].'</td>';
    					echo '</tr>';
    				}
    				?>								
					</tbody>
				</table>
			</div>

			<div id="page">

			</div><!-- page -->
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<div class="modal fade" id="modal_point" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">충전하기</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form_wrap">

						<div class="form-group">
							<ul class="row">
								<li class="title col-md-2">입금자명</li>
								<li class="col-md-10"><input type="text" class="input_default" id="bankSender"></li>
							</ul>
						</div><!-- 입금자명 -->

						<div class="form-group">
							<ul class="row">
								<li class="title col-md-2">입금은행</li>
								<li class="col-md-5 col-xs-6">
									<select class="input_default" id="bankName"></select>
								</li>
								<li class="col-md-5 col-xs-6"><input type="text" class="input_default" id="bankAccount" readonly></li>
							</ul>
						</div><!-- 입금은행 -->

						<div class="form-group">
							<ul class="row">
								<li class="title col-md-2">충전금액</li>
								<li class="col-md-10"><input type="text" class="input_default" id="bankPrice"></li>
							</ul>
						</div><!-- 입금은행 -->

						<div class="btn_wrap">
							<ul class="row">
								<li class="col-xs-3 col-xs-offset-3"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
								<li class="col-xs-3"><input class="main_bg" type="submit" value="확인" onClick="doSavePoint();""></li>
							</ul>
						</div>

						

					</div><!-- form_wrap -->
				</form>
			</div>
		</div>
	</div>
</div><!-- 충전 -->
<script type="text/javascript">

</script>
<?php
include_once('./_tail.php');
?>