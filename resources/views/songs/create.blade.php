<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Lagu - Step 1: Data Petugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex items-center">
                        <div class="flex items-center text-blue-600">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-blue-600 bg-blue-600 text-white text-center">
                                <span class="text-sm font-bold">1</span>
                            </div>
                            <div class="text-xs text-blue-600 ml-2">Data Petugas</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                        <div class="flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-gray-300 text-center">
                                <span class="text-sm font-bold">2</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-2">Lagu Pembuka</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                        <div class="flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-gray-300 text-center">
                                <span class="text-sm font-bold">3</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-2">Lagu Persembahan</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                        <div class="flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-gray-300 text-center">
                                <span class="text-sm font-bold">4</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-2">Lagu Komuni</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                        <div class="flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-gray-300 text-center">
                                <span class="text-sm font-bold">5</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-2">Lagu Penutup</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                        <div class="flex items-center text-gray-500">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-gray-300 text-center">
                                <span class="text-sm font-bold">6</span>
                            </div>
                            <div class="text-xs text-gray-500 ml-2">Liturgi</div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('songs.store-step1') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas *</label>
                        <p class="text-xs text-gray-500 mb-2">Silahkan isi nama Kelompok Koor/Lingkungan/Wilayah</p>
                        <input type="text" name="nama_petugas" id="nama_petugas" value="{{ old('nama_petugas', session('song_data.nama_petugas')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_petugas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama_pic" class="block text-sm font-medium text-gray-700">Nama PIC *</label>
                        <p class="text-xs text-gray-500 mb-2">Silahkan isi Nama Penanggung Jawab</p>
                        <input type="text" name="nama_pic" id="nama_pic" value="{{ old('nama_pic', session('song_data.nama_pic')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nama_pic')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nomor_telp" class="block text-sm font-medium text-gray-700">Nomor Telp *</label>
                        <p class="text-xs text-gray-500 mb-2">Silahkan isi Nomor Telp PIC</p>
                        <input type="tel" name="nomor_telp" id="nomor_telp" value="{{ old('nomor_telp', session('song_data.nomor_telp')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nomor_telp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_tugas" class="block text-sm font-medium text-gray-700">Tanggal Tugas *</label>
                        <p class="text-xs text-gray-500 mb-2">Silahkan isi Tanggal anda tugas</p>
                        <input type="date" name="tanggal_tugas" id="tanggal_tugas" value="{{ old('tanggal_tugas', session('song_data.tanggal_tugas')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('tanggal_tugas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="waktu_tugas" class="block text-sm font-medium text-gray-700">Waktu Tugas *</label>
                        <p class="text-xs text-gray-500 mb-2">Silahkan isi Pukul Berapa Anda Tugas</p>
                        <select name="waktu_tugas" id="waktu_tugas" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Waktu Tugas</option>
                            @for($hour = 5; $hour <= 22; $hour++)
                                @for($minute = 0; $minute < 60; $minute += 30)
                                    @php
                                        $time = sprintf('%02d:%02d', $hour, $minute);
                                        $selected = old('waktu_tugas', session('song_data.waktu_tugas')) == $time ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $time }}" {{ $selected }}>{{ $time }}</option>
                                @endfor
                            @endfor
                        </select>
                        @error('waktu_tugas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('songs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Lanjut ke Lagu Pembuka
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            const fields = ['nama_petugas', 'nama_pic', 'nomor_telp', 'tanggal_tugas', 'waktu_tugas'];
            for (let field of fields) {
                const value = document.getElementById(field).value.trim();
                if (!value) {
                    alert('Silahkan isi field: ' + document.querySelector(`label[for="${field}"]`).textContent.replace(' *', ''));
                    return false;
                }
            }
            return true;
        }
    </script>
</x-app-layout>
