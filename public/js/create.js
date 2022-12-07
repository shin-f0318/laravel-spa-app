'use strict';

// 送信時のエラーアラート
var submit = document.getElementById("submitInput");
var name = document.getElementById("nameInput");
var sex = document.getElementById("sexInput");
var mail = document.getElementById("mailInput");
var tel = document.getElementById("telInput");
var text= document.getElementById("textInput");

let check = () => {
    let error = "入力してください。";
    let flag = 0;

    if (name.value =="") {
        flag = 1;
    }else if (sex.value =="") {
        flag = 2;
    }else if (mail.value =="") {
        flag = 3;
    } else if (tel.value =="") {
        flag = 4;
    } else if (text.value=="") { 
        flag = 5;
    } else if (flag == 1) {
        document.getElementById("errorMessage").innerHTML = error;
        return false;
    } else if (flag == 2) {
        document.getElementById("errorMessage1").innerHTML = error;
        return false;
    } else if (flag == 3) {
        document.getElementById("errorMessage2").innerHTML = error;
    } else if (flag == 4) {
        document.getElementById("errorMessage3").innerHTML = error;
        return false;
    } else if (flag == 5) {
        document.getElementById("errorMessage4").innerHTML = error;
        return false;
    }  else if (flag == 0) {
        return true;
    }
}