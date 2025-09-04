<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    public function index()
    {
        $songs = auth()->user()->role === 'admin' ? 
            Song::with('user')->latest()->paginate(10) : 
            Song::where('user_id', auth()->id())->latest()->paginate(10);
        
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        // Clear any existing session data
        session()->forget('song_data');
        return view('songs.create');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'nomor_telp' => 'required|string|max:20',
            'tanggal_tugas' => 'required|date',
            'waktu_tugas' => 'required|string',
        ]);

        // Store step 1 data in session
        session(['song_data' => array_merge(session('song_data', []), $request->all())]);

        return redirect()->route('songs.create-step2');
    }

    public function createStep2()
    {
        if (!session('song_data')) {
            return redirect()->route('songs.create')->with('error', 'Silahkan mulai dari step 1');
        }

        // Get existing songs for autocomplete
        $songs = Song::select('judul_lagu_pembuka', 'sumber_lagu_pembuka', 'teks_lagu_pembuka')
                    ->whereNotNull('judul_lagu_pembuka')
                    ->get();

        return view('songs.create-step2', compact('songs'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'judul_lagu_pembuka' => 'required|string|max:255',
            'sumber_lagu_pembuka' => 'required|string|max:255',
            'teks_lagu_pembuka' => 'required|string',
        ]);

        session(['song_data' => array_merge(session('song_data', []), $request->all())]);

        return redirect()->route('songs.create-step3');
    }

    public function createStep3()
    {
        if (!session('song_data')) {
            return redirect()->route('songs.create')->with('error', 'Silahkan mulai dari step 1');
        }

        $songs = Song::select('judul_lagu_persembahan', 'sumber_lagu_persembahan', 'teks_lagu_persembahan')
                    ->whereNotNull('judul_lagu_persembahan')
                    ->get();

        return view('songs.create-step3', compact('songs'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'judul_lagu_persembahan' => 'required|string|max:255',
            'sumber_lagu_persembahan' => 'required|string|max:255',
            'teks_lagu_persembahan' => 'required|string',
        ]);

        session(['song_data' => array_merge(session('song_data', []), $request->all())]);

        return redirect()->route('songs.create-step4');
    }

    public function createStep4()
    {
        if (!session('song_data')) {
            return redirect()->route('songs.create')->with('error', 'Silahkan mulai dari step 1');
        }

        $songs = Song::select('judul_lagu_komuni', 'sumber_lagu_komuni', 'teks_lagu_komuni')
                    ->whereNotNull('judul_lagu_komuni')
                    ->get();

        return view('songs.create-step4', compact('songs'));
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            'judul_lagu_komuni' => 'required|string|max:255',
            'sumber_lagu_komuni' => 'required|string|max:255',
            'teks_lagu_komuni' => 'required|string',
        ]);

        session(['song_data' => array_merge(session('song_data', []), $request->all())]);

        return redirect()->route('songs.create-step5');
    }

    public function createStep5()
    {
        if (!session('song_data')) {
            return redirect()->route('songs.create')->with('error', 'Silahkan mulai dari step 1');
        }

        $songs = Song::select('judul_lagu_penutup', 'sumber_lagu_penutup', 'teks_lagu_penutup')
                    ->whereNotNull('judul_lagu_penutup')
                    ->get();

        return view('songs.create-step5', compact('songs'));
    }

    public function storeStep5(Request $request)
    {
        $request->validate([
            'judul_lagu_penutup' => 'required|string|max:255',
            'sumber_lagu_penutup' => 'required|string|max:255',
            'teks_lagu_penutup' => 'required|string',
        ]);

        session(['song_data' => array_merge(session('song_data', []), $request->all())]);

        return redirect()->route('songs.create-step6');
    }

    public function createStep6()
    {
        if (!session('song_data')) {
            return redirect()->route('songs.create')->with('error', 'Silahkan mulai dari step 1');
        }

        return view('songs.create-step6');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tuhan_kasihanilah' => 'required|string',
            'kemuliaan' => 'required|string',
            'kudus' => 'required|string',
            'anamnesis' => 'required|string',
            'bapa_kami' => 'required|string',
            'anak_domba_allah' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        // Merge final step data with session data
        $songData = array_merge(session('song_data', []), $request->all());
        $songData['user_id'] = auth()->id();

        Song::create($songData);

        // Clear session data
        session()->forget('song_data');

        return redirect()->route('songs.index')->with('success', 'Lagu berhasil ditambahkan!');
    }

    public function edit(Song $song)
    {
        if (auth()->user()->role !== 'admin' && $song->user_id !== auth()->id()) {
            abort(403);
        }
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        if (auth()->user()->role !== 'admin' && $song->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'nomor_telp' => 'required|string|max:20',
            'tanggal_tugas' => 'required|date',
            'waktu_tugas' => 'required|string',
            'judul_lagu_pembuka' => 'required|string|max:255',
            'sumber_lagu_pembuka' => 'required|string|max:255',
            'teks_lagu_pembuka' => 'required|string',
            'judul_lagu_persembahan' => 'required|string|max:255',
            'sumber_lagu_persembahan' => 'required|string|max:255',
            'teks_lagu_persembahan' => 'required|string',
            'judul_lagu_komuni' => 'required|string|max:255',
            'sumber_lagu_komuni' => 'required|string|max:255',
            'teks_lagu_komuni' => 'required|string',
            'judul_lagu_penutup' => 'required|string|max:255',
            'sumber_lagu_penutup' => 'required|string|max:255',
            'teks_lagu_penutup' => 'required|string',
            'tuhan_kasihanilah' => 'required|string',
            'kemuliaan' => 'required|string',
            'kudus' => 'required|string',
            'anamnesis' => 'required|string',
            'bapa_kami' => 'required|string',
            'anak_domba_allah' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $song->update($request->all());

        return redirect()->route('songs.index')->with('success', 'Lagu berhasil diperbarui!');
    }

    public function updateStatus(Song $song)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $song->update(['status' => 'diterima']);
        return redirect()->back()->with('success', 'Status lagu berhasil diperbarui!');
    }

    public function bahanLagu(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $query = Song::with('user');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('judul_lagu_pembuka', 'like', '%' . $request->search . '%')
                  ->orWhere('judul_lagu_persembahan', 'like', '%' . $request->search . '%')
                  ->orWhere('judul_lagu_komuni', 'like', '%' . $request->search . '%')
                  ->orWhere('judul_lagu_penutup', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_petugas', 'like', '%' . $request->search . '%')
                  ->orWhere('tanggal_tugas', 'like', '%' . $request->search . '%');
            });
        }

        $songs = $query->latest()->paginate(10);
        
        return view('songs.bahan-lagu', compact('songs'));
    }
}
