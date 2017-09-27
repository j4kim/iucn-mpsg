$(function() {
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
    var quill = new Quill('#quill', options);

    $("form").submit(function(e){
        $('input[name=content]').val(
            $('.editor').children().first().html()
        );
    });

});