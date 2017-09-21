$(function() {

    var pswpElement = document.querySelectorAll('.pswp')[0];

    function createGallery(thumbnails){

        var items = [];

        thumbnails.each(function(index, elem){
            items.push({
                src: $(elem).attr("href"),
                w: $(elem).data("width"),
                h: $(elem).data("height")
            });
            $(elem).data("index", index);
        });

        thumbnails.click(function(e){
            new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, {
                index : $(this).data("index")
            }).init();
            return false;
        });

    }

    createGallery($(".species-image > a"));
    createGallery($(".species-map > a"));

});