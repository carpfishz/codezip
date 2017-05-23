/**
 * Created by sangminlee on 2017. 5. 23..
 */

$(document).ready(function(){
    var code = $(".codemirror-textarea")[0];
    var editor = CodeMirror.fromTextArea(code, {
        lineNumbers: true,
        mode: "text/x-java"
    });
});