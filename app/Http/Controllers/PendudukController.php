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
        // Tambahkan filter untuk admin

        if ($request->user() != null) {
            // Admin dapat mencari berdasarkan NIK atau nama
            if ($request->has('search') && $request->user()->admin == "1") {
                $query->where(function ($q) use ($request) {
                    $q->where('nik', 'like', '%' . $request->search . '%')
                    ->orWhere('nama','like','%'.$request->search.'%');
                       ;
                });
            }
        } else {
            if ($request->has('search')) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            }
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
        return redirect('/dashboard')->with('status', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view('admin.dashboard.edit', ["data" => $penduduk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        $data = $request->validated();
        $data['nama'] = ucwords(strtolower($data['nama']));
        $data['alamat'] = ucwords(strtolower($data['alamat']));
        $data['tmp_lahir'] = ucwords(strtolower($data['tmp_lahir']));
        $data['pekerjaan'] = ucwords(strtolower($data['pekerjaan']));
        $penduduk->update($data);
        return redirect('/dashboard')->with('status', 'Berhasil mengubah data.');
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
        if ($request->has('tahun')) {
            $startYear = $request->tahun;
        } else {
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
