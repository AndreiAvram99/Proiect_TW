function validateForm() {
    var chart_type = document.forms["all_filters_form"]["chart_types_container[]"].value;
    var xaxis = document.forms["all_filters_form"]["xaxis_container[]"].value;
    var yaxis = document.forms["all_filters_form"]["yaxis_container[]"].value;
  
    if (chart_type === "") {
        alert("You must choose a chart type from data base filters menu");
        return false;
    }

    if (xaxis === ""){
        alert("You must choose x-axis from choose chart axis menu");
        return false;
    }

    if (yaxis === ""){
        alert("You must choose y-axis from choose chart axis menu");
        return false;
    }

}
function chooseSelectALL(e){
    element =  document.getElementsByName(e.target.name);
    var len = element.length;
    for (var i=1; i<len; i++) {
        element[i].checked = false;
    }
}

function change_all_option_for_one(element){
    var len = element.length;
    for (var i = 1; i < len; i++) {
        if(element[i].checked && element[0].checked)
            element[0].checked = false;
    }
}

function change_all_option_for_all(elementsArray){
    len = elementsArray.length;
    for (var i = 0; i < len; i++)
        change_all_option_for_one(elementsArray[i]);
}


function validateOne(cboxesArray){
    
    var len = cboxesArray.length;
    for (var i=0; i<len; i++) {
        if(cboxesArray[i].checked)
            return true;
    }
    return false;
}

function validateAll(state_value, county_value, city_value, side_value, severity_value, chart_type){
    if(validateOne(state_value) &&
       validateOne(county_value) &&
       validateOne(city_value) &&
       validateOne(side_value) &&
       validateOne(severity_value)&&
       chart_type!="")
       return true;
    return false;
}

function apearDisapearChartMenu(){
    
    var chart_filters_menu = document.getElementById("second_filter_menu");

    var state_value = document.getElementsByName('states_container[]');
    var county_value = document.getElementsByName('counties_container[]');
    var city_value = document.getElementsByName('cities_container[]'); 
    var side_value = document.getElementsByName('sides_container[]');
    var severity_value = document.getElementsByName('severities_container[]');
    
    let elementsArray = [];
    elementsArray.push(state_value);
    elementsArray.push(county_value);
    elementsArray.push(city_value);
    elementsArray.push(side_value);
    elementsArray.push(severity_value);
    
    change_all_option_for_all(elementsArray);

    var chart_type = document.forms["all_filters_form"]["chart_types_container[]"].value;
    

    if(validateAll(state_value, 
                county_value,
                city_value,
                side_value,
                severity_value,
                chart_type) === true){
                    
        chart_filters_menu.className += " open";
    }
    else {
        chart_filters_menu.className = "second-filter-menu";
    }

}