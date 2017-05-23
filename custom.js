$(document).ready(function(){

    //console.log($('#select_code').val());
    $('#select_code').on('change', function(){

        var lang = this.value;

        var fm = document.createElement('form');
        var data1 = document.createElement('input');
        var data2 = document.createElement('input');


        var zzz = 'asd';

        fm.setAttribute('action', 'http://223.194.105.180/nologmain.php');
        fm.setAttribute('method', 'POST');

        data1.setAttribute('name', 'val1');
        data2.setAttribute('name', 'val2');

        data2.setAttribute('value', $('#select_code').val());



        switch($('#select_code').val()){
            case 'python' : data1.setAttribute('value', './default.js');break;
            case 'c' : data1.setAttribute('value', './mode_c.js');break;
            case 'java' : data1.setAttribute('value', './mode_java.js');break;
            case 'ruby' : data1.setAttribute('value', './mode_c.js');break;
            defalut : data1.setAttribute('value', './default.js');break;
        }

        fm.append(data1);
        fm.append(data2);

        document.body.appendChild(fm);

        fm.submit();

    })
});