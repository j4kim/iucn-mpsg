<?php

function imgUrl($img, $size="o"){
    if($img){
        return $img->assetUrl($size);
    }
//    return asset("images/noimage.png");
}