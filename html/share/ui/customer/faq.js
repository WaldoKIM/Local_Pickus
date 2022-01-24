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