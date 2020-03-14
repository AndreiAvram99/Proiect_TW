$(document).ready(function(){
    addNavBar();
});

async function addNavBar() {
    var navBarContainer = document.getElementById('navBarContainer');
    if (navBarContainer != null) {
        navBarContainer.appendChild(await getNavBar());
    }
}