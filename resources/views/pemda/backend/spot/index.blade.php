<x-app-layout>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between p-2 items-center">
                    <h1 class="text-lg font-bold">Data Table Locations</h1>
                    <button class="inline-flex items-center px-4 py-2 text-white bg-[#75B896] border border-transparent rounded-md hover:border-[#75B896] hover:bg-white hover:text-[#75B896] transition ease-in-out duration-150">
                        <x-link :href="route('spot.create')">
                            {{ __('Create Data') }}
                        </x-link>
                    </button>
                </div>
                <div class="p-2">
                    <table class="w-full">
                        <tr class="bg-[#DBEECB]">
                            <th class="p-3">No</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Year</th>
                            <th class="p-3">Action</th>
                        </tr>
                        @foreach($spots as $spot)
                        
                        <tr class="odd:bg-[#DBEECB]">
                            <td class="text-center p-2">{{$loop->index+1}}</td>
                            @foreach($spot->getYear as $itemYear)
                            <td class="p-2">{{$spot->name}}</td>
                                    <td class="text-center p-2">{{$itemYear->year}}</td>
                                    <td class="text-center p-2 flex justify-center items-center gap-2">
                                        <button class="inline-flex items-center px-4 py-1 text-white bg-[#FFC700] border border-transparent rounded-md hover:border-[#FFC700] hover:bg-white hover:text-[#FFC700] transition ease-in-out duration-150">
                                            <a href="{{ route('spot.details', $spot->slug) }}">
                                                {{ __('Update') }}
                                            </a>
                                        </button>
                                        <form action="{{ route('spot.destroy', $spot->id), }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="inline-flex items-center px-4 py-1 text-white bg-[#E72929] border border-transparent rounded-md hover:border-[#E72929] hover:bg-white hover:text-[#E72929] transition ease-in-out duration-150">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
    
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


