/*------------------CALENDAR-------------------*/
let result = document.querySelectorAll(".result h3");

result.forEach(function(r){
    let target = r.getAttribute('content');

    if (target == ''){ 

        let parent = r.parentElement.parentElement;
        parent.style.backgroundColor ="#333A3D";

        let round = parent.querySelector(".round");
        round.style.backgroundColor ="#242E35";

        let goals = parent.querySelector(".sep");
        goals.innerHTML = "vs"
    }
});


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


/*------------------LAST MATCHES-------------------*/
$( ".round" ).each( function () {
    var round = $(this);
    if ( round.children().length == 1 ) {
        round.css("display", "none");
    }
});



/*------------------ADD MATCHES TO CALENDAR-------------------*/
function add(){
    $("#addMatch").fadeIn();
}
function added(){
    $("#addMatch").fadeOut();
}

function dateSelect(sel) {
    document.getElementById("date").disabled = false;

    if(sel.options[sel.selectedIndex].text == 14){
        document.getElementById("date").setAttribute('min', '2021-02-27');
        document.getElementById("date").setAttribute('max', '2021-02-28');
    }
    if(sel.options[sel.selectedIndex].text == 13){
        document.getElementById("date").setAttribute('min', '2021-02-20');
        document.getElementById("date").setAttribute('max', '2021-02-23');
    }
    if(sel.options[sel.selectedIndex].text == 12){
        document.getElementById("date").setAttribute('min', '2021-02-14');
        document.getElementById("date").setAttribute('max', '2021-02-16');
    }
    if(sel.options[sel.selectedIndex].text == 11){
        document.getElementById("date").setAttribute('min', '2021-02-07');
        document.getElementById("date").setAttribute('max', '2021-02-09');
    }
    if(sel.options[sel.selectedIndex].text == 10){
        document.getElementById("date").setAttribute('min', '2021-02-01');
        document.getElementById("date").setAttribute('max', '2021-02-03');
    }
    if(sel.options[sel.selectedIndex].text == 9){
        document.getElementById("date").setAttribute('min', '2021-01-24');
        document.getElementById("date").setAttribute('max', '2021-01-26');
    }
    if(sel.options[sel.selectedIndex].text == 8){
        document.getElementById("date").setAttribute('min', '2021-01-17');
        document.getElementById("date").setAttribute('max', '2021-01-19');
    }
    if(sel.options[sel.selectedIndex].text == 7){
        document.getElementById("date").setAttribute('min', '2021-01-10');
        document.getElementById("date").setAttribute('max', '2021-01-12');
    }
    if(sel.options[sel.selectedIndex].text == 6){
        document.getElementById("date").setAttribute('min', '2021-01-03');
        document.getElementById("date").setAttribute('max', '2021-01-05');
    }
    if(sel.options[sel.selectedIndex].text == 5){
        document.getElementById("date").setAttribute('min', '2020-12-27');
        document.getElementById("date").setAttribute('max', '2020-12-29');
    }
    if(sel.options[sel.selectedIndex].text == 4){
        document.getElementById("date").setAttribute('min', '2020-12-20');
        document.getElementById("date").setAttribute('max', '2020-12-22');
    }
    if(sel.options[sel.selectedIndex].text == 3){
        document.getElementById("date").setAttribute('min', '2020-12-13');
        document.getElementById("date").setAttribute('max', '2020-12-15');
    }
    if(sel.options[sel.selectedIndex].text == 2){
        document.getElementById("date").setAttribute('min', '2020-12-06');
        document.getElementById("date").setAttribute('max', '2020-12-08');
    }
    if(sel.options[sel.selectedIndex].text == 1){
        document.getElementById("date").setAttribute('min', '2020-11-28');
        document.getElementById("date").setAttribute('max', '2020-11-30');
    }
}
