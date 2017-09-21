$(function() {

    var pswpElement = document.querySelectorAll('.pswp')[0];


    function createGallery(thumbnails){

        var items = [];

        thumbnails.each(function(index, elem){
            items.push({
                src: $(elem).attr("href"),
                w: $(elem).data("width"),
                h: $(elem).data("height"),
                title: $(elem).data("title"),
                legend: $(elem).data("legend")
            });
            $(elem).data("index", index);
        });

        thumbnails.click(function(e){
            var pswp = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, {
                index : $(this).data("index")
            });
            pswp.listen('afterChange', function() {
                $(".pswp__caption__center").append(" | <small>"+ pswp.currItem.legend +"</small>");
            });
            pswp.init();
            return false;
        });

    }

    createGallery($(".species-image > a"));
    createGallery($(".species-map > a"));


    // var msnry = new Masonry( '.image-gallery', {
    //     // options
    //     itemSelector: '.species-image',
    //     columnWidth: 160
    // });

    // init Masonry
    var $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer'
    });
    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });

});