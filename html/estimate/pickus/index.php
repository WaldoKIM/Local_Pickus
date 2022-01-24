<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.php');
?>
<link rel="stylesheet" type="text/css" href="/css/jquery.bxslider.css"/>
<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<link href="/share/css/aos.css" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="/share/js/aos.js"></script>
<div class="main">
    <div id="wrap">
        <div class="header">
            <div class="container">
                <!--===================== 버전 1 =====================================-->
<!-- 
                <img src="/img/main/main_slide_01.png">
                <div class="mob_title">
                    <p>중고가전/가구 매입, 피커스가 가장 잘하는 일</p>
                    <p>철거와 원상복구는 물론<br>
                        깔끔한 정리까지, <span>피커스</span>
                    </p>
                    <img src="/img/main/mob_main_slide_01v2.png">
                    <div class="mob_left"></div>
                    <div class="mob_center">
                        <a onclick="mob_aco_btn()">견적 신청</a>
                        <a href="/estimate/estimate_register1B.php" class="mob_sel01">중고가전/가구 매입</a>
                        <a href="/estimate/estimate_register2D.php" class="mob_sel02">대량 매입</a>
                        <a href="/estimate/estimate_register3B.php" class="mob_sel03">철거/원상복구</a>
                        <a href="/estimate/estimate_register4.php" class="mob_sel04">매입+철거(기업전용)</a>
                        <div class="mob_hidden"></div>
                    </div>
                    <div class="mob_right"></div>
                   
                </div>
                <div class="title">
                    <div class="text">
                        <h2>중고가전/가구매입, 피커스가 가장 잘하는 일<br><br></h2>
                        <h2>철거와 원상복구는 물론<br>깔끔한 정리까지,<span>피커스</span></h2>
                    </div>
                    <div class="menu">
                        <div class="aco"></div>
                        <div class="menu_selecter" onclick="menu_btn()">
                            <a>▼</a>
                            <div class="sel_01"><a href="/estimate/estimate_register1B.php">중고가전/가구 매입</a></div>
                            <div class="sel_02"><a href="/estimate/estimate_register2D.php">대량 매입</a></div>
                            <div class="sel_03"><a href="/estimate/estimate_register3B.php">철거/원상복구</a></div>
                            <div class="sel_04"><a href="/estimate/estimate_register4.php">매입+철거(기업전용)</a></div>
                        </div>
                    </div>
                </div> -->
                <!--===================== 버전 1 끝 =====================================-->

                <section class="main3__table">
                <div class="main3_title">
                    <div class="main3_title-top">
                    1213건의 거래, 81%의 만족도
                    </div>
                    <div class="main3_title-bottom">
                    우리동네 재활용센터, 피커스
                    </div> 
                </div>

                <div class="main3_btn">
                    <a href="/estimate/estimate_register.php">
                    <div class="main3_btn-item">
                    견적신청 바로가기
                    </div>
                    </a>
                    <a href="/estimate/estimate_register.php">
                    <div class="main3_btn-item">
                    우수업체 추천받기
                    </div>
                    </a>
                </div>

                <div class="main3_service">
                <a href="/estimate/estimate_register1B.php">
                <div class="main3_service-item">
                <img class="main3_service-src"src="../../../img/main/title_slide_img01.png">
                중고매입
                </div>
                </a>
                <a href="/estimate/estimate_register2D.php">
                <div class="main3_service-item">
                <img class="main3_service-src"src="../../../img/main/title_slide_img02.png">
                대량매입
                </div>
                </a>
                <a href="/estimate/estimate_register3B.php">
                <div class="main3_service-item">
                <img class="main3_service-src"src="../../../img/main/title_slide_img03.png">
                철거/원상복구
                </div>
                </a>
                <a href="/estimate/estimate_register4.php">
                <div class="main3_service-item">
                <img class="main3_service-src"src="../../../img/main/title_slide_img04.png">
                기업전용
                </div>
                </a>
                </div>
                </section>
                <!--버전 3-->
            </div>
        </div>
    </div>

    <!--메인 버전 3-아이템-->    

    <div class="container reason-back">
        <article class="main3__reason">
            <div class="reason_main">
            <div class="reason-title">
            피커스에 견적문의를 해야하는 이유!
            </div>
            <div class="reason-link">
                <p>지금 피커스에서 견적문의하세요</p>
                <a href="/estimate/estimate_register.php">
                <div class="reason-link-btn">
                견적문의하러가기
                </div>
