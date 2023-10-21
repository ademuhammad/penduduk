<?php

namespace App\Http\Controllers;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $provinsis = Provinsi::latest()->paginate(10);
        return view('provinsi.index', compact('provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        Provinsi::create([
            'nama' => $request->nama
        ]);


         return redirect()->route('provinsis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);

        return view('provinsi.edit', compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $this->validate($request, [
            'nama'=> 'required'
        ]);

        $provinsi= Provinsi::findOrFail($id);
        $provinsi->update([
            'nama' => $request->nama
        ]);

         return redirect()->route('provinsis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $provinsi= Provinsi::findOrFail($id);
        $provinsi->delete();
         return redirect()->route('provinsis.index');
    }
}