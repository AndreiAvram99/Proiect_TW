
function addRemoveMenu(count){
    
    var chart_filters_menu = document.getElementById("first_filter_menu");
    var menus_list = [];

    for (let i = 0; i < count ; i++)
        var element = chart_filters_menu.childNodes[i];
        var lg = element.childNodes.length;
        for(let j = 0 ; j < lg; j++)
            menus_list.push(element.childNodes[j]);

    console.log(menus_list);

}