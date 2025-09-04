<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bahan Lagu') }}
        </h2>
    </x-slot>

    <style>
        .scrollable-text {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
        }
        .scrollable-text::-webkit-scrollbar {
            width: 8px;
        }
        .scrollable-text::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 4px;
        }
        .scrollable-text::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }
        .scrollable-text::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
        .text-cell {
            max-width: none;
            width: 100%;
            word-wrap: break-word;
        }
        .text-cell .scrollable-text {
            max-height: 300px;
        }
        #songDetails {
            height: calc(100vh - 200px);
            overflow-y: scroll !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Search Form -->
                <div class="mb-6">
                    <form action="{{ route('songs.bahanLagu') }}" method="GET" class="flex space-x-4">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari berdasarkan judul lagu, nama petugas, atau tanggal..."
                               class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Cari
                        </button>
                        @if(request('search'))
                        <a href="{{ route('songs.bahanLagu') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Reset
                        </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petugas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Tugas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Lagu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($songs as $song)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $song->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $song->nama_petugas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $song->tanggal_tugas->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $song->judul_lagu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $song->status === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($song->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="showDetails({{ $song->id }})" class="text-blue-600 hover:text-blue-900">
                                        Detail
                                    </button>
                                    @if($song->status === 'diproses')
                                    <form action="{{ route('songs.updateStatus', $song) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Terima lagu ini?')">
                                            Terima
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    {{ request('search') ? 'Tidak ada hasil pencarian.' : 'Belum ada data lagu.' }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $songs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for song details -->
    <div id="songModal" class="fixed inset-0 bg-white hidden z-50">
        <div class="w-full h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center p-8 border-b bg-gray-50">
                <div class="flex items-center space-x-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Detail Lagu</h3>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span id="pageInfo" class="bg-blue-100 text-blue-800 px-3 py-2 rounded">Halaman 1 dari 4</span>
                    </div>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 p-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
<div id="songDetails" class="flex-1 p-8 overflow-y-auto" style="max-height: calc(100vh - 200px);"></div>

            <!-- Footer -->
            <div class="flex justify-between items-center border-t p-8 bg-gray-50 flex-shrink-0">
                <button id="prevBtn" onclick="changePage(-1)" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded 
                            disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    ← Sebelumnya
                </button>
                <div class="flex space-x-2">
                    <button onclick="goToPage(1)" class="page-btn px-3 py-1 rounded transition-colors">1</button>
                    <button onclick="goToPage(2)" class="page-btn px-3 py-1 rounded transition-colors">2</button>
                    <button onclick="goToPage(3)" class="page-btn px-3 py-1 rounded transition-colors">3</button>
                    <button onclick="goToPage(4)" class="page-btn px-3 py-1 rounded transition-colors">4</button>
                </div>
                <button id="nextBtn" onclick="changePage(1)" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded 
                            disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>


    <script>
        const songs = @json($songs->items());
        let currentPage = 1;
        let currentSong = null;
        
        function showDetails(songId) {
            currentSong = songs.find(s => s.id === songId);
            currentPage = 1;
            if (currentSong) {
                renderPage();
                document.getElementById('songModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }
        }

        function renderPage() {
            const formatDate = (dateString) => {
                return new Date(dateString).toLocaleDateString('id-ID', {
                    day: '2-digit', month: 'long', year: 'numeric'
                });
            };

            const formatTime = (timeString) => {
                return timeString ? timeString.substring(0, 5) : '-';
            };

            const formatText = (text) => {
                if (!text) return '<span class="text-gray-500">-</span>';
                const isLongText = text.length > 200;
                return `<div class="bg-gray-50 p-3 rounded text-sm border text-cell ${isLongText ? 'scrollable-text' : ''}" ${isLongText ? 'title="Scroll untuk melihat selengkapnya"' : ''}>
                    <pre class="whitespace-pre-wrap">${text}</pre>
                    ${isLongText ? '<div class="text-xs text-gray-400 mt-1 italic">↕ Scroll untuk melihat selengkapnya</div>' : ''}
                </div>`;
            };

            const pages = {
                1: `<table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="bg-blue-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-blue-800">INFORMASI PETUGAS</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 w-1/3">Nama Petugas</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.nama_petugas || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Tanggal Tugas</td><td class="px-4 py-3 text-sm text-gray-700">${formatDate(currentSong.tanggal_tugas)}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900">Nama PIC</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.nama_pic || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Nomor Telp</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.nomor_telp || '-'}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900">Waktu Tugas</td><td class="px-4 py-3 text-sm text-gray-700">${formatTime(currentSong.waktu_tugas)}</td></tr>
                        <tr class="bg-green-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-green-800">LAGU PEMBUKA</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900">Judul</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.judul_lagu_pembuka || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Sumber</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.sumber_lagu_pembuka || '-'}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Teks</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.teks_lagu_pembuka)}</td></tr>
                    </tbody></table>`,
                2: `<table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="bg-purple-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-purple-800">LAGU PERSEMBAHAN</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 w-1/3">Judul</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.judul_lagu_persembahan || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Sumber</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.sumber_lagu_persembahan || '-'}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Teks</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.teks_lagu_persembahan)}</td></tr>
                        <tr class="bg-yellow-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-yellow-800">LAGU KOMUNI</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900">Judul</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.judul_lagu_komuni || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Sumber</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.sumber_lagu_komuni || '-'}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Teks</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.teks_lagu_komuni)}</td></tr>
                    </tbody></table>`,
                3: `<table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="bg-red-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-red-800">LAGU PENUTUP</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 w-1/3">Judul</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.judul_lagu_penutup || '-'}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Sumber</td><td class="px-4 py-3 text-sm text-gray-700">${currentSong.sumber_lagu_penutup || '-'}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Teks</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.teks_lagu_penutup)}</td></tr>
                        <tr class="bg-indigo-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-indigo-800">LITURGI</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Tuhan Kasihanilah</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.tuhan_kasihanilah)}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Kemuliaan</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.kemuliaan)}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Kudus</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.kudus)}</td></tr>
                    </tbody></table>`,
                4: `<table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="bg-indigo-50"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-indigo-800">LITURGI (LANJUTAN)</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 w-1/3 align-top">Anamnesis</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.anamnesis)}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Bapa Kami</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.bapa_kami)}</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Anak Domba Allah</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.anak_domba_allah)}</td></tr>
                        <tr class="bg-gray-100"><td colspan="2" class="px-4 py-3 text-sm font-semibold text-gray-800">INFORMASI TAMBAHAN</td></tr>
                        <tr><td class="px-4 py-3 text-sm font-medium text-gray-900 align-top">Keterangan</td><td class="px-4 py-3 text-sm text-gray-700">${formatText(currentSong.keterangan)}</td></tr>
                        <tr class="bg-gray-50"><td class="px-4 py-3 text-sm font-medium text-gray-900">Status</td><td class="px-4 py-3 text-sm text-gray-700"><span class="px-2 py-1 text-xs rounded-full ${currentSong.status === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">${currentSong.status.charAt(0).toUpperCase() + currentSong.status.slice(1)}</span></td></tr>
                    </tbody></table>`
            };

            document.getElementById('songDetails').innerHTML = pages[currentPage];
            document.getElementById('pageInfo').textContent = `Halaman ${currentPage} dari 4`;
            
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === 4;
            
            document.querySelectorAll('.page-btn').forEach((btn, index) => {
                btn.className = `page-btn px-3 py-1 rounded ${index + 1 === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
            });
        }

        function changePage(direction) {
            const newPage = currentPage + direction;
            if (newPage >= 1 && newPage <= 4) {
                currentPage = newPage;
                renderPage();
            }
        }

        function goToPage(page) {
            currentPage = page;
            renderPage();
        }
        
        function closeModal() {
            document.getElementById('songModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore background scrolling
        }
    </script>
</x-app-layout>
