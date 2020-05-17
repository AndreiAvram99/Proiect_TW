var mapAccesToken = 'pk.eyJ1IjoiYW5kcmVpYXZyYW0iLCJhIjoiY2thMnoxMDljMDg2dzNlbGtnbWZlZDM4NiJ9.KnLe_WeiBKW1xAkiT2faLA';
var mymap = L.map('mapid').setView([38.89103282648846, -99.140625], 4);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + mapAccesToken, {    
id: 'mapbox/light-v9',
attribution:'',
tileSize: 512,
zoomOffset: -1
}).addTo(mymap);

function getColor(d) {
    return d > 1000 ? '#800026' :
    d > 500  ? '#BD0026' :
    d > 200  ? '#E31A1C' :
    d > 100  ? '#FC4E2A' :
    d > 50   ? '#FD8D3C' :
    d > 20   ? '#FEB24C' :
    d > 10   ? '#FED976' :
                '#FFEDA0';
}

function style(feature) {
    return {
        fillColor: getColor(feature.properties.accidents_per_state),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}


var info = L.control();

info.onAdd = function (mymap) {
this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
this.update();
return this._div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
this._div.innerHTML = '<h4>US Acidents/State</h4>' +  (props ?
'<b>' + props.name + '</b><br />' + props.accidents_per_state + ' accidents'
: 'Hover over a state');
};

info.addTo(mymap);



function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function zoomToFeature(e) {
    mymap.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

geojson = L.geoJson(statesData, {
    style: style,
    onEachFeature: onEachFeature
}).addTo(mymap);
