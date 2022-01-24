<?
include('../common.php');
//if($_SESSION['ss_mb_id']){echo $_SESSION['ss_mb_id'];}else{echo "NULL";}	
if ($_GET[CACHE]) {
    session_cache_limiter('nocache, must-revalidate');
}

// 장바구니 아이디 생성
if (empty($_SESSION[CART])) {
    $CART = md5(uniqid(rand()));
    ($_SESSION["CART"] = $CART) or die("session_register CART_ID err");
}
if (empty($_SESSION[VIEW_LIST])) {
    $VIEW_LIST = md5(uniqid(rand()));
    ($_SESSION["VIEW_LIST"] = $VIEW_LIST) or die("session_register VIEW_LIST_ID err");
}
// 기본 클래스 불러오기

// 관리자 정보 불러오기
$admin_stat = $db->object("cs_admin", "");
$design_stat = $db->object("cs_design", "");
//현재 페이지 이름 가져오기
$TARGETFILENAME = basename($_SERVER['PHP_SELF']);
//보안서버 설정 --- 특정페이지를 제외하고 보안설정이 잡혀있을 경우 리다이렉트
if ($_SERVER[HTTPS] && basename($_SERVER['PHP_SELF']) != "order_trade.php") {
    //		$tools->metaGo("http://".$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI']);
}
//상품아이콘배열화
$iconRe        = $db->select("cs_icon_list", "order by idx asc");
$arrPicon = array();
while ($iconRow = mysqli_fetch_object($iconRe)) {
    $arrPicon[$iconRow->idx] = $iconRow->icon;
}
//메타태그설정 게시판, 상품
include('../metakeyword.inc.php');
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?
    $shop_ico = "../data/designImages/" . $design_stat->bookmarkicon;
    $shop_bookmark = "../data/designImages/" . $design_stat->icoicon;
    $shop_og = "../data/designImages/" . $design_stat->bookmarkicon;
    ?>
    <link href="../data/designImages/<?= $design_stat->bookmarkicon ?>" rel="apple-touch-icon" />
    <link rel="shortcut icon" href="../data/designImages/<?= $design_stat->icoicon ?>" type="image/x-icon">
    <title><?= $MetaTailebar; ?></title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="description" content="<?= $MetaDescription; ?>">
    <meta name="keywords" content="<?= $MetaKeywords; ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $design_stat->title_bar; ?>">
    <meta property="og:description" content="<?= $MetaDescription; ?> ">
    <meta property="og:image" content="http://<?= $admin_stat->shop_domain; ?>/data/designImages/<?= $design_stat->title_logo; ?>">
    <meta property="og:url" content="">

    <!--[if lt IE 9]>
    <style>.container-fluid {display:none;}</style>
    <p style="font-size:12pt; color:#FF00D8FF00D8; font-family: 'NanumGothicBold', 'NanumGothic','Dotum'; padding-top:50px; text-align:center"><img src="images/ie8er.jpg"/><br/>죄송합니다. 익스플로러 9버전 이하에서는 이용할 수 없습니다.<br/>사용하고 계신 익스플로러 버전을 업그레이드 하신후 이용해 주시기 바랍니다.<br/><br/><a href='http://browsehappy.com/' target='_new' class='iecheck01' style="font-size:12pt; font-family: 'NanumGothicBold', 'NanumGothic','Dotum'; padding:20px; text-align:center">업그레이드 바로가기</a></p>
    <![endif]-->
    <!--상단인트로 베너-->
    <link rel='stylesheet' href='css/new/settings.css' type='text/css' media='all' />
    <link rel="stylesheet" href="css/calendar_add_poll.css">
    <link rel="shortcut icon" href="" />
    <link rel="stylesheet" type="text/css" href="css/style.css?ver=<?= time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/style_main.css?ver=<?= time(); ?>">
    <link rel='stylesheet' href='css/new/style.css?ver=<?= time(); ?>' type='text/css' media='all' />
    <!-- 게시판 첨부파일 속성 -->
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/jquery-ui.js"></script> <!-- 레이어 드래그 -->
    <!-- 우측레이어 최근본 상품 -->
    <script src="js/Rightlayer-Slide.js"></script>
    <script src="js/right_slide.js"></script>
    <!-- 상단 제품검색 팝업 //**모바일용~//-->
    <script src="js/popup.js"></script>
    <!--브랜트코너 카테고리 팝업 -->
    <script src="js/bland_popuplayer.js"></script>
    <script src="js/form_file.js"></script>
    <script>
        $(document).ready(function() {
            fileInput();
        });
    </script>
    <!-- 게시판 첨부파일 속성 -->
    <!--제품미리보기 팝업창-->
    <link rel="stylesheet" href="css/popup/fancybox.css" type="text/css" media="all" />
    <script type="text/javascript" src="./js/popup/global.js"></script>
    <script type="text/javascript" src="./js/popup/jquery.fancybox.js"></script>
    <script type="text/javascript">
        var CUSTOMIZE_TEXTFIELD = 1;
        var FancyboxI18nClose = 'Close';
        var FancyboxI18nNext = 'Next';
        var FancyboxI18nPrev = 'Previous';
        var quickView = true;
    </script>
    <!--제품미리보기 팝업창-->
    <?
    if (!array_search($TARGETFILENAME, $jqcheck)) {    //모달창과 충돌이 있어서 회원가입부분에서 제외 이후 추가할것
    ?>
        <!-- istope소스코드 -->
        <script type="text/javascript" src="js/istope_main.js"></script>
        <script type="text/javascript" src="js/istope.js"></script>
        <script type="text/javascript">
            window.onload = (function() {
                //갤러리목록 진열
                $('#imglistBox').isotope({
                    sortBy: 'original-order',
                    itemSeletor: '.element',
                    itemPositionDataEnabled: true
                });
                //갤러리 상세이미지 크기설정 1140 보여주고자 하는 크기에 맞게 설정
                $("#item_img_content img, .resizablebox").each(function() {
                    var oImgWidth = $(this).width();
                    var oImgHeight = $(this).height();
                    var screenw = 1140;
                    if (screenw < oImgWidth) {
                        $(this).css({
                            'max-width': screenw + 'px',
                            'max-height': oImgHeight + 'px',
                            'width': '100%',
                            'height': 'auto'
                        });
                    } else {
                        $(this).css({
                            'max-width': oImgWidth + 'px',
                            'max-height': oImgHeight + 'px',
                            'width': '100%',
                            'height': 'auto'
                        });
                    }
                });
            });
        </script>
        <!-- //istope소스코드 -->
    <? } ?>
    <!--제품리스트 각 항목들의 좌우 화살표 버튼들 css-->
    <link rel="stylesheet" type="text/css" href="css/carousel.css" media="all" />
    <!--제품리스트 해상도별 레이아웃설정영역 css-->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="all" />
    <!--제품확대 모달팝업창 css-->
    <link rel="stylesheet" type="text/css" href="css/cloud-lightbox-zoom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/component.css" media="all" />
    <!-- 슬라이드속성-->
    <link rel="stylesheet" type="text/css" href="css/tm_flexslider.css" media="all" />
    <script src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/boardmenu.js"></script>
    <!--상단로테이트-->
    <script type="text/javascript" src="js/main/tm_jquery.flexslider.min.js"></script>
    <!--제품-->
    <script type="text/javascript" src="js/main/megnor.min.js"></script>
    <script type="text/javascript" src="js/main/jquery.selectbox-0.2.min.js"></script>
    <script type="text/javascript" src="js/main/carousel.min.js"></script>
    <script type="text/javascript" src="js/main/jstree.min.js"></script>
    <script type="text/javascript" src="js/main/jquery.colorbox.min.js"></script>
    <!--상품상세 썸네일이미지-->
    <?
    if (!array_search($TARGETFILENAME, $jqcheck)) {    //모달창과 충돌이 있어서 회원가입부분에서 제외 이후 추가할것
    ?>
        <!--하단배너들-->
        <script type="text/javascript" src="js/main/custom.js"></script>
    <? } ?>
    <script type='text/javascript' src='js/new/jquery.themepunch.tools.min.js'></script>
    <script type='text/javascript' src='js/new/jquery.themepunch.revolution.min.js'></script>
    <script type='text/javascript' src='js/new/bootstrap.min.js'></script>
    <script type='text/javascript' src='js/new/jquery.appear.js'></script>
    <script type='text/javascript' src='js/new/plugins.js'></script>
    <script type='text/javascript' src='js/new/main.js'></script>
    <script type='text/javascript' src='js/new/owl.carousel.min.js'></script>
    <script type='text/javascript' src='js/new/jquery.isotope.min.js'></script>
    <script type='text/javascript' src='js/new/new_layout.js'></script>
    <link rel="stylesheet" type="text/css" href="css/main/cloud-lightbox-zoom.css" media="all" />
    <!--상품상세 썸네일이미지-->
    <script type="text/javascript" src="js/main/cloud-zoom.1.0.2.js"></script>
    <!--상품상세 썸네일이미지-->
    <!-- 모바일용 페이지 슬라이드 탭메뉴 -->
    <script src="js/jquery.lbslider.js"></script>
    <script type="text/javascript" language="javascript" src="../cheditor/cheditor.js"></script>
    <script type="text/javascript" language="javascript" src="../lib/flash.js"></script>
    <LINK REL="stylesheet" HREF="../lib/oolim_button_style.css" TYPE="TEXT/CSS">
    <!--회사전경스크립트, css -->
    <link rel="stylesheet" href="css/galleria.classic.css">
    <script src="../lib/galleria-1.4.2.min.js"></script>
    <!-- 이미지 레이어 새창 -->
    <script type="text/javascript" src="../lib/jquery.lightbox.js"></script>
    <script type="text/javascript">
        function lightboxLoad() {
            jQuery(function() {
                jQuery("a[rel=lightbox]").slightbox();
            });
        }
        lightboxLoad();
    </script>
    <script type="text/javascript">
        function capsLock(e) {
            var keyCode = 0;
            var shiftKey = false;
            keyCode = e.keyCode;
            shiftKey = e.shiftKey;
            if (((keyCode >= 65 && keyCode <= 90) && !shiftKey) || ((keyCode >= 97 && keyCode <= 122) && shiftKey)) {
                alert("CapsLock이 켜져 있습니다");
                return;
            }
        }
    </script>
    <iframe src='' name='hidden_target' style="display:none"></iframe>
    <div id="viewImage"></div>
    <!-- //이미지 레이어 새창 -->
    <!-- 상태바 출력 -->
    <script language="JavaScript">
        <!--
        window.status = '<?= $design_stat->stat_title; ?>';
        //
        -->
    </script>
    <script language='javascript'>
        //사업자 확인
        function onopen(wrkr_no) {
            var url = "http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=" + wrkr_no;
            window.open(url, "communicationViewPopup", "width=750, height=500;");
        }
        //-->
    </script>
    <script language="JavaScript">
        function bluring() {
            if (event.srcElement.tagName == "A" || event.srcElement.tagName == "IMG") document.body.focus();
        }
        document.onfocusin = bluring;
    </script>
    <script language="JavaScript">
        <!--
        function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable) {
            toolbar_str = toolbar ? 'yes' : 'no';
            menubar_str = menubar ? 'yes' : 'no';
            statusbar_str = statusbar ? 'yes' : 'no';
            scrollbar_str = scrollbar ? 'yes' : 'no';
            resizable_str = resizable ? 'yes' : 'no';
            window.open(url, name, 'left=' + left + ',top=' + top + ',width=' + width + ',height=' + height + ',toolbar=' + toolbar_str + ',menubar=' + menubar_str + ',status=' + statusbar_str + ',scrollbars=' + scrollbar_str + ',resizable=' + resizable_str);
        }
        // 
        -->
    </script>
    <script language="JavaScript">
        <!--
        function na_restore_img_src(name, nsdoc) {
            var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc + '.' + name : 'document.all.' + name);
            if (name == '')
                return;
            if (img && img.altsrc) {
                img.src = img.altsrc;
                img.altsrc = null;
            }
        }

        function na_preload_img() {
            var img_list = na_preload_img.arguments;
            if (document.preloadlist == null)
                document.preloadlist = new Array();
            var top = document.preloadlist.length;
            for (var i = 0; i < img_list.length; i++) {
                document.preloadlist[top + i] = new Image;
                document.preloadlist[top + i].src = img_list[i + 1];
            }
        }

        function na_change_img_src(name, nsdoc, rpath, preload) {
            var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc + '.' + name : 'document.all.' + name);
            if (name == '')
                return;
            if (img) {
                img.altsrc = img.src;
                img.src = rpath;
            }
        }

        function brandChange(value) {
            location.href = "brand_list.php?search_order=" + value;
        }
        // 
        -->
    </script>
    <!--폰트축소 및 확대-->
    <script language='javascript'>
        // 폰트사이즈 조정
        var fontObj;
        var nowFontSz = 11; // 위의 CSS prtArt와 같은 사이즈로...
        function fontSz() {
            if (document.getElementById) fontObj = document.getElementById("fontSzArea").style;
            else if (document.all) fontObj = document.all("fontSzArea").style;
            if (arguments[0] == "-") {
                if (nowFontSz <= 9) return;
                fontObj.fontSize = (nowFontSz - 1) + "pt";
                nowFontSz = eval(nowFontSz - 1);
            } else if (arguments[0] == "+") {
                if (nowFontSz >= 14) return;
                fontObj.fontSize = (nowFontSz + 1) + "pt";
                nowFontSz = eval(nowFontSz + 1);
            }
        }
        // 프린트
        function pagePrint() {
            window.open("./bbs_print.php?board_data=<?= $MV_DATA; ?>&search_items=<?= $MV_SEARCH_ITEM; ?>", "_Print", "scrollbars=yes, width=710, height=600, left=0, top=0");
        }
        //레이어새창
        function open_cenlayer(url) {
            var el = "contentitemBox";
            document.contentlayerbox.location.href = url;
            if ($(document).width() > 500) {
                frame_box.width = 450;
                frame_box.height = 450;
            } else {
                frame_box.width = 300;
                frame_box.height = 300;
            }
            //frame_box.height = 500;
            var temp = $('#' + el);
            var bg = temp.prev().hasClass('bg'); //dimmed 레이어를 감지하기 위한 boolean 변수
            if (bg) {
                $('.full_layer').fadeIn(); //'bg' 클래스가 존재하면 레이어가 나타나고 배경은 dimmed 된다.
            } else {
                temp.fadeIn();
            }
            // 화면의 중앙에 레이어를 띄운다.
            if (temp.outerHeight() < $(document).height()) temp.css('margin-top', '-' + temp.outerHeight() / 2 + 'px');
            else temp.css('top', '0px');
            if (temp.outerWidth() < $(document).width()) temp.css('margin-left', '-' + temp.outerWidth() / 2 + 'px');
            else temp.css('left', '0px');
            temp.find('a.cbtn').click(function(e) {
                if (bg) {
                    $('.full_layer').fadeOut(); //'bg' 클래스가 존재하면 레이어를 사라지게 한다.
                } else {
                    temp.fadeOut();
                }
                e.preventDefault();
            });
            $('.full_layer .bg').click(function(e) { //배경을 클릭하면 레이어를 사라지게 하는 이벤트 핸들러
                $('.full_layer').fadeOut();
                e.preventDefault();
            });
        }

        function close_cenlayer() {
            $('.full_layer').fadeOut(); //'bg' 클래스가 존재하면 레이어를 사라지게 한다.
        }
        //레이어새창
        //-->
    </script>
    <!--폰트축소 및 확대-->
    <!-- 회원가입 css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/joinform_layout.css" media="screen and (max-width:980px)">
    <link rel="stylesheet" type="text/css" media="all" href="css/joinform_style.css">
    <!-- //회원가입 css-->
    <link rel="stylesheet" type="text/css" media="all" href="css/sub_divide.css">
    <!-- 모달팡업창 -->
    <link rel="stylesheet" href="css/modal_css/styles.css">
    <link rel="stylesheet" href="css/modal_css/jquery_modal.css">
    <link rel="stylesheet" href="css/modal_css/themes/light.css">
    <!-- 제품리스트에서 카테고리 클릭시 출력되는 카테고리 레이어 //모바일용 -->
    <link href="css/mtree.css" rel="stylesheet" type="text/css">
    <!--위로가기 버튼 생성-->
    <script type="text/javascript">
        $(function() {
            $(window).scroll(function() {
                var scrolltop = $(this).scrollTop();
                if (scrolltop >= 200) {
                    $("#elevator_item").show();
                } else {
                    $("#elevator_item").hide();
                }
            });
            $("#elevator").click(function() {
                $("html,body").animate({
                    scrollTop: 0
                }, 500);
            });
            $(".qr").hover(function() {
                $(".qr-popup").show();
            }, function() {
                $(".qr-popup").hide();
            });
        });
    </script>
    <!--모바일화면 상단메뉴 열고닫기-->
    <script type="text/javascript" src="js/mobilemenu_hide.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".accordion_example2").smk_Accordion({
                showIcon: true,
                animation: true,
                closeAble: true,
                slideSpeed: 200 //integer, miliseconds
            });
        });
        //오늘 본 상품
        jQuery(document).ready(function($) {
            $('.right_qmenu a.nav-toggle-open').click(function() {
                $('.today_view_area').animate({
                    'right': '0'
                });
                $('.right_qmenu').animate({
                    'right': '190px'
                });
                $(this).hide();
                $('.right_qmenu a.nav-toggle-close').show();
                return false
            });
            $('.right_qmenu a.nav-toggle-close').click(function() {
                $('.today_view_area').animate({
                    'right': '-190px'
                });
                $('.right_qmenu').animate({
                    'right': '0'
                });
                $(this).hide();
                $('.right_qmenu a.nav-toggle-open').show();
                return false
            });
            $('.right_qmenu a.p_top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                return false
            });
        });
    </script>
    <!--//모바일화면 상단메뉴 열고닫기-->
    <!-- 레이어 팝업-->
    <script language="javascript" src="../lib/popup.js"></script>
    <!-- 레이어 팝업
    <div id="elevator_item">
        <a id="elevator" onclick="return false;" title="Back To Top"></a>
    </div>-->
    <!-- ************사이트 전체 포인트 색상
    <style>
    .main_noticeL,.oolimbtn-botton2,.oolimbtn-botton4,.btn-type5_view,.company_smallBtn01,.company_smallBtn02,.company_smallBtn04
    .company_smallBtn00,.company_smallBtn01,.company_smallBtn04,.btn-type5_view,.idcheck2015,.divbox_text-center
    .main_cscenter-mini1,.divbox_text-center,.minibox_btn03_bold,.pagebox_div_btn3,.main_cscenter-server,.pagebox_div_btn1,.pagebox_div_btn2,.minibox_btn02_chomini_black,.minibox_btn03_chomini_black,.searchWi {background:#FF00D8;}
    .button_oolim_buttonOverL, .minibox_btn01_bold, .button2014oolim, .oolimbtn-botton5, .oolimbtn-botton1, .fileUpload, .fileBtn, .searchB, .smallBtn08, .sp_itemBtn01, .smallBtn_copy, .smallBtn07:hover{ background-color:#FF00D8;}
    .ui-select-list>li:hover { background-color: #FF00D8;}
    .ui-select-list>li.selected {background-color: #FF00D8;}
    .ui-select-list>li.disabled {background-color: #FF00D8;}
    .ui-select-list>li.disabled.selected {background-color: #FF00D8;}
    .fa-circ_font,.item_list_block,.new_price,.new_price_won,.price_cart_list1,.price_cart_point,.bbsnnews_date,.bbsnone1 {color:#FF00D8;}
    .bbs_newsA,.slide-oolim-arrow,.button_oolim_buttonOverL:hover { color:#FF00D8;}
    #cssmenu ul ul li a { background-color: #FF00D8; border-color:#FF00D8;}
    #cssmenu ul ul li a:hover {background-color: #FF00D8; border-color:#FF00D8;}
    #pagebox_icon_div_left:hover {background-color:#FF00D8;}
    #pagebox_icon_div_center1:hover {background-color:#FF00D8;}
    #pagebox_icon_div_center2:hover {background-color:#FF00D8;}
    #pagebox_icon_div_right:hover {background-color:#FF00D8;}
    #mainbox_divbox {background-color: #FF00D8;}
    #toggle_menu{ background-color:#FF00D8; }
    #toggle_menu:hover{background-color:#FF00D8;}
    #toggle_menu.mobile-active{background-color:#FF00D8;}
    #toggle_menu.mobile-active:after{background-color:#FF00D8;}
    #pagebox_div_text4 {color:#FF00D8;}
    .item_page_number_on,.item_page_number_off,.fa-gratipay-box,.fa-credit-card-box,.fa-shopping-cart-bo,.fa-search-plus-box:hover {
    background-color:#FF00D8;
    background: -webkit-linear-gradient(top,  #FF00D8 0%,#08A9D2 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #FF00D8 0%,#08A9D2 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #FF00D8 0%,#08A9D2 100%); /* IE10+ */
    background: linear-gradient(top,  #FF00D8 0%,#08A9D2 100%); /* W3C */
    }
    </style>
    ***********사이트 전체 포인트 색상-->
</head>

<body>
    <!--우측 레이어 오늘본 상품-->
    <div class="today_view_area">
        <h3 class="tit">Today VIEW</h3>
        <!--목록-->
        <ul class="view_list" id="todaylist">
            <?
            $show_cookie_name = $_SESSION[VIEW_LIST];
            //$show_arr = explode("&&", $HTTP_COOKIE_VARS[$show_cookie_name]);$ _COOKIE
            $show_arr = explode("&&", $_COOKIE[$show_cookie_name]);
            $show_cnt = 6;
            if ($show_cnt > count($show_arr) - 1) {
                $view_cnt = count($show_arr) - 1;
            } else {
                $view_cnt = $show_cnt;
            }
            if ($_COOKIE[$show_cookie_name]) {
                for ($i = 0; $i < $view_cnt; $i++) {
                    $goods_info = $db->object("cs_goods", "where idx='$show_arr[$i]'");
                    $quick_data = $tools->encode("idx=" . $goods_info->idx . "&startPage=" . $startPage . "&listNo=" . $listNo . "&table=" . $table . "&part_idx=" . $goods_info->part_idx . "&search_item=" . $search_item);
                    $ThumbEncode = $tools->encode("idx=" . $goods_info->idx . "&table=cs_goods&img=images1&dire=goodsImages&w=60&h=30");
                    $todayList++;
            ?>
                    <li>
                        <a href='product_view.php?part_idx=<?= $goods_info->part_idx; ?>&goods_data=<?= $quick_data; ?>'>
                            <dl>
                                <dt><img src='../data/goodsImages/<?= $goods_info->images1 ?>' style="width:60px;" /></dt>
                                <dd>
                                    <span class="prd_name"><?= $tools->strCut($goods_info->name, 55); ?></span>
                                    <!--제품명-->
                                    <span class="prd_price"></span>
                                    <!--가격-->
                                </dd>
                            </dl>
                        </a>
                    </li>
            <? }
            } ?>
            <? if ($todayList == 0) { ?>
                <li class="none_data">오늘 본 상품이 없습니다.</li>
            <? } ?>
        </ul>
        <!--//목록-->
        <!--컨트롤버튼-->
        <div class="con_btn">
            <?/*
		<a href="#" class="vc_goDown"><i class="fas fa-angle-left"></i></a>
		<a href="#" class="vc_goUp"><i class="fas fa-angle-right"></i></a>
		*/ ?>
            <a href="todayview_reset.iframe.php" target="hidden_target" title='리스트 삭제'><i class="fas fa-trash"></i></a>
        </div>
        <!--//컨트롤버튼-->
        <!--몰정보-->
        <ul class="mall_info">
            <li class="tit"><?= $admin_stat->shop_name; ?> 고객센터</li>
            <li class="tel"><?= $admin_stat->shop_tel1; ?></li>
            <li class="time"><?= $tools->strHtmlBr($admin_stat->week); ?></li>
        </ul>
        <ul class="mall_info">
            <li class="tit">계좌안내</li>
            <?
            $bankResult = $db->select("cs_banklist", "where main_marking=1 order by idx asc");
            while ($bankRow = @mysqli_fetch_object($bankResult)) { ?>
                <li><?= $bankRow->bank_name ?> : <?= $bankRow->bank_account ?></li>
                <li>예금주 : <?= $bankRow->name ?></li>
            <? } ?>
        </ul>
        <!--//몰정보-->
    </div>
    <div class="right_qmenu">
        <ul>
            <li>
                <a href="#" class="nav-toggle-open" title="오늘 본 상품 열기"><img src="images/right_qmenu_i_01.gif" /></a>
                <a href="#" class="nav-toggle-close" title="오늘 본 상품 닫기" style="display:none"><img src="images/right_qmenu_i_11.gif" /></a>
            </li>
            <!--<li><a href="#" class="search_btn" title="상품검색"><img src="images/right_qmenu_i_02.gif"/></a></li>-->
            <li><a href="mypage.php" title="마이페이지"><img src="images/right_qmenu_i_03.gif" /></a></li>
            <li><a href="cart.php" title="장바구니"><img src="images/right_qmenu_i_04.gif" /></a></li>
            <li><a href="my_wishlist.php" title="관심상품"><img src="images/right_qmenu_i_05.gif" /></a></li>
            <li><a href="my_order_list.php" title="주문조회"><img src="images/right_qmenu_i_06.gif" /></a></li>
            <!--<li><a href="#" class="nav-toggle" title="오늘 본 상품"><img src="images/right_qmenu_i_07.gif"/></a></li>-->
            <li><a href="https://open.kakao.com/o/szOtqofd" title="카카오톡"><img src="images/right_qmenu_i_08.gif" /></a></li>
            <li><a href="#" class="p_top" title="위로"><img src="images/right_qmenu_i_09.gif" /></a></li>
            <!--<li><a href="#" title="아래로"><img src="images/right_qmenu_i_10.gif"/></a></li>-->
        </ul>
    </div>
    <script>
        $(".verticalCarousel").verticalCarousel({
            currentItem: 1,
            showItems: 3, // 제품 출력 갯수
        });

        function recall() {
            $(".verticalCarousel").verticalCarousel({
                currentItem: 1,
                showItems: 3, // 제품 출력 갯수
            });
        }
        var wrapper = $("#site-wrapper"),
            menu = $(".menu-oolimslide"),
            menuLinks = $(".menu-oolimslide ul li a"),
            toggle = $(".nav-toggle"),
            toggleIcon = $(".nav-toggle span");

        function toggleThatNav() {
            if (menu.hasClass("show-nav")) {
                if (!Modernizr.csstransforms) {
                    menu.removeClass("show-nav");
                    toggle.removeClass("show-nav");
                    menu.animate({
                        right: "-=300"
                    }, 500);
                    toggle.animate({
                        right: "-=300"
                    }, 500);
                } else {
                    menu.removeClass("show-nav");
                    toggle.removeClass("show-nav");
                }
            } else {
                if (!Modernizr.csstransforms) {
                    menu.addClass("show-nav");
                    toggle.addClass("show-nav");
                    menu.css("right", "0px");
                    toggle.css("right", "330px");
                } else {
                    menu.addClass("show-nav");
                    toggle.addClass("show-nav");
                }
            }
        }

        function changeToggleClass() {
            toggleIcon.toggleClass("fa-times");
            toggleIcon.toggleClass("fa-bars");
        }
        $(function() {
            toggle.on("click", function(e) {
                e.stopPropagation();
                e.preventDefault();
                toggleThatNav();
                changeToggleClass();
            });
            // Keyboard Esc event support
            $(document).keyup(function(e) {
                if (e.keyCode == 27) {
                    if (menu.hasClass("show-nav")) {
                        if (!Modernizr.csstransforms) {
                            menu.removeClass("show-nav");
                            toggle.removeClass("show-nav");
                            menu.css("right", "-300px");
                            toggle.css("right", "30px");
                            changeToggleClass();
                        } else {
                            menu.removeClass("show-nav");
                            toggle.removeClass("show-nav");
                            changeToggleClass();
                        }
                    }
                }
            });
        });

        function ajaxtodayview() {
            $.ajax({
                type: "GET",
                url: "ajax_today_list.php",
                data: "",
                cache: false,
                success: function(html) {
                    $("ul#todaylist").html(html);
                    recall();
                }
            });
        }

        function bookmarkaddsite(url, title) {
            // Internet Explorer
            if (document.all) {
                window.external.AddFavorite(url, title);
            }
            // Google Chrome
            else if (window.chrome) {
                alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.");
            }
            // Firefox
            else if (window.sidebar) // firefox 
            {
                window.sidebar.addPanel(title, url, "");
            }
            // Opera
            else if (window.opera && window.print) { // opera 
                var elem = document.createElement('a');
                elem.setAttribute('href', url);
                elem.setAttribute('title', title);
                elem.setAttribute('rel', 'sidebar');
                elem.click();
            }
        }
    </script>
    <!--//////우측 레이어 오늘본 상품-->
    <div class='container-fluid Desktop_Version Mobile_Version'>
 