$(function(){
    var source_template = $("#image-template").html();
    var image_template = Handlebars.compile(source_template);

    // initialize editors
    tinymce.init({
        selector: '.editor',
        plugins: [
            'advlist autolink lists link image charmap preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true
    });

    function checkPlurality(){
        if(document.querySelector('#Common_name').value.includes(";")){
            document.querySelector('#Common_name_label').innerHTML = "Common names"
        }else{
            document.querySelector('#Common_name_label').innerHTML = "Common name"
        }
    }

    document.querySelector('#Common_name').oninput = checkPlurality;
    checkPlurality();

    $("#image-input").change(function(){addImageFromInput(this, "img");});
    $("#map-input").change(function(){addImageFromInput(this, "map");});

    function addImageFromInput(input, type){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var n = Date.now();

            reader.onload = function (e) {
                $('#images-'+type).append(image_template({
                    url:e.target.result,
                    type:type,
                    img:{id:n}
                }));
            };

            reader.readAsDataURL(input.files[0]);

            var $clone = $(input).clone();
            $clone.insertAfter($(input)).removeAttr('id').attr("name", type+"_new_"+n).attr("id",n);
        }
    }

    // replace placeholders prefilled server-side by filled image templates
    $(".template-placeholder").each(function(i,e){
        $(e).replaceWith(image_template({
            url: $(e).data("image-url"),
            type: $(e).data("image-type"),
            img:{
                id: $(e).data("image-id"),
                legend: $(e).data("image-legend"),
                title: $(e).data("image-title")
            }
        }));
    });


    $(".form-horizontal").on("click", ".remove", function(){
        var id = $(this).data("id");
        var type = $(this).data("type");
        $(this).parent().parent().remove();
        // remove potential new file input
        $("#"+id).remove();
        var $hid = "<input type='hidden' name='"+type+"_remove[]' value='"+id+"'>";
        $($hid).insertAfter($('#images-'+type));
    });


    $("#species-delete-form").submit(function (e) {
        if(!confirm("Delete this species ?")){
            e.preventDefault();
        }
    });

    $("#add-syn-btn").click(function(e){
        var p = $(this).parent();
        var syn_div = p.prev();
        syn_div.clone().insertBefore(p).find("input").val("");
        return false;
    });
});