<script type="text/javascript">
    $(document).ready(function() {
        $('a.all_catecory').click(function() {
            $('.cate_menu .category_menu').show();
            return false
        });
        $(".cate_menu .category_menu").mouseleave(function() {
            $(this).hide();
            $('ul.two_depth').hide();
            $('ul.three_depth').hide();
        });
        $(".cate_menu li.one_cate").mouseover(function() {
            $('.cate_menu li.one_cate a.one_depth_link').removeClass('on');
            $('ul.two_depth').hide();
            $(this).find('ul.two_depth').show();
            $(this).find('a.one_depth_link').addClass('on');
            return false;
        });
        $(".cate_menu li.two_cate").mouseover(function() {
            $('.cate_menu li.two_cate a.two_depth_link').removeClass('on');
            $('ul.three_depth').hide();
            $(this).find('ul.three_depth').show();
            $(this).find('a.two_depth_link').addClass('on');
            return false;
        });
    });
</script>
<style>
    #header {
        border-top: 1px solid #d6d6d6;
        border-bottom: 1px solid #d6d6d6;
        width: 100%;
        display: block
    }

    #header:after {
        background: -moz-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, #<?= $design_stat->menu_bg_color1 ?>), color-stop(100%, #<?= $design_stat->menu_bg_color2 ?>));
        background: -webkit-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -o-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -ms-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: linear-gradient(to right, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?= $design_stat->menu_bg_color1 ?>', endColorstr='#<?= $design_stat->menu_bg_color2 ?>', GradientType=1);
    }

    #mainslider+#header,
    #mainslider+#header_wrapper>#header.affix-top {
        position: static;
        z-index: 2000;
        background: -moz-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%, #<?= $design_stat->menu_bg_color1 ?>), color-stop(100%, #<?= $design_stat->menu_bg_color2 ?>));
        background: -webkit-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -o-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: -ms-linear-gradient(left, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        background: linear-gradient(to right, #<?= $design_stat->menu_bg_color1 ?> 0%, #<?= $design_stat->menu_bg_color2 ?> 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?= $design_stat->menu_bg_color1 ?>', endColorstr='#<?= $design_stat->menu_bg_color2 ?>', GradientType=1);
    }

    #navigation-menu {
        text-align: center;
        line-height: 0
    }

    nav#mainmenu_wrapper {
        width: 1200px;
        display: inline-block;
    }

    nav#mainmenu_wrapper .cate_menu {
        float: left;
        position: relative
    }

    nav#mainmenu_wrapper .cate_menu a.all_catecory {
        height: 50px;
        float: left;
        line-height: 50px;
        padding: 0 20px;
        background: #1379cd;
        color: #fff;
        font-weight: bold;
    }

    nav#mainmenu_wrapper .cate_menu a.all_catecory i {
        vertical-align: middle;
        margin-right: 5px
    }

    nav#mainmenu_wrapper .cate_menu * {
        box-sizing: border-box
    }

    nav#mainmenu_wrapper .category_menu {
        position: absolute;
        left: 0;
        top: 50px;
        display: none
    }

    nav#mainmenu_wrapper .category_menu ul.one_depth {
        width: 230px;
        float: left;
        border: 1px solid #ccc;
        background: #fff
    }

    nav#mainmenu_wrapper .category_menu li.one_cate {
        width: 100%;
        text-align: left;
        float: left
    }

    nav#mainmenu_wrapper .category_menu a.one_depth_link {
        width: 230px;
        float: left;
        line-height: 1em
    }

    nav#mainmenu_wrapper .category_menu a.one_depth_link span {
        width: 100%;
        display: block;
        padding: 15px;
        border-bottom: 1px dotted #ccc
    }

    nav#mainmenu_wrapper .category_menu a.one_depth_link:hover {
        background: #1379cd;
        color: #fff;
        width:100%;
    }

    nav#mainmenu_wrapper .category_menu a.one_depth_link.on {
        background: #1379cd;
        color: #fff;
        width: 100%;
    }

    nav#mainmenu_wrapper .category_menu li.one_cate:last-child a.one_depth_link span {
        border-bottom: none
    }

    nav#mainmenu_wrapper .category_menu ul.two_depth {
        width: 230px;
        position: absolute;
        top: 0;
        left: 229px;
        border: 1px solid #ccc;
        background: #fff;
        display: none
    }

    nav#mainmenu_wrapper .category_menu li.two_cate {
        width: 100%;
        text-align: left;
        display: inline-block
    }

    nav#mainmenu_wrapper .category_menu a.two_depth_link {
        width: 230px;
        float: left;
        line-height: 1em
    }

    nav#mainmenu_wrapper .category_menu a.two_depth_link span {
        width: 100%;
        display: block;
        padding: 15px;
        border-bottom: 1px dotted #ccc
    }

    nav#mainmenu_wrapper .category_menu a.two_depth_link:hover {
        background: #1379cd;
        color: #fff;
        width:100%;
    }

    nav#mainmenu_wrapper .category_menu a.two_depth_link.on {
        background: #1379cd;
        color: #fff;
        width:100%;
    }

    nav#mainmenu_wrapper .category_menu li.two_cate:last-child a.two_depth_link span {
        border-bottom: none
    }

    nav#mainmenu_wrapper .category_menu ul.three_depth {
        width: 230px;
        position: absolute;
        top: -1px;
        left: 228px;
        border: 1px solid #ccc;
        background: #fff;
        display: none
    }

    nav#mainmenu_wrapper .category_menu li.three_cate {
        width: 100%;
        text-align: left;
        display: inline-block
    }

    nav#mainmenu_wrapper .category_menu a.three_depth_link {
        width: 230px;
        float: left;
        line-height: 1em
    }

    nav#mainmenu_wrapper .category_menu a.three_depth_link span {
        width: 100%;
        display: block;
        padding: 15px;
        border-bottom: 1px dotted #ccc
    }

    nav#mainmenu_wrapper .category_menu a.three_depth_link:hover {
        background: #000;
        color: #fff
    }

    nav#mainmenu_wrapper .category_menu li.three_cate:last-child a.three_depth_link span {
        border-bottom: none
    }

    nav#mainmenu_wrapper .cate_menu>ul {
        float: left
    }

    nav#mainmenu_wrapper .ad_menu {
        float: right
    }

    nav#mainmenu_wrapper .ad_menu>ul {
        float: right
    }

    nav#mainmenu_wrapper .ad_menu>ul>li {
        float: left;
        margin-left: 1px
    }

    nav#mainmenu_wrapper .ad_menu a.sf-menu_link {
        background: url(./images/ad_menu_bg.gif)
    }

    .sf-menu ul {
        /************pc ???????????? ??????????????????, Box????????????****************/
        text-align: left;
        list-style: none;
        padding: 0 0;
        background-color: #<?= $design_stat->submenu_bg_color ?>;
        border-bottom: 1px solid #<?= $design_stat->submenu_line_color ?>;
        border-right: 1px solid #<?= $design_stat->submenu_line_color ?>;
        border-left: 1px solid #<?= $design_stat->submenu_line_color ?>;
        box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.1);
        min-width: 17em;
        *width: 17em;
    }

    .sf-menu>li>a {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: <?= $design_stat->menu_padding_left ?>px;
        /***pc 1????????? ????????????***/
        padding-right: <?= $design_stat->menu_padding_right ?>px;
        /***pc 1????????? ????????????***/
        color: #<?= $design_stat->menu_text_color ?>;
        /************pc 1????????? ??????****************/
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        
    }

    .sf-menu>li>a:hover,
    .sf-menu>li.active>a {
        color: #<?= $design_stat->menu_text_color_hover ?>;
        /************pc 1????????? ?????? hover ??????****************/
    }

    .sf-menu>li>a:hover {
        background-color: rgba(255, 255, 255, 0.10);
        /**2016 06 25??????*/
        text-transform: uppercase;
        z-index: 9;
    }

    .sub-menu_link li a {
        /************pc 2????????? ????????????****************/
        font-size: 11pt;
        color: #<?= $design_stat->submenu_text_color ?>;
        text-transform: uppercase;
    }

    .sub-menu_link li a:hover {
        /************pc 2????????? ?????? hover ??????****************/
        font-size: 11pt;
        color: #<?= $design_stat->submenu_text_color_hover ?>;
        background-color: #<?= $design_stat->submenu_over_color ?>;
        /*****************************************************2016 06 25??????*/
    }

    .sf-menu,
    .sf-menu ul {
        padding: 0;
        list-style: none;
        font-family: 'RixSGo M', 'NanumBarunGothic', 'NanumBarunGothicBold', "Dotum", 'Gulim', sans-serif;
    }

    .sf-menu li {
        position: relative;
    }

    .sf-menu ul {
        position: absolute;
        display: none;
        top: 100%;
        z-index: 9999;
    }

    .sf-menu>li>ul {
        /************pc ????????????Box??????****************/
        left: 0;
        margin-left: 0px;
        border-top: 1px solid #ddd
    }

    .sf-menu li:hover>ul,
    .sf-menu li.sfHover>ul {
        display: block
    }

    .sf-menu a {
        display: block;
        position: relative;
    }

    .sf-menu ul ul {
        top: 0;
        left: 100%;
    }

    .sf-menu {
        text-align: center;
    }

    .sf-menu a {
        padding: .50em 1.1em;
        /************pc 2????????? ??????****************/
        text-decoration: none;
        zoom: 1;
    }

    .sf-menu li {
        white-space: nowrap;
        *white-space: normal;
        -webkit-transition: background .2s;
        transition: background .2s;
    }

    .sf-menu>li {
        display: inline-block;
        padding: 0 0;
        /************pc 1????????? ??????****************/
        position: relative;
    }

    .sf-menu>li+li:before {
        content: '';
        width: 1px;
        height: 20px;
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -9px;
        background-color: rgba(255, 255, 255, 0.15);
        /************pc ???????????? ?????? ??????****************/
    }

    .sf-menu ul a {
        font-size: 14px;
        font-weight: 400;
        text-transform: uppercase;
    }

    .sf-menu ul a.menu-link2 {
        font-size: 13px;
        padding: 20px 10px
    }

    .sf-menu ul>li+li:before {
        position: absolute;
        content: '';
        height: 1px;
        left: 0;
        right: 15px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.07);
    }

    .sf-menu ul a:hover,
    .sf-menu ul li.active a {
        color: #<?= $design_stat->submenu_text_color_hover ?>;
    }

    #header.desktop-hide {
        opacity: 0;
        visibility: hidden;
    }

    .sf-menu>li>ul.customer_list {
        left: initial;
        right: 0
    }

    .sf-menu>li>ul.customer_list li a {
        padding: 20px 10px
    }

    /*************PC??? ?????? ??????**???????????? ????????? css/new/style.css****************/
    /*Tablet*/
    @media all and (max-width:1200px) {
        nav#mainmenu_wrapper {
            width: 100%
        }

        nav#mainmenu_wrapper .cate_menu ul.cate_gnb {
            display: none
        }
    }
