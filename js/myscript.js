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


window.addEventListener("click", function(e){
        if (document.getElementById("open").contains(e.target) || document.getElementById("players").contains(e.target)){
            document.getElementById("players").style.opacity = 100;
            document.getElementById("players").style.marginBottom = '50px';
            document.getElementById("players").style.transform = 'none';
            document.getElementById("open").innerText= '-';
        }
        else {
            document.getElementById("players").style.opacity = 0;
            document.getElementById("players").style.marginBottom = '-150px';
            document.getElementById("players").style.transform = 'translate(0,-45%);';
            document.getElementById("open").innerText= '+';
    }
});

