$(function(){

    function aspect(elem){
        return elem.width()/elem.height()
    }

    function resizeHeaderImage(){
        var image = $(".img-header img");
        var header = $(".img-header");
        if(aspect(header) > aspect(image)){
            // cas desktop
            image.css({"width": "100%", "height":"initial"});
        }else{
            // cas mobile
            image.css({"height": "100%", "width": "initial", "max-width": "initial"});
        }
    }

    $(window).resize(function(){
        resizeHeaderImage();
    })

    resizeHeaderImage();
});