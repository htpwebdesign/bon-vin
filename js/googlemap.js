(function ($) {
  /**
   * initMap
   *
   * Renders a Google Map onto the selected jQuery element
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @return  object The map instance.
   */
  function initMap($el) {
    // Find marker elements within map.
    var $markers = $el.find(".marker");

    // Create gerenic map.
    var mapArgs = {
      zoom: $el.data("zoom") || 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [
        {
          featureType: "landscape",
          stylers: [
            {
              hue: "#FFC18D",
            },
            {
              saturation: 71.66666666666669,
            },
            {
              lightness: -8.400000000000006,
            },
            {
              gamma: 1,
            },
          ],
        },
        {
          featureType: "road.highway",
          stylers: [
            {
              hue: "#E8FF00",
            },
            {
              saturation: -76.6,
            },
            {
              lightness: 11,
            },
            {
              gamma: 1,
            },
          ],
        },
        {
          featureType: "road.arterial",
          stylers: [
            {
              hue: "#FF8300",
            },
            {
              saturation: -7,
            },
            {
              lightness: -7.400000000000006,
            },
            {
              gamma: 1,
            },
          ],
        },
        {
          featureType: "road.local",
          stylers: [
            {
              hue: "#FF8C00",
            },
            {
              saturation: -6.6,
            },
            {
              lightness: -4.400000000000006,
            },
            {
              gamma: 1,
            },
          ],
        },
        {
          featureType: "water",
          stylers: [
            {
              hue: "#F4FBFF",
            },
            {
              saturation: 22.799999999999997,
            },
            {
              lightness: 50.399999999999991,
            },
            {
              gamma: 1,
            },
          ],
        },
        {
          featureType: "poi",
          stylers: [
            {
              hue: "#094925",
            },
            {
              saturation: -60,
            },
            {
              lightness: -2.200000000000003,
            },
            {
              gamma: 1,
            },
          ],
        },
      ],
    };
    var map = new google.maps.Map($el[0], mapArgs);

    // Add markers.
    map.markers = [];
    $markers.each(function () {
      initMarker($(this), map);
    });

    // Center map based on markers.
    centerMap(map);
    // Return map instance.
    return map;
  }

  /**
   * initMarker
   *
   * Creates a marker for the given jQuery element and map.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @param   object The map instance.
   * @return  object The marker instance.
   */
  function initMarker($marker, map) {
    // Get position from marker.
    var lat = $marker.data("lat");
    var lng = $marker.data("lng");
    var latLng = {
      lat: parseFloat(lat),
      lng: parseFloat(lng),
    };

    // Create marker instance.
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
    });

    // Append to reference for later use.
    map.markers.push(marker);

    // If marker contains HTML, add it to an infoWindow.
    if ($marker.html()) {
      // Create info window.
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html(),
      });

      // Show info window when marker is clicked.
      google.maps.event.addListener(marker, "click", function () {
        infowindow.open(map, marker);
      });
    }
  }

  /**
   * centerMap
   *
   * Centers the map showing all markers in view.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   object The map instance.
   * @return  void
   */
  function centerMap(map) {
    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function (marker) {
      bounds.extend({
        lat: marker.position.lat(),
        lng: marker.position.lng(),
      });
    });

    // Case: Single marker.
    if (map.markers.length == 1) {
      map.setCenter(bounds.getCenter());

      // Case: Multiple markers.
    } else {
      map.fitBounds(bounds);
    }
  }

  // Render maps on page load.
  $(document).ready(function () {
    $(".acf-map").each(function () {
      var map = initMap($(this));
    });
  });
})(jQuery);
