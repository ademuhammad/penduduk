<?php

namespace App\Http\Controllers;
use App\Models\Penduduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;


class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $provinces;
    private $districts;

    public function __construct()
    {
        $this->provinces = Provinsi::all();
        $this->districts = Kabupaten::all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {                
        $penduduks = Penduduk::with('provinsi')->latest()->paginate(10);
        return view('penduduk.index', compact('penduduks'));
        


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $provinces = Provinsi::all();
    $districts = Kabupaten::all();

    return view('penduduk.create', [
        'provinces' => $provinces,
        'districts' => $districts,
        'provinsi_id' => 0,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'nama' => 'required',
        'nik' => 'required',
        'jeniskelamin' => 'required',
        'tanggallahir' => 'required|date',
        'alamat' => 'required',
        'provinsi_id' => 'required',
        'kabupaten_id' => 'required',
        ]);

        $kabupaten = Kabupaten::find($request->kabupaten_id);


        Penduduk::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
            'alamat' => $request->alamat,
'provinsi_id' => $kabupaten->provinsi_id, // Mengambil provinsi_id dari kabupaten terkait
        'kabupaten_id' => $request->kabupaten_id,
        ]);

        return redirect()->route('penduduks.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getKabupaten($id)
    {
    $kabupaten = Kabupaten::where('provinsi_id', $id)->pluck('nama', 'id');
    return response()->json($kabupaten); 
    }

}