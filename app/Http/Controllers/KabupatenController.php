<?php

namespace App\Http\Controllers;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Models\Provinsi;


class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $kabupatens = Kabupaten::latest()->paginate(10);
        return view('kabupaten.index', compact('kabupatens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
       $createkabupatens = Provinsi::all(); 
       return view('kabupaten.create', compact('createkabupatens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
          Kabupaten::create([
            'nama' => $request->nama,
            'provinsi_id' => $request->provinsi_id
        ]);
        return redirect()->route('kabupatens.index');
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
        $kabupatens = Kabupaten::findOrFail($id);

        return view('kabupaten.edit', compact('kabupatens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request, [
            'nama'=> 'required'
        ]);

        $kabupatens= Kabupaten::findOrFail($id);
        $kabupatens->update([
            'nama' => $request->nama,
            'provinsi_id' => $request->provinsi_id
        ]);

         return redirect()->route('kabupaten.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kabupaten= Kabupaten::findOrFail($id);
        $kabupaten->delete();
        return redirect()->route('kabupatens.index');
    }
}