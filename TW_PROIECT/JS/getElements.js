async function getNavBar(){
    var navBar;
    await $.get('Elements/navBar.html #navBar', function(data) {
        navBar = stringToElement(data);
    }, 'html');
    return navBar;
}

async function createEvent(title, description, author, seeMoreLink){
    var event;
    await $.get('Elements/event.php #event', function(data) {
        event = stringToElement(data);
    }, 'html');
    event.querySelector("#title").innerText = title;
    event.querySelector("#description").innerText = description;
    event.querySelector("#author").innerText = author;
    // event.querySelector("#seeMore").innerText = seeMoreLink;

    return event;
}

function stringToElement(data){
    var div = document.createElement('div');
    div.innerHTML += data.trim();
    return div.firstChild;
}