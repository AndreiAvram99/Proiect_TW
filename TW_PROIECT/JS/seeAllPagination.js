var activePage = 0;
var eventContainer;
var pagination;
const NUM_OF_ELEMENTS_PER_PAGE = 10;
var events;

window.onload = function(){
    activePage = 1;
    eventContainer = document.getElementById("seeAllEventsContainer");
    pagination = document.getElementById("seeAllPagination");

    makeEventList();

    showActivePage();
}

function makeEventList() {
    events = new Array();

    for (var i=0;i<=1005;i++){
        events.push(getEvent(i.toString(),"dsadsa", "Denis Nume2"));
    }
}

function showActivePage(){
    printEvents();
    printPagination();
}

function printEvents(){
    eventContainer.innerHTML = "";
    for (var i = (activePage - 1) * NUM_OF_ELEMENTS_PER_PAGE; i <
        Math.min(activePage * NUM_OF_ELEMENTS_PER_PAGE, events.length); i++){
        eventContainer.appendChild(events[i]);
    }
}

function printPagination(){
    var numberOfPages = Math.ceil(events.length / NUM_OF_ELEMENTS_PER_PAGE);
    pagination.innerHTML = "";

    if (numberOfPages <= 7){
        for (var i = 1;i <= numberOfPages; i++){
            var isActive = false;
            if (activePage == i){
                isActive = true;
            }
            pagination.appendChild(getPageButton(i.toString(), isActive));
        }
    }
    else{
        if (activePage <= 4){
            for (var i = 1; i <= activePage + 2; i++){
                var isActive = false;
                if (activePage == i){
                    isActive = true;
                }
                pagination.appendChild(getPageButton(i.toString(), isActive));
            }
            pagination.appendChild(getEllipsis());
            pagination.appendChild(getPageButton(numberOfPages.toString(), false));
        }
        else if (activePage > 4 && activePage < numberOfPages - 3) {
            pagination.appendChild(getPageButton("1", false));
            pagination.appendChild(getEllipsis());

            for (var i = activePage - 2; i <= activePage + 2; i++){
                var isActive = false;
                if (activePage == i){
                    isActive = true;
                }
                pagination.appendChild(getPageButton(i.toString(), isActive));
            }

            pagination.appendChild(getEllipsis());
            pagination.appendChild(getPageButton(numberOfPages.toString(), false));
        }
        else if (activePage >= numberOfPages - 3){
            pagination.appendChild(getPageButton("1", false));
            pagination.appendChild(getEllipsis());

            for (var i = activePage - 2; i <= numberOfPages; i++){
                var isActive = false;
                if (activePage == i){
                    isActive = true;
                }
                pagination.appendChild(getPageButton(i.toString(), isActive));
            }
        }
    }
}

function getEllipsis() {
    var ellipsis = document.createElement("a");
    ellipsis.text = "...";
    return ellipsis;
}

function changeActivePage(page){
    activePage = page;
    showActivePage();
}

function getPageButton(content, isActive){
    var page = document.createElement("a");
    page.text = content;
    if (isActive){
        page.classList.add("active");
    }
    page.onclick = function(){
        changeActivePage(parseInt(content));
    };

    return page;
}

function getEvent(titleText, eventDescriptionText, authorNameText){
    var event = document.createElement("div");
    event.classList.add("event");

    var eventHeader = document.createElement("div");
    eventHeader.classList.add("eventHeader");
    event.appendChild(eventHeader);

    var eventTitle = document.createElement("p");
    eventTitle.classList.add("eventTitle");
    eventTitle.textContent = titleText;
    eventHeader.appendChild(eventTitle);

    var eventBody = document.createElement("div");
    eventBody.classList.add("eventBody");
    event.appendChild(eventBody);

    var eventDescription = document.createElement("p");
    eventDescription.classList.add("eventDescription");
    eventDescription.textContent = eventDescriptionText;
    eventBody.appendChild(eventDescription);

    var eventFooter = document.createElement("div");
    eventFooter.classList.add("eventFooter");
    event.appendChild(eventFooter);

    var eventFooterLeft = document.createElement("div");
    eventFooterLeft.classList.add("eventFooterLeft");
    eventFooter.appendChild(eventFooterLeft);

    var author = document.createElement("span");
    author.classList.add("author");
    eventFooterLeft.appendChild(author);

    var fasFaUser = document.createElement("span");
    fasFaUser.className += "fas fa-user";

    author.appendChild(fasFaUser);

    author.appendChild(document.createElement("span"));
    var authorName = document.createElement("a");
    authorName.classList.add("linkColor");
    authorName.title = "Post author";
    authorName.href = "#";
    authorName.text = authorNameText;

    author.childNodes.item(author.childNodes.length - 1).appendChild(authorName);

    var eventFooterRight = document.createElement("div");
    eventFooterRight.classList.add("eventFooterRight");
    eventFooter.appendChild(eventFooterRight);

    var seeMoreButton = document.createElement("button");
    seeMoreButton.type = "button";
    seeMoreButton.className = "eventSeeMoreButton";
    seeMoreButton.innerText = "See more";
    eventFooterRight.appendChild(seeMoreButton);

    return event;
}
