<?php

namespace App\Http\Controllers;

use App\Models\domisili;
use Illuminate\Http\Request;
use App\Http\Requests\StoredomisiliRequest;
use App\Http\Requests\UpdatedomisiliRequest;
use App\Models\Penduduk;
use App\Models\statuspenduduk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DomisiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Penduduk $pdd)
    {
        $query = $pdd->newQuery()->with(['data_status','domisili'])->whereHas('domisili');
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

    public function chart(Request $request, domisili $dms){
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
        //
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
