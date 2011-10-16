function initialize() {
  var latlng = new google.maps.LatLng(46.81303, -71.22538);
  var myOptions = {
    zoom: 15,
    center: latlng,
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true
  };
  var map = new google.maps.Map(document.getElementById("googlemaps-footer"), myOptions);

  var marker = new google.maps.Marker({
    position: latlng,
      title:"Web à Québec"
  });

  marker.setMap(map);
}

$(function(){ initialize(); });

