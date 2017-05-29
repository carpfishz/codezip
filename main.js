/**
 * Created by sangminlee on 2017. 5. 29..
 */

window.onload = function () {
    var modal1 = document.getElementById('myModal1');
    var modal2 = document.getElementById('myModal2');
    var span = document.getElementsByClassName('close')[0];
    var ct_button = document.getElementById('ct-button');
    var cs_button = document.getElementById('cs-button');

    ct_button.onclick = function () {
        modal1.style.display = "block";
    }

    cs_button.onclick = function () {
        modal2.style.display = "block";
    }

    span.onclick = function () {
        modal1.style.display = "none";
        modal2.style.display = "none";
    }

    window.onclick = function (event) {
        if(event.target == modal1) {
            modal1.style.display = "none";
        }

        if(event.target == modal2) {
            modal2.style.display = "none";
        }
    }
}