</a>
            </div>
</div>
<div class="reason__list">
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_01.png" alt="" style="width:100px; height: 100px;">
		<p>지역전문 재활용센터를 통한 중고 거래</p>
    </div>
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_02.png" alt="" style="width:100px; height: 100px;">
		<p>이사,폐업시 대량물품도 한번에 처리가능</p>
    </div>
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_03.png" alt="" style="width:100px; height: 100px;">
		<p>중고매입부터 폐기 철거까지 원스톱 지원</p>
	</div>
</div>

<div class="reason__list">
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_04.png" alt="" style="width:100px; height: 100px;">
		<p>사진을 통한 쉬운 간편견적 등록 및 확인</p>
    </div>
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_05.png" alt="" style="width:100px; height: 100px;">
		<p>온라인으로 간편하게 쉬운 견적 비교가능</p>
    </div>
    <div class="reason__list-item">
	    <img src="../../../img/main/reason_06.png" alt="" style="width:100px; height: 100px;">
		<p>대형 대량물품도 전문가를 통한 빠른처리</p>
	</div>
</div>


</article>
    </div>

    <!--메인 버전 3-아이템-->




    <div class="container">
        <!--=============================pc버전==================================-->
        <div class="box_01">
            <p>피커스 견적신청 서비스</p>
            <div class="box_01_sec01">
                <a href="/estimate/estimate_register1B.php">
                    <img src="/img/main/box01_slide_img01.png">
                    <img src="/img/main/box01_slide_img01.png">
                </a>
                <a href="/estimate/estimate_register2D.php">
                    <img src="/img/main/box01_slide_img02.png">
                    <img src="/img/main/box01_slide_img02.png">
                </a>
            </div>
            <div class="box_01_sec02">
                <a href="/estimate/estimate_register3B.php">
                    <img src="/img/main/box01_slide_img03.png">
                    <img src="/img/main/box01_slide_img03.png">
                </a>
                <a href="/estimate/estimate_register4.php">
                    <img src="/img/main/box01_slide_img04.png">
                    <img src="/img/main/box01_slide_img04.png">
                </a>
            </div>
            <ul>
                <li><p>●</p></li>
                <li><p>○</p></li>
            </ul>
            <p class="box_01_toggle" onclick="box_01_btn()">더보기</p>
        </div>
        <!--=============================pc 버전 끝==================================-->
        <!--=============================모바일 버전  ==================================-->
        <div class="mob_box_01">
            <ul>
                <li>
                    <a href="/estimate/estimate_register.php">
                        <img src="/img/main/box01_slide_img01.png">
                    </a>
                </li>
                <li>
                    <a href="/estimate/estimate_register.php">
                        <img src="/img/main/box01_slide_img02.png">
                    </a>
                </li>
                <li>
                    <a href="/estimate/estimate_register.php">
                        <img src="/img/main/box01_slide_img03.png">
                    </a>
                </li>
                <li>
                    <a href="/estimate/estimate_register.php">
                        <img src="/img/main/box01_slide_img04.png">
                    </a>
                </li>

            </ul>
            <p>● ○ ○ ○</p>
            <img src="/img/main/box01_slide_left.png" onclick="mob_box_01_left_btn()">
            <img src="/img/main/box01_slide_right.png" onclick="mob_box_01_right_btn()">
        </div>
        <!--=============================모바일 버전 끝  ==================================-->
    </div>


    <div class="box_02">
        <div class="container">
            <table class="col-sm-10 col-md-offset-1">
                <tr>
                    <td>
                        <h1 id="box02_test">찍고, 올리고, 확인! <br/>언제든지 재활용센터 <br/>비교견적을 한번에 OK! </h1></td>
                    <td>
                        <img src="/img/main/main_section01_img.png">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="box_03">
        <div class="container">
            <div class="box_03_01">
                <h2>전문가들이 소개해주는 재활용 TIP</h2>
                <!--<a href="<?php echo G5_BBS_URL;?>/forum.php">포럼 바로가기</a>-->
                <a href="https://blog.naver.com/pickus" target="_blank">포럼 바로가기</a>
            </div>
            <div class="box_03_02">
                <h2>전문가가 케어한 안전한 중고마켓</h2>
                <a href="#!">중고마켓보기</a>
            </div>
        </div>
    </div>

    <div class="box_04">
        <div class="container">
            <div class="box_04_left">
                <img src="../img/main/main_section02_img.png">
            </div>
            <div class="box_04_right">
                <h1>Pickus '피커스'<br/>스마트한 우리동네 재활용센터</h1>
                <ul class="row">
                    <li class="col-md-4 col-xs-6"><a href="#"><img src="/img/main/main_app01_img.png"></a></li>
                    <li class="col-md-4 col-xs-6"><a href="https://play.google.com/store/apps/details?id=com.dehuv.pickus" target="_blank"><img src="../img/main/main_app02_img.png"></a></li>
                </ul>
                <div class="box_04_app">
                        <input type="text" placeholder="휴대폰번호를 입력해주세요.">
                        <input type="button" value="→" onclick="box_04_app_btn()">
                        <p>보내기</p>
                </div>
            </div>
        </div>
    </div>

    <div class="box_05 text-center">
        <div class="container">
            <h1>이젠 돌아다니지 말고, <strong>쉽게 고객을 만나 보세요.</strong></h1>
            <a href="/bbs/partner_service.php">파트너문의</a>
        </div>
    </div>
