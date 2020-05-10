function validateForm() {
    var chart_type = document.forms["all_filters_form"]["chart_type_container[]"].value;
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
