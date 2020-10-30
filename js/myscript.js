function myFunction(x) {
    x.classList.toggle("change");
    var menu = document.getElementById("mobile");
    menu.style.transition = menu.style.transition == "height 0.3s ease-out" ? "height 0.15s ease-in" : "height 0.3s ease-out";
    menu.style.height = menu.style.height == "100vh" ? "0" : "100vh";
}

$(document).ready(function(){
    var $searchBar = $("#searchBar");
    $("#searchOpen").click(function(){
        $searchBar.fadeIn("fast");
    });
});