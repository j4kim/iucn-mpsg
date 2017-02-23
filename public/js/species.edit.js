// Quill makes these two divs editable
var quillText = new Quill('#quillText',{theme: 'snow'});
var quillAddRef = new Quill('#quillAddRef',{theme: 'snow'});

var form = document.querySelector('form');
// we need to retrieve the HTML content of the editable inputs before to submit the form
form.onsubmit = function() {
    // the hidden input that will contain the html text of the species
    var Text = document.querySelector('input[name=Text]');
    // first child of #quillText is a special div created by Quill, we dont need it
    Text.value =  document.querySelector('#quillText').children[0].innerHTML;

    var Additional_References = document.querySelector('input[name=Additional_References]');
    Additional_References.value =  document.querySelector('#quillAddRef').children[0].innerHTML;
}