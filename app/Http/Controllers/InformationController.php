<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::latest()->paginate(10);
        return view('information.index', compact('informations'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('information.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = base64_encode(file_get_contents($image->path()));
        }

        Information::create($data);

        return redirect()->route('information.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function edit(Information $information)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = base64_encode(file_get_contents($image->path()));
        }

        $information->update($data);

        return redirect()->route('information.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    public function destroy(Information $information)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $information->delete();
        return redirect()->route('information.index')->with('success', 'Informasi berhasil dihapus!');
    }
}
