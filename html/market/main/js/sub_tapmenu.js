$(function() {
  var items = $('#navMenu-items_scroll_oolim').width();
  var itemSelected = document.getElementsByClassName('navMenu-item_scroll_oolim');
  navPointerScroll($(itemSelected));
  $("#navMenu-items_scroll_oolim").scrollLeft(200).delay(200).animate({
    scrollLeft: "-=200"
  }, 2000, "easeOutQuad");
 
	$('.navMenu-paddle-right_scroll_oolim').click(function () {
		$("#navMenu-items_scroll_oolim").animate({
			scrollLeft: '+='+items
		});
	});
	$('.navMenu-paddle-left_scroll_oolim').click(function () {
		$( "#navMenu-items_scroll_oolim" ).animate({
			scrollLeft: "-="+items
		});
	});

  if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    var scrolling = false;

    $(".navMenu-paddle-right_scroll_oolim").bind("mouseover", function(event) {
        scrolling = true;
        scrollContent("right");
    }).bind("mouseout", function(event) {
        scrolling = false;
    });

    $(".navMenu-paddle-left_scroll_oolim").bind("mouseover", function(event) {
        scrolling = true;
        scrollContent("left");
    }).bind("mouseout", function(event) {
        scrolling = false;
    });

    function scrollContent(direction) {
        var amount = (direction === "left" ? "-=3px" : "+=3px");
        $("#navMenu-items_scroll_oolim").animate({
            scrollLeft: amount
        }, 1, function() {
            if (scrolling) {
                scrollContent(direction);
            }
        });
    }
  }
  
  $('.navMenu-item_scroll_oolim').click(function () {
		$('#navMenu_scroll_oolim').find('.active_scroll_oolim').removeClass('active_scroll_oolim');
		$(this).addClass("active_scroll_oolim");
		navPointerScroll($(this));
	});

});

function navPointerScroll(ele) {

	var parentScroll = $("#navMenu-items_scroll_oolim").scrollLeft();
	var offset = ($(ele).offset().left - $('#navMenu-items_scroll_oolim').offset().left);
	var totalelement = offset + $(ele).outerWidth()/2;

	var rt = (($(ele).offset().left) - ($('#navMenu-wrapper_scroll_oolim').offset().left) + ($(ele).outerWidth())/2);
	$('#menuSelector_scroll_oolim').animate({
		left: totalelement + parentScroll
	})
}
