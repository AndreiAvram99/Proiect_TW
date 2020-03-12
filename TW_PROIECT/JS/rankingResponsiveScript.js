window.onload = function (){
    document.getElementById("sidePanel").style.height = window.screen.height + "px";
    console.log(window.screen.height);
    console.log(document.getElementById("sidePanel").style.height);
}

window.onresize = function (){
    document.getElementById("sidePanel").style.height = window.screen.height + "px";
    console.log(window.screen.height);
    console.log(document.getElementById("sidePanel").style.height);
}

function openPanel(event) {
    document.getElementById("sidePanel").style.width = "90%";
    document.getElementById("panelOpenBtn").style.display = "none";
}

function closePanel(event) {
    document.getElementById("sidePanel").style.width = "0";
    document.getElementById("panelOpenBtn").style.display = "block";

}