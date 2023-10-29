<?php

namespace App\Http\Controllers;
use App\Models\Penduduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

use App\DataTables\ExportDataTable;




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
    public function index(Request $request)
    {
    
        // return $pendd = Penduduk::with('provinsis')->get();
     if ($request->ajax()) {
        $pendd = Penduduk::with('provinsis');

        if ($request->has('provinsi_id')) {
            $provinsiId = $request->input('provinsi_id');
            $pendd->where('provinsi_id', $provinsiId);
        }
            return DataTables::eloquent($pendd)
            ->addColumn('provinsis', function ($pen) {
                return $pen->provinsis->nama;
            })
            ->addColumn('provinsis',function ($pen) {
                return $pen->provinsis->nama;
            })->addColumn('kabupatens', function ($pen) {
            return $pen->kabupatens->nama; 
        }) ->addColumn('action', function($row){
                 $updateButton = "<a href='" . route('penduduks.edit', $row->id) . "' class='btn btn-sm btn-info'>Edit</a>";
                 $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fas fa-trash'></i> Hapus</button>";
                 return $updateButton." ".$deleteButton;
            }) 
                ->toJson();
        }


    return view('penduduk.index', [
        'provinces' => $this->provinces,
        'districts' => $this->districts,
    ]);
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
            'provinsi_id' => $kabupaten->provinsi_id,
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
    $penduduks = Penduduk::findOrFail($id);
    $provinces = Provinsi::all();
    $districts = Kabupaten::all(); // Define $districts here

    return view('penduduk.edit', compact('penduduks', 'districts', 'provinces'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $this->validate($request, [
            'nama'=>'required',
            'nik'=>'required',
            'jeniskelamin'=>'required',
            'tanggallahir'=>'required',
            'alamat'=>'required',
            
        ]);

        $penduduks = Penduduk::findOrFail($id);
        $penduduks->update([
            'nama'=> $request->nama,
            'nik'=>$request->nik,
            'jeniskelamin'=>$request->jeniskelamin,
            'tanggallahir'=>$request->tanggallahir,
            'alamat'=>$request->alamat,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id
        ]);
        return redirect()->route('penduduks.index');
    }

    public function deletedata(Request $request){


         $id = $request->post('id');

         $datapen = Penduduk::find($id);

         if($datapen->delete()){
             $response['success'] = 1;
             $response['msg'] = 'Delete successfully'; 
         }else{
             $response['success'] = 0;
             $response['msg'] = 'Invalid ID.';
         }

         return response()->json($response); 
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $penduduk = Penduduk::findOrFail($id);
    $penduduk->delete();
    return redirect()->route('penduduks.index')->with('success', 'Penduduk deleted successfully');

    }

    public function getKabupaten($id)
    {
        try {
            $kabupaten = Kabupaten::where('provinsi_id', $id)->pluck('nama', 'id');
            return response()->json($kabupaten);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Mengembalikan pesan error dalam respons JSON
        }
    }


   public function download() 
{
    return Excel::download(new ExportDataTable, 'penduduk.xlsx');
}



}