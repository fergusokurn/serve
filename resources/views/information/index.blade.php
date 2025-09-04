<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Informasi') }}
            </h2>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('information.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Informasi
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <div class="space-y-6">
                    @forelse($informations as $info)
                    <div class="border rounded-lg p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold mb-2">{{ $info->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $info->date->format('d M Y') }}</p>
                                <p class="text-gray-800 mb-4">{{ $info->description }}</p>
                                @if($info->image)
                                <img src="data:image/jpeg;base64,{{ $info->image }}" alt="Info Image" class="max-w-md rounded">
                                @endif
                            </div>
                            @if(auth()->user()->role === 'admin')
                            <div class="flex space-x-2 ml-4">
                                <a href="{{ route('information.edit', $info) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('information.destroy', $info) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-8">Belum ada informasi.</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $informations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
