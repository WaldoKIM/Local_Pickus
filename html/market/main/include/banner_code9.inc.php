<script type="text/javascript">    /*Main Banner*/    (function ($) {        $(document).ready(function () {            //Slide            $('.slides_banner').flexslider({
                animation: "",
                pauseOnAction: false,
                pauseOnHover: true,
                controlNav: true,
                slideshow: false,
                directionNav: false,
                animationSpeed: 1000,
                slideshowSpeed: 5000,
            });
        });
    })(jQuery);
</script>
<?
$banner_code = "banner_code9";
if($db->cnt( "cs_banner", "where status='$banner_code'" )) {
?>
<div class="slides_banner">    <ul class="slides">        <?        $bannerCnt = 0;        $result	= $db->select("cs_banner", "where status='$banner_code' order by idx asc limit 2" );        while( $row = mysqli_fetch_object($result)) {        $bannerCnt++;        ?>        <? if($row->type==1) {//HTML?>        <?=$row->content;?>        <?}else if($row->type==2){//IMG?>        <li>            <? if($row->link_url) {?>            <a href="http://<?=$row->link_url;?>" target="<? if($row->target) { echo('_self'); } else { echo('_blank');}?>"><img src="../data/designImages/<?=$row->banner_images;?>" border="0"></a><?            } else {            ?><img src="../data/designImages/<?=$row->banner_images;?>" border="0"><?            }?>        </li>        <?}        }?>    </ul></div><?}else{?><table width="315">    <tr>        <td align="center"><font color='red'>관리자페이지에서 디자인설정>배너설정부분의 banner_code9 등록해 주세요.</font></td>    </tr></table><?}?>