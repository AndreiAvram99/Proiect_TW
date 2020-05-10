function addRemoveMenu(id){ 
    sub_menu = document.getElementById(id);
    console.log(sub_menu.className);

    if(sub_menu.className == 'data-filters-container'){
        sub_menu.className += ' open';
    }
    else{
        sub_menu.className = 'data-filters-container';
    }
}