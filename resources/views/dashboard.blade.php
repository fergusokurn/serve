<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800">Total Lagu</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalSongs }}</p>
                    </div>
                    <div class="bg-green-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800">
                            {{ auth()->user()->role === 'admin' ? 'Semua Lagu' : 'Lagu Saya' }}
                        </h3>
                        <p class="text-3xl font-bold text-green-600">{{ $userSongs }}</p>
                    </div>
                    <div class="bg-purple-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-purple-800">Role</h3>
                        <p class="text-xl font-bold text-purple-600 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>

                @if($latestInfo)
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4">Informasi Terbaru</h3>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h4 class="font-semibold text-lg">{{ $latestInfo->title }}</h4>
                        <p class="text-gray-600 text-sm">{{ $latestInfo->date->format('d M Y') }}</p>
                        <p class="mt-2">{{ Str::limit($latestInfo->description, 200) }}</p>
                        @if($latestInfo->image)
                        <img src="data:image/jpeg;base64,{{ $latestInfo->image }}" alt="Info Image" class="mt-4 max-w-xs rounded">
                        @endif
                    </div>
                </div>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('information.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition">
                        <h4 class="font-semibold">Informasi</h4>
                        <p class="text-sm">Lihat semua informasi</p>
                    </a>
                    <a href="{{ route('songs.index') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition">
                        <h4 class="font-semibold">Input Lagu</h4>
                        <p class="text-sm">Kelola lagu</p>
                    </a>
                    <a href="{{ route('chat.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition">
                        <h4 class="font-semibold">Chat</h4>
                        <p class="text-sm">Komunikasi</p>
                    </a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('songs.bahanLagu') }}" class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-lg text-center transition">
                        <h4 class="font-semibold">Bahan Lagu</h4>
                        <p class="text-sm">Cari semua lagu</p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
