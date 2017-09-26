$(function() {

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