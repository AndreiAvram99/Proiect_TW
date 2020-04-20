window.onload = function (){
    document.getElementById("side_panel").style.height = window.screen.height + "px";
    console.log(window.screen.height);
    console.log(document.getElementById("side_panel").style.height);
}

function openPanel(event) {
    document.getElementById("side_panel").style.width = "90%";
    document.getElementById("panel_open_btn").style.display = "none";
}

function closePanel(event) {
    document.getElementById("side_panel").style.width = "0";
    document.getElementById("panel_open_btn").style.display = "block";

}