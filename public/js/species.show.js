$(function() {

    var pswpElement = document.querySelectorAll('.pswp')[0];

    var items = [];

    $(".species-image > a").each(function(index, elem){
        items.push({
            src: $(elem).attr("href"),
            w: $(elem).data("width"),
            h: $(elem).data("height")
        });
        $(elem).data("index", index);
    });

    $(".species-image > a").click(function(e){
        new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, {
            index : $(this).data("index")
        }).init();
        return false;
    });

});