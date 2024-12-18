@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/styles_dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('container')
<nav class="navbar justify-content-between p-2" style="background-color: #2F3D40;">
    <a class="navbar-brand text-white" href="#">Dashboard</a>
    <div class="ms-auto d-flex align-items-center">
        <img src="https://via.placeholder.com/40" class="avatar rounded-circle" alt="User Avatar">
        <span class="ms-2 text-white">{{auth()->user()->name}}</span>
    </div>
</nav>
<div class="container">

    <div class="row p-2">
        <div class="col-md-6 col-lg-3 gap-2 col-sm-6">
            <div class="card m-2" style="background: linear-gradient(135deg, #3D5A73, #639ab0);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">TOTAL DATA</h5>
                    <p class="card-text"><span id="total_data"></span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 gap-2 col-sm-6">
            <div class="card m-2" style="background: linear-gradient(135deg, #455559, #769aa8);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Penduduk Tetap</h5>
                    <p class="card-text"><span id="penduduk_tetap"></span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 gap-2 col-sm-6">
            <div class="card m-2" style="background: linear-gradient(135deg, #3D5A73, #639ab0);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Pindahan</h5>
                    <p class="card-text"><span id="pindahan"></span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 gap-2 col-sm-6">
            <div class="card m-2" style="background: linear-gradient(135deg, #455559, #769aa8);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">Tahun Terbanyak</h5>
                    <p class="card-text"><span id="tahun_terbanyak"></span></p>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('status') }} </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card mb-3">
        <select name="tahun" id="tahun" class="form-select" onchange="filterChart()">
            <option value="">Pilih Tahun</option>
            @php
            $currentYear = date('Y');
            $startYear = 2000;
            @endphp
            @for ($year = $startYear; $year <= $currentYear; $year++)
                <option value="{{ $year }}">{{ $year }}</option>
                @endfor
        </select>
    </div>

    <!-- Grafik Persebaran Perpindahan -->
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                <b>Pesebaran Perpindahan</b>
            </div>
            <div class="card-body p-0">
                <div class="chart-container">
                    <canvas id="persebaranPerpindahan"></canvas>
                </div>
            </div>
        </div>
    </div>



    <div class="row pt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <h5 class="mb-3 mb-md-0">Pengelolaan Data Penduduk</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <!-- Tombol Tambah Data -->
                        <a href="/dashboard/tambah" class="btn btn-primary btn-sm flex-grow-1 flex-md-grow-0">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </a>
                        <!-- Tombol Refresh -->
                        <button class="btn btn-success btn-sm flex-grow-1 flex-md-grow-0" onclick="refreshPage()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <!-- Tombol Cetak -->
                        <button class="btn btn-warning btn-sm flex-grow-1 flex-md-grow-0" onclick="printTable()">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>


                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="filtersearchInput" placeholder="Cari data penduduk..." onkeyup="applyFilter()">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-" id="pendudukTable">
                            <thead class="text-center">
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat Asal</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Tanggal Pindah</th>
                                    <th>Alasan Pindah</th>
                                    <th>PDF</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="TablePenduduk">
                                <!-- Data lain -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div>
        <ul class="pagination" id="pagination" class="my-2">
        </ul>
    </div>
</div>


<!-- model -->
<div class="modal fade mt-5" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data dengan nik <span id="deletenik"></span> ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mt-5" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="pdfEmbed" src="" type="application/pdf" width="100%" height="400px" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/domisili.js') }}"></script>
@endsection