<?php
header('Location: https://repickus.com/bbs/pick.php');
include_once('./_common.php');


$g5['title'] = '파트너 문의';
include_once('./_head.php');
?>
<link rel="stylesheet" type="text/css" href="/css/info.css"/>
<div class="sub_title partner_bg">
	<h5>파트너 문의</h5>
	<h1>피커스와 함께 해요!</h1>
</div><!-- sub_title -->

<div class="partner">
	
	<div class="box01">
		<div class="container">
			<h1><i class="main_co">피커스</i>와 합께 쉽게 고객을 만나세요!</h1>
			<p>
				지역을 돌아다니지 않으셔도 빠르게 원하는 고객을 만날 수 있습니다. <br class="web" />
				기업의 홍보비가 없어도 고객후기에 따라 업체 홍보가 가능합니다.
			</p>
			
			<table>
				<tr>
					<th><div><img src="/img/info/partner_img01.jpg"></div></th>
					<td>
						<h3 class="main_co">피커스 소개</h3>
						<h2>무료 견적 및 입찰</h2>
						<p>무료로 입찰 참여가 가능합니다.<br />견적 후 완료된 건에 대해서만 수수료 지급</p>
						<dl>
							<dt class="main_co">가전/가구 매입</dt>
							<dd>가정집, 사업장 등 물품수거</dd>
							<dt class="main_co">대량 매입</dt>
							<dd>가정집 붙박이장, 욕조 등 철거</dd>
							<dt class="main_co">철거/원상복구</dt>
							<dd>사업장, 식당, 학원 등 원상복구</dd>
						</dl>
					</td>
				</tr>
			</table>
		</div><!-- container -->
	</div><!-- box01 -->

	<div class="box02 main_bg">
		<div class="container">
			<h1>견적 입찰 프로세스</h1>
			<ul>
				<li>
					<img src="/img/info/partner_icon01.png">
					<p>견적참여</p>
				</li>
				<li>
					<img src="/img/info/partner_arr.png">
				</li>
				<li>
					<img src="/img/info/partner_icon02.png">
					<p>고객업체선정</p>
				</li>
				<li>
					<img src="/img/info/partner_arr.png">
				</li>
				<li>
					<img src="/img/info/partner_icon03.png">
					<p>상담 및 일정 진행</p>
				</li>
				<li>
					<img src="/img/info/partner_arr.png">
				</li>
				<li>
					<img src="/img/info/partner_icon04.png">
					<p>견적처리진행</p>
				</li>
			</ul>
		</div><!-- container -->
	</div><!-- box02 -->

	<div class="box03">
		<div class="container">
			<table>
				<tr>
					<td>
						<h1>사장님 <i class="main_co">'피커스'</i>와 함께, <br class="web" />편리한 사업 진행하세요!</h1>
						<ul>
							<li class="col-xs-6">
								<a class="join_btn" href="/bbs/register_partner_form.php">회원가입하러가기</a>
							</li>
							<li class="col-xs-6">
								<a class="faq_btn" href="/bbs/faq.php">FAQ</a>
							</li>
						</ul>
					</td>
					<th><img src="/img/info/partner_img02.jpg"></th>
				</tr>
			</table>
		</div><!-- container -->
	</div><!-- box02 -->

</div><!-- info -->
<?php
include_once('./_tail.php');
?>
