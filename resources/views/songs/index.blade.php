<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Input Lagu') }}
            </h2>
            <a href="{{ route('songs.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Insert Lagu
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <script>alert('{{ session('success') }}');</script>
                    {{ session('success') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petugas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lagu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($songs as $song)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $song->nama_petugas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>{{ $song->nama_pic }}</div>
                                    <div class="text-xs text-gray-500">{{ $song->nomor_telp }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>{{ $song->tanggal_tugas ? $song->tanggal_tugas->format('d M Y') : '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $song->waktu_tugas ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="space-y-1">
                                        @if($song->judul_lagu_pembuka)
                                        <div><span class="font-medium">Pembuka:</span> {{ $song->judul_lagu_pembuka }}</div>
                                        @endif
                                        @if($song->judul_lagu_persembahan)
                                        <div><span class="font-medium">Persembahan:</span> {{ $song->judul_lagu_persembahan }}</div>
                                        @endif
                                        @if($song->judul_lagu_komuni)
                                        <div><span class="font-medium">Komuni:</span> {{ $song->judul_lagu_komuni }}</div>
                                        @endif
                                        @if($song->judul_lagu_penutup)
                                        <div><span class="font-medium">Penutup:</span> {{ $song->judul_lagu_penutup }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $song->status === 'diterima' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($song->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    @if(auth()->user()->role === 'admin' || $song->user_id === auth()->id())
                                    <a href="{{ route('songs.edit', $song) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    @endif
                                    @if(auth()->user()->role === 'admin' && $song->status === 'diproses')
                                    <form action="{{ route('songs.updateStatus', $song) }}" method="POST" class="inline">
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
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data lagu.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $songs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
