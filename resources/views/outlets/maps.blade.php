<x-app-layout>
    <x-slot name="css">
        <style>
            #map {
                height: 100%;
            }

            html,body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </x-slot>

    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Outlets Maps</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('outlets.index') }}" title="" class="btn btn-secondary">
                        <i class="fa fa-list"  aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">
        {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}

        <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

        <script>
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 3,
                    center: { lat: -28.024, lng: 140.887 },
                });
                const infoWindow = new google.maps.InfoWindow({
                    content: "",
                    disableAutoPan: true,
                });
                // Create an array of alphabetical characters used to label the markers.
                const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                // Add some markers to the map.
                const markers = locations.map((position, i) => {
                    const label = labels[i % labels.length];
                    const marker = new google.maps.Marker({
                    position,
                    label,
                    });

                    // markers can only be keyboard focusable when they have click listeners
                    // open info window when marker is clicked
                    marker.addListener("click", () => {
                    infoWindow.setContent(label);
                    infoWindow.open(map, marker);
                    });
                    return marker;
                });

                // Add a marker clusterer to manage the markers.
                new MarkerClusterer({ markers, map });
            }

            const locations = [
                { lat: -31.56391, lng: 147.154312 },
                { lat: -33.718234, lng: 150.363181 },
                { lat: -33.727111, lng: 150.371124 },
                { lat: -33.848588, lng: 151.209834 },
                { lat: -33.851702, lng: 151.216968 },
                { lat: -34.671264, lng: 150.863657 },
                { lat: -35.304724, lng: 148.662905 },
                { lat: -36.817685, lng: 175.699196 },
                { lat: -36.828611, lng: 175.790222 },
                { lat: -37.75, lng: 145.116667 },
                { lat: -37.759859, lng: 145.128708 },
                { lat: -37.765015, lng: 145.133858 },
                { lat: -37.770104, lng: 145.143299 },
                { lat: -37.7737, lng: 145.145187 },
                { lat: -37.774785, lng: 145.137978 },
                { lat: -37.819616, lng: 144.968119 },
                { lat: -38.330766, lng: 144.695692 },
                { lat: -39.927193, lng: 175.053218 },
                { lat: -41.330162, lng: 174.865694 },
                { lat: -42.734358, lng: 147.439506 },
                { lat: -42.734358, lng: 147.501315 },
                { lat: -42.735258, lng: 147.438 },
                { lat: -43.999792, lng: 170.463352 },
            ];

            window.initMap = initMap;
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly" defer></script>
    </x-slot>
</x-app-layout>
