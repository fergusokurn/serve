<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lagu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('songs.update', $song) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas *</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" value="{{ old('nama_petugas', $song->nama_petugas) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_petugas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_tugas" class="block text-sm font-medium text-gray-700">Tanggal Tugas *</label>
                        <input type="date" name="tanggal_tugas" id="tanggal_tugas" value="{{ old('tanggal_tugas', $song->tanggal_tugas->format('Y-m-d')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_tugas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="judul_lagu" class="block text-sm font-medium text-gray-700">Judul Lagu *</label>
                        <input type="text" name="judul_lagu" id="judul_lagu" value="{{ old('judul_lagu', $song->judul_lagu) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('judul_lagu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="teks_lagu" class="block text-sm font-medium text-gray-700">Teks Lagu *</label>
                        <textarea name="teks_lagu" id="teks_lagu" rows="8" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('teks_lagu', $song->teks_lagu) }}</textarea>
                        @error('teks_lagu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan *</label>
                        <textarea name="keterangan" id="keterangan" rows="3" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', $song->keterangan) }}</textarea>
                        @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('songs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
