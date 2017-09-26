$(function() {

    initGalleries([
        {thumbnails:".species-image > a", simple:false},
        {thumbnails:".species-map > a", simple:true},
    ]);

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