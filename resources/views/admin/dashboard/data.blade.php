@extends('admin.dashboard.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/styles_dashboard.css') }}">
@endsection

@section('container')
<div class="containera">
    <nav class="navbar navbar-expand-lg" style="background-color: #2F3D40;">
        <a class="navbar-brand text-white" href="#">Dashboard</a>
        <div class="ms-auto d-flex align-items-center">
            <img src="https://via.placeholder.com/40" class="avatar rounded-circle" alt="User Avatar">
            <span class="ms-2 text-white">{{auth()->user()->name}}</span>
        </div>
    </nav>
    <div class="row p-3">
        <!-- Total Data -->
        <div class="col-md-3 col-sm-6">
            <div class="card" style="background: linear-gradient(135deg, #3D5A73, #639ab0);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">TOTAL DATA</h5>
                    <p class="card-text"><span id="total_penduduk"></span></p>
                </div>
            </div>
        </div>

        <!-- Average Temperature -->
        <div class="col-md-3 col-sm-6">
            <div class="card" style="background: linear-gradient(135deg, #455559, #769aa8);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">LAKI-LAKI</h5>
                    <p class="card-text"><span id="laki-laki"></span></p>
                </div>
            </div>
        </div>

        <!-- Average Humidity -->
        <div class="col-md-3 col-sm-6">
            <div class="card" style="background: linear-gradient(135deg, #3D5A73, #639ab0);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">PEREMPUAN</h5>
                    <p class="card-text"><span id="perempuan"></span></p>
                </div>
            </div>
        </div>

        <!-- Device Online -->
        <div class="col-md-3 col-sm-6">
            <div class="card" style="background: linear-gradient(135deg, #455559, #769aa8);">
                <div class="card-body text-center text-white">
                    <h5 class="card-title">WNA</h5>
                    <p class="card-text"><span id="wna"></span></p>
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
    <div class="card">
        <div class="mb-3">
            <select name="tahun" id="tahun" class="form-select" onchange="filterChart()">
                <option value="">Pilih Tahun</option>
                @php
                $currentYear = date('Y');
                $startYear = 1970;
                @endphp
                @for ($year = $startYear; $year <= $currentYear; $year++) <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="row">
        <!-- Pendatang Graph -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Persebaran Kelahiran</b>
                </div>
                <div class="card-body">
                    <canvas id="persebaranKelahiran"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Pengelolaan Data Penduduk</h5>
                    <div>
                        <!-- Tombol Tambah Data yang mengarahkan ke halaman lain -->
                        <a href="/dashboard/tambah" class="btn btn-primary me-1">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </a>
                        <!-- Tombol Refresh -->
                        <button class="btn btn-success me-1" onclick="refreshPage()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <!-- Tombol Cetak -->
                        <button class="btn btn-warning me-1" onclick="printTable()">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari data penduduk..." onkeyup="applyFilter()">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-" id="pendudukTable">
                            <thead class="text-center">
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Gol. Darah</th>
                                    <th>Alamat</th>
                                    <th>Agama</th>
                                    <th>Status Perkawinan</th>
                                    <th>Pekerjaan</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="TablePenduduk">
                                <!-- Tambahkan baris lain di sini -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="pagination">
        <!-- Tombol pagination akan diisi di sini -->
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
                Apakah Anda yakin ingin menghapus data dengan kode <span id="deletenik"></span> ini?
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
@endsection

@section('scripts')
<!-- Chart.js CDN for graphs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/penduduk.js') }}"></script>
@endsection