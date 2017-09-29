
$(function(){
    var paragraphs = $('.page-content > *');
    var figures = $('.figure');
    var step = parseInt(paragraphs.length / figures.length);

    figures.each(function(i,e){
        $(e).insertAfter(paragraphs[(1+i)*step -1]);
    });

    initGalleries([
        {thumbnails:"figure > a", simple:true},
    ]);
});