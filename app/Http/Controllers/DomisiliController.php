<?php

namespace App\Http\Controllers;

use App\Models\domisili;
use Illuminate\Http\Request;
use App\Http\Requests\StoredomisiliRequest;
use App\Http\Requests\UpdatedomisiliRequest;
use App\Models\Penduduk;
use App\Models\statuspenduduk;
use Illuminate\Support\Facades\DB;

class DomisiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Penduduk $pdd)
    {
        // Mulai query dengan relasi domisili dan data_status
        $query = $pdd->newQuery()->with(['domisili', 'data_status']);

        // Jika user adalah admin, gunakan logika pencarian admin
        if ($request->user() && $request->user()->admin == "1") {
            if ($request->has('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('nik', 'like', '%' . $request->search . '%')
                        ->orWhereHas('data_status', function ($subQuery) use ($request) {
                            $subQuery->where('nama', 'like', '%' . $request->search . '%');
                        });
                });
            }
        }
        // Jika bukan admin, hanya cari berdasarkan nama
        else {
            if ($request->has('search')) {
                $query->whereHas('data_status', function ($subQuery) use ($request) {
                    $subQuery->where('nama', 'like', '%' . $request->search . '%');
                });
            }
        }

        // Tambahkan filter whereHas untuk memastikan ada data domisili
        $query->whereHas('domisili');

        // Urutkan berdasarkan updated_at dari tabel penduduks
        $query->orderBy('penduduks.updated_at', 'desc');

        // Ambil data dengan paginasi
        $data = $query->paginate(10);

        return response()->json($data, 200);
    }

    public function chart(Request $request, domisili $dms)
    {
        if ($request->has('tahun')) {
            $startYear = $request->tahun;
        } else {
            $startYear = 2007;
        }
        $endYear = $startYear + 10 - 1;
        $pindah = domisili::selectRaw('
        DATE_FORMAT(' . 'tanggal_pindah' . ', "%Y") as tahun,
        count(*) as total
        ')
            ->whereYear('tanggal_pindah', '>=', $startYear)
            ->whereYear('tanggal_pindah', '<=', $endYear)
            ->groupBy(DB::raw('DATE_FORMAT(' . 'tanggal_pindah' . ', "%Y")'))
            ->orderBy('tanggal_pindah', 'asc')
            ->get();
        $status = $dms->select(DB::raw('status, count(*) as total'))->groupBy('status')->get();

        $tahun_banyak = domisili::selectRaw('
        DATE_FORMAT(' . 'tanggal_pindah' . ', "%Y") as tahun,
        count(*) as total
        ')
            ->whereYear('tanggal_pindah', '>=', $startYear)
            ->whereYear('tanggal_pindah', '<=', $endYear)
            ->groupBy(DB::raw('DATE_FORMAT(' . 'tanggal_pindah' . ', "%Y")'))
            ->orderBy('total', 'desc')
            ->first();;


        $data = [
            "Pindah" => $pindah,
            "Tahun_Terbanyak" => $tahun_banyak,
            "Status" => $status
        ];

        // Kembalikan response dengan status 200
        return response()->json($data, 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.pindah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredomisiliRequest $request)
    {
        $data = $request->validated();
        $nik = $data['nik'];
        $datapenduduk = statuspenduduk::where('nik', $nik)->first();
        $penduduk = penduduk::where('nik', $nik)->first();
        if (is_null($nik)) {
            return redirect("/dashboard/pindah")->with('error', "Nik Belum Terdaftar.");
        }

        $cleanedLocation1 = str_replace(",", " ", $data['alamat_tujuan']);
        $cleanedLocation = str_replace("  ", " ", $cleanedLocation1);
        $data['alamat_tujuan'] = ucwords(strtolower($cleanedLocation)) . ', ' . $data['desa'] . ', ' . $data['kecamatan'] . ', ' . $data['kabupaten'] . ', ' . $data['provinsi'];

        $domisilipdd = collect($data)->only([
            'nik',
            'alamat_asal',
            'alamat_tujuan',
            'tanggal_pindah',
            'alasan_pindah',
            'status'
        ])->toArray();
        $check_status = $domisilipdd['status'];
        if ($check_status == "tetap") {
            $domisilipdd['status'] = 1;
        } elseif ($check_status == "pindah") {
            $domisilipdd['status'] = 0;
        } else {
            return redirect("/dashboard/pindah")->with('error', "Status tidak valid.");
        }

        if ($request->file('link')) {
            // Ambil file dari request
            $document = $request->file('link');
            // Buat nama file unik
            $filename = 'pdf_' . time() . '_' . $data['nik'] . '.pdf';
            // Tentukan path lengkap
            $directory = 'pdf';
            $path = '/storage/' . $directory . '/' . $filename;
            // Simpan file ke path yang ditentukan
            $document->storeAs($directory, $filename, 'public');
            // Simpan path ke database
            $domisilipdd['link'] = $path;

            domisili::create($domisilipdd);
            $datapenduduk->update(['alamat' => $data['alamat_tujuan']]);
            $datapenduduk->touch();
            $penduduk->touch();
            return redirect('/dashboard/datapindah')->with('status', "Data Berhasil diubah.");
        }
        return redirect("/dashboard/pindah")->with('error', "Harap Isi semua form.");
    }

    /**
     * Display the specified resource.
     */
    public function show(domisili $domisili)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(domisili $domisili)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedomisiliRequest $request, domisili $domisili)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(domisili $domisili)
    {
        //
    }
}
