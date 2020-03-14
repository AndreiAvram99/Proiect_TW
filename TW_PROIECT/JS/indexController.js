$(document).ready(function(){
    addNavBar();
    addMap();
    addEvents();
});

async function addEvents() {
    for (var i=0;i<3;i++) {
        var event = await createEvent("Title", "So perhaps, you've generated some fancy text, and you're content that you can now copy\n" +
            "                        and paste your fancy text in the comments section of funny cat videos, but perhaps you're\n" +
            "                        wondering how it's even possible to change the font of your text? Is it some sort of hack?\n" +
            "                        Are you copying and pasting an actual font?", "Denis Banu", "#");

        document.getElementById("eventsContainer").appendChild(event);
    }
}

async function addNavBar() {
    var navBarContainer = document.getElementById('navBarContainer');
    if (navBarContainer != null) {
        navBarContainer.appendChild(await getNavBar());
    }
}