</style>
<!--????????????-->
<header id="header" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" id="navigation-menu">
                <nav id="mainmenu_wrapper">
                    <div class="cate_menu">
                        <a href="#" class="all_catecory"><i class="fas fa-bars"></i>?????? ????????????</a>
                        <!--main cate-->
                        <div class="category_menu">
                            <ul class="one_depth">
                                <?
                                $part1_result = $db->select("cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
                                // ?????????
                                while ($part1_row = @mysqli_fetch_object($part1_result)) {
                                    $depth2_cnt = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
                                    // ???????????? ????????? ??????
                                    if ($part1_row->list_display_check == 1) {
                                        $P1_images = "../data/designImages/" . $part1_row->list_display_images1;
                                    }
                                    // ???????????? ??????????????? ??????(????????? ?????????)
                                    if ($part1_row->list_display_check == 2) {
                                        $P1_images = "../data/designImages/" . $part1_row->list_display_images1;
                                        $P2_images = "../data/designImages/" . $part1_row->list_display_images2;
                                    }
                                    if (!$depth2_cnt) {
                                ?>
                                        <li class="one_cate">
                                            <a href="<? if ($part1_row->url) { ?><?= $part1_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part1_row->idx; ?><? } ?>" class="one_depth_link">
                                                <? if ($part1_row->list_display_check == 1) { ?><img src="<?= $P1_images; ?>" border="0" align="absmiddle">
                                                <? } else if ($part1_row->list_display_check == 2) { ?><a href="<? if ($part1_row->url) { ?><?= $part1_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part1_row->idx; ?><? } ?>" onMouseOver='rollover<?= $part1_row->idx ?>.src="<?= $P2_images; ?>"' onMouseOut='rollover<?= $part1_row->idx ?>.src="<?= $P1_images; ?>"'>
                                                        <img src="<?= $P1_images; ?>" name="rollover<?= $part1_row->idx ?>" border="0" align="absmiddle">
                                                    <? } else { ?><span><?= $part1_row->part_name; ?></span><? } ?>
                                                    </a>
                                        </li>
                                    <? } else { ?>
                                        <li class="one_cate">
                                            <a href="<? if ($part1_row->url) { ?><?= $part1_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part1_row->idx; ?><? } ?>" class="one_depth_link">
                                                <? if ($part1_row->list_display_check == 1) { ?><img src="<?= $P1_images; ?>" border="0" align="absmiddle">
                                                <? } else if ($part1_row->list_display_check == 2) { ?><a href="<? if ($part1_row->url) { ?><?= $part1_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part1_row->idx; ?><? } ?>" onMouseOver='rollover<?= $part1_row->idx ?>.src="<?= $P2_images; ?>"' onMouseOut='rollover<?= $part1_row->idx ?>.src="<?= $P1_images; ?>"'>
                                                        <img src="<?= $P1_images; ?>" name="rollover<?= $part1_row->idx ?>" border="0" align="absmiddle">
                                                    <? } else { ?><span><?= $part1_row->part_name; ?></span><? } ?>
                                                    </a>
                                                    <ul class="two_depth">
                                                        <?
                                                        //????????? ??????
                                                        $part2_result = $db->select("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code' order by part_ranking asc");
                                                        while ($part2_row = mysqli_fetch_object($part2_result)) {
                                                            $depth3_cnt = $db->cnt("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code'");
                                                            if (!$depth3_cnt) {
                                                        ?>
                                                                <li class="two_cate"><a href="<? if ($part2_row->url) { ?><?= $part2_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part2_row->idx; ?><? } ?>" class="two_depth_link"><span><?= $part2_row->part_name; ?></span></a></li>
                                                            <? } else { ?>
                                                                <li class="two_cate">
                                                                    <a href="<? if ($part2_row->url) { ?><?= $part2_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part2_row->idx; ?><? } ?>" class="two_depth_link"><span><?= $part2_row->part_name; ?></span></a>
                                                                    <ul class="three_depth">
                                                                        <?
                                                                        //???????????? ??????
                                                                        $part3_result = $db->select("cs_part", "where part_index=3 and part_display_check=1 and part1_code='$part1_row->part1_code' and part2_code='$part2_row->part2_code' order by part_ranking asc");
                                                                        while ($part3_row = mysqli_fetch_object($part3_result)) {
                                                                        ?>
                                                                            <li class="three_cate"><a href="<? if ($part3_row->url) { ?><?= $part3_row->url ?><? } else { ?>product_list.php?part_idx=<?= $part3_row->idx; ?><? } ?>" class="three_depth_link"><span><?= $part3_row->part_name; ?></span></a></li>
                                                                        <? } ?>
                                                                    </ul>
                                                                </li>
                                                            <? } ?>
                                                        <? } ?>
                                                    </ul>
                                        </li>
                                <? }
                                } ?>
                            </ul>
                        </div>
                        <!--//main cate-->
                        <ul class="nav sf-menu cate_gnb">
                            <? // include('./include/category.inc.php');
                            ?>
                            <? include('shopcate.inc.php'); ?>
                        </ul>
                    </div>
                    <div class="ad_menu">
                        <ul class="nav sf-menu">
                            <li><a class="sf-menu_link" href="../../">????????? ???</a></li>
                            <li><a class="sf-menu_link" href="../../bbs/faq.php">????????????</a></li>
                            <?
                            $navresult    = $db->select("cs_navigation", "where open=1 order by ranking asc");
                            while ($navrow = mysqli_fetch_object($navresult)) {
                                if ($navrow->tablename != "cs_part_fixed") { ?>
                                    <li>
                                        <a href="<?= $navrow->url ?>" class='sf-menu_link'><?= $navrow->title ?></a><? }
                                                                                                            if ($navrow->tablename) {
                                                                                                                if ($navrow->tablename == "cs_page") {
                                                                                                                    if ($db->cnt("cs_page", "order by idx desc")) {
                                                                                                                ?>
                                                <ul class="sub-menu_link">
                                                    <?
                                                                                                                        $result1    = $db->select("cs_page", "order by idx desc");
                                                                                                                        while ($navrow1 = mysqli_fetch_object($result1)) {
                                                    ?>
                                                        <li><a href="pageview.php?url=<?= $navrow1->page_index; ?>"><?= $navrow1->title ?></a></li>
                                                    <? } ?>
                                                </ul>
                                            <? } ?>
                                        <? } else if ($navrow->tablename == "cs_bbs") { ?>
                                            <ul class="sub-menu_link customer_list">
                                                <li><a href="customer.php">????????????</a></li>
                                                <?
                                                                                                                    $result1    = $db->select("cs_bbs", "order by code asc");
                                                                                                                    while ($navrow1 = mysqli_fetch_object($result1)) {
                                                ?>
                                                    <li><a href="bbs_list.php?code=<?= $navrow1->code; ?>"><?= $navrow1->name ?></a></li>
                                                <? } ?>
                                            </ul>
                                        <? } else if ($navrow->tablename == "cs_part_fixed") { ?>
                                    </li>
                                    <?
                                                                                                                    $result1    = $db->select("cs_part_fixed", "where part_display_check=1 order by part_ranking asc");
                                                                                                                    while ($navrow1 = mysqli_fetch_object($result1)) {
                                    ?>
                                        <li><a href="<?= $navrow1->urllink ?>" class='sf-menu_link'><?= $navrow1->part_name ?></a></li>
                                    <? } ?>
                                <? } ?>
                            <? } ?>
                            <? if ($navrow->tablename == "cs_part_fixed") { ?></li><? }
                                                                        } ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <!--col-sm-12-->
        </div>
        <!--row-->
    </div>
    <!--container-->
</header>
<span id="toggle_menu"><span></span></span>
<!--????????????End-->
<!--??????????????? ?????? ??????-->
<? if ($TARGETFILENAME == "index.php") include('include/maintitle.inc.php'); ?>
<!--??????????????? ?????? End-->

</div>