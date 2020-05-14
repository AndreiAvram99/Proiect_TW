var statesData = (function() {
    var json = null;
    $.ajax({
      'async': false,
      'global': false,
      'url': "./../RESOURCES/JSON/map_data.json",
      'dataType': "json",
      'success': function(data) {
        json = data;
      }
    });
    return json;
  })();