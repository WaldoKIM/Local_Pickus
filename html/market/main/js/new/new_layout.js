(function ($) {
    $(document).ready(function () {
        //Best Item Slider
        var $window = $(window),
            flexslider = { vars: {} };
        //해상도
        function getGridSize() {
            return (window.innerWidth < 840) ? 2 :
                (window.innerWidth < 900) ? 2 : 3;
        }
        $(function () {
            SyntaxHighlighter.all();
        });
        $window.load(function () {
            $('.prd_list_area .prd_list_best').flexslider({
                animation: "slide",
                animationLoop: true,
                itemWidth: 210,
                itemMargin: 5,
                move: 1,
                controlNav: false,
                directionNav: false,
                minItems: getGridSize(),
                maxItems: getGridSize() 
            });
        });
        //크기조정
        $window.resize(function () {
            var gridSize = getGridSize();
            flexslider.vars.minItems = gridSize;
            flexslider.vars.maxItems = gridSize;
        });
    });
})(jQuery);