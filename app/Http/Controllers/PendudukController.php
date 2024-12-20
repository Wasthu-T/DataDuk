<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\statuspenduduk;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Penduduk $pdd)
    {
        $query = $pdd->newQuery()->with('data_status');
        if ($request->user() != null) {
            // Admin dapat mencari berdasarkan NIK atau nama
            if ($request->has('search') && $request->user()->admin == "1") {
                $query->where(function ($q) use ($request) {
                    $q->where('nik', 'like', '%' . $request->search . '%')
                        ->orWhereHas('data_status', function ($query) use ($request) {
                            $query->where('nama', 'like', '%' . $request->search . '%');
                        });
                });
            }
        } else {
            if ($request->has('search')) {
                $query->WhereHas('data_status', function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                });
            }
        }
        $query->orderBy('updated_at', 'desc');

        // $data = $query->firstOrFail();
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
        $data['nama'] = ucwords(strtolower($data['nama']));
        $cleanedLocation1 = str_replace(",", " ", $data['alamat']);
        $cleanedLocation = str_replace("  ", " ", $cleanedLocation1);
        $data['alamat'] = ucwords(strtolower($cleanedLocation)) . ', ' . $data['desa'] . ', ' . $data['kecamatan'] . ', ' . $data['kabupaten'] . ', ' . $data['provinsi'];
        $data['tmp_lahir'] = ucwords(strtolower($data['tmp_lahir']));
        $data['pekerjaan'] = ucwords(strtolower($data['pekerjaan']));

        $pendudukData = collect($data)->only([
            'nik',
            'tmp_lahir',
            'tgl_lahir',
            'jns_kel',
            'gol_d'
        ])->toArray();

        $statusPendudukData = collect($data)->only([
            'nik',
            'nama',
            'alamat',
            'agama',
            'stt_kawin',
            'pekerjaan',
            'kwn'
        ])->toArray();
        Penduduk::create($pendudukData);
        statuspenduduk::create($statusPendudukData);
        return redirect('/dashboard')->with('status', 'Berhasil menambahkan data.');
    }

    public function store_domisili(StorePendudukRequest $request)
    {
        $data = $request->validated();
        $data['nama'] = ucwords(strtolower($data['nama']));
        $cleanedLocation1 = str_replace(",", " ", $data['alamat']);
        $cleanedLocation = str_replace("  ", " ", $cleanedLocation1);
        $data['alamat'] = ucwords(strtolower($cleanedLocation)) . ', ' . $data['desa'] . ', ' . $data['kecamatan'] . ', ' . $data['kabupaten'] . ', ' . $data['provinsi'];
        $data['tmp_lahir'] = ucwords(strtolower($data['tmp_lahir']));
        $data['pekerjaan'] = ucwords(strtolower($data['pekerjaan']));

        $pendudukData = collect($data)->only([
            'nik',
            'tmp_lahir',
            'tgl_lahir',
            'jns_kel',
            'gol_d'
        ])->toArray();

        $statusPendudukData = collect($data)->only([
            'nik',
            'nama',
            'alamat',
            'agama',
            'stt_kawin',
            'pekerjaan',
            'kwn'
        ])->toArray();
        Penduduk::create($pendudukData);
        statuspenduduk::create($statusPendudukData);
        return redirect('/dashboard')->with('status', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view(
            'admin.dashboard.edit',
            [
                "data" => $penduduk,
                "data_status" => $penduduk->data_status
            ]
        );
    }

    public function show_api(statuspenduduk $sttpdd, $nik)
    {
        $penduduk = $sttpdd->where('nik',$nik)->firstOrFail();
        $data = [
            "data" => $penduduk,
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        $data = $request->validated();
        $data['nama'] = ucwords(strtolower($data['nama']));
        $cleanedLocation1 = str_replace(",", " ", $data['alamat']);
        $cleanedLocation = str_replace("  ", " ", $cleanedLocation1);
        $data['alamat'] = ucwords(strtolower($cleanedLocation)) . ', ' . $data['desa'] . ', ' . $data['kecamatan'] . ', ' . $data['kabupaten'] . ', ' . $data['provinsi'];
        $data['tmp_lahir'] = ucwords(strtolower($data['tmp_lahir']));
        $data['pekerjaan'] = ucwords(strtolower($data['pekerjaan']));

        $pendudukData = collect($data)->only([
            'nik',
            'tmp_lahir',
            'tgl_lahir',
            'jns_kel',
            'gol_d'
        ])->toArray();

        $statusPendudukData = collect($data)->only([
            'nik',
            'nama',
            'alamat',
            'agama',
            'stt_kawin',
            'pekerjaan',
            'kwn'
        ])->toArray();
        $penduduk->update($pendudukData);

        $sttpdd = $penduduk->data_status;
        $sttpdd->update($statusPendudukData);
        return redirect('/dashboard')->with('status', 'Berhasil mengubah data.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect('/dashboard')->with('status', 'Data berhasil dihapus.');
    }

    public function chart(Request $request, Penduduk $pdd, statuspenduduk $stt)
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
        $asing = $stt->select(DB::raw('count(*) as total, kwn'))
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
