
$(function(){
    var paragraphs = $('main p');
    var figures = $('.figure');
    var step = parseInt(paragraphs.length / figures.length);
    figures.each(function(i,e){
        $(e).insertAfter(paragraphs[i*step]);
    });

    initGalleries([
        {thumbnails:"figure > a", simple:true},
    ]);
});