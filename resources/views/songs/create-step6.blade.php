<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Lagu - Step 6: Liturgi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('songs.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="tuhan_kasihanilah" class="block text-sm font-medium text-gray-700">Tuhan Kasihanilah *</label>
                        <textarea name="tuhan_kasihanilah" id="tuhan_kasihanilah" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('tuhan_kasihanilah', session('song_data.tuhan_kasihanilah')) }}</textarea>
                        @error('tuhan_kasihanilah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kemuliaan" class="block text-sm font-medium text-gray-700">Kemuliaan *</label>
                        <textarea name="kemuliaan" id="kemuliaan" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('kemuliaan', session('song_data.kemuliaan')) }}</textarea>
                        @error('kemuliaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kudus" class="block text-sm font-medium text-gray-700">Kudus *</label>
                        <textarea name="kudus" id="kudus" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('kudus', session('song_data.kudus')) }}</textarea>
                        @error('kudus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="anamnesis" class="block text-sm font-medium text-gray-700">Anamnesis *</label>
                        <textarea name="anamnesis" id="anamnesis" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('anamnesis', session('song_data.anamnesis')) }}</textarea>
                        @error('anamnesis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bapa_kami" class="block text-sm font-medium text-gray-700">Bapa Kami *</label>
                        <textarea name="bapa_kami" id="bapa_kami" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bapa_kami', session('song_data.bapa_kami')) }}</textarea>
                        @error('bapa_kami')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="anak_domba_allah" class="block text-sm font-medium text-gray-700">Anak Domba Allah *</label>
                        <textarea name="anak_domba_allah" id="anak_domba_allah" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('anak_domba_allah', session('song_data.anak_domba_allah')) }}</textarea>
                        @error('anak_domba_allah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan *</label>
                        <textarea name="keterangan" id="keterangan" rows="3" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('keterangan', session('song_data.keterangan')) }}</textarea>
                        @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('songs.create-step5') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Kembali
                        </a>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Simpan Semua Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            const fields = ['tuhan_kasihanilah', 'kemuliaan', 'kudus', 'anamnesis', 'bapa_kami', 'anak_domba_allah', 'keterangan'];
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
