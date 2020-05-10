function addRemoveMenu(menu_id, btn_id){ 
    
    button = document.getElementById(btn_id);
    sub_menu = document.getElementById(menu_id);
    
    if(sub_menu.className == 'data-filters-container'){
        sub_menu.className += ' open';
        button.value = 'Hide menu';
    }
    else{
        sub_menu.className = 'data-filters-container';
        button.value = 'Show menu';
    }
}
