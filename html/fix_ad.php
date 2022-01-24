<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<style>
    @media(max-width:1100px){
    .fix_ad{
        position:fixed !important;  
        left:0px !important; 
        bottom:0px !important; 
        width:100% !important; 
        color: #6e6e6e !important;  
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: flex-end !important;
        z-index: 99999999 !important;
    }

    #close_td{
        font-size: 12px;
        padding: 1%;
        font-weight: bold;
        position: absolute;
        top: 0;
    }

}
@media(min-width:1101px){
	.fix_ad{
        position:fixed !important;  
        left:20% !important; 
        bottom:0px !important; 
        margin: auto !important;
        width:60% !important; 
        color: #6e6e6e !important;  
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: flex-end !important;
        z-index: 99999999 !important;
        
    }
    
    #close_td{
        font-size: 16px;
        padding: 1%;
        font-weight: bold;
        position: absolute;
        top: 0;
    }
}
</style>
<div id="ad_pop">
    <div id="fix_ad" class="fix_ad">
        <a id="close_td" href="javascript:;">오늘 하루 보지 않기</a>
        <a style="width:100%;" href="http://naver.me/GQ4ICeSI" target="_blank">
            <picture>
            <source media="(max-width: 321px)" srcset="/bbs/images/mobile_ad1.png">
            <source media="(max-width: 376px)" srcset="/bbs/images/mobile_ad2.png">
            <source media="(max-width: 415px)" srcset="/bbs/images/mobile_ad3.png">
            <img src="/bbs/images/web_ad.png">
            </picture>
        </a>
    </div>
</div>

<head>

<!-- 레이어팝업시작 -->
<script language="Javascript">

$(document).ready(function () {
                $("#close_td").click(function () {
                    setCookieMobile( "todayCookie", "done" , 1);
                    $("#ad_pop").hide();
                });
            });
             
            function setCookieMobile ( name, value, expiredays ) {
                var todayDate = new Date();
                todayDate.setDate( todayDate.getDate() + expiredays );
                document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
            }
            function getCookieMobile () {
                var cookiedata = document.cookie;
                if ( cookiedata.indexOf("todayCookie=done") < 0 ){
                     $("#ad_pop").show();
                }
                else {
                    $("#ad_pop").hide();
                }
            }
            getCookieMobile();

</script>


