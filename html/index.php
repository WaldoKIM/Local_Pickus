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
  <link rel="stylesheet" href="./bbs/css/main.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/jQuery/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="/js/jquery.animateNumber.js"></script>
  


  
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
      

      <?php if ($member['mb_level'] == 2) {
        include_once('./main_seller.php');
      }?>

      <?php if($member['mb_level'] != 2) { 
        include_once('./main_customer.php');
      ?>

    <?php } ?>
    <!-- with KJS dance 광고창 삭제 -->
    <!--
        <?//include_once('./fix_ad.php');?>
        
        <div style="display:flex; justify-content:center;">
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6324853175392320"
            crossorigin="anonymous"></script>
        
        <ins class="adsbygoogle"
            style="display:inline-block;width:1200px;height:150px"
            data-ad-client="ca-pub-6324853175392320"
            data-ad-slot="5123790083"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>
    </div>
  </div> 
      -->
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
    
<!-- 광고 삭제
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6324853175392320" crossorigin="anonymous"></script>
    
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6324853175392320" data-ad-slot="1465013656" data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    -->
</body>


<?php
include_once(G5_PATH . '/tail.php');
?>