$(function() {

    var pswpElement = document.querySelectorAll('.pswp')[0];

    var items = [];

    $(".species-image > a").each(function(index, elem){
        items.push({
            src: $(elem).attr("href"),
            w: $(elem).data("width"),
            h: $(elem).data("height")
        });
    });

// define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };

// Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();

});