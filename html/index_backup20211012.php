<?php
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH . '/head.php');
/*if(!isset($_SERVER["HTTPS"])) {
    header('Location: https://www.repickus.com?token='.$token);
}*/

?>

<?php
include_once(G5_LIB_PATH . '/latest.lib.php');

$sql = "select * from g5_estimate_list WHERE title != '' ORDER BY writetime DESC LIMIT 20";
$fec_union = sql_query($sql);
$sql = 'select sum(price) as total from g5_estimate_propose';
$fec = sql_fetch($sql);

$sql_match = "select * from g5_estimate_match WHERE title != '' ORDER BY apply_date DESC LIMIT 20";
$fec_union_match = sql_query($sql_match);
?>
<?php include G5_BBS_PATH . '/newwin.inc.php'; // 팝업레이어
?>

<body>
  <script>
    $(window).load(function() {
      $('#load').hide();
    });
  </script>

  <div id="load">
    <p class="loading_font">로딩중...</p>
  </div>

  <style type="text/css">
    @media(max-width:768px) {
      .loading_font {
        font-size: 24px;
        font-weight: 800;
        color: #1379cd;
        margin: auto;
        margin-top: 70%;
        opacity: 1 !important;
      }

      #load {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        display: block;
        opacity: 0.8;
        background: white;
        z-index: 99999999;
        text-align: center;
      }
    }

    @media(min-width:768px) {
      .loading_font {
        font-size: 24px;
        font-weight: 800;
        color: #1379cd;
        margin: auto;
        margin-top: 20%;
        opacity: 1 !important;
      }

      #load {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        display: block;
        opacity: 0.8;
        background: white;
        z-index: 99999999;
        text-align: center;
      }
    }

    #fixed_kakao {
      display: block !important;
    }

    .m_review {
      max-height: 340px;
    }

    .pic_lt {
      padding-top: 0;
      margin-bottom: 0;
      border: 0;
      background-color: transparent;
      width: 100%;
    }

    .pic_lt ul {
      padding: 0
    }

    .ui-tabs .ui-tabs-nav li {
      white-space: normal;
    }

    .pic_lt .lt_more,
    .pic_lt .lat_title,
    .pic_lt li .new_icon,
    .pic_lt li p {
      display: none;
    }

    .pic_lt li {
      width: 48%;
      padding: 0;
    }

    .m_css {
      display: none;
    }

    .container>.cont_01>.contico>ul>li>a {
      font-size: 21px !important;
      white-space: nowrap;
    }

    .mob_back {
      display: none !important;
    }

    .lt_date {
      display: none !important;
    }

    .pic_lt li a {
      font-size: 20px;
      font-weight: bold;
      margin: 10px 0;
      text-align: center;
      width: 100%;
      line-height: 20px;
    }

    .pic_lt .lt_date {
      width: 100%;
      text-align: center;
      margin-top: 0;
    }

    .pic_lt li .lt_img img {
      border-radius: 8px;
      max-width: 100%;
      max-height: 100%;
    }

    em {
      color: #fff;
    }

    .first03 {
      background-color: #333
    }

    #quick li a {
      color: #fff !important
    }

    .footer .copyright {
      margin-top: 55px !important;
    }

    .carousel-indicators li {
      width: 30px !important;
      height: 3px !important;
      border: 0;
      margin-right: 3px;
      margin-left: 3px;
    }

    .carousel-indicators .active {
      margin-right: 3px !important;
      margin-left: 3px !important;
      margin: 1px;
    }

    .carousel-indicators {
      width: 100%;
    }

    .container>.cont_02>.cont>.pick>h2 {
      margin-bottom: 10px !important;
    }

    .ui-widget.ui-widget-content,
    .ui-widget-header,
    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default,
    .ui-button,
    html .ui-button.ui-state-disabled:hover,
    html .ui-button.ui-state-disabled:active,
    .ui-widget-content {
      border: 0;
    }

    .ui-state-default,
    .ui-widget-content .ui-state-default,
    .ui-widget-header .ui-state-default,
    .ui-button,
    html .ui-button.ui-state-disabled:hover,
    html .ui-button.ui-state-disabled:active,
    .ui-widget-header {
      background-color: transparent;
    }

    .container>.cont_03>.how>.how_slider>.service>.serv_box>.swiper-slide .serv_con>ul>li>a>em {
      color: #a9a9a9;
    }

    .ui-tabs .ui-tabs-nav .ui-tabs-anchor {
      padding: 0;
    }

    .container>.cont_01>.est>.Brea .list>ul li {
      margin: 0 5px !important;
    }

    #free_estimate {
      width: 200px;
      height: 40px;
      color: #fff !important;
      margin-top: 15px;
      background-color: #fe8e3a !important;
      float: right;
      border: 1px solid #ededed;
      font-size: 21px;
      padding: 12px 0;
    }

    .pic_lt li:first-of-type {
      margin-right: 15px;
    }

    @media(max-width: 1000px) {
      .pic_lt li {
        width: 47%;
      }
    }


    @media(max-width: 768px) {
      .pic_lt li a {
        font-size: 16px;
        margin-bottom: 15px;
      }

      .hd_pops_con {
        width: 100% !important;
      }

      .conbox_txt p {
        color: #666;
      }

      .conbox_txt em {
        color: #666;
      }

      .container>.cont_03>.how>.how_slider>.service>.serv_box>.swiper-slide .serv_con>.conbox {
        margin-bottom: 0 !important;
        overflow: hidden;
      }

      .container>.cont_03>.how>.how_slider>.service>.serv_box>.swiper-slide .serv_con>.conbox_09 {
        padding-bottom: 0 !important
      }

      .container>.cont_03>.how>.how_slider>.service>.serv_box>.swiper-slide .serv_con>.conbox>p {
        font-size: 18px !important;
      }

      .m_css {
        display: block;
      }

      .container>.cont_01>.contico>ul>li>a {
        font-size: 16px !important;
      }

      .container>.cont_03>.how>.how_slider>.service {
        padding-bottom: 80px;
      }

      #free_estimate {
        width: 150px;
        height: 35px;
        color: #fff !important;
        margin-top: 15px;
        background-color: #fe8e3a !important;
        border: 1px solid #ededed;
        font-size: 17px;
        padding: 9px 0;
        float: none !important;
      }

      #txt_last {
        width: 80% !important;
      }

      .swiper-req {
        width: 60%;
        float: right;
      }

      .container>.cont_01>.est>.Brea .list>ul {
        margin-bottom: 0 !important;
        margin-top: 0 !important
      }

      .swiper-slide {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
      }

      .pic_lt li:first-of-type {
        margin-right: 0;
      }

      .pic_lt li:last-of-type {
        margin-left: 5% !important;
      }
    }

    @media(max-width:400px) {
      .pic_lt li:first-of-type {
        margin-right: 0;
      }

      .container>.cont_01>.contico>ul>li>a {
        font-size: 14px !important;
      }
    }
  </style>

  <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
  <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./bbs/css/main.css?after">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/jQuery/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="/js/jquery.animateNumber.js"></script>

  <!-- <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->

  <style type="text/css">
    .reviw {
      width: 100% !important;
    }

    .swiper-button-prev_review,
    .swiper-button-next_review {
      z-index: 999;

    }

    @media(max-width:768px) {}
  </style>

  <div id="Wrap">
    <div id="contents" class="container">
      <div style="display:none;" id="randomCarousel" class="carousel slide" data-ride="carousel">
        <!--Indicator Buttons-->
        <ol class="carousel-indicators">
          <li data-target="#randomCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#randomCarousel" data-slide-to="1"></li>
          <li data-target="#randomCarousel" data-slide-to="2"></li>
        </ol>
        <!--Carousel w/Images-->
        <div class="container">
          <div class="carousel-inner">
            <!--ALL PICS ARE PART OF CREATIVE COMMONS; ADDED SIMPLY FOR FUN-->
            <div class="carousel-item active">
              <img src="" class="d-block w-100" alt="First">
            </div>
            <div class="carousel-item">
              <img src="" class="d-block w-100" alt="Second">
            </div>
            <div class="carousel-item">
              <img src="" class="d-block w-100" alt="Third">
            </div>
          </div>
        </div>
        <!--Next and Previous buttons-->
        <a class="carousel-control-prev" href="#randomCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#randomCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <?php if ($member['mb_level'] == 2) {
        include_once('./main_seller.php');
      }?>

    <?php if($member['mb_level'] != 2) { ?>
      <div id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- 슬라이드 쇼 -->
          <div class="carousel-item active">
            <!-- <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div> -->
            <!--가로-->
            <picture>
              <source media="(max-width: 321px)" srcset="/bbs/images/i5.png">
              <source media="(max-width: 376px)" srcset="/bbs/images/i678.png">
              <source media="(max-width: 415px)" srcset="/bbs/images/iplus.png">
              <img style="width:100% !important" src="/bbs/images/web1.png" class="d-block w-100">
            </picture>

          </div>
          <div class="carousel-item ">
            <picture>
              <source media="(max-width: 321px)" srcset="/bbs/images/i52.png">
              <source media="(max-width: 376px)" srcset="/bbs/images/i6782.png">
              <source media="(max-width: 415px)" srcset="/bbs/images/iplus2.png">
              <img style="width:100% !important" src="/bbs/images/web2.png" class="d-block w-100">
            </picture>

          </div>
          <div class="carousel-item ">
            <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div>
            <!--가로--> <img style="width:100% !important" class="d-block w-100" src="/bbs/images/main_banner.png" alt="비쥬얼이미지1">

          </div>

          <!-- / 슬라이드 쇼 끝 -->
          <!-- 왼쪽 오른쪽 화살표 버튼 -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <!-- <span>Previous</span> -->
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <!-- <span>Next</span> -->
          </a> <!-- / 화살표 버튼 끝 -->
          <!-- 인디케이터 -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <!--0번부터시작-->
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul> <!-- 인디케이터 끝 -->
        </div>
      </div>
      
      <section class="cont_01">
        
        <div class="est">
          <div class="estim">
            <div>
              <span class="ico01">icon</span>
              <h4 class="tit">총 견적가</h4>
              <span class="won">
                <span id="won_total" style="font-size: 20px;"><?php echo number_format(round($fec['total'], -3)); ?></span><span style="font-size: 20px;">원</span>
              </span>
            </div>
          </div>
          <div class="Brea">
            <div>
              <span class="ico02">icon</span>
              <h4 class="tit">실시간 신청내역</h4>
              <div class="swiper-req" style="height: 82px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union); $i++) {
                    $type = '';
                    if ($row['e_type'] == '0') {
                      $type = '<li class="first01">매입</li>';
                    } else if ($row['e_type'] == '1') {
                      $type = '<li class="first02">다량</li>';
                    } else if ($row['e_type'] == '2') {
                      $type = '<li class="first03">철거</li>';
                    }
                    echo "<ul class='swiper-slide' style='min-width:300px'>";
                    echo $type;
                    echo "<li>" . mb_substr($row['area1'], 0, 2) . "</li>";
                    echo "<li>" . mb_substr($row['title'], 0, 6) . "</li>";
                    echo "</ul>";
                  } ?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="contico">
          <ul>
            <?php if ($member['mb_level'] != 2) {?>
            <li class="sell_01"><a href="/estimate/estimate_register1B.php">가전가구 판매</a></li>
            <li class="sell_02"><a href="/estimate/estimate_register2D.php">대량판매</a></li>
            <li class="sell_03"><a href="/estimate/estimate_register3B.php">철거/원상복구</a></li>
            <li class="sell_04"><a href="/estimate/estimate_register4.php">기업전용(매입+철거)</a></li>
            <?php } ?>
          </ul>
        </div>
        <?php if($member['mb_level'] != 2) { ?>
        <div class="matc" style="cursor: pointer;" onclick="window.loacation.href='/bbs/guide.php'">
          <span class="ico">icon</span>
          <div class="mat" onclick="window.location.href='/bbs/guide.php'">
            <h4>안심구매매칭</h4>
            <p>예상금액에 맞는 적합한 상품을 추천해 드립니다.</p>
            <a href="/bbs/guide.php" class="more">바로가기</a>
          </div>
        </div>
        <?php } ?>
      </section>
      <?php if($member['mb_level'] != 2) { ?>
      <section class="cont_02">
        <div class="cont">
          <div class="pick">
            <h2>PICKUS PICK!</h2>
            <ul>
              <?php echo latest("pic_basic", "gallery", 2, 25, '', "메인 노출"); ?>
              <!-- <li>
                <a href="">
                  <img src="images/pick_img01.png">
                  <h5>피커스 재활용센터</h5>
                  <p>피커스 재활용센터 피커스 재활용센터</p>
                </a>
              </li>
              <li>
                <a href="">
                  <img src="images/pick_img02.png">
                  <h5>피커스 재활용센터</h5>
                  <p>피커스 재활용센터 피커스 재활용센터</p>
                </a>
              </li> -->
            </ul>
          </div>
          <div class="video">
            <iframe style="overflow: hidden;" width="100%" height="338" src="https://www.youtube.com/embed/GGmkLnbOlcg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </section>
      <section class="cont_03">
        <div class="how">
          <h2>피커스 사용법</h2>
          <p>피커스만의 편리하고 안전한 프로세스를 경험해보세요.</p>
          <div class="how_slider">
            <div class="service swiper-container swiper1">
              <div class="btn">
                <a href="" class="prev swiper-button-prev">이전</a>
                <a href="" class="next swiper-button-next">다음</a>
              </div>
              <div class="serv_box swiper-wrapper">
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      <span>STEP 1</span>
                      <h3>서비스 선택</h3>
                    </div>
                    <div class="serv_con tab" id="tabs1">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">중고판매</a></li>
                        <li><span></span><a href="#tabs-2">다량판매</a></li>
                        <li><span></span><a href="#tabs-3">철거/원상복구</a></li>
                        <li><span></span><a href="#tabs-4">기업 전용<em>(매입+철거)</em></a></li>
                        <li><span></span><a href="#tabs-5">중고 구매 매칭</a></li>
                        <li><span></span><a href="#tabs-6">피커스 마켓</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_01 conbox on">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>가전/가구 매입 연결</p>
                        </div>
                      </div>
                      <div id="tabs-2" class="conbox_02 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>가정,사무,업소 이사 및 정리 등 다량 매입 업체 연결</p>
                        </div>
                      </div>
                      <div id="tabs-3" class="conbox_03 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>가정,사무,업소,철거/원상 복구 업체 연결</p>
                        </div>
                      </div>
                      <div id="tabs-4" class="conbox_04 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>기업 이사 및 정리 시 매입과 철거를 한번에</p>
                        </div>
                      </div>
                      <div id="tabs-5" class="conbox_05 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>원하는 가전/가구 구매 연결</p>
                        </div>
                      </div>
                      <div id="tabs-6" class="conbox_06 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>중고 가전/가구 판매몰</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      <span>STEP 2</span>
                      <h3>견적 정보 입력</h3>
                    </div>
                    <div class="serv_con tab" id="tabs2">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">물품 판매시</a></li>
                        <li><span></span><a href="#tabs-2">물품 구매 시</a></li>
                        <li><span></span><a href="#tabs-3">철거 진행 시</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_07 conbox on">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>가전.가구 제조사, 모델명, 년식 정보와 사진을 함께 넣어주세요.</p>

                        </div>
                      </div>
                      <div id="tabs-2" class="conbox_08 conbox">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>구매하고자 하는 물품 정보와 예상 비용을 입력해주세요.</p>
                        </div>
                      </div>
                      <div id="tabs-3" class="conbox_09 conbox">
                        <span>icon</span>

                        <div class="conbox_txt">
                          <p>각 철거 내역 사진과 정보에 대해 상세히 작성해주세요.</p>
                          <em>※ 다량 매입 및 철거의 경우 정확한 견적을 위해 업체 방문이 진행 될 수 있습니다.</em>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      <span>STEP 3</span>
                      <h3>업체 견적 확인 및 선택</h3>
                    </div>
                    <div class="serv_con tab" id="tabs3">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">피커스에서는 전문 업체를 통해 내용에 맞는 적정 견적을 안내합니다.</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_10 conbox on">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>고객님께서 전문 업체 견적을 확인하고 선택</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      <span>STEP 4</span>
                      <h3>업체 방문 수거/철거, 배송 완료</h3>
                    </div>
                    <div class="serv_con tab" id="tabs4">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</a></li>

                      </ul>
                      <div id="tabs-1" class="conbox_11 conbox on">
                        <span>icon</span>
                        <div class="conbox_txt">
                          <p>선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</p>
                          <a id="free_estimate" href="/estimate/estimate_register.php">무료로 견적 신청</a>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="review">
          <h2>베스트 리뷰</h2>
          <div class="rev">
            <div class="swiper-container swiper_review web pc_review">
              <div class="btn">
                <a href="" class="prev swiper-button-prev_review">이전</a>
                <a href="" class="next swiper-button-next_review">다음</a>
              </div>
              <div class="rev_box swiper-wrapper">
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>박**님</h5>
                        <p>여러 업체에서 견적 받아보고<br />
                          마음에 드는 곳으로 선택할 수 있어서 <br />
                          굉장히 편리했어요!
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>홍**님</h5>
                        <p>신청 방법이나 처리 과정이 간단해서 <br />
                          큰 어려움 없이 해결했어요 ;-) <br />
                          대만족 합니다
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>한**님</h5>
                        <p>그냥 버려야 하나 고민하다 혹시나 하는 <br />
                          마음으로 견적 신청했는데 용돈 벌었네요
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>임**님</h5>
                        <p>무거운 가전 가구 한 번에 처리할 수 있어서<br />
                          너무나 편했던 피커스는 신의 한 수!
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>이**님</h5>
                        <p>사무실 이전으로 철거 원상복구 신청했거든요<br />
                          우선 견적가도 합리적인 데다가<br />
                          꼼꼼한 일처리까지 해주셔서 감사합니다.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-container swiper_review m_css m_review">
              <div class="btn">
                <a href="" class="prev swiper-button-prev_review_m">이전</a>
              </div>
              <div class="rev_box swiper-wrapper">
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>박**님</h5>
                        <p>여러 업체에서 견적 받아보고<br />
                          마음에 드는 곳으로 선택할 수 있어서 <br />
                          굉장히 편리했어요!
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>홍**님</h5>
                        <p>신청 방법이나 처리 과정이 간단해서 <br />
                          큰 어려움 없이 해결했어요 ;-) <br />
                          대만족 합니다
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>한**님</h5>
                        <p>그냥 버려야 하나 고민하다 혹시나 하는 <br />
                          마음으로 견적 신청했는데 용돈 벌었네요
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>임**님</h5>
                        <p>무거운 가전 가구 한 번에 처리할 수 있어서<br />
                          너무나 편했던 피커스는 신의 한 수!
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>이**님</h5>
                        <p>사무실 이전으로 철거 원상복구 신청했거든요<br />
                          우선 견적가도 합리적인 데다가<br />
                          꼼꼼한 일처리까지 해주셔서 감사합니다.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn">
                <a href="" class="next swiper-button-next_review_m">다음</a>
              </div>
            </div>
          </div>
        </div>
        <div class="pickus_open">
          <div class="pickus_serv">
            <h4>최상급 중고 물품 안심 매칭 서비스 오픈!</h4>
            <p>A/S는 기본! 올 수리 제품만을 알뜰하게 구입하실 수 있도록 매칭해 드립니다.</p>
            <a href="/bbs/guide.php" class="more">바로가기</a>
          </div>
          <div class="pickus_partner">
            <h4>“피커스와 함께 성장할 대표님을 모십니다.”</h4>
            <p style="color: #fff">
              전국적으로 사업을 확장하는 피커스의 파트너가 되어주세요.</p>
            <a href="/bbs/pick.php" class="more">바로가기</a>
          </div>
        </div>
        <div class="app_down">
          <span>우리동네 재활용센터를 모으다</span>
          <h3>피커스</h3>
          <p>매입/철거/구매 비교 견적을 한번에<br>
            중고 전문가들을 통한 안전한 거래 지금 시작해보세요!</p>
          <a href="https://play.google.com/store/apps/details?id=com.dehuv.pickus" class="more">구글스토어 다운로드</a>
          <a href="https://apps.apple.com/kr/app/%ED%94%BC%EC%BB%A4%EC%8A%A4/id1576649249" class="more">애플스토어 다운로드</a>
        </div>

    </div>
    </section>
    <?php } ?>
   
      <div style="display:none; margin-top:10%;" id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- 슬라이드 쇼 -->
          <div class="carousel-item active">
            <!-- <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div> -->
            <!--가로-->
            <a style="width:100%;" href="http://naver.me/GQ4ICeSI" target="_blank">
              <picture>
                <source media="(max-width: 321px)" srcset="/bbs/images/mobile_ad1.png">
                <source media="(max-width: 376px)" srcset="/bbs/images/mobile_ad2.png">
                <source media="(max-width: 415px)" srcset="/bbs/images/mobile_ad3.png">
                <img src="/bbs/images/web_ad.png" class="d-block w-1001">
              </picture>
            </a>
          </div>
          

          <!-- / 슬라이드 쇼 끝 -->
          <!-- 왼쪽 오른쪽 화살표 버튼 -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <!-- <span>Previous</span> -->
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <!-- <span>Next</span> -->
          </a> <!-- / 화살표 버튼 끝 -->
          <!-- 인디케이터 -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <!--0번부터시작-->
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul> <!-- 인디케이터 끝 -->
        </div>
      </div>
    
    <!--
	  <input type="button" value="인터페이스 호출" id="btn_inter">
	 
	  <input type="button" value="FCM 테스트" id="btn_fcm">
	  -->

    <style type="text/css">
      .container>.cont_01>.est>.Brea .list>ul {
        max-height: 41px;
      }

      @media(max-width: 480px) {
        img.d-block.w-100 {
          height: 200px;
        }

        img.d-block.w-1001 {
          height: 100px;
        }
        .container>.cont_03>.review>.rev>.swiper-container>.btn>a.next {
          top: 275px;
        }
      }
    </style>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.m_menu').unbind('click').bind('click', function(e) {
          $('.sidenav').addClass("opened");
          return false;
        });
        $('#close_menu').click(function() {
          $('.sidenav').removeClass("opened");
        });
        $('#won_total').animateNumber({
          number: 6719266000
        }, {
          duration: 2000
        });
      });
    </script>
    <script>
      $(function() {
        $("#tabs1").tabs();
        $("#tabs2").tabs();
        $("#tabs3").tabs();
        $("#tabs4").tabs();
        new Swiper('.swiper1', {
          pagination: { // 페이징 설정
            el: '.swiper-pagination',
            clickable: true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
          },
          navigation: { // 네비게이션 설정
            nextEl: '.swiper-button-next', // 다음 버튼 클래스명
            prevEl: '.swiper-button-prev', // 이번 버튼 클래스명
          },
        });
      });
      // swiper2
      var swiper_slide = new Swiper('.swiper-req', {
        direction: 'vertical',
        slidesPerView: 2,
        loop: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        simulateTouch: false,
        allowTouchMove: false
      });
      /*
              swiper_slide.on('reachEnd', function(){
                  swiper_slide.autoplay = false;
              })*/

      new Swiper('.pc_review', {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: { // 네비게이션 설정
          nextEl: '.swiper-button-next_review', // 다음 버튼 클래스명
          prevEl: '.swiper-button-prev_review', // 이번 버튼 클래스명
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });
      new Swiper('.m_review', {
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        direction: 'vertical',
        navigation: { // 네비게이션 설정
          nextEl: '.swiper-button-next_review_m', // 다음 버튼 클래스명
          prevEl: '.swiper-button-prev_review_m', // 이번 버튼 클래스명
        },
      });

      $(document).ready(function() {

        var mb_id = '<?php echo $member['mb_id']; ?>';
        //          console.log(mb_id);

        //           if(mb_id != ""){
        // 		//토큰 가져오기
        // 		var setToken = webView.getToken();

        // 		$.ajax({
        // 			url : "ajax_do_Token.php",
        // 			type : "post",
        // 			dataType : "json",
        // 			data : 
        // 			{
        // 				setToken : setToken,
        // 			},
        // 			error:function(request,status,error){
        // 				alert("code = "+ request.status + 
        // 					" message = " + request.responseText + 
        // 					" error = " + error); // 실패 시 처리
        // 			},

        // 		}).done(function(data) {
        // 			if(data.ret == true){
        // //				alert(data.msg);
        // 			}else{
        // 				//alert(data.msg);
        // 			}
        // 		});

        //           }

        /*
        		//토큰 가져오기
        		var setToken = webView.getToken();

        		$.ajax({
        			url : "ajax_do_Token.php",
        			type : "post",
        			dataType : "json",
        			data : 
        			{
        				setToken : setToken,
        			},
        			error:function(request,status,error){
        				alert("code = "+ request.status + 
        					" message = " + request.responseText + 
        					" error = " + error); // 실패 시 처리
        			},

        		}).done(function(data) {
        			if(data.ret == true){
        				//alert(data.msg);
        			}else{
        				//alert(data.msg);
        			}
        		});
        */
        //버튼 : FCM호출 
        /*
        $("#btn_fcm").click(function(){
        	$.ajax({
        		url : "ajax_do_fcm.php",
        		type : "post",
        		dataType : "json",
        		data : 
        		{
        		},
        		error:function(request,status,error){
        			alert("code = "+ request.status + 
        				" message = " + request.responseText + 
        				" error = " + error); // 실패 시 처리
        		},

        	}).done(function(data) {
        		if(data.ret == true){
        			//alert(data.msg);
        		}else{
        			//alert(data.msg);
        		}
        	});
        });
        */
        /*
        //버튼 : 인터페이스 호출
        $("#btn_inter").click(function(){
        	var setToken = webView.getToken();
        	//alert(setToken);

        	$.ajax({
        		url : "ajax_do_Token.php",
        		type : "post",
        		dataType : "json",
        		data : 
        		{
        			setToken : setToken,
        		},
        		error:function(request,status,error){
        			alert("code = "+ request.status + 
        				" message = " + request.responseText + 
        				" error = " + error); // 실패 시 처리
        		},

        	}).done(function(data) {
        		if(data.ret == true){
        			alert(data.msg);
        		}else{
        			//alert(data.msg);
        		}
        	});
        });
        */
      });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6324853175392320" crossorigin="anonymous"></script>
    <!-- 하단광고 -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6324853175392320" data-ad-slot="1465013656" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</body>


<?php
include_once(G5_PATH . '/tail.php');
?>