window.onload = function (){   
        
    var pie_chart_id = document.getElementById("Pie_chart");
        if(pie_chart_id != null)
            pieChartDraw();
    
    var barplot_chart_id = this.document.getElementById("Bar_plot_chart");
        if(barplot_chart_id != null)
            barPlotChartDraw();
    
    var lollipop_chart_id = this.document.getElementById("Lollipop_chart");
        if(lollipop_chart_id != null)
            lollipopChartDraw(); 
};