</div><!-- main -->
<script type="text/javascript" src="/js/jquery.bxslider.js"></script>
<script type="text/javascript">
    $(function(){
        $(".mob_back").hide();
        $('.bxslider').bxSlider({
            auto: true,
            mode: 'horizontal',
            touchEnabled: true,
            preventDefaultSwipeX:false
        });

        $('.bxslider_mob').bxSlider({
            auto: true,
            mode: 'horizontal',
            controls: false,
            touchEnabled: true,
            preventDefaultSwipeX:false
        });

        AOS.init({
            easing: 'ease-in-out-sine'
        });
    });

var vPageCount = 3;
var scrollposition;
var sw = 1;
var menu_toggle = 1;
var scroll_toggle = 1;
var mob_menu_toggle = 1;



var box_01_btn_toggle = 1;
function box_01_btn()
{
    if( box_01_btn_toggle == 1 )
    {
        $(".box_01 .box_01_sec01").css("margin-left","-100%");
        $(".box_01 .box_01_sec01").css("transition","1s");
        $(".box_01 ul li:nth-child(1)").text("○");
        $(".box_01 ul li:nth-child(2)").text("●");
        box_01_btn_toggle = 0;
    }
    else
    {
        $(".box_01 .box_01_sec01").css("margin-left","0");
        $(".box_01 .box_01_sec01").css("transition","1s");
        $(".box_01 ul li:nth-child(1)").text("●");
        $(".box_01 ul li:nth-child(2)").text("○");
        box_01_btn_toggle = 1;
    }
}
box_01_img_slide = setInterval(function()
{
    if( box_01_btn_toggle == 1 )
    {
        $(".box_01 .box_01_sec01").css("margin-left","-100%");
        $(".box_01 .box_01_sec01").css("transition","1s");
        $(".box_01 ul li:nth-child(1)").text("○");
        $(".box_01 ul li:nth-child(2)").text("●");
        box_01_btn_toggle = 0;
    }
    else
    {
        $(".box_01 .box_01_sec01").css("margin-left","0");
        $(".box_01 .box_01_sec01").css("transition","1s");
        $(".box_01 ul li:nth-child(1)").text("●");
        $(".box_01 ul li:nth-child(2)").text("○");
        box_01_btn_toggle = 1;
    }
},4500);

