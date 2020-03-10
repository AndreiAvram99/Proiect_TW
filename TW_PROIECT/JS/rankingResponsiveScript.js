function openPanel(event) {
    document.getElementById("sidePanel").style.width = "90%";
    document.getElementById("panelOpenBtn").style.display = "none";
}

function closePanel(event) {
    document.getElementById("sidePanel").style.width = "0";
    document.getElementById("panelOpenBtn").style.display = "block";

}