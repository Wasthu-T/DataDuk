<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Penduduk $pdd)
    {
        $query = $pdd->newQuery();

        // Tambahkan filter berdasarkan query parameter
        if ($request->has('nik')) {
            $query->where('nik', 'like', '%' . $request->nik . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(10);

        // Kembalikan response dengan status 200
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendudukRequest $request)
    {
        $data = $request->validated(); 
        Penduduk::create($data);
        return redirect('/dashboard')->with('status','Berhasil menambahkan data.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view('admin.dashboard.edit', ["data"=>$penduduk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk, UpdatePendudukRequest $request)
    {
        $data = $request->validated();
        $penduduk->update($data);
        return redirect('/dashboard')->with('status','Berhasil mengubah data.');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePendudukRequest $request, Penduduk $pdd)
    // {
    //     $validate = $request->validate();
    //     //return redirect()
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect('/dashboard')->with('status', 'Data berhasil dihapus.');
    }

    public function chart(Request $request, Penduduk $pdd)
    {
        if($request->has('tahun')){
            $startYear = $request->tahun;
        }else{
            $startYear = 1970;
        }
        $endYear = $startYear + 10 - 1;
        $lahir = Penduduk::selectRaw('
        DATE_FORMAT(' . 'tgl_lahir' . ', "%Y") as tahun,
        count(*) as total
        ')
            ->whereYear('tgl_lahir', '>=', $startYear)
            ->whereYear('tgl_lahir', '<=', $endYear)
            ->orderBy('tgl_lahir', 'asc')
            ->groupBy(DB::raw('DATE_FORMAT(' . 'tgl_lahir' . ', "%Y")'))
            ->get();

        $asing = $pdd->select(DB::raw('count(*) as total, kwn'))
            ->groupBy('kwn')
            ->get();
        // $total_gender = $pdd['jns_kel'];

        $gender = $pdd->select(DB::raw('count(*) as total, jns_kel'))
            ->groupBy('jns_kel')
            ->get();

        $data = [
            "data_kelahiran" => [$lahir],
            "kwn" => [$asing],
            "gender" => [$gender],

        ];

        // Kembalikan response dengan status 200
        return response()->json($data, 200);
    }
}
