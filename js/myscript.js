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


