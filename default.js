$(document).ready(function(){

    var code = $(".codemirror-textarea")[0];
    var test = CodeMirror.fromTextArea(code, {
    lineNumbers: true,
    mode: "text/x-python"
  });
});