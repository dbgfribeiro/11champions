let matches = document.getElementsByClassName('calendar-match');
let rounds = document.getElementsByClassName('round');

for (let x = 0; x < matches.length; x++) {
    let match = matches[x];
    let target = match.getAttribute('content');

    if (target !== 'vs'){
        match.style.backgroundColor ="#242E35";
        rounds[x].style.backgroundColor= "#333a3d";
    }
}

//calendar
var now = new Date();
var nowMonth = now.getMonth()+1;


var matchMonth = document.getElementsByClassName("round-container");
var matchNov = document.getElementById("nov");
var matchDec = document.getElementById("dec");
var matchJan = document.getElementById("jan");
var matchFev = document.getElementById("fev");


let backA = document.querySelectorAll("#arrow-back");
let frontA = document.querySelectorAll("#arrow-front");

backA.forEach(function(b){
    b.addEventListener("click", function(){
         if (nowMonth == 1) {
            nowMonth = 13;
        }
         if (nowMonth == 11){
             nowMonth = 3;
         }
        nowMonth--;
        console.log(nowMonth);
        if (nowMonth == 11){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchNov.style.display = "block";
            }
        }
        if (nowMonth == 12){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchDec.style.display = "block";
            }
        }
        if (nowMonth == 1){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchJan.style.display = "block";
            }
        }
        if (nowMonth == 2){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchFev.style.display = "block";
            }
        }
    });
})
frontA.forEach(function(f){
    f.addEventListener("click", function(){
        if (nowMonth == 12){
            nowMonth = 0;
        }
        if (nowMonth == 2){
            nowMonth = 10;
        }
        nowMonth++;
        console.log(nowMonth);
        if (nowMonth == 11){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchNov.style.display = "block";
            }
        }
        if (nowMonth == 12){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchDec.style.display = "block";
            }
        }
        if (nowMonth == 1){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchJan.style.display = "block";
            }
        }
        if (nowMonth == 2){
            for(var i = 0; i < matchMonth.length; i++){
                matchMonth[i].style.display = "none";
                matchFev.style.display = "block";
            }
        }
    });
})

if (nowMonth == 11){
    for(var i = 0; i < matchMonth.length; i++){
        matchMonth[i].style.display = "none";
        matchNov.style.display = "block";
    }
}
if (nowMonth == 12){
    for(var i = 0; i < matchMonth.length; i++){
        matchMonth[i].style.display = "none";
        matchDec.style.display = "block";
    }
}
if (nowMonth == 1){
    for(var i = 0; i < matchMonth.length; i++){
        matchMonth[i].style.display = "none";
        matchDec.style.display = "block";
    }
}
if (nowMonth == 2){
    for(var i = 0; i < matchMonth.length; i++){
        matchMonth[i].style.display = "none";
        matchFev.style.display = "block";
    }
}