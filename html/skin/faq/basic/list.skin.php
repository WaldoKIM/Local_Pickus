<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>

<div class="member com_pd">
    <div class="container">
    	<div class="sub_title">
			<h1 class="main_co">FAQ</h1>
			<p class="tit_desc">자주하는 질문을 모았습니다.</p>
		</div>
        <div>
            <ul class="tab">
                <li style="display: none;" class="col-xs-4">
                    <a href="./notice.php">공지사항</a>
                </li>
                <li class="col-xs-6">
                    <a href="./qna.php">1:1문의</a>
                </li>
                <li class="col-xs-6 on">
                    <a href="#.">FAQ</a>
                </li>
            </ul>
        </div>
        
        <div id="board">

            <div class="faq">
                <ul>
                <?php
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                ?>
                    <li class="q">
                        <div class="type"><span>Q</span></div>
                        <div class="title"><?php echo $row['fa_subject'] ?></div>
                        <div class="icon">
                            <span class="xi-angle-up up" aria-hidden="true"></span>
                            <span class="xi-angle-down down" aria-hidden="true"></span>
                        </div>
                    </li>
                    <li class="a">
                        <div class="type"><span>A</span></div>
                        <div class="con">
                            <?php echo $row['fa_content'] ?>
                        </div>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div><!-- faq -->
            
        </div><!-- board -->

    </div><!-- container -->
</div><!-- member -->
<script type="text/javascript">
$(function(){
    $(".faq .q").click(function(){
        $(".faq .a").slideUp();
        $('.icon .down').css('display','block');
        $('.icon .up').css('display','none');
        if(!$(this).next().is(":visible"))
        {
            $(this).next().slideDown();
            $(this).find('.icon .down:eq(0)').css('display','none');
            $(this).find('.icon .up:eq(0)').css('display','block');
        }
    })
})    
</script>