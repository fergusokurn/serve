<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Lagu - Step 2: Lagu Pembuka') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex items-center">
                        <div class="flex items-center text-green-600">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-green-600 bg-green-600 text-white text-center">
                                <span class="text-sm font-bold">✓</span>
                            </div>
                            <div class="text-xs text-green-600 ml-2">Data Petugas</div>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-green-600"></div>
                        <div class="flex items-center text-blue-600">
                            <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-3 border-2 border-blue-600 bg-blue-600 text-white text-center">
                                <span class="text-sm font-bold">2</span>
                            </div>
                            <div class="text-xs text-blue-600 ml-2">Lagu Pembuka</div>
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

                <form action="{{ route('songs.store-step2') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="judul_lagu_pembuka" class="block text-sm font-medium text-gray-700">Judul Lagu Pembuka *</label>
                        <input type="text" name="judul_lagu_pembuka" id="judul_lagu_pembuka" 
                               value="{{ old('judul_lagu_pembuka', session('song_data.judul_lagu_pembuka')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               autocomplete="off">
                        <div id="suggestions_pembuka" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden"></div>
                        @error('judul_lagu_pembuka')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="sumber_lagu_pembuka" class="block text-sm font-medium text-gray-700">Sumber Lagu Pembuka *</label>
                        <input type="text" name="sumber_lagu_pembuka" id="sumber_lagu_pembuka" 
                               value="{{ old('sumber_lagu_pembuka', session('song_data.sumber_lagu_pembuka')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('sumber_lagu_pembuka')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="teks_lagu_pembuka" class="block text-sm font-medium text-gray-700">Teks Lagu Pembuka *</label>
                        <textarea name="teks_lagu_pembuka" id="teks_lagu_pembuka" rows="8" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('teks_lagu_pembuka', session('song_data.teks_lagu_pembuka')) }}</textarea>
                        @error('teks_lagu_pembuka')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('songs.create') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Kembali
                        </a>
                        <div class="space-x-3">
                            <button type="button" onclick="saveDraft()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Simpan Draft
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Lanjut ke Lagu Persembahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Song database for suggestions
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
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !suggestions.contains(e.target)) {
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
            const fields = ['judul_lagu_pembuka', 'sumber_lagu_pembuka', 'teks_lagu_pembuka'];
            for (let field of fields) {
                const value = document.getElementById(field).value.trim();
                if (!value) {
                    alert('Silahkan isi field: ' + document.querySelector(`label[for="${field}"]`).textContent.replace(' *', ''));
                    return false;
                }
            }
            return true;
        }
        
        function saveDraft() {
            // Add draft saving functionality here
            alert('Draft akan disimpan (fitur akan dikembangkan)');
        }
        
        // Initialize autocomplete
        setupAutocomplete('judul_lagu_pembuka', 'suggestions_pembuka', 'pembuka');
    </script>
</x-app-layout>
