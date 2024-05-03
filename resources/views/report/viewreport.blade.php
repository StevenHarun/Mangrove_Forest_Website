<x-app-layout>
    <style>
        .custom-button {
            background-color: #F2FAE9;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: none;
            cursor: pointer;
        }

        .penghijauan {
            color: #49B56D;
        }

        .kerusakan {
            color: #EC9D84;
        }

        /* Styling for category Kerusakan */
        .category-kerusakan {
            background-color: #FEE2B2;
            border-color: #F59E0B;
        }

        /* Styling for category Penghijauan */
        .category-penghijauan {
            background-color: #C6F6D5;
            border-color: #10B981;
        }
    </style>

    <!-- Content -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Table -->
                    <div style="background-color: #75B896; color: white;" class="text-center py-3 mb-1 text-xl">
                        Report History
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex justify-center mt-4">
                        <a href="{{ route('filter', 'penghijauan') }}" class="custom-button penghijauan mr-4">Penghijauan</a>
                        <a href="{{ route('filter', 'kerusakan') }}" class="custom-button kerusakan">Kerusakan</a>
                    </div>

                    <!-- Card for each report -->
                    @foreach ($reports as $key => $report)
                    <div class="flex items-center justify-between px-4 py-2 mt-4">
                        <div class="flex flex-col">
                            <div class="text-gray-700 text-2xl font-bold">{{ $report->report_title }}</div>
                            <div class="text-m text-gray-500">Category: 
                                <span class="@if($report->category == 'Kerusakan') category-kerusakan @elseif($report->category == 'Penghijauan') category-penghijauan @endif">
                                    {{ $report->category }}
                                </span>
                            </div> <!-- Styling hanya untuk tulisan kategori -->
                            <div class="text-m text-gray-500">Location: {{ $report->location }}</div> 
                            <div class="text-m text-gray-500">Date: {{ $report->date }}</div>
                            <div class="text-m text-gray-500">Deskripsi: {{ $report->description }}</div>
                        </div>
                        <div>
                            <!-- Display Image -->
                            @if ($report->image)
                                <a href="{{ route('reports.image', $report->id) }}" class="view-image">View</a>
                            @else
                                No image
                            @endif
                        </div>
                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageModal = document.getElementById('imageModal');
        var closeImage = imageModal.querySelector('.close-image');
        var imageSrc = imageModal.querySelector('#imageSrc');

        // Fungsi untuk menampilkan modal image
        function displayImageModal(imageUrl) {
            imageSrc.src = imageUrl;
            imageModal.classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan modal image
        function hideImageModal() {
            imageModal.classList.add('hidden');
        }

        // Menambahkan event listener untuk setiap link gambar
        document.querySelectorAll('.view-image').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var imageUrl = this.getAttribute('href');
                displayImageModal(imageUrl);
            });
        });

        // Menambahkan event listener untuk tombol close
        closeImage.addEventListener('click', function() {
            hideImageModal();
        });

        // Menambahkan event listener untuk klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target == imageModal) {
                hideImageModal();
            }
        });
    });
</script>
