<x-app-layout> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center py-2 mb-4 text-3xl font-bold bg-[#75B896] h-[75px] flex justify-center items-center">
                    <h1>
                        Selamat Datang di Dashboard Pelestarian Hutan Mangrove
                    </h1>
                </div>
                <div class="text-center py-2">
                    <h1>
                    Hutan mangrove sangat penting bagi ekosistem Indonesia, 
                    melindungi pantai dan menjadi habitat bagi banyak spesies. 
                    Namun, hutan ini terancam oleh kerusakan dan perubahan iklim. 
                    Lihatlah diagram kami untuk memahami tingkat kerusakan dan upaya penghijauan yang sedang dilakukan. 
                    Mari bersama-sama menjaga hutan mangrove demi masa depan yang lebih hijau.
                    </h1>
                </div>
                <div class="flex items-center justify-center">
                    <div class="bg-[#75B896] text-white text-center text-3xl font-bold h-[75px] w-[870px] flex justify-center items-center rounded-2xl">
                        <h1>Data Statistik Hutan Mangrove</h1>
                    </div>
                </div>
                <div class="p-6 text-gray-900 grid grid-cols-2 h-auto">
                    <div class="w-full h-full p-4">
                        {!! $chartPenghijauan->render() !!} 
                    </div>
                    <div class="w-full h-full p-4">
                        {!! $chartKerusakan->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>