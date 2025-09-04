<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Lagu - Step 5: Lagu Penutup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('songs.store-step5') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    
                    <div class="mb-4 relative">
                        <label for="judul_lagu_penutup" class="block text-sm font-medium text-gray-700">Judul Lagu Penutup *</label>
                        <input type="text" name="judul_lagu_penutup" id="judul_lagu_penutup" 
                               value="{{ old('judul_lagu_penutup', session('song_data.judul_lagu_penutup')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               autocomplete="off">
                        <div id="suggestions_penutup" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden"></div>
                    </div>

                    <div class="mb-4">
                        <label for="sumber_lagu_penutup" class="block text-sm font-medium text-gray-700">Sumber Lagu Penutup *</label>
                        <input type="text" name="sumber_lagu_penutup" id="sumber_lagu_penutup" 
                               value="{{ old('sumber_lagu_penutup', session('song_data.sumber_lagu_penutup')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label for="teks_lagu_penutup" class="block text-sm font-medium text-gray-700">Teks Lagu Penutup *</label>
                        <textarea name="teks_lagu_penutup" id="teks_lagu_penutup" rows="8" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('teks_lagu_penutup', session('song_data.teks_lagu_penutup')) }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('songs.create-step4') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Kembali
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Lanjut ke Liturgi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const songDatabase = @json($songs ?? []);

        function setupAutocomplete(inputId, suggestionsId, type) {
            const input = document.getElementById(inputId);
            const suggestions = document.getElementById(suggestionsId);
            
            input.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                if (query.length < 2) {
                    suggestions.classList.add('hidden');
                    return;
                }
                
                const matches = songDatabase.filter(song => 
                    song[`judul_lagu_${type}`] && 
                    song[`judul_lagu_${type}`].toLowerCase().includes(query)
                );
                
                if (matches.length > 0) {
                    suggestions.innerHTML = matches.map(song => 
                        `<div class="p-2 hover:bg-gray-100 cursor-pointer" onclick="selectSong('${type}', ${JSON.stringify(song).replace(/"/g, '&quot;')})">
                            <div class="font-medium">${song[`judul_lagu_${type}`]}</div>
                            <div class="text-sm text-gray-500">${song[`sumber_lagu_${type}`] || ''}</div>
                        </div>`
                    ).join('');
                    suggestions.classList.remove('hidden');
                } else {
                    suggestions.classList.add('hidden');
                }
            });
        }
        
        function selectSong(type, song) {
            document.getElementById(`judul_lagu_${type}`).value = song[`judul_lagu_${type}`] || '';
            document.getElementById(`sumber_lagu_${type}`).value = song[`sumber_lagu_${type}`] || '';
            document.getElementById(`teks_lagu_${type}`).value = song[`teks_lagu_${type}`] || '';
            document.getElementById(`suggestions_${type}`).classList.add('hidden');
        }
        
        function validateForm() {
            const fields = ['judul_lagu_penutup', 'sumber_lagu_penutup', 'teks_lagu_penutup'];
            for (let field of fields) {
                const value = document.getElementById(field).value.trim();
                if (!value) {
                    alert('Silahkan isi field: ' + document.querySelector(`label[for="${field}"]`).textContent.replace(' *', ''));
                    return false;
                }
            }
            return true;
        }
        
        setupAutocomplete('judul_lagu_penutup', 'suggestions_penutup', 'penutup');
    </script>
</x-app-layout>
