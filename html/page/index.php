<?php include_once '../_common.php'; ?>
<?php include_once '/thema/Basic/head.php'; ?>

<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>재활용센터 피커스</title>
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
      
    });


    
  </script>
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
</head>

<body>
  <div id="Wrap">
    <div class="header">
      <div class="lang">
        <div class="lang_box">
          <ul>
            <li><a href="">회원가입</a></li>
            <li><a href="">로그인</a></li>
          </ul>
        </div>
      </div>
      <div class="head">
        <h2 class="logo">PICKUS</h2>
        <div class="menu">
          <ul>
            <li><a href="">견적신청</a></li>
            <li><a href="">피커스픽</a></li>
            <li><a href="">고객센터</a></li>
            <li><a href="">파트너 문의</a></li>
            <li><a href="">중고구매매칭</a></li>
          </ul>
      </div>
      <div class="sidenav">
        <span id="close_menu"><img src="images/White_icon_24_close.png"></span>
        <div class="items">
              <div class="my main_bg">
                  <h2>로그인 하세요</h2>
              </div>
              <!-- my -->
              <ul class="login row main_bg">
                  <li class="col-xs-6"><a class="white_bg" href="/bbs/login.php">로그인</a></li>
                  <li class="col-xs-6"><a class="white_bg" href="/bbs/register_customer_form.php">회원가입</a></li>
              </ul>
              <!-- quick_login -->
        </div>
        <ul class="nav" id="nav-left">
              <li><a href="/estimate/estimate_register.php">견적 신청</a></li>
              <li><a href="/bbs/board_pick.php">피커스 픽</a></li>
              <li><a href="/bbs/faq.php">고객센터</a></li>
              <li><a href="/bbs/pick.php">파트너문의</a></li>
              <li><a href="/bbs/guide.php">중고구매매칭</a></li>
                      
              <div class="coll">
                  <h2>고객 상담 및 파트너 문의</h2>
                  <h1 class="main_co">1800-5528</h1>
                  <p>운영시간: 09:00 ~ 18:00</p>
                  <p>(일/공휴일 휴무)</p>
              </div>
        </ul>
    </div>
      <div class="m_menu">
          <div class="m_ico">
            <a href="" class="m_ham">햄버거 메뉴 </a>
          </div>
      </div>
      </div>
    </div>
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
              <span class="won">1,000,000원</span>
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
            <li class="sell_01"><a href="">가전가구 판매</a></li>
            <li class="sell_02"><a href="">대량판매</a></li>
            <li class="sell_03"><a href="">철거/원상복구</a></li>
            <li class="sell_04"><a href="">기업전용(매입+철거)</a></li>
          </ul>
        </div>
        <div class="matc">
          <span class="ico">icon</span>
          <div class="mat">
            <h4>안심구매매칭</h4>
            <p>예상금액에 맞는 적합한 상품을 추천해 드립니다.</p>
            <a href="" class="more">바로가기</a>
          </div>
        </div>
      </section>
      <section class="cont_02">
        <div class="cont">
          <div class="pick">
            <h2>PICKUS PICK!</h2>
            <ul>
              <li>
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
              </li>
            </ul>
          </div>
          <div class="video">
            <img src="images/video.png">
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
                      <li data-id="con1" class="on"><span></span><a href="#tabs-1">피커스에서는 전문 업체를 통해 내용에 맞는 적정 견적을 안내합니다.</a></li>
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
                      <li data-id="con1" class="on"><span></span><a href="#tabs-1">선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</a></li>
                      
                    </ul>
                    <div id="tabs-1"  class="conbox_11 conbox on">
                      <span>icon</span>
                      <div class="conbox_txt">
                      <p>선택하신 업체에서 고객님과의 일정 조율 후 방문 수거/철거 및 배송을 진행합니다.</p>
                    </div>
                    </div>
                    
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        <!--  -->
        <div class="review">
          <h2>베스트 리뷰</h2>
          <div class="rev">
            <div class="swiper-container swiper1">
              <div class="btn">
                <a href="" class="prev swiper-button-prev">이전</a>
                <a href="" class="next swiper-button-next">다음</a>
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
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
                      </div>
                    </div>
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
                      </div>
                    </div>
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
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
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
                      </div>
                    </div>
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
                      </div>
                    </div>
                    <div class="reviw">
                      <div class="review_box">
                        <ul>
                          <li class="star">1</li>
                          <li class="star">2</li>
                          <li class="star">3</li>
                          <li class="star">4</li>
                          <li class="star">5</li>
                        </ul>
                        <h5>김**님</h5>
                        <p>큰 가구들 처리하기 어려웠는데 너무너무 감사하게도 
                          날이 추운데도 열심히 작업해주셨어여 
                          너무 감사합니당 !</p>
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
              <a href="" class="more">바로가기</a>
            </div>
            <div class="pickus_partner">
              <h4>“피커스와 함께 성장할 대표님을 모십니다.”</h4>
              <p>
                전국적으로 사업을 확장하는 피커스의 파트너가 되어주세요.</p>
              <a href="" class="more">바로가기</a>
            </div>
          </div>
          <div class="app_down">
            <span>우리동네 재활용센터를 모으다</span>
            <h3>피커스</h3>
            <p>매입/철거/구매 비교 견적을 한번에<br>
              중고 전문가들을 통한 안전한 거래 지금 시작해보세요!</p>
            <a href="" class="more">바로가기</a>
          </div>
        </div>
       
        <!--  -->
    </section>
      <footer class="footer">
        <p>PICKUS</p>
      </footer>
</body>
</html>