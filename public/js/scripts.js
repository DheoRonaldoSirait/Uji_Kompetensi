/*!
* Start Bootstrap - Bare v5.0.7 (https://startbootstrap.com/template/bare)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-bare/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

$( document ).ready(function() {

    $("#animatebutton").click(function(){
    const element = document.querySelector('.animatebutton');
    element.classList.add('animated', 'fadeInLeft');
    setTimeout(function() {
    element.classList.remove('fadeInLeft');
    }, 1000);
    });
    });
$(function() {
    //Date picker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:true,
    });
});
function openSkema(skema) {
    var i;
    var x = document.getElementsByClassName("skema");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(skema).style.display = "block";
}

function validateTglAgro() {
    var userdate = new Date(document.getElementById("tanggalAgro").value);
    var today = new Date();
    var todayForComparison = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, -today.getTimezoneOffset());

    if(userdate < todayForComparison){
        alert('Pilih tanggal yang valid!');
        document.getElementById('tanggalAgro').value = new Date().toDateInputValue();
    }
}

function validateTglMill() {
    var userdate = new Date(document.getElementById("tanggalMill").value);
    var today = new Date();
    var todayForComparison = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, -today.getTimezoneOffset());

    if(userdate < todayForComparison){
        alert('Pilih tanggal yang valid!');
        document.getElementById('datePicker').value = new Date().toDateInputValue();
    }
}

function openSkema(skema) {
    var i;
    var x = document.getElementsByClassName("skema");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(skema).style.display = "block";
}

function onSetuju(btn, cek) {
    var checkBox = document.getElementById(cek);
    var formAgro = document.forms["formAgro"];
    var hitung = 0;
    if (btn == 'btn1'){
        for(var i = 0; i<3;i++){
            if(formAgro.elements[i].checked){
                hitung = hitung + 1;
            }
        }
        if(hitung == 0){
            alert("Anda belum memilih Fundamental");
        }
    }
    if (checkBox.checked == true) {
        document.getElementById(btn).disabled = false;
    } else {
        document.getElementById(btn).disabled = true;
    }
}


function onLihat(uk) {
    document.getElementById(uk).style.display = "block";
}

function onTidakProses() {
    document.getElementById("tidakProses").innerHTML = "Anda tidak dapat melanjutkan asesmen, karena belum pernah menjadi asisten proses!";
    document.getElementById("tidakNampak").style.display = "none";
}

function onProses() {
    document.getElementById("tidakProses").innerHTML = "";
    document.getElementById("tidakNampak").style.display = "block";
}

function onNamaAsesi(str, unit){
    if (str.length == 0) {
        document.getElementById("nama").value = "";
        return;
    } 
    else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById("nama" + unit).value = this.responseText;
        }
    xmlhttp.open("GET", "nama_asesi.php?q=" + str);
    xmlhttp.send();
    }
    
}