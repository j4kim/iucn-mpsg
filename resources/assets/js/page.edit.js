$(function() {
    // Quill makes these two divs editable
    var quill = new Quill('#quill', {theme: 'snow'});

    $("form").submit(function(e){
        $('input[name=content]').val(
            $('.editor').children().first().html()
        );
    });

});
