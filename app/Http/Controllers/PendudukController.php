<?php

namespace App\Http\Controllers;
use App\Models\Penduduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;



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
    // $query = Penduduk::with('provinsi')->latest();

    // if (request()->has('search')) {
    //     $query->where('nama', 'like', '%' . request('search') . '%')
    //           ->orWhere('nik', 'like', '%' . request('search') . '%');
    // }

    // if (request()->has('provinsi')) {
    //     $query->where('provinsi_id', request('provinsi'));
    // }

    // if (request()->has('kabupaten')) {
    //     $query->where('kabupaten_id', request('kabupaten'));
    // }

    // $penduduks = $query->paginate(10)->withQueryString();
    // $kabupatens = Kabupaten::all();
    // $provinsis = Provinsi::all();
    
        // return $pendd = Penduduk::with('provinsis')->get();
     if (request()->ajax()) {
            $pendd = Penduduk::with('provinsis');
            return DataTables::eloquent($pendd)
            ->addColumn('provinsis',function ($pen) {
                return $pen->provinsis->nama;
            })

                ->toJson();
        }

    // return view('penduduk.index', compact('penduduks', 'kabupatens','provinsis'));
    return view('penduduk.index');
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
        $penduduk= Penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->route('penduduks.index');
    }

    public function getKabupaten($id)
    {
    $kabupaten = Kabupaten::where('provinsi_id', $id)->pluck('nama', 'id');
    return response()->json($kabupaten); 
    }

     public function export()
{
    return Excel::download(new PendudukExport, 'users.xlsx');
}
}