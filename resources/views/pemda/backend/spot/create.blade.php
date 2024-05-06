<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6"/>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-5 text-gray-700"> --}}
                {{-- <div class="max-w-md mx-auto">      --}}
                <!-- Header Table -->
                <div style="background-color: #75B896; color: white;" class="text-center py-2 mb-4 text-xl">
                    Add Locations
                </div>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-lg px-4 py-6">

                    <!-- Button back -->
                    <a href="{{ url()->previous() }}" class="underline" >Back</a>

                    <!-- Title 'Locations DETAILS' -->
                    <h2 class="text-center text-3xl mb-3 text-gray-700">LOCATIONS DETAILS</h2>

                    <!-- Form Registrasi -->
                    <form method="POST" action="{{ route('spot.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mt-4 grid grid-cols-2">
                            <label for="name" class="text-gray-700">Name</label>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4 grid grid-cols-2">
                            <label for="description" class="text-gray-700">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        
                        <!-- Year -->
                        <div class="mt-4 grid grid-cols-2">
                            <label for="year_id[]" class="text-gray-700">Year</label>
                            <select id="year_id" name="year_id[]" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($years as $itemYears)
                                <option value="{{ $itemYears->id }}">{{ $itemYears->year }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                        
                        <!-- Coordinates map -->
                        <div class="mt-4 grid grid-cols-2">
                            <div>Select Area</div>
                            <div id="map" style="height: 400px;"></div>
                        </div>

                        <!-- Coordinates -->
                        <div class="mt-4 grid grid-cols-2">
                            <label for="coordinates" class="text-gray-700">Coordinates</label>
                            <textarea name="coordinates" id="coordinates" cols="30" rows="10" readonly></textarea>
                            <x-input-error :messages="$errors->get('coordinates')" class="mt-2" />
                        </div>

                        <!-- fillColor -->
                        <!-- <div class="mt-4 grid grid-cols-2">
                            <label for="fillColor" class="textFill Color</label>
                            <x-text-input id="fills"b mt-1w-mlClColor" />
                            <x-input-error :messages="$errors->get('fillColor')" class="mt-2" />
                        </div> -->
                        
                        <!-- fillColor -->
                        <div class="mt-4 grid grid-cols-2">
                            <p class="text-gray-700"">Fill Color</p>
                            <div>
                                <div class="flex items-center mb-4">
                                    <x-text-input id="fillColor" value="#65B741" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="fillColor" required autocomplete="fillColor" />
                                    <label for="fillColor" class="ms-2 font-medium text-gray-700">High fertility</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <x-text-input id="fillColor" value="#FFFEC4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="fillColor" required autocomplete="fillColor" />
                                    <label for="fillColor" class="ms-2 font-medium text-gray-700">Medium fertility</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <x-text-input id="fillColor" value="#FFCF81" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" type="radio" name="fillColor" required autocomplete="fillColor" />
                                    <label for="fillColor" class="ms-2 font-medium text-gray-700">Low fertility</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('fillColor')" class="mt-2" />
                        </div>

                        <!-- Tombol Add -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" style="background-color: #75B896; color: white;">
                                {{ __('Add location') }}
                            </x-primary-button>
                        </div>

                        {{-- Notification Alert --}}
                        @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg @click="show = false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path fill-rule="evenodd" d="M14.348 5.652a.5.5 0 0 0-.708 0L10 9.293 6.36 5.652a.5.5 0 1 0-.708.708L9.293 10l-3.64 3.64a.5.5 0 0 0 .708.708L10 10.707l3.64 3.64a.5.5 0 0 0 .708-.708L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z" />
                                </svg>
                            </span>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- {{-- Load cdn js leaflet --}} -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- {{-- Load cdn js leaflet Draw --}} -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <!-- {{-- Load cdn js select2 --}} -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- {{-- Load cdn js plugin leaflet fullscreen map --}} -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>
    <script>
        let map = L.map("map", {
            fullscreenControl: {
                pseudoFullscreen: false
            },
        }).setView([-.18353765071211733, 116.30192451474325], 3);
        L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //Membuat featureGroup untuk layer drawnItems
        let drawnItems = new L.FeatureGroup;
        map.addLayer(drawnItems);

        //Membuat drawControl leaflet
        //Untuk mengaktifkan fitur seperti polyline, marker dan yang lainnya
        //Ubah nilainya menjadi true
        //Contoh : {polyline:true}
        let drawControl = new L.Control.Draw({
            position: "topright",
            draw: {
                polygon: {
                    //Mengatur warna dan ketebalan garis
                    shapeOptions: {
                        color: "#04628A",
                        weight: 5,
                        opacity: .65
                    }
                },
                polyline: !1,
                rectangle: !1,
                circle: !1,
                circlemarker: !1,
                marker: true
            },
            edit: {
                featureGroup: drawnItems
            }
        });

        // Menambahkan drawControl pada addControl dan juga mengaktifkan
        // event draw created, edited, dan deleted
        map.addControl(drawControl), map.on("draw:created", function(e) {
            // Ketika event created aktif
            // Kita akan menambahkan feature, properties, type geometri, titik koordinat
            // dari layer drawnItems. Lalu hasil Jsonnya  akan kita ubah 
            // Ke format GeoJSON dan tampilkan hasilnya pada textarea dengan id resultGeoJson.
            let nameInput = document.getElementById('name').value;
            console.log(nameInput);
            var layer = e.layer,
                feature = layer.feature = layer.feature || {};
            feature.type = feature.type || "Feature", (feature.properties = feature.properties || {}).name =
                nameInput, drawnItems.addLayer(layer)
            var feature = JSON.stringify(drawnItems.toGeoJSON());
            document.getElementById("coordinates").value = feature

        }), map.on("draw:edited", function(e) {
            // Untuk event edited 
            // Jika terjadi kesalahan kita bisa mengubahnya lalu
            // menambahkan feature, properties, type geometri, titik koordinat yang baru
            // dari layer drawnItems. Lalu hasil Jsonnya akan kita ubah 
            // Ke format GeoJSON dan tampilkan hasilnya pada textarea dengan id resultGeoJson.
            let nameInput = document.getElementById('name').value;
            let layers = e.layers
            layers.eachLayer(function(layer) {
                let feature = layer.feature = layer.feature || {};
                feature.type = feature.type || "Feature", (feature.properties = feature.properties || {}).name = nameInput, drawnItems.addLayer(layer)
                let r = JSON.stringify(drawnItems.toGeoJSON());
                document.getElementById("coordinates").value = r
            })
        }), map.on("draw:deleted", function(e) {
            // Untuk event deleted akan menghapus vector yang kita gambar 
            e.layers.eachLayer(function(e) {
                document.getElementById("coordinates").value = ""
            })
        });
    </script>
</x-app-layout>