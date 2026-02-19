jQuery(document).ready(function($) {
    var currentIndex = 0;
    var items = $('.rlq-slider-item');
    var itemAmt = items.length;

    function cycleItems() {
        var item = $('.rlq-slider-item').eq(currentIndex);
        items.hide();
        item.css('display', 'block');
    }

    var autoSlide = setInterval(function() {
        currentIndex += 1;
        if (currentIndex > itemAmt - 1) {
            currentIndex = 0;
        }
        cycleItems();
    }, 5000); // 5 seconds

    $('.rlq-slider-next').click(function() {
        clearInterval(autoSlide);
        currentIndex += 1;
        if (currentIndex > itemAmt - 1) {
            currentIndex = 0;
        }
        cycleItems();
    });

    $('.rlq-slider-prev').click(function() {
        clearInterval(autoSlide);
        currentIndex -= 1;
        if (currentIndex < 0) {
            currentIndex = itemAmt - 1;
        }
        cycleItems();
    });
});
