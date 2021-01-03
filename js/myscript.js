//hamburguer
function myFunction(x) {
    x.classList.toggle("change");
    var menu = document.getElementById("mobile");
    menu.style.transition = menu.style.transition == "height 0.3s ease-out" ? "height 0.15s ease-in" : "height 0.3s ease-out";
    menu.style.height = menu.style.height == "100vh" ? "0" : "100vh";

}

//search bar
$(document).ready(function(){
    var $searchBar = $("#searchBar");
    $("#searchOpen").click(function(){
        $searchBar.fadeIn("fast");
    });
});


//intro menus
$(document).ready(function(){
    var $intro = $("#intro");
    var $login = $("#login");
    setTimeout(function(){
        $intro.fadeOut(300);
        $login.fadeIn(700);
        }, 1500)

    $("#admin").click(function() {
        $("#userKind").fadeOut(50);
        $("#adminLogin").fadeIn();
    });
});


//add player form
function add(){
    $("#addPlayer").fadeIn();
}
function added(){
    $("#addPlayer").fadeOut();
}




let stats = document.querySelectorAll(".match-stats");
stats.forEach(function(s){
    if(s.innerText == ""){
        s.style.display = "none";
    }
});


let teamCont = document.querySelectorAll('.team-container');

if(teamCont.length == 1){
    let players = teamCont[0].querySelector('.team-players');
    players.style.opacity = 1;
    players.style.marginTop = "-4%";

    let playersul = players.querySelectorAll('ul');
    playersul.forEach(function(p){
        p.style.display = "block";
    });

    let playersinfo = teamCont[0].querySelector('.team-info');
    playersinfo.style.transform = "scale(1.05,1.05)";
    playersinfo.style.boxShadow = "0 10px 15px -10px rgba(1,1,1,0.5)";
    playersinfo.querySelector('#open').style.display = "none";

    if (window.matchMedia("(max-width: 1000px)").matches) {
        players.style.display = "block";
    }
    else{
        players.style.display = "flex";
    }
}