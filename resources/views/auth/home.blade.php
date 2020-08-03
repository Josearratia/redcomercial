@extends('auth.contenido')
@section('mapa')

    <script>
        (function(exports) {
            "use strict";

            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var infoWindow;

            function initMap() {
                exports.map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    },
                    zoom: 13
                });

                infoWindow = new google.maps.InfoWindow(); // Try HTML5 geolocation.

                if (navigator.geolocation) {
                    var location_timeout = setTimeout("geolocFail()", 10000);
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            clearTimeout(location_timeout);
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            infoWindow.setPosition(pos);
                            infoWindow.setContent("Tú");
                            infoWindow.open(exports.map);
                            exports.map.setCenter(pos);
                        },
                        function() {
                            handleLocationError(true, infoWindow, exports.map.getCenter());
                        }, {
                            maximumAge: Infinity,
                            timeout: 5000
                        }

                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, exports.map.getCenter());
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(
                    browserHasGeolocation ?
                    "Error: The Geolocation service failed." :
                    "Error: Your browser doesn't support geolocation."
                );
                infoWindow.open(exports.map);
            }

            exports.handleLocationError = handleLocationError;
            exports.initMap = initMap;
        })((this.window = this.window || {}));
    </script>




<div id="map"></div>
  
@endsection
