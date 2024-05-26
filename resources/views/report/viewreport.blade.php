<x-app-layout>
    <style>
        /* Styles for custom buttons */
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

        .seemaps {
            color: #395a5b;
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

        /* Styling for the card */
        .card {
            background-color: #FFFFFF; /* White color */
            border: 1px solid #E5E7EB; /* Border color */
            border-radius: 2.975rem; /* Rounded corners */
            padding: 1rem; /* Padding inside the card */
            width: 100%; /* Card width */
            display: flex;
            flex-wrap: wrap; /* Allows flex wrapping */
            margin-bottom: 20px; /* Margin between each card */
        }

        /* Styling for the layer below the card */
        .layer {
            background-color: #F4F4F4; /* Light gray color */
            border-radius: 3.375rem; /* Rounded corners */
            padding: 1rem; /* Padding inside the layer */
            margin-top: 1rem; /* Top margin */
        }

        /* Styling for text inside the card */
        .left-elements {
            flex: 1; /* Arrange elements on the left */
        }

        .right-elements {
            flex: 1; /* Arrange elements on the right */
            text-align: right; /* Right-align text */
        }

        /* Styling for the line separator */
        .line {
            width: 100%; /* Line width */
            border-bottom: 1px solid #E5E7EB; /* Horizontal line */
            margin: 1rem 0; /* Margin between line and description */
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
                    <div class="flex justify-center mt-4 ">
                        <a href="{{ route('filter', 'penghijauan') }}" class="custom-button penghijauan mr-1 font-bold">Penghijauan</a>
                        <a href="{{ route('filter', 'kerusakan') }}" class="custom-button kerusakan font-bold">Kerusakan</a>
                    </div>
                    
                    @if (session('success'))
                        <div class="bg-orange-100 border border-orange-400 text-red-700 px-4 py-3 rounded relative mt-3" role="alert">
                            <strong class="font-bold">Deleted!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <button onclick="this.parentElement.style.display='none'" class="text-red-500 hover:text-red-700 focus:outline-none">
                                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.435a1 1 0 01-1.456-1.374l3.333-2.777a1 1 0 011.192 0l3.333 2.777a.997.997 0 010 1.457z"/></svg>
                                </button>
                            </span>
                        </div>
                    @endif

                    <div class="layer">    
                        <!-- Card for each report -->
                        @foreach ($reports as $key => $report)
                        <div class="card">
                            <div class="left-elements">
                                <div class="report-title font-bold text-3xl ml-4 mt-1">{{ $report->report_title }}</div>
                            </div>
                            <div class="right-elements">
                                <div class="date text-xl font-bold mr-4">{{ Carbon\Carbon::parse($report->date)->format('d F Y') }}</div> 
                                <div class="category font-bold mr-4 mt-1 mb-1"> 
                                    <span class="@if($report->category == 'Kerusakan') category-kerusakan @elseif($report->category == 'Penghijauan') category-penghijauan @endif">
                                        {{ $report->category }}
                                    </span>
                                </div>
                                <div class="view font-bold mb-1 mt-1"> 
                                    <a href="{{ route('viewdetail', $report->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full ml-2 mr">View Detail</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $reports->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageModal = document.getElementById('imageModal');
        var closeImage = imageModal.querySelector('.close-image');
        var imageSrc = imageModal.querySelector('#imageSrc');

        // Function to display image modal
        function displayImageModal(imageUrl) {
            imageSrc.src = imageUrl;
            imageModal.classList.remove('hidden');
        }

        // Function to hide image modal
        function hideImageModal() {
            imageModal.classList.add('hidden');
        }

        // Add event listener to each image link
        document.querySelectorAll('.view-image').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var imageUrl = this.getAttribute('href');
                displayImageModal(imageUrl);
            });
        });

        // Add event listener to close button
        closeImage.addEventListener('click', function() {
            hideImageModal();
        });

        // Add event listener to click outside modal
        window.addEventListener('click', function(event) {
            if (event.target == imageModal) {
                hideImageModal();
            }
        });
    });
</script>