var mob_box_01_btn_toggle = 1;
function mob_box_01_left_btn()
{
    if(mob_box_01_btn_toggle == 1)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-300%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ○ ●");

        mob_box_01_btn_toggle = 4;
    }
    else if(mob_box_01_btn_toggle == 2)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","0");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("● ○ ○ ○");

        mob_box_01_btn_toggle = 1;
    }
    else if(mob_box_01_btn_toggle == 3)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-100%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ● ○ ○");

        mob_box_01_btn_toggle = 2;
    }
    else if(mob_box_01_btn_toggle == 4)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-200%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ● ○");

        mob_box_01_btn_toggle = 3;
    }
}
function mob_box_01_right_btn()
{
    if(mob_box_01_btn_toggle == 1)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-100%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ● ○ ○");

        mob_box_01_btn_toggle = 2;
    }
    else if(mob_box_01_btn_toggle == 2)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-200%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ● ○");

        mob_box_01_btn_toggle = 3;
    }
    else if(mob_box_01_btn_toggle == 3)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-300%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ○ ●");

        mob_box_01_btn_toggle = 4;
    }
    else if(mob_box_01_btn_toggle == 4)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","0");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("● ○ ○ ○");

        mob_box_01_btn_toggle = 1;
    }
}

mob_box_01_img_slide = setInterval(function()
{
    if(mob_box_01_btn_toggle == 1)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-100%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ● ○ ○");
        mob_box_01_btn_toggle = 2;
    }
    else if(mob_box_01_btn_toggle == 2)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-200%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ● ○");
        mob_box_01_btn_toggle = 3;
    }
    else if(mob_box_01_btn_toggle == 3)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","-300%");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("○ ○ ○ ●");
        mob_box_01_btn_toggle = 4;
    }
    else if(mob_box_01_btn_toggle == 4)
    {
        $(".mob_box_01 > ul > li:first-child").css("margin-left","0");
        $(".mob_box_01 > ul > li:first-child").css("transition","1s");
        $(".mob_box_01 > p:nth-child(2)").text("● ○ ○ ○");
        mob_box_01_btn_toggle = 1;
    }
},4500);






function box_04_app_btn()
{
    window.open("https://play.google.com/store/apps/details?id=com.dehuv.pickus","test","width=400,height=300,left=100,top=50");
}


box_02_btn = setInterval(function()
{
    if( $(document).scrollTop() <= 1000 && $(document).scrollTop() >= 600 && scroll_toggle )
    {
        $("#box02_test").css("opacity","1");
        $("#box02_test").css("transition","1s");
        $("#box02_test").css("font-size","190%");
        scroll_toggle = 0;
    }

},0);


function mob_aco_btn()
{
    if( mob_menu_toggle == 1 )
    {
        $(".mob_hidden").css("height","0");
        $(".mob_hidden").css("transition","1s");
        $(".mob_center > a:first-child").css("border-radius","5px 5px 0 0");
        $(".mob_center > a:first-child").css("transition","1s");
        mob_menu_toggle = 0;
    }
    else
    {
        $(".mob_hidden").css("height","20%");
        $(".mob_center > a:first-child").css("border-radius","5px 5px 5px 5px");
        $(".mob_center > a:first-child").css("transition","1s 1s");

        mob_menu_toggle = 1;
    }
}
function menu_btn()
{
    if(menu_toggle == 1)
    {
        $(".aco").css("top","60%");
        $(".aco").css("transition","1s");
        $(".menu_selecter").css("border-radius","5px 5px 0px 0px");
        menu_toggle = 0;
        /*
        $(".sel_01").css("top","100%");
        $(".sel_01").css("transition","1s");

        $(".sel_02").css("top","200%");
        $(".sel_02").css("transition","1s");

        $(".sel_03").css("top","300%");
        $(".sel_03").css("transition","1s");


        $(".menu_selecter").css("transition","1s");

        */
    }
    else
    {
        $(".aco").css("top","12%");
        $(".aco").css("transition","1s");
        $(".menu_selecter").css("border-radius","5px 5px 5px 5px");
        $(".menu_selecter").css("transition","1s");
        menu_toggle = 1;
        /*
        $(".sel_01").css("top","-300%");
        $(".sel_01").css("transition","1s");

        $(".sel_02").css("top","-200%");
        $(".sel_02").css("transition","1s");

        $(".sel_03").css("top","-100%");
        $(".sel_03").css("transition","1s");

        $(".menu_selecter").css("border-radius","5px 5px 5px 5px");
        $(".menu_selecter").css("transition","1.5s");


        */

    }
}
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
