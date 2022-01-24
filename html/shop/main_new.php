<?php 
  include_once("../_common.php");  
  include_once(G5_LIB_PATH.'/latest.lib.php');

  $sql = "select * from estimate_list UNION select * from estimate_match";
  $fec_union = sql_query($sql);
  $sql = 'select sum(price) as total from g5_estimate_propose';
  $fec = sql_fetch($sql);

?>
<body>
  <?php print_r($fec_union); ?>
	<style type="text/css">
    .m_review {max-height: 340px;}
    .pic_lt{padding-top: 0; margin-bottom: 0; border:0; background-color: transparent ; width: 100%;}
    .pic_lt ul{padding: 0}
    .ui-tabs .ui-tabs-nav li{white-space: normal;}
    .pic_lt .lt_more,
    .pic_lt .lat_title,
    .pic_lt li .new_icon,
    .pic_lt li p{display: none;}
    .pic_lt li{width: 48%; padding: 0;}
    .m_css{display: none;}
    .container > .cont_01 > .contico > ul > li > a{font-size: 21px !important;}

    @media(max-width: 1000px){
      .pic_lt li{width: 47%;}
    }
    #free_estimate{width: 200px; height: 40px; color: #fff !important; margin-top: 15px; background-color: #fe8e3a !important; float: right; border:1px solid #ededed; font-size: 21px; padding: 12px 0;}
    @media(max-width: 768px){
      .m_css{display: block;}
      .container > .cont_01 > .contico > ul > li > a{font-size: 16px !important;}
      .container > .cont_03 > .how > .how_slider > .service{padding-bottom: 40px;}
      #free_estimate{width: 150px; height: 35px; color: #fff !important; margin-top: 15px; background-color: #fe8e3a !important; float: right; border:1px solid #ededed; font-size: 17px; padding: 9px 0;}
      #txt_last{width: 80% !important;}
    }
    .pic_lt li a{
        font-size: 20px;
      font-weight: bold;
      margin: 10px 0;
      text-align: center;
      width: 100%;
      line-height: 20px;
    }

    .pic_lt .lt_date{width: 100%; text-align: center; margin-top: 0;}
    .pic_lt li .lt_img img{border-radius: 8px;}
    .pic_lt li:first-of-type{margin-right: 10px;}
    .pic_lt li:last-of-type{margin-left: 10px;}
		em{color: #fff;}
		#quick li a{color: #fff !important}
		.footer .copyright{margin-top: 55px !important;}
		.carousel-indicators li{width: 30px !important; height: 3px !important; border:0; margin-right: 3px;margin-left: 3px;}
    .carousel-indicators .active{ margin-right: 3px !important;margin-left: 3px !important; margin: 1px;}
		.carousel-indicators{width: 100%;}
		.ui-widget.ui-widget-content,
		.ui-widget-header,
		.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active,
		.ui-widget-content{border:0;}
		.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active,
		.ui-widget-header{background-color: transparent;}
		.container > .cont_03 > .how > .how_slider > .service> .serv_box > .swiper-slide .serv_con > ul > li > a > em{color: #a9a9a9;}
		.ui-tabs .ui-tabs-nav .ui-tabs-anchor{padding: 0;}

	</style>
	<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/jQuery/jquery-ui.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script>
    
    $('.carousel').carousel({ interval: 2000 })
    $(function () {
      $( "#tabs1" ).tabs();
      $( "#tabs2" ).tabs();
      $( "#tabs3" ).tabs();
      $( "#tabs4" ).tabs();

      new Swiper('.swiper1', {
      pagination : { // 페이징 설정
        el : '.swiper-pagination',
        clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
      },
      navigation : { // 네비게이션 설정
        nextEl : '.swiper-button-next', // 다음 버튼 클래스명
        prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
      },
    });

    // swiper2
    new Swiper('.swiper2', {
      loop : true, // 무한 루프 슬라이드, 반복이 되며 슬라이드가 끝이 없다.
      pagination : {
        el : '.swiper-pagination',
      },
    });

      // var mySwiper = new Swiper('.swiper-container', {
      //   observer: true,
      //   observeParents: true,
      //   spaceBetween: 24,
      //   navigation: {
      //       nextEl: '.swiper-button-next',
      //       prevEl: '.swiper-button-prev',
      //   },
        
      // });
      new Swiper('.pc_review', {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation : { // 네비게이션 설정
          nextEl : '.swiper-button-next_review', // 다음 버튼 클래스명
          prevEl : '.swiper-button-prev_review', // 이번 버튼 클래스명
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });

      new Swiper('.m_review', {
        direction: 'vertical',
        navigation : { // 네비게이션 설정
          nextEl : '.swiper-button-next_review', // 다음 버튼 클래스명
          prevEl : '.swiper-button-prev_review', // 이번 버튼 클래스명
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });
    });


    
  </script>
  <style type="text/css">
    .swiper_review .swiper-slide{padding: 0 !important;}
    .reviw{width: 100% !important;}
    .swiper-button-prev_review,.swiper-button-next_review{z-index: 999;}
  </style>
<script type="text/javascript">
  $(document).ready(function(){
      $('.m_menu').unbind('click').bind('click', function (e) {
        $('.sidenav').addClass("opened");
        return false;
      });
      $('#close_menu').click(function(){
          $('.sidenav').removeClass("opened");
      });
  });
</script>
  <div id="Wrap">
    <div id="contents" class="container">
      <div id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- 슬라이드 쇼 -->
          <div class="carousel-item active">
            <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div>
            <!--가로--> <img class="d-block w-100" src="images/visual_img.png" alt="비쥬얼이미지1">
                      
          </div>
          <div class="carousel-item ">
            <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div>
            <!--가로--> <img class="d-block w-100" src="images/visual_img.png" alt="비쥬얼이미지1">
                      
          </div>
          <div class="carousel-item ">
            <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div>
            <!--가로--> <img class="d-block w-100" src="images/visual_img.png" alt="비쥬얼이미지1">
                      
          </div>

           <!-- / 슬라이드 쇼 끝 -->
          <!-- 왼쪽 오른쪽 화살표 버튼 --> <a class="carousel-control-prev" href="#demo" data-slide="prev"> <span
              class="carousel-control-prev-icon" aria-hidden="true"></span> <!-- <span>Previous</span> --> </a> <a
            class="carousel-control-next" href="#demo" data-slide="next"> <span class="carousel-control-next-icon"
              aria-hidden="true"></span> <!-- <span>Next</span> --> </a> <!-- / 화살표 버튼 끝 -->
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
                <?php echo number_format(round($fec['total'],-3)); ?>원</span>
            </div>
          </div>
          <div class="Brea">
            <div>
              <span class="ico02">icon</span>
              <h4 class="tit">실시간 신청내역</h4>
              <div class="list">
                <ul>
                  <li class="first01">판매</li>
                  <li>서울</li>
                  <li>도봉구</li>
                  <li>냉장고</li>
                </ul>
                <ul>
                  <li class="first02">다량</li>
                  <li>경기</li>
                  <li>고양시</li>
                  <li>제목...</li>
                </ul>
              </div>
          </div>
          </div>
        </div>
        <div class="contico">
          <ul>
            <li class="sell_01"><a href="/estimate/estimate_register1B.php">가전가구 판매</a></li>
            <li class="sell_02"><a href="/estimate/estimate_register2D.php">대량판매</a></li>
            <li class="sell_03"><a href="/estimate/estimate_register3B.php">철거/원상복구</a></li>
            <li class="sell_04"><a href="/estimate/estimate_register4.php">기업전용(매입+철거)</a></li>
          </ul>
        </div>
        <div class="matc" style="cursor: pointer;" onclick="window.loacation.href='/bbs/guide.php'">
          <span class="ico">icon</span>
          <div class="mat">
            <h4>안심구매매칭</h4>
            <p>예상금액에 맞는 적합한 상품을 추천해 드립니다.</p>
            <a href="/bbs/guide.php" class="more">바로가기</a>
          </div>
        </div>
      </section>
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
            <iframe style="overflow: hidden;" width="100%" height="338" src="https://www.youtube.com/embed/g0tdQXMIBaA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                        <li ><span></span><a href="#tabs-2">다량판매</a></li>
                        <li ><span></span><a href="#tabs-3">철거/원상복구</a></li>
                        <li><span></span><a href="#tabs-4">기업 전용<em>(매입+철거)</em></a></li>
                        <li ><span></span><a href="#tabs-5">중고 구매 매칭</a></li>
                        <li ><span></span><a href="#tabs-6">피커스 마켓</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_01 conbox on">
                        <span>icon</span>
                        <p>가전/가구 매입 연결</p>
                      </div>
                      <div id="tabs-2" class="conbox_02 conbox">
                        <span>icon</span>
                        <div class="conbox_txt"><p>가정,사무,업소 이사 및 정리 등 다량 매입 업체 연결</p></div>
                      </div>
                        <div id="tabs-3" class="conbox_03 conbox">
                        <span>icon</span>
                        <div class="conbox_txt"><p>가정,사무,업소,철거/원상 복구 업체 연결</p></div>
                      </div>
                      <div id="tabs-4" class="conbox_04 conbox">
                        <span>icon</span>
                        <div class="conbox_txt"><p>기업 이사 및 정리 시 매입과 철거를 한번에</p>
                     </div> </div>
                      <div id="tabs-5" class="conbox_05 conbox">
                        <span>icon</span>
                        <div class="conbox_txt"><p>원하는 가전/가구 구매 연결</p></div>
                      </div>
                      <div id="tabs-6" class="conbox_06 conbox">
                        <span>icon</span>
                        <div class="conbox_txt"> <p>중고 가전/가구 판매몰</p></div>
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
                    <div id="tabs-1"  class="conbox_07 conbox on">
                      <span>icon</span>
                      <div class="conbox_txt"><p>가전.가구 제조사, 모델명, 년식 정보와 사진을 함께 넣어주세요.</p>
                    
                    </div>  </div>
                    <div id="tabs-2" class="conbox_08 conbox">
                      <span>icon</span>
                      <div class="conbox_txt"><p>구매하고자 하는 물품 정보와 예상 비용을 입력해주세요.</p>
                   </div></div>
                    <div id="tabs-3" class="conbox_09 conbox">
                      <span>icon</span>
                     
                      <div class="conbox_txt"><p>각 철거 내역 사진과 정보에 대해 상세히 작성해주세요.</p>
                      <em>※ 다량 매입 및 철거의 경우 정확한 견적을 위해 업체 방문이 진행 될 수 있습니다.</em></div>
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
                    <div id="tabs-1"  class="conbox_10 conbox on">
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
                    <div id="tabs-1"  class="conbox_11 conbox on">
                      <span>icon</span>
                      <div class="conbox_txt">
                      <p>선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</p>
                      <a id="free_estimate" href="/estimate/estimate_register.php" style="">무료로 견적 신청</a>
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
                        <p>여러 업체에서 견적 받아보고<br/>
                        마음에 드는 곳으로 선택할 수 있어서 <br/>
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
                        <p>신청 방법이나 처리 과정이 간단해서 <br/>
                        큰 어려움 없이 해결했어요 ;-) <br/>
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
                        <p>그냥 버려야 하나 고민하다 혹시나 하는 <br/>
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
                        <p>무거운 가전 가구 한 번에 처리할 수 있어서<br/>
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
                        <p>사무실 이전으로 철거 원상복구 신청했거든요<br/>
                        우선 견적가도 합리적인 데다가<br/>
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
                        <p>여러 업체에서 견적 받아보고<br/>
                        마음에 드는 곳으로 선택할 수 있어서 <br/>
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
                        <p>신청 방법이나 처리 과정이 간단해서 <br/>
                        큰 어려움 없이 해결했어요 ;-) <br/>
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
                        <p>그냥 버려야 하나 고민하다 혹시나 하는 <br/>
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
                        <p>무거운 가전 가구 한 번에 처리할 수 있어서<br/>
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
                        <p>사무실 이전으로 철거 원상복구 신청했거든요<br/>
                        우선 견적가도 합리적인 데다가<br/>
                        꼼꼼한 일처리까지 해주셔서 감사합니다.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
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
              <p style="color: #fff;">
                전국적으로 사업을 확장하는 피커스의 파트너가 되어주세요.</p>
              <a href="/bbs/pick.php" class="more">바로가기</a>
            </div>
          </div>
          <div class="app_down">
            <span>우리동네 재활용센터를 모으다</span>
            <h3>피커스</h3>
            <p>매입/철거/구매 비교 견적을 한번에<br>
              중고 전문가들을 통한 안전한 거래 지금 시작해보세요!</p>
            <a href="https://play.google.com/store/apps/details?id=com.dehuv.pickus" target="_blank" class="more">바로가기</a>
          </div>
        </div>
       
        <!--  -->
    </section>