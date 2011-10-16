function initialize() {
  var latlng = new google.maps.LatLng(46.81303, -71.22538);

  var map = new google.maps.Map(document.getElementById("googlemaps-footer"), {
    zoom: 15,
    center: latlng,
    scrollwheel: false,
    disableDefaultUI: true,
    mapTypeControl: false,
    navigationControl: true,
    mapTypeControlOptions: {
      mapTypeIds: 'waq'
    }
  });

  /* Styles {{{ */

  var mapStyles = [
  {
    featureType: "landscape",
      elementType: "all",
      stylers: [
      { hue: "#000000" },
      { saturation: -255 },
      { lightness: 3 }
    ]
  },
  {
    featureType: "water",
    elementType: "all",
    stylers: [
    { hue: "#4CABCF" }
    ]
  },
  {
    featureType: "road",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { lightness: 10 }
    ]
  },
  {
    featureType: "poi",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { saturation: -30 },
    { gamma: 0.7 }
    ]
  }
  ];
  var styledMapType = new google.maps.StyledMapType(mapStyles, {name: 'waq'});
  map.mapTypes.set('waq', styledMapType);
  map.setMapTypeId('waq');

  /*}}}*/

  var marker = new google.maps.Marker({
    position: latlng,
      title:"Web à Québec"
  });

  marker.setMap(map);
}

$(function(){ initialize(); });

