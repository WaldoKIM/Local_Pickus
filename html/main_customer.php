<?php include_once('./_common.php'); ?>


<!--메인배너-->
<div id="demo" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <!-- 슬라이드 쇼 -->
        <div class="carousel-item active">
            <a style="width:100%;" href="https://repickus.com/estimate/estimate_registerSearch.php" target="_blank">
              <picture>
                <source media="(max-width: 321px)" srcset="/bbs/images/search1.png">
                <source media="(max-width: 376px)" srcset="/bbs/images/search2.png">
                <source media="(max-width: 415px)" srcset="/bbs/images/search3.png">
                <img src="/bbs/images/searchweb.png" class="d-block w-100">
              </picture>
            </a>
        </div>  
        <div class="carousel-item">
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
        <li data-target="#demo" data-slide-to="3"></li>
        </ul> <!-- 인디케이터 끝 -->
    </div>
</div>
<!--메인배너 끝-->




<!--실시간 견적-->
<section class="section_cont01_flex cont_01">
<div class="aboutusform width50">
    <p class="aboutus">ABOUT US</p>
    <p class="aboutuscon">
        중고전문가를 통한 신속하고 안전한 거래를 추구 합니다.</br>
        처리가 어려운 다량의 물품 구매부터 주방.사무 공간정리,</br>
        판매까지 한번에!!<em class="about_font">자원 재활용 기준의 시작,</em><em class="about_font2">"피커스"</em>
    </p>
</div>
<div class="width50 contico">
    <ul>
        <li class="sell_01"><a href="/estimate/estimate_register1B.php">가전/가구 판매</a></li>
        <li class="sell_02"><a href="/estimate/estimate_register2D.php">다량판매</a></li>
        <li class="sell_03"><a href="/bbs/guide.php">중고구매매칭</a></li>
        <li class="sell_04"><a href="/estimate/estimate_register3B.php">철거/원상복구</a></li>
        <li class="sell_05"><a href="/estimate/estimate_register4.php">기업전용</a></li>
        <li style="display:none;" class="sell_06"><a href="/market">피커스몰</a></li>
    </ul>
</div>
</section>
<section class="cont_01">
    <div style="border:none;" class="est est_design">
          <div class="Brea">
            <div>
              <span class="ico01">icon</span>
              <h4 class="tit">판매 견적리스트</h4>
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
          <div class="Brea">
            <div>
              <span class="ico02">icon</span>
              <h4 class="tit">구매 견적리스트</h4>
              <div class="swiper-req" style="height: 82px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union_match); $i++) {
                    
                   
                    $type = '<li class="first02">구매</li>';
                    
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
</section>
<!--실시간 견적 끝-->
<??>
<!--피커스픽-->
<section class="cont_02">
        <div class="cont">
          <div class="pick">
            <h2>PICKUS PICK!</h2>
            <ul>
              <?php echo latest("pic_basic", "gallery", 1, 25, '', "메인 노출"); ?>
              
            </ul>
          </div>
          <!-- <div class="video">
            <iframe style="overflow: hidden;" width="100%" height="338" src="https://www.youtube.com/embed/GGmkLnbOlcg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div> -->
          
            <?php include_once('./main_guide.php');?>  
          
        </div>
      </section>
<!--피커스픽 끝-->


<!--베스트리뷰-->
<section class="cont_03">
                <!-- <div class="how">
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
        </div> -->

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
    <!-- 광고 삭제
    <div style="max-width:1200px; margin:auto; margin-top:10%;" id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          
          <div class="carousel-item active"> -->
            <!-- <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div> -->
            <!--가로-->
            <!--
            <a style="width:100%;" href="http://naver.me/GQ4ICeSI" target="_blank">
              <picture>
                <source media="(max-width: 321px)" srcset="/bbs/images/mobile_ad1.png">
                <source media="(max-width: 376px)" srcset="/bbs/images/mobile_ad2.png">
                <source media="(max-width: 415px)" srcset="/bbs/images/mobile_ad3.png">
                <img src="/bbs/images/web_ad.png" class="d-block w-1001">
              </picture>
            </a>
          </div>
            

        
         
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span>Previous</span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span>Next</span> 
          </a> 
         인디케이터
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
          
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul> 
        </div>
      </div>
    </section>
            -->
<!--베스트리뷰 끝-->
<!-- 광고 삭제
<style>
    @media(min-width:1100px){
        .w-1001{
            height:850px;
        }
    }
</style>
  -->

