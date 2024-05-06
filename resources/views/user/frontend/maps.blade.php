<x-app-layout>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <!-- <div class="p-6 text-gray-900">
                    {{-- Tambahkan tombol registrasi --}}
                    {{-- @if (Route::has('register'))
                        < class="mt-4">
                            <a href="{{ router') ="roundeding-1 rwxt-while:ring-white">
                            ister
                            </a>
                        <
                    @endif --}}
                </div> -->
                <div class="flex justify-between p-2">
                    <div class="z-20">
                        <div class="sm:flex sm:items-center sm:ms-6">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-4 py-2 text-white bg-[#75B896] border border-transparent rounded-md hover:border-[#75B896] hover:bg-white hover:text-[#75B896] transition ease-in-out duration-150">
                                        <div>{{ __('Filter tahun') }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach ($years as $year)
                                    <x-dropdown-link :href="route('map_year', $year->id)">
                                        {{ $year->year }}
                                    </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                        
                    </div>
                </div>
                <div id="map" style="height: 500px;" class="z-10"></div>
                <div class="w-full h-16 p-4 flex gap-4 items-center">
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-[#65B741] h-4 w-4"></div>
                        <p>High fertility</p>
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-[#FFFEC4] h-4 w-4"></div>
                        <p>Medium fertility</p>
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <div class="bg-[#FFCF81] h-4 w-4"></div>
                        <p>Low fertility</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- {{-- Load cdn js LeafletJS --}} -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- {{-- Load cdn js Leaflet-Search --}} -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.js"></script>

    <!-- {{-- Load cdn js Leaflet fullscreen --}} -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>

    <script>
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbDY5OGJkajkwcHliM2xwMzdwYzZ0MjNqIn0.yRMI7Q02u6qldbDGRypgQQ';

        // Inisiasi dan Setup tipe map yang akan dimuat pada baseLayers
        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });


            // Inisiasi map titik koordinat, zoom, layers, dan button fullscreen map
            var map = L.map('map', {
                center: [-0.18353765071211733, 116.30192451474325],
                zoom: 5,
                layers: [satellite],
                fullscreenControl: {
                    pseudoFullscreen: false
                }
            });

            // Inisiasi baseLayers
            // Lalu tambahkan ke dalam layer control
            var baseLayers = {
                "Streets": streets,
                "Satellite": satellite,
                "Dark": dark,
            };

            L.control.layers(baseLayers).addTo(map);

            // Looping data coordinates pada tabel spot
            var dataSearch = [
                @foreach ($spot as $key => $value)
                    {!! $value->coordinates !!},
                @endforeach
            ]

            // inisiasi layerGroup dan menambahkan button search
            // Pada map
            var markersLayer = new L.LayerGroup()
            map.addLayer(markersLayer)
            var searchControl = new L.Control.Search({
                layer: markersLayer,
                propertyName: 'name',
                zoom: 15
            })
            map.addControl(searchControl);


            // Looping variabel dataSearch
            // Lalu hasil looping tersebut kita masukkan dalam object geoJSON
            // Dam tambahkan ke layerGroup markersLayer
            for (i in dataSearch) {
                var coords = dataSearch,
                    marker = L.geoJSON(coords)
                markersLayer.addLayer(marker)

                //Looping semua data dari table spot serta relasi ke tabel kategori
                @foreach ($spot as $data)
                    @foreach ($data->getYear as $itemYear)
                        L.geoJSON({!! $data->coordinates !!}, {
                                style: {
                                    color: '{{ $data->fillColor }}',
                                    fillColor: '{{ $data->fillColor }}',
                                    fillOpacity: 0.8,
                                },
                            })
                            .bindPopup("<div class='my-2'><strong>Nama Lokasi:</strong> <br>{{ $data->name }}</div>" +
                                "<div class='my-2'><strong>Tahun:</strong> <br>{{ $itemYear->year }}</div>" +
                                "<div class='my-2'><strong>Deskripsi Lokasi:</strong> <br>{{ $data->description }}</div>" 
                            ).addTo(map);
                    @endforeach
                @endforeach
            }
    </script>
</x-app-layout>


