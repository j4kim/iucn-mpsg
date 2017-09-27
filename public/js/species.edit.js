$(function(){
    var source_template = $("#image-template").html();
    var image_template = Handlebars.compile(source_template);

    var options = {
        modules: {
            toolbar: [
                [{ 'header': [2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['link','image','video','formula'],
                [{ 'font': [] }],
                [{ 'align': [] }],
                [{ 'color': [] }, { 'background': [] }],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                ['clean']
            ]
        },
        theme: 'snow'
    };

    // Quill makes these two divs editable
    var quillText = new Quill('#quillText', options);
    var quillAddRef = new Quill('#quillAddRef', options);


    var form = document.getElementById('species-edit-form');
    // we need to retrieve the HTML content of the editable inputs before to submit the form
    form.onsubmit = function() {
        // the hidden input that will contain the html text of the species
        var Text = document.querySelector('input[name=Text]');
        // first child of #quillText is a special div created by Quill, we dont need it
        Text.value =  document.querySelector('#quillText').children[0].innerHTML;

        var Additional_References = document.querySelector('input[name=Additional_References]');
        Additional_References.value =  document.querySelector('#quillAddRef').children[0].innerHTML;
    };


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