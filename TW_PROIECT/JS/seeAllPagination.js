var activePage = 0;
var eventContainer;
var pagination;
const NUM_OF_ELEMENTS_PER_PAGE = 10;
var events;

window.onload = async function(){
    activePage = 1;
    eventContainer = document.getElementById("seeAllEventsContainer");
    pagination = document.getElementById("seeAllPagination");

    await makeEventList();

    showActivePage();
};

async function makeEventList() {
    events = new Array();

    for (var i=0;i<=305;i++){
        events.push(await createEvent(i.toString(),"dsadsa", "Denis Nume2", "#"));

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