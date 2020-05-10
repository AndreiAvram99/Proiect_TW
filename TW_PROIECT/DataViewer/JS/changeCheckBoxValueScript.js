function chooseALL(event){
    element =  document.getElementsByName(event.target.name);
    var len = element.length;

    for (var i=1; i<len; i++) {
        element[i].checked = false;
    }
}

function chooseOthers(event){
    element =  document.getElementsByName(event.target.name);
    element[0].checked = false;
}