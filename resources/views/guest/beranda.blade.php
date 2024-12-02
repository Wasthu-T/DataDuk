@extends('guest.index')

@section('content')
<!-- Carousel -->
<div id="infoCarousel" class="carousel slide mb-4 mt-navbar" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #2F3D40; color: white;">
                <div class="text-center">
                    <i class="fas fa-database fa-3x mb-3"></i>
                    <h3>Efisiensi Pengelolaan Data Penduduk</h3>
                    <p>Mengelola data penduduk secara cepat dan terorganisir.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #3D5A80; color: white;">
                <div class="text-center">
                    <i class="fas fa-shield-alt fa-3x mb-3"></i>
                    <h3>Keakuratan Data Terjamin</h3>
                    <p>Data yang diverifikasi untuk hasil yang akurat.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #2F3D40; color: white;">
                <div class="text-center">
                    <i class="fas fa-user-friends fa-3x mb-3"></i>
                    <h3>Mudah Digunakan</h3>
                    <p>Antarmuka sederhana untuk pengalaman pengguna terbaik.</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#infoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#infoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="card-body">
    <div class="mb-3">
        <input type="text" class="form-control" id="filtersearchInput" placeholder="Cari data penduduk..." onkeyup="applyFilter()">
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="pendudukTable">
            <thead class="text-center">
                <tr>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Gol. Darah</th>
                    <th>Agama</th>
                    <th>Status Perkawinan</th>
                    <th>Pekerjaan</th>
                    <th>Kewarganegaraan</th>
                </tr>
            </thead>
            <tbody id="TablePenduduk">
                <!-- Data lain -->
            </tbody>
        </table>
    </div>

</div>

<div class="container my-5">
    <!-- Paginasi -->
    <div>
        <ul class="pagination" id="pagination" class="my-2">
        </ul>
    </div>
</div>
@endsection

@section('javascripts')
<script src="{{ asset('js/penduduk.js') }}"></script>
@endsection