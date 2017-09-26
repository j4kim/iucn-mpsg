
var pswpElement = document.querySelectorAll('.pswp')[0];

// tiré du dernier exemple sur http://photoswipe.com/documentation/getting-started.html
// parse picture index and gallery index from URL (#&pid=1&gid=2)
var photoswipeParseHash = function() {
    var hash = window.location.hash.substring(1),
        params = {};

    if(hash.length < 5) {
        return params;
    }

    var vars = hash.split('&');
    for (var i = 0; i < vars.length; i++) {
        if(!vars[i]) {
            continue;
        }
        var pair = vars[i].split('=');
        if(pair.length < 2) {
            continue;
        }
        params[pair[0]] = pair[1];
    }

    if(params.gid) {
        params.gid = parseInt(params.gid, 10);
    }

    return params;
};

function openGallery(gallery, pid){
    var pswp = new PhotoSwipe(
        pswpElement,
        PhotoSwipeUI_Default,
        gallery.items,
        $.extend({index : pid}, gallery.options)
    );
    pswp.listen('afterChange', function() {
        if(pswp.currItem.legend)
            $(".pswp__caption__center").append(" - <small>"+ pswp.currItem.legend +"</small>");
        if(pswp.currItem.link)
            $(".pswp__caption__center").append(" - <a href='"+ pswp.currItem.link +"'>Open this species sheet</a>");
    });

    pswp.init();
}

var counter = 0;

function createItems(thumbnails){
    var items = [];
    thumbnails.each(function(index, elem){
        items.push(
            {
                src: $(elem).attr("href"),
                msrc: $(elem).find('img').attr('src'),
                w: $(elem).data("width"),
                h: $(elem).data("height"),
                title: $(elem).data("title"),
                legend: $(elem).data("legend"),
                link: $(elem).data("link")
            }
        );
        $(elem).data("index", index);
    });
    return items;
}

function createGallery(items, simple=false){
    var gallery = {
        items: items,
        options:{
            history:!simple,
            galleryUID : ++counter,
            shareEl: !simple,
            counterEl: !simple,
            arrowEl: !simple,
            zoomEl: !simple,
            fullscreenEl: !simple,
            tapToClose: simple
        }
    };
    return gallery;
}

/**
 *
 * @param params list of {thumbnails: string selector, simple: boolean } objects
 */
function initGalleries(params){
    var galleries = [];

    params.forEach(function(p){
        var items = createItems($(p.thumbnails));
        var gallery = createGallery(items, p.simple);

        galleries.push(gallery);

        $(p.thumbnails).click(function(e){
            openGallery(gallery, $(this).data('index'));
            return false;
        });
    });


    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openGallery(galleries[hashData.gid - 1], hashData.pid);
    }

    return galleries;
}
